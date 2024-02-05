<?php
class Vehicule {
    protected $marque;
    protected $modele;

    public function __construct($marque, $modele) {
        $this->marque = $marque;
        $this->modele = $modele;
    }

    public function demarrer() {
        echo "Le véhicule démarre.";
    }
}

class Voiture extends Vehicule {
    public function demarrer() {
        echo "La voiture démarre.";
    }
}

class Moto extends Vehicule {
    public function demarrer() {
        echo "La moto démarre.";
    }
}

// Utilisation
$voiture = new Voiture("Toyota", "Corolla");
$moto = new Moto("Honda", "CBR");

$voiture->demarrer(); // La voiture démarre.
$moto->demarrer();    // La moto démarre.
?>
