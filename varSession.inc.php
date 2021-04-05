<?php
    //récupération des données depuis le fichiers json
    $url="application/donnees_produits.json";
    $json = file_get_contents($url);
    $produits = json_decode($json, true);

    //récupération de l'url 
    $categorie = htmlspecialchars($_GET['cat']);

    //on vérifie que la catégorie est légitime
    if (array_key_exists($categorie,$produits["categorie"][0])){
        //Tri des produits selon leurs catégories, puis initialisation des variables de session
        $_SESSION["$categorie"] = $produits["categorie"][0]["$categorie"];
    } else {
        //Sinon, on redirige vers l'accueil
        header('Location: index.php');
    }

?>