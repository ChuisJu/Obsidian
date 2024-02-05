<?php

class Auteur {
    public $id;
    public $nom;
    public $prenom;

    public function __construct($id, $nom, $prenom) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    public function save() {
        $db = new Database();
        $conn = $db->getConnection();

        // Assurez-vous d'ajuster le nom de la table et les colonnes en fonction de votre schéma de base de données
        $stmt = $conn->prepare("INSERT INTO auteurs (nom, prenom) VALUES (?, ?)");
        $stmt->bindParam(1, $this->nom);
        $stmt->bindParam(2, $this->prenom);

        $stmt->execute();
    }

    public static function getById($id) {
        $db = new Database();
        $conn = $db->getConnection();

        // Assurez-vous d'ajuster le nom de la table et les colonnes en fonction de votre schéma de base de données
        $stmt = $conn->prepare("SELECT * FROM auteurs WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Auteur($row['id'], $row['nom'], $row['prenom']);
        }

        return null;
    }

    public static function getAllAuteurs() {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM auteurs");
        $stmt->execute();

        $auteurs = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $auteurs[] = new Auteur($row['id'], $row['nom'], $row['prenom']);
        }

        return $auteurs;
    }

    public function getId() {
        return $this->id;
    }

    public function getNomComplet() {
        return $this->nom . ' ' . $this->prenom;
    }

    // Ajoutez d'autres méthodes en fonction de vos besoins

}

?>
