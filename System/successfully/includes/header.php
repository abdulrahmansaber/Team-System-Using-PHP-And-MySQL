<?php
  require 'connect.php';

  $statement = $conn->prepare('SELECT * FROM teamcheck WHERE id = ?');
  $statement->execute(array($_SESSION['idene']));
  $getRecorders = $statement->fetch();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="layout/css/resets.css">
  <link rel="stylesheet" href="layout/css/font-awesome.min.css">
  <link rel="stylesheet" href="layout/css/nav.css">
  <link rel="stylesheet" href="layout/css/profile.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
</head>
<body>
  <!-- Start Navigation Bar -->
  <header class="navbar">
    <h1>
      <?php
        echo $getRecorders['name'];
        if ($getRecorders['status'] != 0) { echo "<span style='color: #999'> (Admin)"; } else { echo "<span style='color: #999'> (User)";  }
      ?>
    </h1>
    <nav>
      <ul>
        <li>
          <a href="tasks.php<?php if($getRecorders['status'] == 0) { ?>?user_id=<?php echo $getRecorders['id']; ?>&task_title=<?php echo $getRecorders['task_title']; } ?>">
            <i class="fa fa-tasks" style='position: relative; top: 1px;'></i>
            Tasks</a>
          </li>

        <li><a href="team.php"><i style='position: relative; top: 1px;' class="fa fa-users"></i> Team</a></li>
        <?php
          if ($getRecorders['status'] != 0) { echo '<li><a href="cp-admin/main.php"><i class="fa fa-gamepad"></i> Control Panel</a></li>'; }
        ?>
        <li class="open-dropdown"><a href="#"><i class="fa fa-ellipsis-h"></i></a></li>
      </ul>
    </nav>

    <div class="dropdown">
      <a href="profile.php">My Profile <i class="fa fa-user"></i></a>
      <a href="about.php">About <i class="fa fa-question-circle"></i></a>
      <a href="#">Project Structure <i class="fa fa-download"></i></a>
      <a href="logout.php">Logout <i class="fa fa-sign-out"></i></a>
    </div>

  </header>
  <br><br><br>

  <div class='replay'><a href='../profile.php'><i class="fa fa-replay"></i></a></div>
