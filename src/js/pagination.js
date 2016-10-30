define("platformVideoGallery/platformVideoGallery", ['jquery', 'pubsub', 'backbone', 'handlebars', 'moment'], function($, pubsub) {

    window.platformGalleryCollection = [];

    var platformGalleryPager = function(opt) {

        var c = {
            platformURL: opt.queryUrlWithoutRange,
            queryParam: opt.queryParam,
            currentPage: 0,
            itemsPerPage: 9,
            totalPages: opt.totalResults,
            fadeEffect: Modernizr.opacity,
            effectClass: 'fade-in',
            destUrl: opt.destURL,
            openNew: opt.openNew,
            pageOffSet: opt.pageOffSet,
            afterRender: {}
        }

        window.platformGalleryConfigs ? null : window.platformGalleryConfigs = [];

        platformGalleryConfigs.push(c);

        c = platformGalleryConfigs[platformGalleryConfigs.length - 1];

        //console.log(c);

        var body = $("html,body");
        var thisGallery;
        var $thisPagerUI = $('.list-pagination').eq(platformGalleryConfigs.length - 1);
        var $thisPager = $('.platformPager').eq(platformGalleryConfigs.length - 1);

        var $prevButton = $thisPagerUI.find('.previousPagination');
        var $nextButton = $thisPagerUI.find('.nextPagination');
        var $thisPagerNumbers = $thisPagerUI.find('.pagenumbers');


        var pagerView = Backbone.View.extend({
            initialize: function() {
                this.unBindUI();
                this.bindUI();
                this.afterRender(c);

                thisGallery = this;

                //first page on load:
                //this.render();

            },
            bindUI: function() {

                $prevButton.bind('click', function() {
                    c.currentPage > 0 ? thisGallery.render(c.currentPage - 1, c.pageOffSet) : null;
                });
                $nextButton.bind('click', function() {
                    c.currentPage < c.totalPages - 1 ? thisGallery.render(c.currentPage + 1, c.pageOffSet) : null;
                });

                if (c.currentPage == 0) {
                    $prevButton.removeClass('is-enabled').addClass('is-disabled');
                    $nextButton.removeClass('is-disabled').addClass('is-enabled');
                } else if (c.currentPage < c.totalPages - 1) {
                    $prevButton.removeClass('is-disabled').addClass('is-enabled');
                    $nextButton.removeClass('is-disabled').addClass('is-enabled');
                } else if (c.currentPage == c.totalPages - 1) {
                    $prevButton.removeClass('is-disabled').addClass('is-enabled');
                    $nextButton.removeClass('is-enabled').addClass('is-disabled');
                }

                if (c.totalPages <= 1) {
                    $thisPagerUI.hide();
                }


                var pagesArray = [];
                var visibleRange = 7;

                for (var i = (c.currentPage + 1); i <= (c.currentPage + 1) + Math.floor(visibleRange / 2); i++) {
                    if (i <= c.totalPages)
                        pagesArray.push(i);
                }

                if ((c.currentPage + 1) - Math.floor(visibleRange / 2) >= -1) {
                    pagesArray.unshift(c.currentPage);
                }

                if ((c.currentPage + 1) - Math.floor(visibleRange / 2) >= 0) {
                    pagesArray.unshift(c.currentPage - 1);
                }

                if ((c.currentPage + 1) == 4) {
                    pagesArray.unshift(c.currentPage - 2);
                }

                if (c.currentPage + 1 > 4) {
                    pagesArray.unshift('<span class="firstdots">1</span>');
                }

                if (c.currentPage + 4 < c.totalPages) {
                    pagesArray.pop(pagesArray.length - 1);
                    pagesArray.push('<span class="lastdots">' + c.totalPages + '</span>');
                }


                var pagesHtml = '';

                for (var i = 0; i < pagesArray.length; i++) {
                    // pagesHtml += '<li class="pipeSymbol">&nbsp;|&nbsp;</li>';
                    pagesHtml += '<li class="pn"><a>' + pagesArray[i] + '</a></li>';
                }


                $thisPagerNumbers.html(pagesHtml);


                $.expr[":"].containsExact = function(obj, index, meta, stack) {
                    return (obj.textContent || obj.innerText || $(obj).text() || "") == meta[3];
                };

                $thisPagerNumbers.find('li:containsExact(' + (c.currentPage + 1) + ')').addClass('currentPage');

                $thisPagerNumbers.find('li:not(.pipeSymbol,.ellip)').bind('click', function() {
                    thisGallery.render($(this).text() - 1, c.pageOffSet);
                });

                this.bindThumbs(c.openNew);

            },
            unBindUI: function() {
                $prevButton.unbind();
                $nextButton.unbind();
                $thisPagerNumbers.unbind();

            },
            openLinkType: function(url, openNew) {
                if (openNew == "true") {
                    window.open(url);
                } else {
                    window.location = url;
                }
            },
            
            afterRender: function(c) {
                _.extend(c.afterRender, Backbone.Events);

                c.afterRender.on("afterRender", function() {
                    if (c.fadeEffect) {
                        $thisPager.find('.video-gallery-thumbnail-link.fade-in').each(function(i) {
                            $(this).delay(i * 15).animate({
                                'opacity': 1
                            }, 300);
                        });
                    }
                });

            },
            renderPage: function(that, data, template) {

                //window.debugData = data;

                that.$el.empty();

                //ie location.origin support
                if (!window.location.origin) {
                    window.location.origin = window.location.protocol +
                        "//" + window.location.hostname +
                        (window.location.port ? ':' + window.location.port : '');
                }

                $.each(data.entries, function(i) {

                    var thumbUrl;

                    for (var j = 0; j < data.entries[i].thumbnails.length; j++) {
                        if (data.entries[i].thumbnails[j].width == '350') {
                            thumbUrl = data.entries[i].thumbnails[j].url;
                        } else if (data.entries[i]['defaultThumbnailUrl'] != "") {
                            thumbUrl = data.entries[i]['defaultThumbnailUrl'];
                        } else {
                            thumbUrl = data.entries[i].thumbnails[0].url;
                        }
                    }


                    var splitId = data.entries[i]['id'].split('/');
                    splitId = splitId[splitId.length - 1];
                    if (c.destUrl) {
                        var urlPrefix = location.origin + c.destUrl;
                    } else {
                        var urlPrefix = location.origin + location.pathname;
                    }

                    var context = {
                        title: data.entries[i]['title'],
                        img: thumbUrl,
                        release: data.entries[i].content[0].url,
                        link: urlPrefix + '?vid=' + splitId,
                        id: splitId,
                        date: moment(data.entries[i]['pubDate']).zone('-04:00').format('MMM DD, h:mma').replace('pm', ' pm').replace('am', ' am'),
                        effectClass: c.fadeEffect ? c.effectClass : ''
                    }

                    var html = template(context);
                    that.$el.append(html);

                });

                c.afterRender.trigger("afterRender");

                that.bindUI();

            },
            render: function(page, pageOffSet) {

                this.unBindUI();

                var template = Handlebars.compile($("#platformGalleryPager-template").html());
                var curHeight = $(".list-video-thumbs").outerHeight();

                // Get list-video-thumbs current inner height, and apply that to .loader
                this.$el.html('<div class="loader" style="height: ' + curHeight +'px; background-image: url(/etc/designs/fsdigital/foxsports/styles/src/components/images/platformVideoGalleryLoader.gif);"></div>');

                c.currentPage = page || 0;

                var url = (c.platformURL + "&form=cjson&range=" + ((c.currentPage * c.itemsPerPage) + 1 + parseInt(pageOffSet) ) + "-" + ((c.currentPage * c.itemsPerPage) + c.itemsPerPage + parseInt(pageOffSet)));

                var that = this;

                if ($.browser.msie && parseInt($.browser.version, 10) >= 8 && window.XDomainRequest) {

                    // Use Microsoft XDR
                    var xdr = new XDomainRequest();

                    function xdrLoaded() {
                        var data = xdr.responseText;
                        data = $.parseJSON(data);
                        that.renderPage(that, data, template);
                    }

                    if (xdr) {
                        xdr.onload = xdrLoaded;
                    }

                    if ($.browser.msie && parseInt($.browser.version, 10) >= 9) {
                        xdr.onprogress = function() {};
                    }

                    xdr.open("get", url);
                    xdr.send();

                } else {

                    $.getJSON(url, {})
                        .done(function(data) {
                            that.renderPage(that, data, template);
                        });

                }

            }

        });


        platformGalleryCollection.push(new pagerView({
            el: $(".list-video-thumbs").eq(platformGalleryConfigs.length - 1)
        }));


    }


    return {
        init: function(options) {

            console.log('platform gallery created.');

            platformGalleryPager(options.platformVideoGalleryConfig);


            // destroy instances on transition

            window.onpopstate = function(e) {
                window.platformGalleryCollection = [];
                window.platformGalleryConfigs = [];
            };

            pubsub.on("page:load", function(PageData) {
                window.platformGalleryCollection = [];
                window.platformGalleryConfigs = [];
            });



        }

    }



});