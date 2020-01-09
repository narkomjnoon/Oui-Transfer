<?php

require "Models/Connexion.php";

function afficherMessage ($chemin){
    global $dbh;
    $message = $dbh->prepare('SELECT * FROM envoi WHERE chemin = :chemin;');
    $message->execute([
        'chemin' => $chemin,
    ]);
    $message = $message->fetch();
    return $message;
   
} 