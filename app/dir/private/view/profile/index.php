<?php
session_start();
include('../../security/dbcon.php');
include('../../security/encrypt_decrypt.php');
include('../../components/header.php');
?>
<!-- Login session -->
<?php if (isset($_SESSION["userID"])): ?>
<?php $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]); ?>
<?php if (isset($_GET["userID"])): ?>

<div class="container" align="center">
  <div class="col-md-12">

    <div class="card mt-3 shadow">
      <?php
        $userID = mysqli_real_escape_string($con, $_GET["userID"]);
        $query = " SELECT * FROM background_image WHERE userID='$userID' ";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0 ) {
          foreach($result as $background_img){
            ?>
      <div class="card" style="background-image: url('../image/background/<?=$background_img['filename'];?>')">
            <?php
          }
        }
      ?>

        <div class="row col-md-4 g-2 mt-2 mb-3">
          <!-- Profile Image -->
          <div class="col">
            <div id="display-image" class="border" style="width:170px;height:170px;border-radius:50%;overflow:auto">
              <?php
                $userID = mysqli_real_escape_string($con, $_GET['userID']);
                $query = " SELECT * FROM profile_image WHERE userID='$userID' ";
                $result = mysqli_query($con, $query);
                if(mysqli_num_rows($result) > 0 ) {
                  foreach($result as $profile_img){
                    ?>
                      <a href="../image/profile/<?=$profile_img['filename'];?>" target="_blank">
                        <img src="../image/profile/<?php echo $profile_img['filename'];?>" style="width:168px;height:168px;border-radius:50%;object-fit:cover;">
                      </a>
                    <?php
                  }
                }
              ?>
            </div>
          </div>

          <!-- Profile -->
          <div class="col">
            <?php
              $userID = mysqli_real_escape_string($con, $_GET['userID']);
              $query = " SELECT * FROM profile WHERE userID='$userID' ";
              $result = mysqli_query($con, $query);
              if(mysqli_num_rows($result) > 0 ) {
                foreach($result as $profile){
                  ?>

                  <?=htmlspecialchars($profile['fname']);?> <?=htmlspecialchars($profile['lname']); ?> <br>
                  <?=htmlspecialchars(decryptthis($profile['role'], $key)); ?>

                  <?php
                }
              }
            ?>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- auto logout/login session -->
<?php else: ?>
<?php endif; ?>

<?php else: ?>
<?php include('../admin/content/logged_out.php') ?>
<?php include('../../components/footer.php'); ?>
<?php endif; ?>
