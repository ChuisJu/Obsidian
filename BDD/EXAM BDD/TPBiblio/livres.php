<?php
// Inclure les fichiers nécessaires, y compris les classes et la connexion à la base de données
include_once 'Database.php';
include_once 'Livre.php';
include_once 'Auteur.php';
include_once 'Utilisateur.php';
include_once 'Emprunt.php';

// Initialiser les variables pour les messages d'erreur et de succès
$errorMsg = "";
$successMsg = "";
$livres = Livre::getAllLivres();

// Ajout d'une vérification pour une variable hypothétique $row
if (isset($row)) {
    // Créez un objet Livre seulement si $row est défini
    $livre = new Livre($row['id'], $row['titre'], $row['date_publication'], $row['nombre_pages'], $row['id_auteur']);

    // Utilisez la méthode getInfosAuteur pour obtenir les informations de l'auteur
    $infosAuteur = $livre->getInfosAuteur();

    // Vérifiez si l'array a des éléments avant d'accéder aux propriétés de l'auteur
    if (!empty($infosAuteur)) {
        echo "<table>";
        echo "<tr><th>Titre</th><th>Date de publication</th><th>Nombre de pages</th><th>Auteur</th></tr>";
        echo "<tr>";
        echo "<td>{$livre->titre}</td>";
        echo "<td>{$livre->datePublication}</td>";
        echo "<td>{$livre->nombrePages}</td>";
        echo "<td>{$infosAuteur['nom']} {$infosAuteur['prenom']}</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "Auteur non défini";
    }
} 

try {
    // Obtenir la liste complète des livres depuis la base de données
    $livres = Livre::getAllLivres();
} catch (Exception $e) {
    // Gérer les erreurs liées à la base de données
    $errorMsg = "Une erreur est survenue : " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Liste des Livres</title>
</head>
<body>
    <header>
        <h1>Liste des Livres</h1>
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

    <main>
        <?php if (!empty($livres)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Date de Publication</th>
                        <!-- Ajoutez d'autres colonnes en fonction de vos besoins -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livres as $livre): ?>
                        <tr>
                            <td><?php echo $livre->id; ?></td>
                            <td><?php echo $livre->titre; ?></td>
                            <td><?php echo $livre->auteur->prenom . ' ' . $livre->auteur->nom; ?></td>
                            <td><?php echo $livre->datePublication; ?></td>
                            <!-- Ajoutez d'autres cellules en fonction de vos besoins -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun livre disponible.</p>
        <?php endif; ?>

        <?php if (!empty($errorMsg)): ?>
            <div class="error-message"><?php echo $errorMsg; ?></div>
        <?php endif; ?>
        <?php if (!empty($successMsg)): ?>
            <div class="success-message"><?php echo $successMsg; ?></div>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Bibliothèque en Ligne</p>
    </footer>
</body>
</html>
