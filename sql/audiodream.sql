use dodobwtdodob;
CREATE TABLE ad_categorie(
    idCat INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255),
    PRIMARY KEY(idCat)
);

CREATE TABLE ad_produit(
    idProduit INT NOT NULL AUTO_INCREMENT,
    nomP VARCHAR(255),  
    prix FLOAT,
    img VARCHAR(255),
    stock INT,
    idCat INT,
    PRIMARY KEY(idProduit),
    FOREIGN KEY fk_categorie(idCat) REFERENCES ad_categorie(idCat)
);

CREATE TABLE ad_utilisateur(
    idUtilisateur INT NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(255) NOT NULL,
    prenom VARCHAR(255),
    nom VARCHAR(255),  
    mail VARCHAR(255),
    motDePasse VARCHAR(255),
    PRIMARY KEY(idUtilisateur)
);

/* CREATE TABLE ad_commande(
    idCommande INT NOT NULL,
    idUtilisateur INT NOT NULL,
    PRIMARY KEY(idCommande),
    FOREIGN KEY fk_utilisateur(idUtilisateur) REFERENCES ad_utilisateur(idUtilisateur)
); */

CREATE TABLE ad_appartenir(
    idCommande INT NOT NULL,
    idProduit INT NOT NULL,
    quantite INT,  
    PRIMARY KEY(idCommande,idProduit),
    /* FOREIGN KEY fk_commande(idCommande) REFERENCES ad_commande(idCommande), */
    FOREIGN KEY fk_produit(idProduit) REFERENCES ad_produit(idProduit)
);