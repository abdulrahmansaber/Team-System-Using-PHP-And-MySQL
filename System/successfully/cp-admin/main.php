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

        include "includes/header.php";
?>

    <!-- Main Page On Control Panel -->
      <article class="cp-content">
        <h1 class='center _300'>Welcome On Admin Control Panel</h1>
        <p class='center'>We Are Working Alot To Be The Best Team If You Are New Admin Read Instructions. You Read Instructions Not To Have A Block And You 'll Be Not Access To See Any Page</p><hr>

        <!-- Directory Of Admin -->
          <section class="card-dir">
            <h1 class='_500'>Choose Control Directory :</h1>
            <a href="controls/add-new-member.php">Add New Mebmber</a>
            <a href="controls/edit-member.php">Edit Mebmber</a>
            <a href="controls/block.php">Block Mebmber</a>
            <a href="controls/deleteMember.php">Delete Member</a>
            <a href="controls/teamMembers.php">Team Members</a>
          </section>

    </article>
<?php
        include "includes/footer.php";
      } else {
        header('Location: ../profile.php');
      }
    } else {
      echo "<h1 style='font-family: Tahoma; color: #f00; text-transform: uppercase; txt-align: center;'>Sorry Sir You Aren't Allowed To See Any Thing Because You Have been blocked Call <strong>01272308683</strong> To Remove It</h1>";
    }
  } else {
    header('Location: ../profile.php');
  }
?>
