<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire pour l'entreprise
    // Récupération des données du formulaire pour l'entreprise
    $nomEntreprise = isset($_POST['nomEntreprise']) ? $_POST['nomEntreprise'] : null;
    $adresseEntreprise = isset($_POST['adresseEntreprise']) ? $_POST['adresseEntreprise'] : null;
    $nbEmploye = isset($_POST['nbEmploye']) ? $_POST['nbEmploye'] : null;
    $idSecteur = isset($_POST['idSecteur']) ? $_POST['idSecteur'] : null;


    echo "Nom Entreprise: $nomEntreprise<br>";
    echo "Adresse Entreprise: $adresseEntreprise<br>";
    echo "Nombre d'employés: $nbEmploye<br>";
    echo "ID Secteur: $idSecteur<br>";

    // Utilisation de requête préparée pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO entreprise (nom, adresse, nbEmploye, idSecteur) VALUES (?, ?, ?, ?)");

    // Liaison des paramètres
    $stmt->bind_param("ssii", $nomEntreprise, $adresseEntreprise, $nbEmploye, $idSecteur);

    // Vérification des données avant d'exécuter la requête préparée
    if ($nomEntreprise !== null && $adresseEntreprise !== null && $nbEmploye !== null && $idSecteur !== null) {
        // Exécution de la requête préparée pour ajouter l'entreprise
        if ($stmt->execute()) {
            echo "Entreprise ajoutée avec succès<br>";

            // Récupérer l'ID de la nouvelle entreprise ajoutée
            $idEntreprise = $conn->insert_id;
            echo "ID Entreprise: $idEntreprise<br>";

            // Utilisation d'une autre requête préparée pour ajouter l'utilisateur avec l'entreprise
            $stmtUtilisateur = $conn->prepare("INSERT INTO utilisateurs (nom, prenom, age, mail, idEntreprise) VALUES (?, ?, ?, ?, ?)");

            // Liaison des paramètres pour l'insertion de l'utilisateur
            $stmtUtilisateur->bind_param("ssisi", $nomUtilisateur, $prenomUtilisateur, $ageUtilisateur, $mailUtilisateur, $idEntreprise);

            // Récupération des données de l'utilisateur
            $nomUtilisateur = isset($_POST['nomUtilisateur']) ? $_POST['nomUtilisateur'] : null;
            $prenomUtilisateur = isset($_POST['prenomUtilisateur']) ? $_POST['prenomUtilisateur'] : null;
            $ageUtilisateur = isset($_POST['ageUtilisateur']) ? $_POST['ageUtilisateur'] : null;
            $mailUtilisateur = isset($_POST['mailUtilisateur']) ? $_POST['mailUtilisateur'] : null;

            echo "Nom Utilisateur: $nomUtilisateur<br>";
            echo "Prenom Utilisateur: $prenomUtilisateur<br>";
            echo "Age Utilisateur: $ageUtilisateur<br>";
            echo "Mail Utilisateur: $mailUtilisateur<br>";

            // Vérification des données avant d'exécuter la requête préparée
            if ($nomUtilisateur !== null && $prenomUtilisateur !== null && $ageUtilisateur !== null && $mailUtilisateur !== null) {
                // Exécution de la requête préparée pour ajouter l'utilisateur
                if ($stmtUtilisateur->execute()) {
                    echo "Utilisateur ajouté avec succès<br>";
                    header('Location: index.php');
                } else {
                    echo "Erreur lors de l'ajout de l'utilisateur : " . $stmtUtilisateur->error;
                }

                // Fermeture de la connexion pour l'ajout d'utilisateur
                $stmtUtilisateur->close();
            } else {
                echo "Les données de l'utilisateur ne sont pas complètes<br>";
            }
        } else {
            echo "Erreur lors de l'ajout de l'entreprise : " . $stmt->error;
        }

        // Fermeture de la connexion pour l'ajout d'entreprise
        $stmt->close();
    } else {
        echo "Les données de l'entreprise ne sont pas complètes<br>";
    }

    // Fermeture de la connexion principale
    $conn->close();
}
?>
