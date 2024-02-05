<?php
class Personne {
    // Propriétés
    private $nom;
    private $prenom;
    private $age;

    // Méthode constructeur
    public function __construct($nom, $prenom, $age) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
    }

    // Méthode d'affichage des informations
    public function afficherInfos() {
        echo "Nom: {$this->nom}, Prénom: {$this->prenom}, Age: {$this->age} ans";
    }
}

// Instanciation d'objets
$personne1 = new Personne("Doe", "John", 25);
$personne1->afficherInfos();
?>
