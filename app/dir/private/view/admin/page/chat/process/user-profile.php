<div style="padding:10px;">
    <div id="display_image">
        <?php
          $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
          $query = " SELECT * FROM profile_image WHERE userID='$userID' ";
          $result = mysqli_query($con, $query);
          if(mysqli_num_rows($result) > 0 ) {
            foreach($result as $profile_img){
              ?>
                <a href="../../../image/profile/<?=$profile_img['filename'];?>" target="_blank">
                  <img id="user_profile_image" src="../../../image/profile/<?php echo $profile_img['filename'];?>">
                </a>
              <?php
            }
          }
        ?>
    </div>
      <a href="../../../../view/profile/index.php?userID=<?=$_SESSION['userID'];?>" target="_blank" style="color:white; text-decoration: none"><?=$_SESSION['fname'];?></a>
      <br>
      <span style="font-size: 13px; opacity: 0.5;"><?=$_SESSION["role"]?></span>
</div>