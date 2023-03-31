<?php
// bdd from https://base-donnees-publique.medicaments.gouv.fr/index.php
// Ouvrir le fichier texte
$fichier = fopen("CIS_bdpm.txt", "r");
$contenu = fread($fichier, filesize("CIS_bdpm.txt"));
fclose($fichier);

// Analyser le contenu pour extraire les données nécessaires
$donnees = [];
$lignes = explode("\n", $contenu);
foreach ($lignes as $ligne) {
    if (!empty(trim($ligne))) {
        $donnee = explode("\t", $ligne);
        $donnees[] = $donnee;
    }
}

// Générer les instructions SQL
$sql_instructions = [];
foreach ($donnees as $donnee) {
    $sql_instructions[] = sprintf("INSERT INTO medicTable (id, name, type, admin, auth, proc, comm, amm, uk, norm, lab, remb) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');", $donnee[0], $donnee[1], $donnee[2], $donnee[3], $donnee[4], $donnee[5], $donnee[6], $donnee[7], $donnee[8], $donnee[9], $donnee[10], $donnee[11]);
}

// Écrire les instructions SQL dans un nouveau fichier
$fichier_sql = fopen("bddmedic.sql", "w");
fwrite($fichier_sql, implode("\n", $sql_instructions));
fclose($fichier_sql);
