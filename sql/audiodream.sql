DROP TABLE categorie;
DROP TABLE produit;
DROP TABLE utilisateur;
DROP TABLE commande;
DROP TABLE appartenir;

CREATE TABLE categorie(
    idCat INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255),
    PRIMARY KEY(idCat)
);

CREATE TABLE produit(
    idProduit INT NOT NULL AUTO_INCREMENT,
    nomP VARCHAR(255),  
    prix FLOAT,
    img VARCHAR(255),
    stock INT,
    idCat INT,
    PRIMARY KEY(idProduit),
    FOREIGN KEY fk_categorie(idCat) REFERENCES categorie(idCat)
);

CREATE TABLE utilisateur(
    idUtilisateur INT NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(255) NOT NULL,
    prenom VARCHAR(255),
    nom VARCHAR(255),  
    mail VARCHAR(255),
    motDePasse VARCHAR(255),
    PRIMARY KEY(idUtilisateur)
);

CREATE TABLE commande(
    idCommande INT NOT NULL,
    idUtilisateur INT NOT NULL,
    PRIMARY KEY(idCommande),
    FOREIGN KEY fk_utilisateur(idUtilisateur) REFERENCES utilisateur(idUtilisateur)
);

CREATE TABLE appartenir(
    idCommande INT NOT NULL,
    idProduit INT NOT NULL,
    quantite INT,  
    PRIMARY KEY(idCommande,idProduit),
    FOREIGN KEY fk_commande(idCommande) REFERENCES commande(idCommande),
    FOREIGN KEY fk_produit(idProduit) REFERENCES produit(idProduit)
);