<?php
class ParcAnimalier {
    private $animaux = [];

    public function ajouterAnimal(Animal $animal) {
        $this->animaux[] = $animal;
    }

    public function afficherInfos() {
        foreach ($this->animaux as $animal) {
            echo "Nom: {$animal->getNom()}, Age: {$animal->getAge()} - ";
            $animal->crier();
            echo "<br>";
        }
    }
}

// Utilisation
$parc = new ParcAnimalier();
$parc->ajouterAnimal(new Chien("Rex", 3));
$parc->ajouterAnimal(new Chat("Whiskers", 2));

$parc->afficherInfos();
?>
