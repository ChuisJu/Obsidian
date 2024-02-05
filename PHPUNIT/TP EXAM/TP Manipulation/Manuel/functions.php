<?php

// functions.php

function inverserChaine($chaine) {
    return strrev($chaine);
}

function estPalindrome($chaine) {
    $chaine = strtolower(preg_replace('/[^a-zA-Z]/', '', $chaine));
    $inverse = inverserChaine($chaine);

    return $chaine === $inverse;
}

?>