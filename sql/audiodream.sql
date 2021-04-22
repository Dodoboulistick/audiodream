DROP TABLE Categorie;
DROP TABLE Produit;
DROP TABLE Utilisateur;
DROP TABLE Commande;
DROP TABLE Appartenir;

CREATE TABLE Categorie(
    idCat INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255),
    PRIMARY KEY(idCat)
);

CREATE TABLE Produit(
    idProduit INT NOT NULL AUTO_INCREMENT,
    nomP VARCHAR(255),  
    prix INT,
    img VARCHAR(255),
    stock INT,
    idCat INT,
    PRIMARY KEY(idProduit),
    FOREIGN KEY fk_categorie(idCat) REFERENCES Categorie(idCat)
);

CREATE TABLE Utilisateur(
    idUtilisateur INT NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(255) NOT NULL,
    prenom VARCHAR(255),
    nom VARCHAR(255),  
    mail VARCHAR(255),
    motDePasse VARCHAR(255),
    PRIMARY KEY(idUtilisateur)
);

CREATE TABLE Commande(
    idCommande INT NOT NULL,
    pseudo VARCHAR(255),
    PRIMARY KEY(idCommande),
    FOREIGN KEY fk_utilisateur(pseudo) REFERENCES Utilisateur(pseudo)
);

CREATE TABLE Appartenir(
    idCommande INT NOT NULL,
    idProduit INT NOT NULL,
    quantite INT,  
    PRIMARY KEY(idCommande,idProduit),
    FOREIGN KEY fk_commande(idCommande) REFERENCES Commande(idCommande),
    FOREIGN KEY fk_produit(idProduit) REFERENCES Produit(idProduit)
);