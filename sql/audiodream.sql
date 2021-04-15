DROP TABLE Categorie;
DROP TABLE Produit;
DROP TABLE Utilisateur;
DROP TABLE Commande;
DROP TABLE Appartenir;

CREATE TABLE Categorie(
    idCat INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(20),
    PRIMARY KEY(idCat)
);

CREATE TABLE Produit(
    idProduit INT NOT NULL AUTO_INCREMENT,
    nomP VARCHAR(20),  
    prix INT,
    img VARCHAR(20),
    stock INT,
    idCat INT,
    PRIMARY KEY(idProduit),
    FOREIGN KEY fk_categorie(idCat) REFERENCES Categorie(idCat)
);

CREATE TABLE Utilisateur(
    pseudo VARCHAR(25) NOT NULL,
    prenom VARCHAR(20),
    nom VARCHAR(20),  
    mail VARCHAR(100),
    motDePasse VARCHAR(50),
    PRIMARY KEY(pseudo)
);

CREATE TABLE Commande(
    idCommande INT NOT NULL,
    pseudo VARCHAR(25),
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