<?php
// Fonction complexe à tester manuellement
function calculerPrixTotal($produits, $remise) {
    // Calcul du prix total avec remise
    $prixTotal = 0;

    foreach ($produits as $produit) {
        $prixTotal += $produit['prix'];
    }

    // Appliquer la remise
    $prixTotal = $prixTotal - ($prixTotal * ($remise / 100));

    return $prixTotal;
}

// Scénario de test
$produitsTest = array(
    array('nom' => 'Produit A', 'prix' => 50),
    array('nom' => 'Produit B', 'prix' => 30),
    array('nom' => 'Produit C', 'prix' => 20)
);

$remiseTest = 10; // 10% de remise

// Appel de la fonction avec le scénario de test
$prixResultat = calculerPrixTotal($produitsTest, $remiseTest);

// Analyse du résultat
$resultatAttendu = 85; // Le résultat attendu avec la remise de 10%

if ($prixResultat === $resultatAttendu) {
    echo "Le test de la fonction calculerPrixTotal a réussi!";
} else {
    echo "Le test de la fonction calculerPrixTotal a échoué.";
}

?>
