<?php

require "Models/Connexion.php";

function ajouterTransfert ($chemin, $message, $exp){
    global $dbh;
    $ajoutChemin = $dbh->prepare('INSERT INTO envoi (chemin, message, expediteur) VALUES (:lien, :com, :exp);');
    $ajoutChemin->execute([
        'lien' => $chemin,
        'com' => $message,
        'exp' => $exp,
    ]);
};

