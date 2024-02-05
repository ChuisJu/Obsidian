<?php
class Animal {
    protected $nom;
    protected $age;

    public function __construct($nom, $age) {
        $this->nom = $nom;
        $this->age = $age;
    }

    public function crier() {
        echo "L'animal crie.";
    }
}

class Chien extends Animal {
    public function crier() {
        echo "Le chien aboie.";
    }
}

class Chat extends Animal {
    public function crier() {
        echo "Le chat miaule.";
    }
}

// Utilisation
$chien = new Chien("Rex", 3);
$chat = new Chat("Whiskers", 2);

$chien->crier(); // Le chien aboie.
$chat->crier();  // Le chat miaule.
?>
