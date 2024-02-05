<?php
session_start();
require_once 'classes.php'; // Inclure le fichier où vous avez défini vos classes

// Vérifiez si les personnages sont déjà créés dans la session
if (!isset($_SESSION['goku']) || !isset($_SESSION['freezer'])) {
    // Créez des instances de personnages pour le combat
    $_SESSION['goku'] = new Heros("Goku", 9000, 100);
    $_SESSION['freezer'] = new Mechant("Freezer", 9500, 120);
}

// Exécutez le combat
$_SESSION['goku']->attaquer($_SESSION['freezer']);

// Affichez les statistiques après le combat
echo "<h1>Résultat du combat</h1>";
$_SESSION['goku']->afficherStats();
$_SESSION['freezer']->afficherStats();
?>
