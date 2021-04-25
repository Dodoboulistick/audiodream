<?php

require("bdd.php");

function ajouterArticle($idProd,$qteProduit){
   //Si le produit existe déjà on ajoute seulement la quantité
   $queryProduit = "SELECT count(*) FROM Appartenir WHERE idCommande=1 AND idProduit=$idProd";
   $reponseProduit = $bdd->query($queryProduit);
   if ($$reponseProduit == 0){//si le produit n'y est pas
      $queryProduit = "INSERT INTO appartenir $idProd";
      $reponseProduit = $bdd->query($queryProduit);
   }else{
      //Sinon on ajoute le produit
      array_push( $_SESSION['panier']['libelleProduit'],$libelleProduit);
      array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
      array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
   }

}

function supprimerArticle($libelleProduit){
   //Si le panier existe
   if (creationPanier()){
      //Nous allons passer par un panier temporaire
      $tmp=array();
      $tmp['libelleProduit'] = array();
      $tmp['qteProduit'] = array();
      $tmp['prixProduit'] = array();
 
      for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++){
         if ($_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit){
            array_push( $tmp['libelleProduit'],$_SESSION['panier']['libelleProduit'][$i]);
            array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
            array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
         }
      }
      //On remplace le panier en session par notre panier temporaire à jour
      $_SESSION['panier'] =  $tmp;
      //On efface notre panier temporaire
      unset($tmp);
   }else{
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
   }
}


?>