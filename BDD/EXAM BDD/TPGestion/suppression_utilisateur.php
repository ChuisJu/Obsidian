<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $idUtilisateur = $_GET['id'];

    // Récupérer l'id de l'entreprise associée à l'utilisateur
    $sqlGetEntrepriseId = "SELECT idEntreprise FROM utilisateurs WHERE id = $idUtilisateur";
    $resultGetEntrepriseId = $conn->query($sqlGetEntrepriseId);
    $row = $resultGetEntrepriseId->fetch_assoc();
    $idEntreprise = $row['idEntreprise'];

    // Supprimer l'utilisateur
    $sqlDeleteUtilisateur = "DELETE FROM utilisateurs WHERE id = $idUtilisateur";
    $conn->query($sqlDeleteUtilisateur);

    // Si l'entreprise existe (idEntreprise n'est pas NULL), supprimer aussi l'entreprise
    if (!is_null($idEntreprise)) {
        $sqlDeleteEntreprise = "DELETE FROM entreprise WHERE id = $idEntreprise";
        $conn->query($sqlDeleteEntreprise);
    }

    // Rediriger l'utilisateur vers la page d'accueil après la suppression
    header('Location: index.php');
}
?>
