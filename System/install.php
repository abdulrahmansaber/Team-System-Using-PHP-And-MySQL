<?php

  if ($_SERVER['REQUEST_METHOD'] == "POST")
  {

    // Try to connect
      try {
        $connect = new PDO('mysql:host=localhost;dbname=teamsystem', "root", "");
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $msgERR) { // Get Error
        echo "Connected Failed " . $msgERR;
      }

    // Create Table
      $query = $connect->prepare("
      CREATE TABLE `teamcheck` (
        `id` int(11) NOT NULL,
        `name` varchar(255) NOT NULL,
        `pass` varchar(255) NOT NULL,
        `status` int(5) NOT NULL DEFAULT '0',
        `job` varchar(255) NOT NULL,
        `block_status` int(11) NOT NULL DEFAULT '0',
        `skills` text NOT NULL,
        `task_title` text NOT NULL,
        `task_info` text NOT NULL,
        `task_end` varchar(255) NOT NULL,
        `exper` int(11) NOT NULL,
        `facebookAcc` text NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        
      // Execute The Code:
        $query->execute();

      // Make The Script Sleep 15 Seconds To Make Databse Successfullt
        sleep(3);

      // Remove This File
        unlink('install.php');

      // Redirect To Main Page
        header('Location: index.php');

  }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Team System Access</title>
  <link rel="stylesheet" href="layout/css/resets.css">
  <link rel="stylesheet" href="layout/css/style.css">
</head>
<body>

  <!-- Installtion File -->
    <div class="installtion center">
      <br><br>
      <h1>Hello This is Team System Project</h1><br>
      <p>This project is open source to control your team with simple design</p><br>
      <form method="post">
        <button style='font-size: 30px; width: 50%;' class="btn btn-dark">Install</button>
      </form>
    </div>

  <script src="layout/js/jquery-3.1.1.min.js"></script>
  <script src="layout/js/main.js"></script>
</body>
</html>
