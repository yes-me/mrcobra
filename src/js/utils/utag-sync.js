import ScriptLoader from './ScriptLoader';

let fsUtils = new FsUtils ();

export class UtagSync {

    constructor () {
        this.scriptLoaded = false;
    }

    //getter for scriptLoaded
    isScriptLoaded () {
        return this.scriptLoaded;
    }

    //setter for scriptLoaded
    setScriptLoaded (value) {
        this.scriptLoaded = value;
    }


    //return jSON object for metadata
    getMetadata () {

        let elm = document.getElementById('page-information');

        if(elm !== null) {
            let metaText = (elm.innerText || elm.textContent || "");

            if(metaText) {
                return JSON.parse(metaText);
            }
        }

        return null;

    }

    //get utag sync script url from metadata
    getUtagSyncUrl () {
        var url = '';
        var that = this;
        var	metaObj = this.getMetadata();

        if(metaObj) {
            var analytics = metaObj.analytics;
            if (analytics !== null) {
                url = (analytics.urlSync)? analytics.urlSync: "";
            }
        }

        return url;

    }

    //get utag sync script url from metadata and inject it into DOM
    init () {

        let url = this.getUtagSyncUrl();

        if ( url && !this.scriptLoaded) {
            fsUtils.getScript(url, this.setScriptLoaded(true));  //load the script asynchronously
            //fsUtils.getScript(url, this.setScriptLoaded(true), false); //load the script synchronously
        }

    }

}

