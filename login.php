<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

//récupération de la liste des membres depuis la bdd
require('bdd.php');

if(isset($_SESSION["isConnected"])){
  header('Location: produit.php');
} else {
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //récupération des données du form
    $email = verifyInput($_POST["signin_mail"]);
    $mot_de_passe = verifyInput($_POST["signin_mdp"]);

    //vérification des données
    while ($usr = $reponseUser->fetch()){
      if ($email == $usr['mail'] && $mot_de_passe == $usr['motDePasse']){
        $_SESSION["utilisateur"] = $value["pseudo"];
        $_SESSION["isConnected"] = true;
        header('Location: produit.php');
      } 
    }
  }
}
$reponseUser->closeCursor();


function verifyInput($var){
  $var = trim($var);
  $var = stripslashes($var);
  $var = htmlspecialchars($var);
  return $var;
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Se connecter</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/accueil/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Ceci est un thème bootstrap -->
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
    <main class="form-signin">
      <form method="post">
        <a href="index.php"><img class="mb-4" src="img/accueil/logo-accueil.png" alt="" width="72" height="57"></a>
        <h1 class="h3 mb-3 fw-bold">Connectez-vous</h1>

        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInput" placeholder="nom@exemple.com" name="signin_mail">
          <label for="floatingInput">Adresse mail</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Mot de passe" name="signin_mdp">
          <label for="floatingPassword">Mot de passe</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" id="connexion" type="submit">Se connecter</button>
        <p class="my-2 text-muted fs-italic">Vous pouvez vous connecter avec l'adresse 'root' et le mot de passe 'root'</p>
        <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
      </form>
    </main>

  </body>
</html>
