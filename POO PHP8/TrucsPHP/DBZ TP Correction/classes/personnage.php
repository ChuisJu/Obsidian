<?php
class Personnage {
    protected $nom;
    protected $niveauPuissance;
    protected $pointsDeVie;

    public function __construct($nom, $niveauPuissance, $pointsDeVie) {
        $this->nom = $nom;
        $this->niveauPuissance = $niveauPuissance;
        $this->pointsDeVie = $pointsDeVie;
    }

    public function attaquer(Personnage $cible) {
        $degats = $this->niveauPuissance * 2;
        $cible->recevoirDegats($degats);
        return "$this->nom attaque $cible->nom et inflige $degats points de dégâts!";
    }

    protected function recevoirDegats($degats) {
        $this->pointsDeVie -= $degats;
        if ($this->pointsDeVie <= 0) {
            $this->mourir();
        }
    }

    protected function mourir() {
        echo "$this->nom est vaincu!";
    }

    // Ajoutez d'autres méthodes et propriétés au besoin

    public function getNom() {
        return $this->nom;
    }

    public function getNiveauPuissance() {
        return $this->niveauPuissance;
    }

    public function getPointsDeVie() {
        return $this->pointsDeVie;
    }
}
?>
