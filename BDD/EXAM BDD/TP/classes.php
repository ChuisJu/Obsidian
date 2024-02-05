<?php

class Personnage {
    protected $nom;
    protected $niveauPuissance;
    protected $pointsDeVie;
    protected $attaques = []; // Tableau pour stocker les attaques du personnage

    public function __construct($nom, $niveauPuissance, $pointsDeVie) {
        $this->nom = $nom;
        $this->niveauPuissance = $niveauPuissance;
        $this->pointsDeVie = $pointsDeVie;
        $this->attaques = ["Attaque normale"];
    }

    public function attaquer($ennemi) {
        $attaqueChoisie = $this->choisirAttaque();
        $degats = $this->niveauPuissance * rand(1, 3);
        $ennemi->prendreDegats($degats);
        echo "{$this->nom} utilise {$attaqueChoisie} sur {$ennemi->nom} et lui inflige {$degats} points de dégâts.\n";
    }

    public function prendreDegats($degats) {
        $this->pointsDeVie -= $degats;
        if ($this->pointsDeVie <= 0) {
            $this->mourir();
        }
    }

    public function mourir() {
        echo "{$this->nom} est mort !\n";
    }

    public function afficherStats() {
        echo "Nom: {$this->nom}, Niveau de puissance: {$this->niveauPuissance}, Points de vie: {$this->pointsDeVie}\n";
    }

    protected function choisirAttaque() {
        return $this->attaques[array_rand($this->attaques)];
    }

    public function augmenterAttaque($augmentation) {
        $this->niveauPuissance += $augmentation;
    }
}

class Heros extends Personnage {
    public function debloquerNouvelleAttaque($nouvelleAttaque) {
        $this->attaques[] = $nouvelleAttaque;
        echo "{$this->nom} a débloqué une nouvelle attaque : {$nouvelleAttaque} !\n";
    }

    public function afficherInfosHeros() {
        echo "Héros spécifique - {$this->nom}, Niveau de puissance: {$this->niveauPuissance}, Points de vie: {$this->pointsDeVie}\n";
    }
}

class Mechant extends Personnage {
    public function afficherInfosMechant() {
        echo "Méchant spécifique - {$this->nom}, Niveau de puissance: {$this->niveauPuissance}, Points de vie: {$this->pointsDeVie}\n";
    }
}

?>
