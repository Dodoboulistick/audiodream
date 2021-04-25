<?php
    //récupération de l'url, sécurisée
    $categorie = htmlspecialchars($_GET['cat']);
    $categorie = stripslashes($categorie);
    $categorie = trim($categorie);
    
    //connexion a la bdd
    require('bdd.php');

    //on vérifie que la catégorie est légitime
    if (!in_array($categorie,$listeCategories)){
        //on redirige vers l'accueil
        header('Location: index.php');
    }
?>