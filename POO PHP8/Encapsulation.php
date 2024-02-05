<?php
class Personne {
    // Propriétés privées
    private $nom;
    private $prenom;
    private $age;

    // Méthode constructeur
    public function __construct($nom, $prenom, $age) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mettreAJourAge($age);
    }

    // Méthode pour mettre à jour l'âge
    public function mettreAJourAge($nouvelAge) {
        if ($nouvelAge >= 0) {
            $this->age = $nouvelAge;
        } else {
            echo "L'âge ne peut pas être négatif.";
        }
    }
}
?>
