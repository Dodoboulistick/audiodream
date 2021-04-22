<?php
    //connexion à la bdd
    require('bdd.php');

    //récupération des données depuis la bdd

    //récupération des catégories -> on stocke dans un tableau, ce qui nous permet de vérifier que 
    //la catégorie récupérée par GET est légitime
    $queryCategories = "SELECT nom FROM categorie";
    $listeCategories= array();
    $reponseCategories = $bdd->query($queryCategories);
    while ($cat = $reponseCategories->fetch()){
        array_push($listeCategories, $cat['nom']);
    };
    $reponseCategories->closeCursor();

    //récupération de l'url, sécurisée
    $categorie = htmlspecialchars($_GET['cat']);
    $categorie = stripslashes($categorie);
    $categorie = htmlspecialchars($categorie);

    //on vérifie que la catégorie est légitime
    if (!in_array($categorie,$listeCategories)){
        //on redirige vers l'accueil
        header('Location: index.php');
    }
?>