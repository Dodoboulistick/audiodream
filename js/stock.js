var getHttpRequest = function (){
    if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+...
        httpRequest = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) { // IE 6 et antérieurs
        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
    }

    return httpRequest;
};

const httpRequest = getHttpRequest();

httpRequest 