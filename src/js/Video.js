class Video {

    constructor() {
        this.videoHeight = '';
        this.videoWidth = '';
        this.videoUrl = '';
        this.videoElm = '.video-embed';

        this.addClickListeners();
    }

    setVideoW(v) {
        this.videoWidth = v;
    }

    getVideoW() {
        return this.videoWidth;
    }

    setVideoH(v) {
        this.videoHeight = v;
    }

    getVideoH() {
        return this.videoHeight;
    }

    setVideoUrl(v) {
        this.videoUrl = v;
    }

    getVideoUrl() {
        return this.videoUrl;
    }

    prepareFrame(src) {

        var playerHolder = document.getElementById('video-player-overlay');
        playerHolder.innerHTML = '<iframe id="video-embed" class="video-embed" width="1024" height="600" src="' + src + '" frameborder="0" allowfullscreen/>';
        playerHolder.style.display = "block";
        playerHolder.scrollIntoView();

        playerHolder.onclick = () => {
            playerHolder.style.display = "none";
            playerHolder.innerHTML = '';
        };



        //document.addEventListener("click", () => {
        //    playerHolder.style.display = "none";
        //});

    }

    showOverlayPlayer (event) {

        event.preventDefault();
        var elem = event.currentTarget;

        //var videoIframe = elem.querySelector('.video-iframe');
        //var videoUrl = videoIframe.getAttribute('data-video-src');

        var videoUrl = elem.getAttribute('data-video-src');


        this.prepareFrame(videoUrl);

        console.log("videoUrl: ", videoUrl);
        console.log("event.currentTarget: ", event.currentTarget);
    }

    addClickListeners () {
        let videos = document.querySelectorAll(this.videoElm);
        let count = videos.length;

        for (let i = 0; i < count; i += 1) {
            videos[i].addEventListener('click', this.showOverlayPlayer.bind(this));
        }
    }
}


export default Video;

