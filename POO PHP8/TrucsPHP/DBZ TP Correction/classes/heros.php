<?php
class Heros extends Personnage {
    private $maitre;

    public function __construct($nom, $niveauPuissance, $pointsDeVie, $maitre) {
        parent::__construct($nom, $niveauPuissance, $pointsDeVie);
        $this->maitre = $maitre;
    }

    public function getMaitre() {
        return $this->maitre;
    }

    // Vous pouvez ajouter d'autres méthodes spécifiques aux héros au besoin
}
?>
