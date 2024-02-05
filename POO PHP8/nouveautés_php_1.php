<?php
class Personne {
    // Attributs au lieu de propriétés
    public string $nom;
    public string $prenom;
    public int $age;

    // Méthode constructeur
    public function __construct(string $nom, string $prenom, int $age) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
    }
}
?>
