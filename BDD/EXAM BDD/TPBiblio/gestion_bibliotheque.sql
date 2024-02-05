-- Script pour créer la base de données et les tables
CREATE DATABASE IF NOT EXISTS gestion_bibliotheque;

USE gestion_bibliotheque;

-- Table des livres
CREATE TABLE IF NOT EXISTS livres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    date_publication DATE,
    nombre_pages INT
);

-- Table des auteurs
CREATE TABLE IF NOT EXISTS auteurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255)
);

-- Table des utilisateurs
CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);

-- Table des emprunts
CREATE TABLE IF NOT EXISTS emprunts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_livre INT,
    id_utilisateur INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_livre) REFERENCES livres(id),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id)
);

-- Exemple d'insertion de données
INSERT INTO livres (titre, date_publication, nombre_pages) VALUES ('Livre 1', '2022-01-01', 200);
INSERT INTO auteurs (nom, prenom) VALUES ('Auteur 1', 'PrenomAuteur1');
INSERT INTO utilisateurs (nom, prenom, email) VALUES ('Utilisateur 1', 'PrenomUtilisateur1', 'utilisateur1@email.com');
