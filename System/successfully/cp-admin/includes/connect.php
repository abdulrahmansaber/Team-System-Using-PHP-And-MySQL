<?php
  // Connect File :

  $userConnection = "root";
  $passwordConnection = "";

  try { // Create Connection :
    $conn = new PDO("mysql:host=localhost;dbname=teamsystem", $userConnection, $passwordConnection);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) { // Error Of Connection
    echo $e->getMessage();
  }
?>
