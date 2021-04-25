<?php

require("bdd.php");

function ajouterArticle($idProd,$qteP){
   //Si le produit existe déjà on ajoute seulement la quantité
   $queryProduit = "SELECT count(*) FROM appartenir WHERE idCommande=1 AND idProduit=$idProd";
   $reponseProduit = $bdd->query($queryProduit);
   if ($$reponseProduit == 0){//si le produit n'y est pas
      $queryProduit = "INSERT INTO appartenir VALUES (1,$idProd,$qteP)";
      $reponseProduit = $bdd->query($queryProduit);
   }else{
      //Sinon on modifie
      $queryProduit = "UPDATE INTO appartenir SET quantite=$qteP WHERE idCommande=1 AND idProduit=$idProd";
      $reponseProduit = $bdd->query($queryProduit);
   }

}

function supprimerArticle($libelleProduit){
   $queryProduit = "DELETE FROM appartenir WHERE idCommande=1 AND idProduit=$idProd";
   $reponseProduit = $bdd->query($queryProduit);
}


?>