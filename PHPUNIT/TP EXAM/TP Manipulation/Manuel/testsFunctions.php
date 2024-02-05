<?php
// testsFunctions.php

require_once 'functions.php';

function assertEqual($expected, $actual, $message = '') {
    if ($expected === $actual) {
        echo "Test réussi: $message\n";
    } else {
        echo "Échec du test: $message. Attendu : $expected, Obtenu : $actual\n";
    }
}

// Test de inverserChaine
assertEqual('olleH', inverserChaine('Hello'), 'inverserChaine - Test 1');
assertEqual('abc123', inverserChaine('321cba'), 'inverserChaine - Test 2');
assertEqual('radar', inverserChaine('radar'), 'inverserChaine - Test 3');
assertEqual('', inverserChaine(''), 'inverserChaine - Test 4');

// Test de estPalindrome
assertEqual(true, estPalindrome('radar'), 'estPalindrome - Test 1');
assertEqual(true, estPalindrome('A man, a plan, a canal, Panama'), 'estPalindrome - Test 2');
assertEqual(false, estPalindrome('hello'), 'estPalindrome - Test 3');
assertEqual(false, estPalindrome('abc123'), 'estPalindrome - Test 4');
assertEqual(true, estPalindrome(''), 'estPalindrome - Test 5');

?>