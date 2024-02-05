<!-- contact_test.php -->

<?php
require 'contact.php';  // Inclure le fichier contenant le script à tester

class ContactTest extends PHPUnit\Framework\TestCase {
    public function testEnvoiMessageReussi() {
        // Simuler une soumission de formulaire
        $_POST["nom"] = "John Doe";
        $_POST["email"] = "john.doe@example.com";
        $_POST["sujet"] = "Test";
        $_POST["message"] = "Ceci est un test.";

        // Inclure le script de contact pour tester la fonction d'envoi
        ob_start();
        include 'contact.php';
        $output = ob_get_clean();

        // Vérifier la sortie
        $this->assertStringContainsString("Votre message a été envoyé avec succès.", $output);
    }

    public function testEnvoiMessageChampsVides() {
        // Simuler une soumission de formulaire avec des champs vides
        $_POST["nom"] = "";
        $_POST["email"] = "";
        $_POST["sujet"] = "";
        $_POST["message"] = "";

        // Inclure le script de contact pour tester la gestion des champs vides
        ob_start();
        include 'contact.php';
        $output = ob_get_clean();

        // Vérifier la sortie
        $this->assertStringContainsString("Tous les champs sont obligatoires.", $output);
    }

    public function testEnvoiMessageMailNonEnvoye() {
        // Simuler une soumission de formulaire
        $_POST["nom"] = "John Doe";
        $_POST["email"] = "john.doe@example.com";
        $_POST["sujet"] = "Test";
        $_POST["message"] = "Ceci est un test.";

        // Remplacer la fonction mail() par une fonction de simulation
        $this->getMockBuilder('ContactTest')
            ->setMethods(['mail'])
            ->getMock();

        $this->expects($this->any())
            ->method('mail')
            ->willReturn(false);

        // Inclure le script de contact pour tester la gestion d'erreur d'envoi de mail
        ob_start();
        include 'contact.php';
        $output = ob_get_clean();

        // Vérifier la sortie
        $this->assertStringContainsString("Une erreur s'est produite lors de l'envoi du message.", $output);
    }
}
?>
