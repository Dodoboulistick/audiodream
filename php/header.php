<!DOCTYPE html>
<html lang="fr">

    <header>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-3">
                    <a id="marque" href="index.php">Audio<span class="gradient-text">Dream</span></a>
                </div>
                <div class="col-md-8">
                    <nav class="navbar navbar-expand-md navbar-light" id="header-navbar">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item"><a class="nav-link" href="produit.php?cat=ecouteurs">Ecouteurs</a></li>
                                <li class="nav-item"><a class="nav-link" href="produit.php?cat=casques">Casques</a></li>
                                <li class="nav-item"><a class="nav-link" href="produit.php?cat=enceintes">Enceintes</a></li>
                                <li class="nav-item"><a class="nav-link" href="produit.php?cat=hifi">Hi-Fi</a></li>
                                <li class="nav-item"><a class="nav-link disabled" href="#">  /  </a></li>
                                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                                <?php 
                                    if(isset($_SESSION["isConnected"])){
                                        ?>
                                            <li class="nav-item"><a class="empty-btn special-header-btn" href="panier.php">Mon panier</a></li>
                                        <?php
                                    } else {
                                        ?>
                                            <li class="nav-item"><a class="empty-btn special-header-btn" href="login.php">Mon compte</a></li>
                                        <?php
                                    }
                                ?>
                                
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

 </html>