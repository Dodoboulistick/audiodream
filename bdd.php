<?php
//DATA BDD
require('bddData.php');

//CONNEXION BDD
class Database {
    private static $dbHost = SERVER;
    private static $dbName = BASE;
    private static $dbUser = USER;
    private static $dbUserPassword = PASSWD;
    private static $connexion = null;

    public static function connect(){
        try{
            self::$connexion = new PDO("mysql:host=". self::$dbHost . ";dbname=" . self::$dbName,self::$dbUser,self::$dbUserPassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }catch(PDOException $e) {
            die($e->getMessage);
        }
        return self::$connexion;
    }
    
    public static function disconnect(){
        self::$connexion = null;
    }
}

$bdd = Database::connect();

//REQUETES USER
$queryUser = "SELECT mail,motDePasse FROM ad_utilisateur";
$reponseUser = $bdd->query($queryUser);

//REQUETES CATEGORIES
$queryCategories = "SELECT nom FROM ad_categorie";
$listeCategories= array();
$reponseCategories = $bdd->query($queryCategories);
while ($cat = $reponseCategories->fetch()){
    array_push($listeCategories, $cat['nom']);
};
$reponseCategories->closeCursor();

//REQUETES PRODUITS
$queryProduit = "SELECT * FROM ad_produit WHERE idCat=(
    SELECT idCat FROM ad_categorie WHERE nom=:nomCategorie
)";
$reponse = $bdd->prepare($queryProduit);
$reponse->bindParam(':nomCategorie', $categorie);
$reponse->execute();

?>