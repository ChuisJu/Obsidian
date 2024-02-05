<?php
session_start();
require_once 'classes.php'; // Inclure le fichier où vous avez défini vos classes

// Vérifiez si le joueur a accompli l'objectif (par exemple, remporté 3 combats)
if (!isset($_SESSION['nombreDeCombats']) || $_SESSION['nombreDeCombats'] < 3) {
    // Redirigez vers une page d'accueil ou une autre page du jeu
    header("Location: index.php");
    exit();
}

echo "<h1>Félicitations, vous avez remporté le jeu !</h1>";

// Vous pouvez afficher d'autres informations ou options ici
?>
