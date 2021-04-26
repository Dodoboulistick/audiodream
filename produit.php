<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

require("varSession.inc.php");
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <link rel="shortcut icon" type="image/x-icon" href="img/accueil/favicon.ico">
        <title>Produits - AudioDream</title>
    </head>

    <body>
        <!-- Haut de page (header) -->
        <?php require("php/header.php"); ?>

        <!-- Affichage des produits --> 
        <section class="shop">
            <div class="container">
                <!-- Affichage de la catégorie -->
                <h1>Nos <?php echo $categorie; ?></h1>

                <div class="divider"></div>

                <?php
                    //$produit est une requete de bdd.php
                    //initialisation du compteur, puis affichage des produits 1 à 1
                    $i=0;
                    while ($produit = $reponse->fetch()){
                        if($i%2 == 0){?>
                            <div class="row justify-content-evenly">
                            <!-- Premier produit de la row -->
                                <div class="col-lg-4">
                                    <div class="carte">
                                        <div class="carte-img">
                                            <!-- Categorie porte le nom de la catégorie dans la variable de session via GET
                                            $_SESSION["$categorie"] est le tableau importé de json qui porte un tableau de produits de ladite catégorie -->
                                            <img class="img-zoom" src="img/<?php echo $categorie ?>/<?php echo $produit['img']; ?>" />
                                        </div>
                                        <div class="carte-text">
                                            <h2 class="my-4"><?php echo $produit['nomP']; ?></h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec condimentum, elit eu maximus varius, urna nisi consequat quam, fermentum commodo urna mauris vel purus. Donec sed aliquam nunc, nec semper libero.</p>
                                            <p class="prix fw-bold fst-italic">Prix : <?php echo $produit['prix']; ?> €</p>
                                            <div class="scriptCommande cache">
                                                <p class="qte">Restants :<span class="mx-2 restant"><?= $produit['stock']; ?></span></p><br>
                                                <span class="maCommande">
                                                    <p>Ma commande :<span class="nbCommande mx-2">0</span></p>
                                                    <a href="#" class="btn btn-sm btn-outline-danger moins disabled"> - </a>
                                                    <a href="#" class="btn btn-sm btn-outline-danger plus">+</a>
                                                </span>
                                            </div>
                                            <div class="button-group">
                                                <a href="#" class="empty-btn stock">Stock</a>
                                                <a class="full-btn ajouterpanier" href="#" id="<?= $produit['idProduit']; ?>">Ajouter au panier</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php } else { ?>
                            <!-- Second produit de la row -->
                                <div class="col-lg-4">
                                    <div class="carte">
                                        <div class="carte-img">
                                            <img class="img-zoom" src="img/<?php echo $categorie ?>/<?php echo $produit['img']; ?>" />
                                        </div>
                                        <div class="carte-text">
                                            <h2 class="my-4"><?php echo $produit['nomP']; ?></h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec condimentum, elit eu maximus varius, urna nisi consequat quam, fermentum commodo urna mauris vel purus. Donec sed aliquam nunc, nec semper libero.</p>
                                            <p class="prix fw-bold fst-italic">Prix : <?php echo $produit['prix']; ?> €</p>
                                            <div class="scriptCommande cache">
                                                <p class="qte">Restants :<span class="mx-2 restant"><?= $produit['stock']; ?></span></p><br>
                                                <span class="maCommande">
                                                    <p>Ma commande :<span class="nbCommande mx-2">0</span></p>
                                                    <a href="#" class="btn btn-sm btn-outline-danger moins disabled"> - </a>
                                                    <a href="#" class="btn btn-sm btn-outline-danger plus">+</a>
                                                </span>
                                            </div>
                                            <div class="button-group">
                                                <a href="#" class="empty-btn stock">Stock</a>
                                                <a class="full-btn ajouterpanier" href="#" id="<?= $produit['idProduit']; ?>">Ajouter au panier</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    $i++;
                }
                $reponse->closeCursor();
                ?>
            </div>
        </section>

        <!-- Pied de page (footer) -->
        <?php require("php/footer.php"); 
            Database::disconnect();
        ?>
    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js" ></script>
    <script type="text/javascript" src="js/stock.js" ></script>
</html>