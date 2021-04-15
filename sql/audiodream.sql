DROP TABLE Categorie;
DROP TABLE Produit;
DROP TABLE Utilisateur;
DROP TABLE Commande;
DROP TABLE Appartenir;

CREATE TABLE Categorie(
    idCat INT PRIMARY KEY,
    nom VARCHAR(20)
);

CREATE TABLE Produit(
    idProduit INT PRIMARY KEY,
    nomP VARCHAR(20),  
    prix INT,
    img VARCHAR(20),
    stock INT,
    idCat INT,
    FOREIGN KEY fk_categorie(idCat) REFERENCES Categorie(idCat)
);

CREATE TABLE Utilisateur(
    pseudo VARCHAR(25) PRIMARY KEY,
    prenom VARCHAR(20),
    nom VARCHAR(20),  
    mail VARCHAR(100),
    motDePasse VARCHAR(50)
);

CREATE TABLE Commande(
    idCommande INT PRIMARY KEY,
    pseudo VARCHAR(25),
    FOREIGN KEY fk_utilisateur(pseudo) REFERENCES Utilisateur(pseudo)
);

CREATE TABLE Appartenir(
    idCommande INT PRIMARY KEY,
    idProduit INT PRIMARY KEY,
    quantite INT,  
    FOREIGN KEY fk_commande(idCommande) REFERENCES Commande(idCommande),
    FOREIGN KEY fk_produit(idProduit) REFERENCES Produit(idProduit)
);