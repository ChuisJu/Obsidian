<?php
require_once 'Database.php'; 

class Utilisateur {
    public $id;
    public $nom;
    public $prenom;
    public $email;

    public function __construct($id, $nom, $prenom, $email) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
    }

    public function save() {
        $db = new Database();
        $conn = $db->getConnection();

        // Assurez-vous d'ajuster le nom de la table et les colonnes en fonction de votre schéma de base de données
        $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, prenom, email) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $this->nom);
        $stmt->bindParam(2, $this->prenom);
        $stmt->bindParam(3, $this->email);

        $stmt->execute();
    }

    public static function getById($id) {
        $db = new Database();
        $conn = $db->getConnection();

        // Assurez-vous d'ajuster le nom de la table et les colonnes en fonction de votre schéma de base de données
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Utilisateur($row['id'], $row['nom'], $row['prenom'], $row['email']);
        }

        return null;
    }

    public static function getAllUtilisateurs() {
        $db = new Database(); // Maintenant, la classe Database devrait être disponible
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM utilisateurs");
        $stmt->execute();

        $utilisateurs = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $utilisateurs[] = new Utilisateur($row['id'], $row['nom'], $row['prenom'], $row['email']);
        }

        return $utilisateurs;
    }

    public function getNomComplet() {
        return $this->prenom . ' ' . $this->nom;
    }

    public static function getListeUtilisateurs() {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM utilisateurs");
        $stmt->execute();

        $utilisateurs = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Créez un objet Utilisateur pour chaque ligne de la base de données
            $utilisateurs[] = new Utilisateur($row['id'], $row['nom'], $row['prenom'], $row['email']);
        }

        return $utilisateurs;
    }
    

    // Ajoutez d'autres méthodes en fonction de vos besoins

}

?>
