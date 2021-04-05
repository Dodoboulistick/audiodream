<?php

$url="application/donnees_produits.json";
$json = file_get_contents($url);
$produits = json_decode($json, true);
$listeArticle = array();
$categories = array ('casques', 'ecouteurs', 'enceintes', 'hifi');
foreach($categories as $element){
   for($i=0;$i<sizeof($produits['categorie'][0][$element]);$i ++){
      array_push($listeArticle,$produits['categorie'][0][$element][$i]['nom']);
   }
}

function creationPanier(){
   if (!isset($_SESSION['panier'])){
      $_SESSION['panier']=array();
      $_SESSION['panier']['libelleProduit'] = array();
      $_SESSION['panier']['qteProduit'] = array();
      $_SESSION['panier']['prixProduit'] = array();
   }
   return true;
}

function existeArticle($nom){
   global $listeArticle;
   $est = false;
   foreach($listeArticle as $article){
      if($nom == $article){
         $est = true;
      }
   }
   return($est);
}


function ajouterArticle($libelleProduit,$qteProduit,$prixProduit){
    //Si le panier existe
   if (creationPanier()){
      //Si le produit existe déjà on ajoute seulement la quantité
      $positionProduit = array_search($libelleProduit, $_SESSION['panier']['libelleProduit']);
      if (existeArticle($libelleProduit)){
         if ($positionProduit > -1){
            $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
         }else{
            //Sinon on ajoute le produit
            array_push( $_SESSION['panier']['libelleProduit'],$libelleProduit);
            array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
            array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
         }
      }
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

function MontantGlobal(){
   $total=0;
   for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++){
      $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
   }
   return $total;
}

function QuantiteGlobal(){
   $qtTotal=0;
   for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++){
      $qtTotal += $_SESSION['panier']['qteProduit'][$i];
   }
   return $qtTotal;
}

function compterArticles(){
   if (isset($_SESSION['panier'])){
      return count($_SESSION['panier']['libelleProduit']);
   }else{
      return 0;
   }
}

function supprimePanier(){
   unset($_SESSION['panier']);
}

?>