<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUtilisateur = $_POST['idUtilisateur'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $mail = $_POST['mail'];

    $nomEntreprise = $_POST['nomEntreprise'];
    $adresseEntreprise = $_POST['adresseEntreprise'];
    $nbEmploye = $_POST['nbEmploye'];
    $idSecteur = $_POST['idSecteur'];

    // Mettre à jour les informations de l'utilisateur
    $sqlUpdateUtilisateur = "UPDATE utilisateurs SET nom = '$nom', prenom = '$prenom', age = $age, mail = '$mail' WHERE id = $idUtilisateur";
    $conn->query($sqlUpdateUtilisateur);

    // Mettre à jour les informations de l'entreprise
    $sqlUpdateEntreprise = "UPDATE entreprise SET nom = '$nomEntreprise', adresse = '$adresseEntreprise', nbEmploye = $nbEmploye, idSecteur = $idSecteur WHERE id = (SELECT idEntreprise FROM utilisateurs WHERE id = $idUtilisateur)";
    $conn->query($sqlUpdateEntreprise);

    // Rediriger l'utilisateur vers la page d'accueil après la modification
    header('Location: index.php');
}
?>
