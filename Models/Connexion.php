<?php
 require "env.php";
  $dbh = null;
  $options = [
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
  ];

  try {
    $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password, $options);
  } catch (PDOException $e) {
    echo "Erreur!: " . $e->getMessage() . "<br/>";
    die();
  }
?>