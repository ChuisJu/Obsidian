<link rel="stylesheet" href="style.css">


<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $idUtilisateur = $_GET['id'];

    // Récupérer les informations actuelles de l'utilisateur
    $sqlUtilisateur = "SELECT * FROM utilisateurs WHERE id = $idUtilisateur";
    $resultUtilisateur = $conn->query($sqlUtilisateur);
    $utilisateur = $resultUtilisateur->fetch_assoc();

    // Récupérer les informations de l'entreprise de l'utilisateur
    $idEntreprise = $utilisateur['idEntreprise'];
    $sqlEntreprise = "SELECT * FROM entreprise WHERE id = $idEntreprise";
    $resultEntreprise = $conn->query($sqlEntreprise);
    $entreprise = $resultEntreprise->fetch_assoc();

    // Récupérer les secteurs de la base de données
    $sqlSecteurs = "SELECT id, nom FROM secteur";
    $resultSecteurs = $conn->query($sqlSecteurs);
    $secteurs = $resultSecteurs->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Modification de l'utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Modification de l'utilisateur</h1>

    <!-- Formulaire de modification -->
    <form action="modifier_utilisateur_traitement.php" method="post">
        <input type="hidden" name="idUtilisateur" value="<?php echo $idUtilisateur; ?>">

        <!-- Informations de l'utilisateur -->
        <label for="nom">Nom:</label>
        <input type="text" name="nom" value="<?php echo $utilisateur['nom']; ?>" required>

        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" value="<?php echo $utilisateur['prenom']; ?>" required>

        <label for="age">Âge:</label>
        <input type="number" name="age" value="<?php echo $utilisateur['age']; ?>" required>

        <label for="mail">Mail:</label>
        <input type="email" name="mail" value="<?php echo $utilisateur['mail']; ?>" required>

        <!-- Informations de l'entreprise -->
        <label for="nomEntreprise">Nom de l'entreprise:</label>
        <input type="text" name="nomEntreprise" value="<?php echo $entreprise['nom']; ?>" required>

        <label for="adresseEntreprise">Adresse de l'entreprise:</label>
        <input type="text" name="adresseEntreprise" value="<?php echo $entreprise['adresse']; ?>" required>

        <label for="nbEmploye">Nombre d'employés:</label>
        <input type="number" name="nbEmploye" value="<?php echo $entreprise['nbEmploye']; ?>" required>

        <!-- Sélection du secteur -->
        <label for="idSecteur">Secteur:</label>
        <select id="idSecteur" name="idSecteur">
            <?php
            foreach ($secteurs as $secteur) {
                $selected = ($secteur['id'] == $entreprise['idSecteur']) ? 'selected' : '';
                echo "<option value='{$secteur['id']}' $selected>{$secteur['nom']}</option>";
            }
            ?>
        </select>

        <!-- Bouton de soumission -->
        <input type="submit" value="Enregistrer les modifications">
    </form>

</body>

</html>
