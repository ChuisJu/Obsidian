<?php
require 'classes.php'; // Inclure le fichier où vous avez défini vos classes

// Simulez un système d'économie
$argentJoueur = 500;

// Obtenez le choix du personnage de l'utilisateur
$nomPersonnage = $_POST['nomPersonnage'] ?? null;

// Créez une instance du personnage choisi
if ($nomPersonnage === 'Goku') {
    $personnage = new Heros("Goku", 9000, 100);
} elseif ($nomPersonnage === 'Freezer') {
    $personnage = new Mechant("Freezer", 9500, 120);
} else {
    die("Personnage non reconnu");
}

// Affichez l'argent du joueur
echo "Argent du joueur : $argentJoueur";

// Exemple d'achat d'une amélioration
if ($argentJoueur >= 200) {
    $argentJoueur -= 200;
    $personnage->augmenterAttaque(10);
    echo "Amélioration achetée avec succès !";
} else {
    echo "Fonds insuffisants pour acheter l'amélioration.";
}

// Affichez le solde mis à jour
echo "Argent restant : $argentJoueur";
?>