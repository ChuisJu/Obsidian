<?php
// ajout_livre.php

// Inclure les fichiers nécessaires
require_once 'Database.php';
require_once 'Livre.php';
require_once 'Auteur.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $datePublication = $_POST['date_publication'];
    $nombrePages = $_POST['nombre_pages'];
    $idAuteur = $_POST['id_auteur'];

    // Créer un nouvel objet Livre
    $nouveauLivre = new Livre(null, $titre, $datePublication, $nombrePages, $idAuteur);

    // Enregistrer le livre dans la base de données
    $nouveauLivre->save();

    // Rediriger vers la page d'accueil ou une autre page après l'ajout du livre
    header('Location: index.php');
    exit;
}

// Récupérer la liste des auteurs depuis la base de données
$database = new Database();
$conn = $database->getConnection();

$stmt = $conn->prepare("SELECT id, nom, prenom FROM auteurs");
$stmt->execute();
$auteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Livre</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Ajouter un Livre</h1>
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
    
    <form action="ajout_livre.php" method="post">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" required>
        
        <label for="date_publication">Date de publication :</label>
        <input type="date" name="date_publication" required>

        <label for="nombre_pages">Nombre de pages :</label>
        <input type="number" name="nombre_pages" required>

        <label for="id_auteur">Auteur :</label>
        <select name="id_auteur" required>
            <?php foreach ($auteurs as $auteur): ?>
                <option value="<?= $auteur['id'] ?>"><?= $auteur['nom'] . ' ' . $auteur['prenom'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Ajouter Livre</button>
    </form>
    <footer>
        <p>&copy; 2024 Bibliothèque en Ligne</p>
    </footer>
</body>

</html>
