<?php

require 'Connexion.php';

// On récupère tous les éléments de la table envoi qui sont dans la table depuis plus de 13 jours

$expired = $dbh->query('SELECT id, chemin FROM envoi WHERE -1*(14+DATEDIFF(date_insert, NOW())) >= 0;');
$expired = $expired->fetchAll();

// pour chaque élément récupéré par la requête au-dessus, on le supprime de la table

foreach ($expired as $value) {
    $id = $value['id'];
    $dbh->query('DELETE FROM envoi WHERE id = ' . $id);
    // On supprime aussi le fichier sur notre serveur, en se basant sur la colonne "chemin"
    if(file_exists($value['chemin'])){
        unlink($value['chemin']);
    }
}

// 0 0 * * * php '/var/www/html/projet/Models/cron.php'