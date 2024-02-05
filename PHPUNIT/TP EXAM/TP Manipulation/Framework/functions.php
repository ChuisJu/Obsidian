<?php
// functions.php

function inverserChaine($chaine) {
    return strrev($chaine);
}

function estPalindrome($chaine) {
    $chaine = strtolower(preg_replace('/[^a-zA-Z]/', '', $chaine)); // Ignore la casse et les caractères non alphabétiques
    $inverse = inverserChaine($chaine);

    return $chaine === $inverse;
}
?>