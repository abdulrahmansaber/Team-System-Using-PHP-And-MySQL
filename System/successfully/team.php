<?php
  session_start();

  if (isset($_SESSION['name'])) {

    require 'includes/connect.php';
    include 'includes/header.php';

    $checkBlk = $conn->prepare("SELECT block_status FROM teamcheck WHERE id = ?");
    $checkBlk->execute(array($_SESSION['idene']));
    $checkBlkG = $checkBlk->fetch();

    if ($checkBlkG['block_status'] == 0) {


      $teamPersonToShow = $conn->prepare("SELECT * FROM teamcheck");
      $teamPersonToShow->execute();
      $one = $teamPersonToShow->fetchAll();

?>

  <!-- Start Page Team Persons -->
    <div class="team">
      <br><h1 class="center _300">Here You Find Your Team Persons</h1><br><br>
      <div class="infosopt">
        <?php foreach ($one as $onePersonFromTbl) { ?>
          <h1><i class="fa fa-user"></i> <span>Name:</span> <?php echo $onePersonFromTbl['name'] . "<br>"; ?></h1>
          <p>
            <strong>Work As :</strong> <?php echo $onePersonFromTbl['job']; ?><br>
            <strong>Facebook Account : </strong><a href='<?php echo $onePersonFromTbl["facebookAcc"] ?>' target="_blank"><?php echo $onePersonFromTbl['name']; ?>'s FB Account</a><br>
            <strong>Permissions As : </strong> <?php if ($onePersonFromTbl['status'] != 0) { echo "<span style='color: #e74c3c; font-weight: bolder;'>Admin <i class='fa fa-star'></i></span>"; } else { echo "A Person Of Team"; } ?><br>
            <strong>Skills : </strong> <?php echo $onePersonFromTbl['skills']; ?>
          </p>
        <?php } ?>
      </div>
    </div>
  <!-- End Page Team Persons -->

<?php
      include "includes/footer.php";
    } else {
      echo "<h1 style='font-family: Tahoma; color: #f00; text-transform: uppercase; txt-align: center;'>Sorry Sir You Aren't Allowed To See Any Thing Because You Have been blocked Call <strong>01272308683</strong> To Remove It</h1>";
    }
  } else {
    header('Location: ../access.php');
  }
?>
