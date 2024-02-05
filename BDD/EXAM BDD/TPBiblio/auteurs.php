<?php
// Inclure les fichiers nécessaires (Database, Auteur)
require_once('Database.php');
require_once('Auteur.php');

// Récupérer la liste de tous les auteurs
$listeAuteurs = Auteur::getAllAuteurs();

// Afficher les auteurs
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Auteurs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1>Liste des AUteurs</h1>
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
    if (!empty($listeAuteurs)) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nom</th><th>Prénom</th></tr>";
        foreach ($listeAuteurs as $auteur) {
            echo "<tr>";
            echo "<td>{$auteur->id}</td>";
            echo "<td>{$auteur->nom}</td>";
            echo "<td>{$auteur->prenom}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Aucun auteur trouvé.";
    }
    ?>

    <footer>
        <p>&copy; 2024 Bibliothèque en Ligne</p>
    </footer>
</body>
</html>
