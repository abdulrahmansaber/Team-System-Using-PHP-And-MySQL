<?php
  session_start();

  if (isset($_SESSION['name'])) {

    require 'includes/connect.php';
    include 'includes/header.php';

    if ($getRecorders['block_status'] == 0) {
?>
  <!-- Start Page Content -->
  <article class="profile-content">
    <h1 class="center">Hello Mr/Ms.<span style="color: #555;" class="_500"> <?php echo $getRecorders['name']; ?></span></h1>

    <!-- Start Table Informations -->
      <section>
        <table>
          <tr><th>Name</th><th>Status</th><th>Password</th><th>Setting</th></tr>
          <tr>
            <td><?php echo $getRecorders['name']; ?></td>
            <td><?php echo $getRecorders['status']; ?></td>
            <td>Can't Be Shown</td>
            <td><button class="btn btn-dark open-edit-form">Edit <i class="fa fa-edit"></i></button></td>
          </tr>
        </table>
      </section>
    <!-- End Table Informations -->

    <!-- Start Edit Informations Form -->
      <section class="edit-form">
        <h1>Edit Informations <i class="fa fa-edit"></i></h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <input type="text" name="newname" placeholder="New Name">
          <input type="Password" name="newpassword" placeholder="New Password" autocomplete="off"><br>
          <input type="submit" class="btn btn-dark" value="Save Changes">
        </form>
      </section>
    <!-- End Edit Informations Form -->

    <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
      <?php
          $newname        = $_POST['newname'];
          $newPassword    = $_POST['newpassword'];
          $idenetfiter    = $_SESSION['idene'];
          $updateErrors   = array();

          // Set Errors To Empty Array [updateErrors]
            if (empty($newname))              { $updateErrors[] = 'Write Value On Input Username'; }
            if (empty($newPassword))          { $updateErrors[] = 'Write Value On Input Password'; }
            if (strlen($newname) <= 5)        { $updateErrors[] = 'Username Must Be More Than 5 Charcharts'; }
            if (strlen($newPassword) <= 5)    { $updateErrors[] = 'Password Must Be More Than 5 Charcharts'; }

          // Print Errors :
          echo "<div class='updates-errors'>";
            echo "<i class='fa fa-close fa-lg close-update-error'></i>";
            foreach ($updateErrors as $oneError) {
                echo '<h4>' . $oneError . '<br>' . '</h4>';
            }
          echo "</div>";

          // Update Informations :
          if (empty($updateErrors)) {
            $sql = 'UPDATE teamcheck SET name = ?, pass = ?  WHERE id = ?';
            $stmtt = $conn->prepare($sql);
            $stmtt->execute(array($newname, $newPassword, $_SESSION['idene']));
            echo "<div class='updated'>Updated Successfully Reload Website <i class='fa fa-close'></i></div>";
            echo "<style>
                      .updates-errors { display: none; }
                  </style>";
          }
        } // If Server Request Method
      ?>

      <br><br><br><br>

      <!-- Start Person Informations Card -->
        <h1 class="_300 center">Person Informations</h1>
        <div class="profile-card">
          <i class="fa fa-users fa-4x"></i><br>
          <div class="info-card">
            <h4><i class="fa fa-user"></i> Name : <span><?php echo $getRecorders['name']; ?></span></h4><hr>
            <h4><i class="fa fa-briefcase"></i> Job : <span><?php echo $getRecorders['job']; ?></span></h4><hr>
            <h4><i class="fa fa-magic"></i> Skills : <span style="font-size: 14px; line-height: 2em"><?php echo $getRecorders['skills']; ?></span></h4><hr>
            <h4><i class="fa fa-support"></i> Permissions : <span style="font-size: 14px; line-height: 2em"><?php if ( $getRecorders['status'] != 0 ) { echo "An Admin"; } else { echo "An User"; } ?></span></h4><hr>
            <h4><i class="fa fa-list-ol"></i> Person Number : <span style="font-size: 14px; line-height: 2em"><?php echo $getRecorders['id']; ?></span></h4>
            <button class="btn btn-success open-edit-form">Edit Informations <i style="margin-left: 4px;" class="fa fa-edit fa-lg"></i></button>
          </div>
        </div>
      <!-- End Person Informations Card -->

  </article> <!-- Article Class = profile-content -->

<?php
      include 'includes/footer.php';
    } else {
      echo "<h1 style='font-family: Tahoma; color: #f00; text-transform: uppercase; txt-align: center;'>Sorry Sir You Aren't Allowed To See Any Thing Because You Have been blocked Call <strong>01272308683</strong> To Remove It</h1>";
    }
  } else {
    header('Location: ../access.php');
  }
?>
