<?php
session_start();
    require("varSession.inc.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="shortcut icon" type="image/x-icon" href="img/accueil/favicon.ico">
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
            <table>
                <tr>
                    <th>Libellé</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Prix Total</th>
                    <th>Supprimer</th>
                </tr>

                <?php
                    $reponse = $bdd->query('SELECT nom, quantite, prix 
                    FROM Produit p, Appartenir a
                    WHERE a.idProduit = p.idProduit AND idCommande=1;');
                    while ($donnees = $reponse->fetch()){
                        echo "<tr>";
                        echo "<td>".$donnees['nom']."</ td>";
                        echo "<td>".$donnees['quantite']."</td>";
                        echo "<td>".$donnees['prix']." &euro;</td>";
                        echo "<td>".$donnees['prix']*$donnees['quantite']." &euro;</td>";
                        echo "<td><a>Retirer</a></td>";
                        echo "</tr>";
                    }
                    echo "<tr><td colspan=\"4\">";
                    echo "</td></tr>";
                    
                
                ?>
            </table>
            <div class="text-center">
            <p class="total">Prix total :  &euro; </p>
            <p class="total">Nombre d'article(s) :  </p>
            </div>
        </div>
    </div>

    
    <?php 
    if(isset($_SESSION["isConnected"])){?>
        <div class="container">
        <div class="divider"></div>
        <p class="text-center"><a href="logout.php" class="btn btn-danger my-5 text-center">Se déconnecter</a></p>
    </div>
    <?php } ?>
    
    <!-- Pied de page (footer) -->
    <?php require("php/footer.php"); ?>

    <script type="text/javascript" src="js/script.js" ></script>
</body>
</html>