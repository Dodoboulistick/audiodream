<?php

require("bdd.php");

//Vérification de l'action en cours (pour ajax)
if(isset($_POST['action'])){
   switch($_POST['action']){
      case 'ajouter': 
         ajouterArticle($_POST["idProduit"],$_POST["quantiteProduit"]);
         break;
      case 'supprimer': 
         supprimerArticle($_POST["idProduit"]);
         break;
      case 'envoyer': 
         supprimerCommande();
         break;
      default: 
         break;
   } 
}

function ajouterArticle($idProd,$qteP){
   $bdd = Database::connect();
   //Si le produit existe déjà on ajoute seulement la quantité

   //Comptage des produits déjà dans la commande
   $reqProduit = "SELECT count(*),quantite FROM appartenir WHERE idCommande=1 AND idProduit=$idProd";
   $reponseProduit = $bdd->query($reqProduit);
   $fetchProduit = $reponseProduit->fetch();
   $reponseProduit->closeCursor();

   //Check de la quantité des produits dans le stock des produits
   $checkQte = "SELECT stock FROM produit WHERE idProduit=$idProd";
   $reponseCheck = $bdd->query($checkQte); 
   $fetchQte = $reponseCheck->fetch();
   $reponseCheck->closeCursor();

   //Calcul des quantités
   $nbProduit = (int)$fetchProduit['count(*)'];
   $nbProduitDejaStock = (int)$fetchProduit['quantite'];
   $qteProduit = (int)$fetchQte['stock'];
   $nouvelleQuantiteAchat = (int)($nbProduitDejaStock + $qteP);
   $nouvelleQuantiteStock = (int)($qteProduit - $qteP);

   //Vérifications
   if((!($nouvelleQuantiteStock < 0)) && ($qteP > 0)){
      if ($nbProduit == 0){//si le produit n'y est pas
         $siqueryProduit = "INSERT INTO appartenir VALUES (1,$idProd,$qteP)";
         $bdd->exec($siqueryProduit);
         $bdd->exec("UPDATE produit SET stock=$nouvelleQuantiteStock WHERE idProduit=$idProd");
      }else{
         //Sinon on modifie
         $sinonqueryProduit = "UPDATE appartenir SET quantite=$nouvelleQuantiteAchat WHERE idCommande=1 AND idProduit=$idProd";
         $bdd->exec($sinonqueryProduit);
         $bdd->exec("UPDATE produit SET stock=$nouvelleQuantiteStock WHERE idProduit=$idProd");
      }
   } else {
      die("Une erreur est survenue.");
   }
   //déconnexion
   Database::disconnect();
}

function supprimerArticle($idProd){
   $bdd = Database::connect();

   //Comptage des produits déjà dans la commande
   $reqProduit = "SELECT quantite FROM appartenir WHERE idCommande=1 AND idProduit=$idProd";
   $reponseProduit = $bdd->query($reqProduit);
   $fetchProduit = $reponseProduit->fetch();
   $reponseProduit->closeCursor();
   $quantiteCommande = (int)$fetchProduit['quantite'];

   //Comptage des stocks dans produit
   $reqStock = "SELECT stock,prix FROM produit WHERE idProduit=$idProd";
   $reponseStock = $bdd->query($reqStock);
   $fetchStock = $reponseStock->fetch();
   $reponseStock->closeCursor();
   $quantiteProduit = (int)$fetchStock['stock'];

   $nouveauStockProduit = $quantiteCommande + $quantiteProduit;

   //suppression du produit dans la commande
   $queryProduit = "DELETE FROM appartenir WHERE idCommande=1 AND idProduit=$idProd";
   $bdd->exec($queryProduit);
   //mais rajout de la quantité dans les produits (il faut bien les reposer quand même!)
   $bdd->exec("UPDATE produit SET stock=$nouveauStockProduit WHERE idProduit=$idProd");

   //données à récupérer dans l'ajax pour mettre a jour le prix total/nb d'article en direct
   $prix = floatval($fetchStock['prix'])*$quantiteCommande;
   $result = array($quantiteCommande,$prix);
   $resultat = json_encode($result);
   echo $resultat;

   Database::disconnect();
}

function supprimerCommande(){
   $bdd = Database::connect();
   //suppression de tous les produits dans la commande
   $querySuppr = "DELETE FROM appartenir WHERE idCommande=1";
   $bdd->exec($querySuppr);
   Database::disconnect();
}


?>