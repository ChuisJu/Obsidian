<?php
include_once 'Database.php';
include_once 'Livre.php';
include_once 'Auteur.php';
include_once 'Utilisateur.php';

class Emprunt {
    public $id;
    public $id_livre;
    public $id_utilisateur;
    public $date_fin;
    public $livre; // Propriété pour stocker l'objet Livre
    public $utilisateur; // Propriété pour stocker l'objet Utilisateur
    public $dateEmprunt;
    public $dateRetour;
    public $rendu;

    public function __construct($id, $livre, $utilisateur, $dateEmprunt, $dateRetour, $rendu) {
        $this->id = $id;
        $this->livre = $livre;
        $this->utilisateur = $utilisateur;
        $this->dateEmprunt = $dateEmprunt;
        $this->dateRetour = $dateRetour;
        $this->rendu = $rendu;
    }
    

    public function save() {
        $db = new Database();
        $conn = $db->getConnection();

        // Assurez-vous d'ajuster le nom de la table et les colonnes en fonction de votre schéma de base de données
        $stmt = $conn->prepare("INSERT INTO emprunts (id_livre, id_utilisateur, date_emprunt, date_retour) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $this->id_livre);
        $stmt->bindParam(2, $this->id_utilisateur);
        $stmt->bindParam(3, $this->dateEmprunt);
        $stmt->bindParam(4, $this->dateRetour);

        $stmt->execute();
    }

    public static function getByUserId($userId) {
        $db = new Database();
        $conn = $db->getConnection();
    
        // Assurez-vous d'ajuster le nom de la table et les colonnes en fonction de votre schéma de base de données
        $stmt = $conn->prepare("SELECT * FROM emprunts WHERE id_utilisateur = ?");
        $stmt->bindParam(1, $userId);
        $stmt->execute();
    
        $emprunts = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Récupérez l'objet Livre associé à l'emprunt
            $livre = Livre::getById($row['id_livre']);
            
            // Récupérez l'objet Utilisateur associé à l'emprunt
            $utilisateur = Utilisateur::getById($row['id_utilisateur']);
            
            // Créez un nouvel objet Emprunt en incluant les objets Livre et Utilisateur
            $emprunts[] = new Emprunt($row['id'], $livre, $utilisateur, $row['date_emprunt'], $row['date_retour'], $row['rendu']);
        }
    
        return $emprunts;
    }
    

    public static function getByBookId($bookId) {
        $db = new Database();
        $conn = $db->getConnection();

        // Assurez-vous d'ajuster le nom de la table et les colonnes en fonction de votre schéma de base de données
        $stmt = $conn->prepare("SELECT * FROM emprunts WHERE id_livre = ?");
        $stmt->bindParam(1, $bookId);
        $stmt->execute();

        $emprunts = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $emprunts[] = new Emprunt($row['id'], $row['id_livre'], $row['id_utilisateur'], $row['date_emprunt'], $row['date_retour']);
        }

        return $emprunts;
    }

    public static function getByDateRetour($limit) {
        $db = new Database();
        $conn = $db->getConnection();

        // Assurez-vous d'ajuster le nom de la table et les colonnes en fonction de votre schéma de base de données
        $stmt = $conn->prepare("SELECT * FROM emprunts WHERE date_retour IS NOT NULL ORDER BY date_retour DESC LIMIT ?");
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        $emprunts = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $emprunts[] = new Emprunt($row['id'], $row['id_livre'], $row['id_utilisateur'], $row['date_emprunt'], $row['date_retour']);
        }

        return $emprunts;
    }

    public static function getListeEmpruntsRecents($limit) {
        $db = new Database();
        $conn = $db->getConnection();
    
        // Assurez-vous d'ajuster le nom de la table et les colonnes en fonction de votre schéma de base de données
        $stmt = $conn->prepare("SELECT * FROM emprunts ORDER BY date_emprunt DESC LIMIT ?");
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
    
        $emprunts = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Récupérez l'objet Livre associé à l'emprunt
            $livre = Livre::getById($row['id_livre']);
    
            // Récupérez l'objet Utilisateur associé à l'emprunt
            $utilisateur = Utilisateur::getById($row['id_utilisateur']);
    
            // Créez un nouvel objet Emprunt en incluant les objets Livre et Utilisateur
            // Assurez-vous de fournir la valeur pour la propriété $rendu
            $emprunts[] = new Emprunt($row['id'], $livre, $utilisateur, $row['date_emprunt'], $row['date_retour'], $row['rendu']);
        }
    
        return $emprunts;
    }

    public function ajouterDelai() {
        // Ajoutez 2 semaines à la date de retour
        $date_retour = new DateTime($this->dateRetour);
        $date_retour->add(new DateInterval('P2W'));
        $this->dateRetour = $date_retour->format('Y-m-d');
    
        // Mettez à jour la base de données avec la nouvelle date de retour
        $db = new Database();
        $conn = $db->getConnection();
    
        $stmt = $conn->prepare("UPDATE emprunts SET date_retour = ? WHERE id = ?");
        $stmt->bindParam(1, $this->dateRetour);
        $stmt->bindParam(2, $this->id);
        $stmt->execute();
    }

    public static function getById($empruntId) {
        $db = new Database();
        $conn = $db->getConnection();

        // Assurez-vous d'ajuster le nom de la table et les colonnes en fonction de votre schéma de base de données
        $stmt = $conn->prepare("SELECT * FROM emprunts WHERE id = ?");
        $stmt->bindParam(1, $empruntId);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Récupérez l'objet Livre associé à l'emprunt
            $livre = Livre::getById($row['id_livre']);

            // Récupérez l'objet Utilisateur associé à l'emprunt
            $utilisateur = Utilisateur::getById($row['id_utilisateur']);

            // Créez un nouvel objet Emprunt en incluant les objets Livre et Utilisateur
            return new Emprunt($row['id'], $livre, $utilisateur, $row['date_emprunt'], $row['date_retour']);
        }

        return null; // Retourne null si l'emprunt n'est pas trouvé
    }

    public function marquerCommeNonRendu() {
        $this->rendu = false;
    
        $db = new Database();
        $conn = $db->getConnection();
    
        $stmt = $conn->prepare("UPDATE emprunts SET rendu = ? WHERE id = ?");
        $stmt->bindParam(1, $this->rendu, PDO::PARAM_BOOL);
        $stmt->bindParam(2, $this->id);
        $stmt->execute();
    }

    public function marquerCommeRendu() {
        $this->rendu = true;
    
        $db = new Database();
        $conn = $db->getConnection();
    
        $stmt = $conn->prepare("UPDATE emprunts SET rendu = ? WHERE id = ?");
        $stmt->bindParam(1, $this->rendu, PDO::PARAM_BOOL);
        $stmt->bindParam(2, $this->id);
        $stmt->execute();
    }

    public function update() {
        $db = new Database();
        $conn = $db->getConnection();
    
        // Assurez-vous d'ajuster le nom de la table et les colonnes en fonction de votre schéma de base de données
        $stmt = $conn->prepare("UPDATE emprunts SET date_retour = ?, rendu = ? WHERE id = ?");
        $stmt->bindParam(1, $this->date_fin);
        $stmt->bindParam(2, $this->rendu, PDO::PARAM_BOOL);
        $stmt->bindParam(3, $this->id);
        $stmt->execute();
    }
    
    

    

    // Ajoutez d'autres méthodes en fonction de vos besoins

}

?>
