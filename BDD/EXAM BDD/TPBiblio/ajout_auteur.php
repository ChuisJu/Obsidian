<?php
// ajout_auteur.php

// Inclure les fichiers nécessaires
require_once 'Database.php';
require_once 'Auteur.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    // Créer un nouvel objet Auteur
    $nouvelAuteur = new Auteur(null, $nom, $prenom);

    // Enregistrer l'auteur dans la base de données
    $nouvelAuteur->save();

    // Rediriger vers la page des auteurs ou une autre page après l'ajout de l'auteur
    header('Location: auteurs.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Auteur</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Ajouter un Auteur</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="livres.php">Liste des Livres</a></li>
            <li><a href="auteurs.php">Liste des Auteurs</a></li>
            <li><a href="utilisateurs.php">Liste des Utilisateurs</a></li>
            <li><a href="ajout_livre.php">Ajouter un livre</a></li>
            <li><a href="ajout_auteur.php">Ajouter un auteur</a></li>
            <li><a href="process_emprunt.php">Ajouter un emprunt</a></li>
        </ul>
    </nav>
<body>

    
    <form action="ajout_auteur.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required>
        
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required>

        <button type="submit">Ajouter Auteur</button>
    </form>
    <footer>
        <p>&copy; 2024 Bibliothèque en Ligne</p>
    </footer>
</body>
</html>
