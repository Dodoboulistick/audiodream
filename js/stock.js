var getHttpRequest = function (){
    if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+...
        httpRequest = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) { // IE 6 et antérieurs
        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
    }

    return httpRequest;
};


//récupération des variables nécessaire dans produit.php
const liens = Array.from(document.querySelectorAll('.ajouterpanier'));
const idLiens = links.map(function(o){
    return parseInt(o.id);
});


for(i=0;i<links.length;i++){
    const lien = liens[i];
    lien.addEventListener('click', function(e){
        e.preventDefault();
        const httpRequest = getHttpRequest();
        httpRequest.onreadystatechange = function(){
            if(httpRequest.readyState === 4){

            }
        }
        httpRequest.open('POST','php/fonctionPanier.php', true);
        httpRequest.send();
    })
}




