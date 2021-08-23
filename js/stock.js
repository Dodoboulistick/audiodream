$(function(){
    $('.ajouterpanier').on("click", function(e) {
        e.preventDefault();
        const cheminRestant = e.target.parentNode.previousSibling.previousSibling.childNodes[1].childNodes[1];
        const cheminCommande = e.target.parentNode.previousSibling.previousSibling.childNodes[4].childNodes[1].childNodes[1];
        const restant = parseInt(cheminRestant.innerHTML);
        const commande = parseInt(cheminCommande.innerHTML);
        if((restant-commande) >= 0){
            $.ajax({
                type: "POST",
                url: "fonctionPanier.php",
                data: { 
                    action: "ajouter",
                    idProduit: e.target.id,
                    quantiteProduit: commande
                  }
              }).done(function() {
                cheminRestant.textContent = restant - commande;
                cheminCommande.textContent = 0;
              });
        } else {
            alert("Votre commande dépasse le stock actuel sur ce produit.");
        }
    });


    $('.supprimerProduit').on("click", function(e) {
        e.preventDefault();
        const chemin = e.target.parentNode.parentNode;
            $.ajax({
                type: "POST",
                url: "fonctionPanier.php",
                data: { 
                    action: "supprimer",
                    idProduit: e.target.id,
                    }
                }).done(function(data) {
                    const result = JSON.parse(data);
                    //récupération des valeurs totales du panier
                    const prixtot = document.querySelector(".panierPrixTotal");
                    const qtetot = document.querySelector(".panierQteTotal");

                    //soustraction quand l'utilsateur supprime un produit
                    prixtot.textContent = parseFloat(parseFloat(prixtot.innerHTML) - result[1]).toFixed(2);
                    qtetot.textContent = parseInt(parseInt(qtetot.innerHTML) - result[0]);
                    chemin.remove();
                });
        });


        $('.finaliserCommande').on("click", function(e) {
            e.preventDefault();
            const chemin = e.target.parentNode.parentNode;
            alert("Merci pour votre commande! Vous allez être redirigé vers l'accueil.");
            $(location).attr("href","index.php");
                $.ajax({
                    type: "POST",
                    url: "fonctionPanier.php",
                    data: { 
                        action: "envoyer"
                        }
                    }).done(function() {
                        alert("Merci pour votre commande! Vous allez être redirigé vers l'accueil.");
                        $(location).attr("href","index.php");
                    });
            }); 
});


