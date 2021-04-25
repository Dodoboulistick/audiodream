<?php
session_start();
require("php/fonctionPanier.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="img/accueil/favicon.ico">
    <link rel="stylesheet" href="css/style.css" />
    <title>Audio Dream - Panier</title>
</head>

<body>
    <!-- Haut de page (header) -->
    <?php require("php/header.php"); ?>
    
    <!-- Partie principale -->
    
    <div class="container shop">
        <h1>Mon panier</h1>
        <div class="divider"></div>
        <div class="row justify-content-evenly">
            <table class="table table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Libellé</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Prix Unitaire</th>
                        <th scope="col">Prix Total</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                    $reponse = $bdd->query('SELECT nomP, quantite, prix 
                    FROM produit p, appartenir a
                    WHERE a.idProduit = p.idProduit AND idCommande=1;');
                    $nbArticles = 0;
                    $prixTotal = 0;
                    $cpt = 1;
                    while ($donnees = $reponse->fetch()){
                        ?>
                        <tr>
                            <th scope="<?= $cpt ?>"><?= $cpt ?></th>
                            <td><?=$donnees['nomP']?></td>
                            <td><?=$donnees['quantite']?></td>
                            <td><?=$donnees['prix']?> &euro;</td>
                            <td><?=$donnees['prix']*$donnees['quantite']?> &euro;</td>
                            <td><a>Retirer</a></td>
                        </tr>
                    <?php 
                    $cpt++;
                    $nbArticles += $donnees['quantite'];
                    $prixTotal += $donnees['prix']*$donnees['quantite'];
                    }
                    ?>
                </tbody>
            </table>

            <div class="text-center">
            <p class="total">Prix total : <?= $prixTotal ?> &euro; </p>
            <p class="total">Nombre d'article(s) : <?= $nbArticles ?>  </p>
            </div>
        </div>
    </div>

    
    <?php 
    if(isset($_SESSION["isConnected"])){?>
        <div class="container">
        <div class="divider"></div>
        <p class="text-center"><a href="#" class="btn btn-lg btn-danger my-5 text-center">Finaliser la commande</a></p>
        <p class="text-center"><a href="logout.php" class="btn btn-secondary my-5 text-center">Se déconnecter</a></p>
    </div>
    <?php } ?>
    
    <!-- Pied de page (footer) -->
    <?php require("php/footer.php"); ?>

    <script type="text/javascript" src="js/script.js" ></script>
</body>
</html>