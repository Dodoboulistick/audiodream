<?php 
session_start();
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
    <title>Audio Dream</title>
</head>

<body>
    <!-- Haut de page (header) -->
    <?php require("php/header.php"); ?>
    
    <!-- Partie principale -->
    <section id="hero">
        <div class="container">
            <div class="row align-items-center justify-content-evenly">
                <div class="col-lg-4 order-lg-2">
                    <p><img id="logo" src="img/accueil/logo-accueil.png "/></p>
                </div>
                <div class="col-lg-6 order-lg-1 text-center text-lg-start">
                    <h2>Unique &amp; innovant</h2>
                    <h1 class="mb-5">Le son parfait<br/>à portée de main.</h1>
                    <div class="mx-5">
                        <a href="#" class="decouvrir">Découvrir</a>
                        <a href="#" class="soutenir">Soutenir</a>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pied de page (footer) -->
    <?php require("php/footer.php"); ?>

    <script type="text/javascript" src="js/script.js" ></script>
</body>
</html>
