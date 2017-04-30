<?php
  session_start();

  if (isset($_SESSION['name'])) {


    require 'includes/connect.php';

    // Check Block Status :
      $checkBlockStatus = $conn->prepare("SELECT block_status FROM teamcheck WHERE id = ?");
      $checkBlockStatus->execute(array($_SESSION['idene']));
      $blockStat = $checkBlockStatus->fetch();


    // Check Block Status
    if ($blockStat['block_status'] == 0) {

      include 'includes/header.php';

      $taskTitle      = $getRecorders['task_title'];
      $taskInfo       = $getRecorders['task_info'];
      $userNameTask   = $getRecorders['name'];
      $statusToCheck  = $getRecorders['status'];
      $taskEnd        = $getRecorders['task_end'];

      if ($statusToCheck != 0) {
        echo '<br><h1 class="center _300" style="width: 80%; margin: 10px auto;">You \'ll Be Redirected Now Because You Are Admin</h1>';
        header('Refresh: 5; URL=profile.php');
      } else {
?>
  <br><h1 class="center _300">Task For User: <span style="color: #555"><?php echo $userNameTask; ?></span></h1>

    <div class="task-card">
      <h1 class="_400"><?php echo $taskTitle . " For: " . $userNameTask; ?></h1>
      <h3>Task Informations :</h3>
      <p><?php echo $taskInfo; ?></p>
      <h3>Task Must Be End :</h3>
      <p><?php echo $taskEnd; ?></p>
      <button class="btn btn-success">Introduce This Task</button>
    </div>


  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/profile.js"></script>
</body>
</html>
<?php
    }
      include 'includes/footer.php';
    } else {
      echo "<h1 style='font-family: Arial; color: #f00; margin-top: 250px; text-transform: capitalize; font-weight: 100; text-align: center;'>Sorry Sir You Aren't Allowed To See Any Thing Because You Have been blocked Call <strong>01272308683</strong> To Remove It</h1>";
    }
  } else {
    header('Location: ../access.php');
  }
?>
