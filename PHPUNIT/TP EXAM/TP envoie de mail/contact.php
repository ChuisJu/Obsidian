<!-- contact.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Contact</title>
</head>
<body>
    <h2>Formulaire de Contact</h2>

    <form action="contact.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br>

        <label for="sujet">Sujet :</label>
        <input type="text" id="sujet" name="sujet" required><br>

        <label for="message">Message :</label>
        <textarea id="message" name="message" required></textarea><br>

        <input type="submit" value="Envoyer">
    </form>

    <?php
    // Fonction d'envoi de mail
    function envoyerMail($destinataire, $sujet, $message, $entete) {
        return mail($destinataire, $sujet, $message, $entete);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $sujet = $_POST["sujet"];
        $message = $_POST["message"];

        // Validation rapide (à personnaliser selon les besoins)
        if (empty($nom) || empty($email) || empty($sujet) || empty($message)) {
            echo "Tous les champs sont obligatoires.";
        } else {
            // Adresse e-mail destinataire (à remplacer par votre adresse)
            $destinataire = "votre@email.com";

            // Entête du mail
            $entete = "From: $nom <$email>\r\n";

            // Envoi du mail
            if (envoyerMail($destinataire, $sujet, $message, $entete)) {
                echo "Votre message a été envoyé avec succès.";
            } else {
                echo "Une erreur s'est produite lors de l'envoi du message.";
            }
        }
    }
    ?>
</body>
</html>
