import ScriptLoader from './utils/ScriptLoader';

class GoogleMap {

    constructor() {
        this.scriptLoader = new ScriptLoader();

        this.loadGoogleJS();


    }

    callbackOnLoadScript() {
        this.scriptLoader.setScriptLoaded(this.scriptLoader.scriptLoadObj.googlemap);
        this.init_map();
    }

    loadGoogleJS() {

        if ( !this.scriptLoader.scriptLoadObj.googlemap) {
            this.scriptLoader.getScript('https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDld3Pfw_Mgdqg1chl7QI-V6gnNLamBChU', this.callbackOnLoadScript.bind(this), true);  //load the script asynchronously
        }
    }

    init_map(){
        var myOptions = {
            zoom:8,
            center:new google.maps.LatLng(34.2068182,-118.20002770000002),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);

        var marker = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(34.2068182,-118.20002770000002)
        });

        var infowindow = new google.maps.InfoWindow({
            content:'<strong></strong><br><br> La Cañada Flintridge, CA, USA<br>'
        });

        google.maps.event.addListener(marker, 'click', function(){
            infowindow.open(map,marker);
        });

        //infowindow.open(map,marker);
    }
}

export default GoogleMap;