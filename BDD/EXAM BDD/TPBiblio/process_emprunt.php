<?php
// Include necessary files and classes
include_once 'Database.php';
include_once 'Livre.php';
include_once 'Utilisateur.php';

// Récupérer la liste des livres disponibles
$livresDisponibles = Livre::getListeLivresDisponibles();

// Récupérer la liste des utilisateurs
$utilisateurs = Utilisateur::getListeUtilisateurs();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Emprunt</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Formulaire d'Emprunt</h1>
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

    <form action="traiter_emprunt.php" method="post">
        <label for="livre">Sélectionnez un livre :</label>
        <select name="livre" id="livre" required>
            <?php foreach ($livresDisponibles as $livre) : ?>
                <option value="<?php echo $livre->id; ?>"><?php echo $livre->titre; ?></option>
            <?php endforeach; ?>
        </select>

        <br>

        <label for="utilisateur">Sélectionnez un utilisateur :</label>
        <select name="utilisateur" id="utilisateur" required>
            <?php foreach ($utilisateurs as $utilisateur) : ?>
                <option value="<?php echo $utilisateur->id; ?>"><?php echo $utilisateur->nom . ' ' . $utilisateur->prenom; ?></option>
            <?php endforeach; ?>
        </select>

        <br>

        <label for="date_emprunt">Date d'emprunt :</label>
        <input type="date" name="date_emprunt" id="date_emprunt" required>

        <br>

        <input type="submit" value="Emprunter">
    </form>
    <footer>
        <p>&copy; 2024 Bibliothèque en Ligne</p>
    </footer>
</body>
</html>
