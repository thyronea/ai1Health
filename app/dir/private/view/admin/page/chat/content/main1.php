<div id="wrapper" style="animation: appear 4s ease"> <!-- style="animation: appear 4s ease" -->
  <!-- User Profile -->
  <div id="left_panel">
    <div style="padding:10px;">
      <div id="display-image">
        <?php
          $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
          $query = " SELECT * FROM profile_image WHERE userID='$userID' ";
          $result = mysqli_query($con, $query);
          if(mysqli_num_rows($result) > 0 ) {
            foreach($result as $profile_img){
              ?>
                <a href="../../../image/profile/<?=$profile_img['filename'];?>" target="_blank">
                  <img id="profile_image" src="../../../image/profile/<?php echo $profile_img['filename'];?>">
                </a>
              <?php
            }
          }
        ?>
      </div>
      <a href="../../../../view/profile/index.php?userID=<?=$_SESSION['userID'];?>" target="_blank" style="color:white; text-decoration: none"><?=$_SESSION['fname'];?></a>
      <br>
      <span style="font-size: 13px; opacity: 0.5;"><?=$_SESSION["role"]?></span>
      <br>
      <br>
      <br>
      <div role="tablist">
        <label class="nav-link active" id="label_chat" for="radio_chat" data-bs-toggle="tab" data-bs-target="#chat-list-pane" type="button" role="tab">Chat <i class="bi bi-chat-dots"></i></label>
        <label class="nav-link" id="label_settings" for="radio_settings" data-bs-toggle="tab" data-bs-target="#settings-tab-pane" type="button" role="tab">Settings <i class="bi bi-gear"></i></label>
      </div>
    </div>
  </div>
  <!-- Header, Container, Inner left and Inner Right-->
  <div id="right_panel">
    <div id="header">Chat</div>
    <div id="container" style="display: flex;">
      <!-- Contact List -->
      <div id="inner_left">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="chat-list-pane" role="tabpanel" tabindex="0">
            <?php include('chat-list.php'); ?>
          </div>
          <div class="tab-pane fade" id="settings-tab-pane" role="tabpanel" tabindex="0">
            ...
          </div>
        </div>
      </div>


      <!-- Display Triggers -->
      <input type="radio" id="radio_chat" name="radio" style="display: none">
      <input type="radio" id="radio_contact" name="radio" style="display: none">
      <input type="radio" id="radio_settings" name="radio" style="display: none">

      <!-- Message Board -->
      <div id="inner_right">
        <div class="tab-pane fade show active" id="chat-board">
          <?php include('chat-board.php'); ?>
        </div>
      </div>
    </div>
  </div>
</div>
