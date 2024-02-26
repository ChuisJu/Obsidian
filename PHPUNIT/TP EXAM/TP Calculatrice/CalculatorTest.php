<?php
require_once 'Calculator.php';

// Crée une instance de la classe Calculator
$calculator = new Calculator();

// Boucle principale pour permettre à l'utilisateur de continuer à utiliser la calculatrice
while (true) {
    // Affiche un message d'accueil et les options disponibles
    echo "Bienvenue dans la calculatrice PHP !\n";
    echo "Options :\n";
    echo "1. Addition\n";
    echo "2. Soustraction\n";
    echo "3. Multiplication\n";
    echo "4. Division\n";
    echo "5. Carré\n";
    echo "6. Quitter\n";

    // Lit le choix de l'utilisateur
    $choice = readline("Entrez le numéro de l'opération que vous souhaitez effectuer : ");

    // Vérifie le choix de l'utilisateur
    switch ($choice) {
        case '1':
            $num1 = readline("Entrez le premier nombre : ");
            $num2 = readline("Entrez le deuxième nombre : ");
            echo "Résultat : " . $calculator->add($num1, $num2) . "\n";
            break;
        case '2':
            $num1 = readline("Entrez le premier nombre : ");
            $num2 = readline("Entrez le deuxième nombre : ");
            echo "Résultat : " . $calculator->subtract($num1, $num2) . "\n";
            break;
        case '3':
            $num1 = readline("Entrez le premier nombre : ");
            $num2 = readline("Entrez le deuxième nombre : ");
            echo "Résultat : " . $calculator->multiply($num1, $num2) . "\n";
            break;
        case '4':
            $num1 = readline("Entrez le premier nombre : ");
            $num2 = readline("Entrez le deuxième nombre : ");
            if ($num2 == 0) {
                echo "Division par zéro impossible.\n";
            } else {
                echo "Résultat : " . $calculator->divide($num1, $num2) . "\n";
            }
            break;
        case '5';
            $num1 = readline("Entrez le nombre : ");
            if ($num1 == 0){
                echo "Résultat : 0\n";
            } else {
                echo "Résultat : " . $calculator->square($num1) . "\n";
            }
            break;
        case '6':
            echo "Au revoir !\n";
            exit;
        default:
            echo "Choix non valide. Veuillez entrer un numéro entre 1 et 6.\n";
    }
}
