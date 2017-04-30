<?php
  session_start();

  require 'includes/connect.php';
  if (isset($_SESSION['name'])) {

    include 'includes/header.php';

    $checkBlk = $conn->prepare("SELECT block_status FROM teamcheck WHERE id = ?");
    $checkBlk->execute(array($_SESSION['idene']));
    $checkBlkG = $checkBlk->fetch();

    if ($checkBlkG['block_status'] == 0) {

?>

  <!-- Start Page About Us -->
    <div class='about-page'>
      <br><h1 class="center _300">About Team </h1>
      <p class="center">Welcome on our team [ The D & D-Team ]</p>
      <h1 style="color: #333; font-weight: 300; margin-left: 8px;">The Most Important informations</h1>
      <ul>
        <li>This Team Created By Abdelrhman Saber</li>
        <li>This Team Created For Develop ourselves And Make A Big Project</li>
        <li>This Team 'll Be Organizer And Everything 'll Be Good</li>
        <li>The Task We Send For You, If you didn't finish it in the time we <br> told you to finish on it you 'll be blocked for 3 days <br> if you repeat this 3 times you 'll be removed from our team </li>
        <li>We Make Project to devlop ourselves and earn money</li>
      </ul><br>
      <hr>
      <h1 style="color: #333; font-weight: 300; margin-top: 20px; margin-left: 8px;">FAQ </h1>
      <div class='faqs'>

        <h1 class="open-f-q" onclick="$('.f-q').slideToggle(500);"><i class="fa fa-question-circle"></i> Where To Send The Task I Have Created ?</h1>
        <div class="f-q">
          <p>
            After Creating The Task You Must Send it, but you said where to send,<br>
            this is the answer you must send the files on this facebook account: <br>
            <a href="https://www.facebook.com/abdulrahman.saber.pro" target="_blank">Abdelrhman Saber Account </a> [ The Creator Of Team ]<br>
          </p>
        </div>
        <hr>
        <h1 class="open-s-q" onclick="$('.s-q').slideToggle(500);"><i class="fa fa-list"></i> When I Have Find The Tasks ?</h1>
        <div class="s-q">
          <p>
            After Joining The Team You Must Done The Tasks, but you ask now where to find tasks<br>
            You 'll find tasks on the tool website at the bottom right or the fixed navbar at top <br>
            Click on it and see the tasks and do it and send it to my account follow the prev question
          </p>
        </div>
        <hr>

        <h1 class="open-t-q" onclick="$('.t-q').slideToggle(500);"><i class="fa fa-users"></i> Who's My Friends On Team And How To Contact With Them</h1>
        <div class="t-q">
          <p>
            The Friends of your team you 'll find them on link Team Lists<br>
            On The Fixed Navigation bar you 'll find them and Facebook Accounts<br>
            Or You 'll Find The Team List At The End Of This Page
          </p>
        </div>

        <hr>

        <h1 class="open-fo-q" onclick="$('.fo-q').slideToggle(500);"><i class="fa fa-phone-square"></i> How To Contact With Admin <strong>Abdelrhman Saber</strong></h1>
        <div class="fo-q">
          <p>
            After Joining the team you 'll find problems or you 'll not find <br>
            Now you have a question and need answer who to ask ??<br>
            Ask The Admin Who ?? This is the account <a href="https://www.facebook.com/abdulrahman.saber.pro" target="_blank">Abdelrhman Saber Facebook </a>
          </p>
        </div>
      </div>
      <br><br><hr>
    </div>
  <!-- End Page About Us -->

  <!-- Start Team Card -->
    <div class='team-card'>
      <br><br><h1 class="center _300">Persons OF Team</h1><br>
      <?php
        // Backend Features OF Team
        // getUsersFunction :
        $teamCard = $conn->prepare("SELECT * FROM teamcheck");
        $teamCard->execute();
        $oneForTeam = $teamCard->fetchAll();
      ?>

    <table>
      <tr style="background-color: #022237; color: #FFF;">
        <th>Name</th>
        <th>Work As:</th>
        <th>Facebook Account</th>
      </tr>

      <?php foreach ($oneForTeam as $onePer) { ?>
        <tr>
          <td><?php echo $onePer['name']; ?></td>
          <td><?php echo $onePer['job']; ?></td>
          <td><a href='<?php echo $onePer['facebookAcc']; ?>' target="_blank"><?php echo $onePer['name']; ?></a>'s Facebook Account</td>
        </tr>
      <?php } ?>
    </table>

    </div>
  <!-- End Team Card -->

<?php
      include "includes/footer.php";
    } else {
      echo "<h1 style='font-family: Tahoma; color: #f00; text-transform: uppercase; txt-align: center;'>Sorry Sir You Aren't Allowed To See Any Thing Because You Have been blocked Call <strong>01272308683</strong> To Remove It</h1>";
    }
  } else {
    header('Location: ../access.php');
  }
?>
