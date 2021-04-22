<?php

require('bddData.php');

$dsn="mysql:dbname=".BASE.";host=".SERVER;
try{
    $bdd=new PDO($dsn,USER,PASSWD,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(PDOException $e){
    printf("Échec de la connexion : %s\n", $e->getMessage());
    exit();
}

?>