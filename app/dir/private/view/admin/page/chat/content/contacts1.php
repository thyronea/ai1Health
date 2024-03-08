<div style="text-align: center; animation: appear 2s ease">
  <div id="contact1" onclick="start_chat(event)">
    <?php
    $myID = mysqli_real_escape_string($con, $_SESSION['userID']);
    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); // this code will only show users from the same groupID
    $query = "SELECT * FROM profile WHERE groupID='$groupID' AND userID!='$myID' "; // finds all users except the current user
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
      foreach($query_run as $user)
      {
        ?>
          <div class="card mb-2 shadow" id="contact_card1">
            <div class="card-body">
              <div class="row g-1">
                <div class="col">
                  <?php
                    $userID = mysqli_real_escape_string($con, $user['userID']);
                    $query = " SELECT * FROM profile_image WHERE userID='$userID' ";
                    $result = mysqli_query($con, $query);
                    if(mysqli_num_rows($result) > 0 ) {
                      foreach($result as $profile_img){
                        ?>
                          <img src="../../../image/profile/<?php echo $profile_img['filename'];?>" style="animation: spin 3s ease">
                        <?php
                      }
                    }
                  ?>
                </div>
                <div class="col" id="contact_info1">
                  <?php
                    $userID = mysqli_real_escape_string($con, $user['userID']);
                    $query = " SELECT * FROM profile WHERE userID='$userID' ";
                    $result = mysqli_query($con, $query);
                    if(mysqli_num_rows($result) > 0 ) {
                      foreach($result as $name){
                        ?>
                        <table>
                          <tr>
                            <td>
                              <a href="../../../../view/profile/index.php?userID=<?=$user['userID'];?>" target="_blank">
                                <?= htmlspecialchars(decryptthis($name['fname'], $key));?>
                                <?= htmlspecialchars(decryptthis($name['lname'], $key));?>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <?= htmlspecialchars(decryptthis($name['email'], $key));?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div role="tablist">
                                <label class="nav-link active" id="label_chat" for="radio_chat" data-bs-toggle="tab" data-bs-target="#chat-tab-pane" type="button" role="tab">Chat <i class="bi bi-chat-dots"></i></label>
                                <label class="nav-link" id="label_contacts" for="radio_contact" data-bs-toggle="tab" data-bs-target="#contacts-tab-pane" type="button" role="tab">Contacts <i class="bi bi-person-lines-fill"></i></label>
                                <label class="nav-link" id="label_settings" for="radio_settings" data-bs-toggle="tab" data-bs-target="#settings-tab-pane" type="button" role="tab">Settings <i class="bi bi-gear"></i></label>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <?php
                                $userID = mysqli_real_escape_string($con, $user["userID"]);
                                $online_status = "SELECT * FROM profile WHERE userID='$userID'";
                                $online_status_run = mysqli_query($con, $online_status);
                                $status = mysqli_fetch_assoc($online_status_run);

                                if($status['online'] == "0") {
                                  ?>
                                  <span style="color: #ff0800">Offline</span>
                                  <?
                                }
                                else {
                                  ?>
                                  <span style="color: #16ff05">Online</span>
                                  <?
                                }
                              ?>
                            </td>
                          </tr>
                        </table>
                        <?php
                      }
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
        <?php
      }
    }
    ?>
  </div>
</div>
