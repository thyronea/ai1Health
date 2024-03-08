<div style="text-align: center; animation: appear 2s ease">
  <div id="contact" onload="">
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
        <table>
          <?php
            $userID = mysqli_real_escape_string($con, $user['userID']);
            $query = " SELECT * FROM profile WHERE userID='$userID' ";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0 ) {
              foreach($result as $name){
                ?>
          <tr>
            <td hidden><?=htmlspecialchars($name['userID']);?></td>
            <td hidden><?=htmlspecialchars($name['engineID']);?></td>
            <td hidden><?=htmlspecialchars($name['groupID']);?></td>
            <td hidden><?= htmlspecialchars(decryptthis($name['fname'], $key));?> <?= htmlspecialchars(decryptthis($name['lname'], $key));?></td>
            <td hidden><?= htmlspecialchars(decryptthis($name['email'], $key));?></td>
            <td hidden><?= htmlspecialchars(decryptthis($name['role'], $key));?></td>
            <td hidden></td>
            <td>
              <div role="tablist">
                <a  id="chat_btn" class="chatbtn" href="#chat-board" data-bs-toggle="tab" type="button" role="tab" style="text-decoration:none;">
                  <div class="card mb-2 shadow" id="contact_card">
                    <div class="card-body">
                      <div class="col" id="contact_info">
                        <table>
                                <tr>
                                  <td>
                                    <?= htmlspecialchars(decryptthis($name['fname'], $key));?>
                                    <?= htmlspecialchars(decryptthis($name['lname'], $key));?>
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
                 </a>
              </div>
            </td>
          </tr>
        </table>
        <?php
      }
    }
    ?>
  </div>
</div>

<!-- Shows recent chat on load -->
<script>
  window.onload = function(){
  document.getElementById('chat_btn').click();
  }
</script>
