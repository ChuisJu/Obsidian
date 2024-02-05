<?php
include_once 'Database.php';
include_once 'Auteur.php';

class Livre {
    public $id;
    public $titre;
    public $datePublication;
    public $nombrePages;
    public $auteur;  // Propriété pour stocker l'objet Auteur
    public $disponible;

    public function __construct($id, $titre, $datePublication, $nombrePages, $id_auteur, $disponible = null) {
        $this->id = $id;
        $this->titre = $titre;
        $this->datePublication = $datePublication;
        $this->nombrePages = $nombrePages;
        $this->auteur = $this->getAuteurById($id_auteur);
        $this->disponible = $disponible;
    }

    public function save() {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO livres (titre, date_publication, nombre_pages, id_auteur, disponible) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $this->titre);
        $stmt->bindParam(2, $this->datePublication);
        $stmt->bindParam(3, $this->nombrePages);
        $stmt->bindParam(4, $this->auteur->id);
        $stmt->bindParam(5, $this->disponible, PDO::PARAM_BOOL);
        $stmt->execute();
    }

    public static function getById($id) {
        $db = new Database();
        $conn = $db->getConnection();
    
        $stmt = $conn->prepare("SELECT * FROM livres WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            $id_auteur = isset($row['id_auteur']) ? $row['id_auteur'] : null;
            return new Livre($row['id'], $row['titre'], $row['date_publication'], $row['nombre_pages'], $id_auteur);
        }
    
        return null;
    }
    

    private function getAuteurById($id_auteur) {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM auteurs WHERE id = :id");
        $stmt->bindParam(':id', $id_auteur, PDO::PARAM_INT);
        $stmt->execute();

        $auteurData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($auteurData) {
            return new Auteur($auteurData['id'], $auteurData['nom'], $auteurData['prenom']);
        } else {
            return new Auteur(null, 'Non défini', 'Non défini');
        }
    }

    public function getAuteur() {
        return $this->auteur;
    }

    public function getInfosAuteur() {
        if ($this->auteur) {
            return [
                'id' => $this->auteur->id,
                'nom' => $this->auteur->nom,
                'prenom' => $this->auteur->prenom,
            ];
        } else {
            return []; // Retourne un tableau vide si l'auteur n'est pas défini
        }
    }

    public static function getListeLivresDisponibles() {
        $livres = self::getAllLivres();
    
        $livresDisponibles = array();
        foreach ($livres as $livre) {
            $livresDisponibles[] = $livre;
        }
    
        return $livresDisponibles;
    }
    

    public static function getAll() {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM livres");
        $stmt->execute();

        $livres = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $livres[] = $row;
        }

        return $livres;
    }

    public static function getListeNouveauxLivres($limit) {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM livres ORDER BY date_publication DESC LIMIT ?");
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        $nouveauxLivres = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $nouveauxLivres[] = new Livre($row['id'], $row['titre'], $row['date_publication'], $row['nombre_pages'], $row['id_auteur'], $row['disponible']);
        }

        return $nouveauxLivres;
    }

    public function setDisponible($disponible) {
        $this->disponible = $disponible;
    }

    public function isDisponible() {
        return $this->disponible;
    }

    public function updateDisponibilite() {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("UPDATE livres SET disponible = ? WHERE id = ?");
        $stmt->bindParam(1, $this->disponible, PDO::PARAM_BOOL);
        $stmt->bindParam(2, $this->id);
        $stmt->execute();
    }

    public static function getAllLivres() {
        $db = new Database();
        $conn = $db->getConnection();
    
        $stmt = $conn->prepare("SELECT id, titre, date_publication, nombre_pages, disponible, id_auteur FROM livres");
        $stmt->execute();
    
        $livres = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $datePublication = isset($row['date_publication']) ? $row['date_publication'] : null;
            $disponible = isset($row['disponible']) ? $row['disponible'] : null;
            $id_auteur = isset($row['id_auteur']) ? $row['id_auteur'] : null;
    
            $livres[] = new Livre($row['id'], $row['titre'], $datePublication, $row['nombre_pages'], $id_auteur, $disponible);
        }
    
        return $livres;
    }
    

    // Ajoutez d'autres méthodes en fonction de vos besoins

}

?>