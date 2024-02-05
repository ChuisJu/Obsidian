<?php
// utilisateurs.php

require_once 'Utilisateur.php'; // Assurez-vous que le fichier Utilisateur.php est inclus correctement

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Liste des Utilisateurs</h1>
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

    <?php
    // Récupérer la liste des utilisateurs
    $utilisateurs = Utilisateur::getAllUtilisateurs();

    // Afficher le tableau des utilisateurs
    if ($utilisateurs) {
        echo '<table>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Nom</th>';
        echo '<th>Prénom</th>';
        echo '<th>Email</th>';
        echo '</tr>';

        foreach ($utilisateurs as $utilisateur) {
            echo '<tr>';
            echo '<td>' . $utilisateur->id . '</td>';
            echo '<td>' . $utilisateur->nom . '</td>';
            echo '<td>' . $utilisateur->prenom . '</td>';
            echo '<td>' . $utilisateur->email . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'Aucun utilisateur trouvé.';
    }
    ?>

    <footer>
        <p>&copy; 2024 Bibliothèque en Ligne</p>
    </footer>
</body>
</html>
