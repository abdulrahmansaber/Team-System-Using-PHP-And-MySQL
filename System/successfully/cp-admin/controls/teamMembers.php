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

        $fetchRecorders = $conn->prepare('SELECT * FROM teamcheck');
        $fetchRecorders->execute();
        $getAllRecorders = $fetchRecorders->fetchAll();

        if (isset($_GET['userid'])) {
          $selectedUserToBlock = $_GET['userid'];
        }
?>
      <table class='updating-tbl' border="1">
        <tr>
          <th>#ID</th>
          <th>Name</th>
          <th>Status</th>
          <th>Block Status</th>
          <th>Job</th>
        </tr>

        <?php foreach($getAllRecorders as $oneRecorder) { ?>
           <?php if($oneRecorder['status'] != 1) {  ?>
              <tr>
                <td><?php echo $oneRecorder['id']; ?></td>
                <td><?php echo $oneRecorder['name']; ?></td>
                <td><?php echo $oneRecorder['status']; ?></td>
                <td style="border-right: 1px solid #DDD;"><?php echo $oneRecorder['block_status']; ?></td>
                <td><?php echo $oneRecorder['job']; ?></td>
              </tr>
            <?php } ?>
        <?php } ?>

      </table>
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
