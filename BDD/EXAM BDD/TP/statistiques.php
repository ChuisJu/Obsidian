<?php
require_once 'classes.php'; // Include the file where you have defined your classes

// Create instances of characters to display statistics
$goku = new Heros("Goku", 9000, 100, "Master Roshi");
$vegeta = new Heros("Vegeta", 8500, 95, "Master Roshi");
$freezer = new Mechant("Freezer", 9500, 120,"Oui Oui baguette"); // replace $arg4, $arg5, $arg6 with actual values

// Display the characters' statistics
$goku->afficherStats();
$vegeta->afficherStats();
$freezer->afficherStats();
?>