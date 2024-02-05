<?php
// Include necessary files and classes
include_once 'Database.php';
include_once 'Livre.php';
include_once 'Utilisateur.php';
include_once 'Emprunt.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $livreId = $_POST["livre"];
    $utilisateurId = $_POST["utilisateur"];
    $dateEmprunt = $_POST["date_emprunt"];

    // Vérifier si le livre est disponible
    $livre = Livre::getById($livreId);

    if ($livre && $livre->disponible) {
        // Créer un nouvel objet Emprunt
        $emprunt = new Emprunt(null, $livre, Utilisateur::getById($utilisateurId), $dateEmprunt, null, false);

        // Enregistrer l'emprunt dans la base de données
        $emprunt->save();

        // Mettre à jour le statut de disponibilité du livre
        $livre->setDisponible(false);
        $livre->updateDisponibilite();

        echo "L'emprunt a été enregistré avec succès.";
    } else {
        echo "Le livre sélectionné n'est pas disponible pour l'emprunt.";
    }
} else {
    echo "Le formulaire n'a pas été soumis correctement.";
}
?>
