<?php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "gestion_bibliotheque";

    public function getConnection() {
        try {
            $conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
            die(); // En cas d'échec de la connexion, arrêter l'exécution du script
        }
    }
}

?>
