<?php
  session_start();

  if (isset($_SESSION['name'])) {

    require "includes/connect.php";

    # Start To Check If Block User Or Not Block User
    $checkToBlockThis = $conn->prepare("SELECT block_status FROM teamcheck WHERE id = ?");
    $checkToBlockThis->execute(array($_SESSION['idene']));
    $block_statusBlocking = $checkToBlockThis->fetch();

    $statusBlocking = $block_statusBlocking['block_status'];
    if ($statusBlocking == 0) {

      # Start To Check if this admin or not
      $getToCheckIfAdmin = $conn->prepare('SELECT * FROM teamcheck WHERE id = ?');
      $getToCheckIfAdmin->execute(array($_SESSION['idene']));
      $oneCheck = $getToCheckIfAdmin->fetch();
      if ($oneCheck['status'] != 0) {

        include 'includes/header.php';

  // Page Add New Member PHP Code

  if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Get Values Of Inputs :
    $username         = $_POST['username'];
    $password         = $_POST['password'];
    $status           = $_POST['status'];
    $b_status         = $_POST['block_status'];
    $skills           = $_POST['skills'];
    $job              = $_POST['job'];
    $exper            = $_POST['exper'];

    $fnme = array();

    // Errors If The Inputs Is Empty
    if (empty($username))         { $fnme[] = 'Username Feild Is Required Sir!'; }
    if (empty($password))         { $fnme[] = 'Password Feild Is Required Sir!'; }
    if (empty($status))           { $fnme[] = 'Status Feild Is Required Sir!'; }
    if (empty($b_status))         { $fnme[] = 'Block Status Feild Is Required Sir!'; }
    if (empty($skills))           { $fnme[] = 'Skills Feild Is Required Sir!'; }
    if (empty($job))              { $fnme[] = 'Job Feild Is Required Sir!'; }
    if (empty($exper))            { $fnme[] = 'Experince Feild Is Required Sir!'; }

    /* ================================================================================================== */

    // If String Lenght OF Inputs Are Small Char :
    if (strlen($username) <= 5)       { $fnme[] = 'Username Feild Must Be More Than 5 Charcharters'; }
    if (strlen($password) <= 7)       { $fnme[] = 'Password Feild Must Be More Than 7 Charcharters'; }
    if (strlen($skills) <= 15)        { $fnme[] = 'Skills Feild Must Be More Than 15 Charcharters'; }
    if (strlen($job) <= 5)            { $fnme[] = 'Job Feild Must Be More Than 5 Charcharters'; }

    /* ================================================================================================== */

    // Show Errors :
    echo "<span class='close-insert-alerts'><i class='fa fa-close'></i> Close All</span><br>";
    foreach ($fnme as $oneError) {
      echo "<div class='insert-errors'>";
        echo $oneError . '<br>';
      echo "</div>";
    }

    /* ================================================================================================== */

    // IF There's No Any Errors :
    if (empty($fnme)) {
      // Insert Values Into DB :
      $insert = $conn->prepare('INSERT INTO teamcheck(name, pass, status, job, skills, exper, block_status)
                                            VALUES(?, ?, ?, ?, ?, ?, ?)');
      $insert->execute(array($username, $password, $status, $job, $skills, $exper, $b_status));

      echo "<style>.insert-errors, .close-insert-alerts { display: none; }</style>";

      echo "<span class='close-inserted-alert'><i class='fa fa-close'></i> Close Alert</span><br><div class='inserted-successfully'>This Informations You Inserted Have Been Inserted Successfully</div>";
    }


  }
?>

  <!-- Add New Member Content -->
  <article class="new-member center">
    <h1 class='_300'>Add New Person On Team</h1>
    <p>Control Page Number #2 For Adding New Member By Admins Only</p>
    <a href="#" class='open-new-member-form'>Add New Member <i class="fa fa-plus-circle"></i></a>
    <form class="new-member-form" action="add-new-member.php" method="post">

      <h1 class='_300'>Add New Person By Simple Steps</h1>

      <input type="text" name="username" placeholder="Enter Username">
      <input type="password" name="password" placeholder="Enter Password">
      <input type="password" name="status" placeholder="Enter Status">
      <input type="password" name="block_status" placeholder="Enter Block Status">
      <input type="text" name="skills" placeholder="Enter Skills">
      <input type="text" name="job" placeholder="Enter Job Member">
      <input type="text" name="exper" placeholder="Enter Experinces In Years">
      <input type="submit" value="Add New Member" class="btn btn-dark">

    </form>
  </article>

<?php include 'includes/footer.php'; ?>
  <?php
        } else {
          header('Location: ../../profile.php');
        }
      } else {
        echo "<h1 style='font-family: Tahoma; color: #f00; text-transform: uppercase; txt-align: center;'>Sorry Sir You Aren't Allowed To See Any Thing Because You Have been blocked Call <strong>01272308683</strong> To Remove It</h1>";
      }
    } else {
      header('Location: ../../../access.php');
    }
  ?>
