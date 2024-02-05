<?php
session_start();
require_once 'classes.php'; // Inclure le fichier où vous avez défini vos classes

// Vérifiez si les personnages sont déjà créés dans la session
if (!isset($_SESSION['goku']) || !isset($_SESSION['freezer'])) {
    // Redirigez vers la page de combat si les personnages ne sont pas créés
    header("Location: combat.php");
    exit();
}

// Affichez les statistiques finales
echo "<h1>Résultat final du combat</h1>";
$_SESSION['goku']->afficherStats();
$_SESSION['freezer']->afficherStats();

// Détruisez les personnages après le combat
unset($_SESSION['goku']);
unset($_SESSION['freezer']);
?>
