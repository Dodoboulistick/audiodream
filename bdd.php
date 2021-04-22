<?php
//DATA BDD
require('bddData.php');

//CONNEXION BDD
$dsn="mysql:dbname=".BASE.";host=".SERVER;
try{
    $bdd=new PDO($dsn,USER,PASSWD,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(PDOException $e){
    printf("Échec de la connexion : %s\n", $e->getMessage());
    exit();
}

//REQUETES USER
$queryUser = "SELECT mail,motDePasse FROM utilisateur";
$reponseUser = $bdd->query($queryUser);

//REQUETES CATEGORIES
$queryCategories = "SELECT nom FROM categorie";
$listeCategories= array();
$reponseCategories = $bdd->query($queryCategories);
while ($cat = $reponseCategories->fetch()){
    array_push($listeCategories, $cat['nom']);
};
$reponseCategories->closeCursor();

//REQUETES PRODUITS
$queryProduit = "SELECT * FROM produit WHERE idCat=(
    SELECT idCat FROM categorie WHERE nom=:nomCategorie
)";
$reponse = $bdd->prepare($queryProduit);
$reponse->bindParam(':nomCategorie', $categorie);
$reponse->execute();
?>