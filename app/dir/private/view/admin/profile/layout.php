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
      <div class="card" style="background-image: url('../../../img/background/<?=$background_img['filename'];?>')">
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
                      <a href="../../../img/profile/<?=$profile_img['filename'];?>" target="_blank">
                        <img src="../../../img/profile/<?php echo $profile_img['filename'];?>" style="width:168px;height:168px;border-radius:50%;object-fit:cover;">
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