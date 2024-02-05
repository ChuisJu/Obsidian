<?php
class Mechant extends Personnage {
    private $plandiabolique;
    private $coteobscur;
    private $nemesis;

    public function __construct($nom, $niveauPuissance, $pointsDeVie, $plandiabolique, $coteobscur, $nemesis) {
        parent::__construct($nom, $niveauPuissance, $pointsDeVie);
        $this->plandiabolique = $plandiabolique;
        $this->coteobscur = $coteobscur;
        $this->nemesis = $nemesis;
    }

    public function getPlan() {
        return $this->plandiabolique;
    }

    public function getCoteObscur() {
        return $this->coteobscur;
    }

    public function getNemesis() {
        return $this->nemesis;
    }

    // Vous pouvez ajouter d'autres méthodes spécifiques aux méchants au besoin
}
?>
