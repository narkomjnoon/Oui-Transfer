<?php
require "Models/Reception.php";
if (isset ($_GET['transfert'])){
    $transfert = $_GET['transfert'];
};

$message = afficherMessage($transfert);
$dateInsert = $message['date_insert'];
$dateFin = date("d-m-Y", strtotime($dateInsert." + 14 days"));;

require "Views/ReceptionView.php";
?>