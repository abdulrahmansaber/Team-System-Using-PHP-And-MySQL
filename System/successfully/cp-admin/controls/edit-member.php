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

      // IF Status != 0
      if ($oneCheck['status'] != 0) {

        include "includes/header.php";

        $fetchRecorders = $conn->prepare('SELECT * FROM teamcheck');
        $fetchRecorders->execute();
        $getAllRecorders = $fetchRecorders->fetchAll();

     if ($_SERVER['REQUEST_METHOD'] == "POST") {

       # The Fields
         $newName = $_POST['new_name'];
         $newPass = $_POST['new_pass'];
         $newFBAc = $_POST['new_fbacc'];
         $newJob  = $_POST['new_job'];
         $newStats = $_POST['new_stats'];
         $newBlock = $_POST['new_blk_stats'];
         $options = $_POST['option'];

       # Array Of Updating Errors :
         $arrayUpdateErrors = array();

       # Array Of Empty Fields
         if (empty($newName))       { $arrayUpdateErrors[] = "Please Fill Field Username"; }
         if (empty($newPass))       { $arrayUpdateErrors[] = "Please Fill Field Password"; }
         if (empty($newFBAc))       { $arrayUpdateErrors[] = "Please Fill Field Facebook Account"; }
         if (empty($newJob))        { $arrayUpdateErrors[] = "Please Fill Field Job"; }
         if (empty($newStats))      { $arrayUpdateErrors[] = "Please Fill Field Status"; }

       # Display->Errors();
         foreach($arrayUpdateErrors as $UpdateError) {
           echo "<div class='UpdateMemberFromCP'>" . $UpdateError . "<br>" . "</div>";
         }

       # Update->SelectedUser();
        if (empty($arrayUpdateErrors)) {
          # IF There's No Error Update :
            $UpdateSelectedMemberID = $conn->
            prepare("UPDATE teamcheck SET
              name  = ?, pass = ?,
              status = ?, job = ?, block_status = ?, facebookAcc = ? WHERE id = ?");
            $UpdateSelectedMemberID->execute(array($newName, $newPass, $newStats, $newJob, $newBlock, $newFBAc, $options));
            $rowsss = $UpdateSelectedMemberID->rowCount();

            if ($rowsss > 0) {
              echo "<div class='updated-successfully'>Updated Successfully</div>";
            } else {
              echo "<div class='not-updated'>Not Updated, Check Code Again</div>";
            }
        }

     }
?>
    <!-- Edit Member Page Content -->
      <article class="edit-member center">
        <h1 class="_300">Edit Member On Team <span class='_500'>#3 Control</span></h1>
        <p>This page created for manage members to edit informations</p>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

          <label style="text-align: left !important;">Choose The Name</label><br>

          <select name="option">
            <?php
              $forUpdateNewMember = $conn->prepare("SELECT id, name FROM teamcheck WHERE status = 0");
              $forUpdateNewMember->execute();
              $oneForUpdate = $forUpdateNewMember->fetchAll();
              foreach($oneForUpdate as $updatedEached) {
            ?>
                <option class="idToolTip"
                    value="
                    <?php echo $updatedEached['id']; ?>" title='The ID Of User Is :
                    <?php echo $updatedEached["id"]; ?>'>Name :
                    <?php echo $updatedEached['name']; ?>
                </option>
            <?php } ?>
          </select>

          <input type='text' name='new_name' placeholder="Enter New Name">

          <input type='password' name='new_pass' placeholder="Enter New Password">

          <input type='text' name='new_fbacc' placeholder="Enter New Facebook">

          <input type='text' name='new_job' placeholder="Enter New Job">

          <input type='text' name='new_stats' placeholder="Enter New Status">

          <input type='text' name='new_blk_stats' placeholder="Enter New Block Status">

          <input type='submit' class='btn btn-dark'>

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
