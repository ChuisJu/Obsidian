<?php
session_start();
require_once 'classes.php'; // Inclure le fichier où vous avez défini vos classes

// Créez des instances de personnages pour un nouveau combat
$goku = new Heros("Goku", 9000, 100);
$cell = new Mechant("Cell", 10000, 110);

// Stockez les personnages dans la session
$_SESSION['goku'] = $goku;
$_SESSION['cell'] = $cell;

echo "<h1>Nouveau combat contre Cell</h1>";

// Affichez les statistiques des personnages
$goku->afficherStats();
$cell->afficherStats();
?>
