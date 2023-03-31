<?php
// bdd from https://base-donnees-publique.medicaments.gouv.fr/index.php

$sourceFile = 'CIS_bdpm.txt';
$destinationFile = 'medic.txt';

// Ouvrir le fichier source en mode lecture seule
$handle = fopen($sourceFile, 'r');

// Ouvrir le fichier de destination en mode écriture
$destinationHandle = fopen($destinationFile, 'w');

// Initialiser un compteur de ligne
$lineNum = 1;

// Parcourt chaque ligne du fichier source
while (($line = fgets($handle)) !== false) {
    // Ajouter une tabulation et le numéro de ligne à la fin de chaque ligne
    $newLine = rtrim($line) . "\t" . $lineNum . PHP_EOL;

    // Écrire la nouvelle ligne dans le fichier de destination
    fwrite($destinationHandle, $newLine);

    // Incrémenter le compteur de ligne
    $lineNum++;
}

fclose($handle);
fclose($destinationHandle);

?>
