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

try {
    // Obtenir la liste des nouveaux livres et des emprunts récents depuis la base de données
    $nouveauxLivres = Livre::getListeNouveauxLivres(20);
    $empruntsRecents = Emprunt::getListeEmpruntsRecents(10);
} catch (Exception $e) {
    // Gérer les erreurs liées à la base de données
    $errorMsg = "Une erreur est survenue : " . $e->getMessage();
}

// Traitement du formulaire d'ajout de délai
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emprunt_id'])) {
    try {
        $emprunt = Emprunt::getById($_POST['emprunt_id']);
        if ($emprunt) {
            $emprunt->ajouterDelai();
            $successMsg = "Délai ajouté avec succès.";
        } else {
            $errorMsg = "Emprunt non trouvé.";
        }
    } catch (Exception $e) {
        $errorMsg = "Une erreur est survenue : " . $e->getMessage();
    }
}

// Traitement du formulaire de marquage comme rendu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['marquer_rendu_id'])) {
    try {
        $emprunt = Emprunt::getById($_POST['marquer_rendu_id']);
        if ($emprunt) {
            $emprunt->marquerCommeRendu();
            $successMsg = "Emprunt marqué comme rendu avec succès.";
        } else {
            $errorMsg = "Emprunt non trouvé.";
        }
    } catch (Exception $e) {
        $errorMsg = "Une erreur est survenue : " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Bibliothèque en Ligne</title>
</head>
<body>
    <header>
        <h1>Bibliothèque en Ligne</h1>
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
        <section>
            <h2>Nouveaux Livres</h2>
            <?php if (!empty($nouveauxLivres)): ?>
                <ul>
                    <?php foreach ($nouveauxLivres as $livre): ?>
                        <li><?php echo $livre->titre; ?> (<?php echo $livre->datePublication; ?>)</li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucun nouveau livre disponible.</p>
            <?php endif; ?>
        </section>

        <section>
            <h2>Emprunts Récents</h2>
            <?php if (!empty($empruntsRecents)): ?>
                <?php

                    if ($empruntsRecents) {
                        // Afficher le tableau des emprunts
                        echo '<table>';
                        echo '<tr><th>ID</th><th>Livre</th><th>Utilisateur</th><th>Date Emprunt</th><th>Date Fin</th><th>Date Retour</th><th>Action</th></tr>';
                        foreach ($empruntsRecents as $emprunt) {
                            echo '<tr>';
                            echo '<td>' . $emprunt->id . '</td>';
                            if ($emprunt->livre) {
                                echo '<td>' . $emprunt->livre->titre . '</td>';
                            } else {
                                echo '<td> Livre non trouvé </td>';
                            }
                            echo '<td>' . $emprunt->utilisateur->getNomComplet() . '</td>';
                            echo '<td>' . $emprunt->dateEmprunt . '</td>';
                            echo '<td>' . $emprunt->date_fin . '</td>';
                            echo '<td>' . $emprunt->dateRetour . '</td>';
                            echo '<td>';
                            if (!$emprunt->rendu) {
                                echo '<form action="ajouter_delai.php" method="post">';
                                echo '<input type="hidden" name="emprunt_id" value="' . $emprunt->id . '">';
                                echo '<button type="submit">Ajouter 2 semaines</button>';
                                echo '</form>';
                                echo '<form action="marquer_rendu.php" method="post">';
                                echo '<input type="hidden" name="marquer_rendu_id" value="' . $emprunt->id . '">';
                                echo '<button type="submit">Marquer comme rendu</button>';
                                echo '</form>';
                            } else {
                                echo 'Rendu';
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        echo '<p>Aucune donnée d\'emprunt trouvée.</p>';
                    }
                ?>
            <?php else: ?>
                <p>Aucun emprunt récent.</p>
            <?php endif; ?>
        </section>
        
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
