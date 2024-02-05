<?php
class Animal {
    public function manger() {
        echo "L'animal mange.";
    }
}

class Chien extends Animal {
    public function aboyer() {
        echo "Le chien aboie.";
    }
}

// Instanciation et utilisation
$chien = new Chien();
$chien->manger(); // Hérité de la classe parente
$chien->aboie();  // Méthode spécifique à la classe Chien
?>
