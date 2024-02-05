<?php
require 'classes/Personnage.php';
require 'classes/Heros.php';
require 'classes/Mechant.php';
require 'classes/Combat.php';

$goku = new Heros('Goku', 9000, 100, 50); // 50 is just an example for the fourth argument
$freezer = new Mechant('Freezer', 8000, 120);

$combat = new Combat();

include 'templates/header.php';

// Si le formulaire est soumis, déclencher le combat
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<div class="combat-result">';
    $combat->debuterCombat($goku, $freezer);
    echo '</div>';
}

// Afficher le formulaire de combat
include 'templates/combat.php';

include 'templates/footer.php';
?>
