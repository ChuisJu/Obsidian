<?php
include 'db_connection.php';

// Récupérer tous les utilisateurs avec leurs informations d'entreprise et secteur
$sql = "SELECT u.id, u.nom, u.prenom, u.age, u.mail, e.nom as entreprise, e.adresse as adresse_entreprise, e.nbEmploye, s.nom as secteur
        FROM utilisateurs u
        INNER JOIN entreprise e ON u.idEntreprise = e.id
        INNER JOIN secteur s ON e.idSecteur = s.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Liste des utilisateurs</h1>

    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Âge</th>
            <th>Mail</th>
            <th>Entreprise</th>
            <th>Adresse Entreprise</th>
            <th>Nombre d'employés</th>
            <th>Secteur</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['nom']}</td>
                    <td>{$row['prenom']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['mail']}</td>
                    <td>{$row['entreprise']}</td>
                    <td>{$row['adresse_entreprise']}</td>
                    <td>{$row['nbEmploye']}</td>
                    <td>{$row['secteur']}</td>
                    <td><a href='modifier_utilisateur.php?id={$row['id']}'>&#128204;</a></td>
                    <td><a href='suppression_utilisateur.php?id={$row['id']}'>&#128683;</a></td>
                </tr>";
        }
        ?>
    </table>

    <!-- Formulaire d'ajout -->
<form action="traitement_formulaire.php" method="post">
    <input type="text" name="nomUtilisateur" placeholder="Nom" required>
    <input type="text" name="prenomUtilisateur" placeholder="Prénom" required>
    <input type="number" name="ageUtilisateur" placeholder="Âge" required>
    <input type="email" name="mailUtilisateur" placeholder="Mail" required>
    <input type="text" name="nomEntreprise" placeholder="Entreprise" required>
    <input type="text" name="adresseEntreprise" placeholder="Adresse Entreprise" required>
    <input type="number" name="nbEmploye" placeholder="Nombre d'employés" required>
    <label for="secteur">Secteur :</label>
    <select id="secteur" name="idSecteur">
    <?php
        include 'db_connection.php';

        // Récupérer les secteurs de la base de données
        $sql = "SELECT id, nom FROM secteur";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Afficher chaque secteur comme une option dans la liste déroulante
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['nom']}</option>";
            }
        } else {
            echo "0 results";
        }
        ?>
    </select><br>

    <input type="submit" value="Ajouter">
</form>

</body>

</html>
