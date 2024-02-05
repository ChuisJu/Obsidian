<?php
// Importez les classes nécessaires
include_once 'Emprunt.php';

// Vérifiez si la clé "emprunt_id" existe dans le tableau $_GET
if (isset($_GET['emprunt_id'])) {
    // Obtenez l'ID de l'emprunt depuis $_GET
    $empruntId = $_GET['emprunt_id'];

    // Utilisez la variable $empruntId comme nécessaire
    // Par exemple, affichez l'ID de l'emprunt
    echo "ID de l'emprunt : " . $empruntId;

    // Vous pouvez également utiliser $empruntId pour d'autres opérations
    // ...

    // Utilisez la méthode getById pour récupérer l'objet Emprunt par son ID
    $emprunt = Emprunt::getById($empruntId);

    // Vérifiez si l'emprunt a été trouvé
    if ($emprunt !== null) {
        // Utilisez l'emprunt comme nécessaire
        // Par exemple, affichez les détails de l'emprunt
        echo "Date de l'emprunt : " . $emprunt->dateEmprunt;
        // ... d'autres détails de l'emprunt
    } else {
        echo "Emprunt non trouvé.";
    }
} else {
    echo "La clé 'emprunt_id' n'existe pas dans le tableau \$_GET.";
}
?>
