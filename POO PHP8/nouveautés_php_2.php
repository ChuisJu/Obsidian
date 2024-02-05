<?php
class Personne {
    // Utilisation des constructeurs de propriétés
    public function __construct(
        public string $nom,
        public string $prenom,
        public int $age
    ) {}
}
?>
