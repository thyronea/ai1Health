<?php
date_default_timezone_set('America/Los_Angeles');
$month = date('m');
$day = date('d');
$year = date('Y');
$today = $year . '-' . $month . '-' . $day;
?>

<div class="container mt-3">
  <div class="card shadow mb-2">
    <div class="card-header" style="color: black;">
      You're chatting with
      <input class="border-0" type="" name="" id="chat_name" style="color: black;" disabled>
      <form class="" action="index.php" method="get">
        <input class="border-0" type="hidden" id="chat_userID2">
      </form>
    </div>
    <div class="card border-0">
      <div class="card-body" id="chat_box" style="height:515px; overflow: auto;">
        <div>
          <?php
          $myID = mysqli_real_escape_string($con, $_SESSION['userID']);
          $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
          $query = "SELECT * FROM chat WHERE groupID='$groupID' AND sender_ID='$myID' ORDER BY id ";
          $query_run = mysqli_query($con, $query);

          if(mysqli_num_rows($query_run) > 0)
          {
            foreach($query_run as $outgoing)
            {
              ?>
              <div align="right">
                <div id="outgoing_chat">
                  <div style="padding-right: 10px;">
                    <small><?= htmlspecialchars(decryptthis($outgoing['time'], $key));?></small>
                  </div>
                  <?= htmlspecialchars(decryptthis($outgoing['message'], $key));?>
                </div>
              </div>
              <?php
            }
          }
          ?>
        </div>
        <!--
        <div align="left">
          <?php
          $myID = mysqli_real_escape_string($con, $_SESSION['userID']);
          $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
          $query = "SELECT * FROM chat WHERE groupID='$groupID' AND receiver_ID='$myID' ORDER BY id ";
          $query_run = mysqli_query($con, $query);
          $incoming = mysqli_fetch_assoc($query_run)
          ?>
          <div align="left">
            <div id="incoming_chat">
              <div style="padding-right: 10px;">
                <small><?= htmlspecialchars(decryptthis($incoming['time'], $key));?></small>
              </div>
              <?= htmlspecialchars(decryptthis($incoming['message'], $key));?>
            </div>
          </div>
        </div>
        -->
      </div>
    </div>
    <div class="card-footer" style="height: 55px">
      <form class="" action="process/chat-process.php" method="post">
        <input class="border-0" type="hidden" name="receiverID" id="chat_userID">
        <input class="border-0" type="hidden" name="date" value="<?php echo $today; ?>">
        <input class="border-0" type="hidden" name="time" value="<?php echo date("h:i:s A"); ?>">
        <input class="mt-2" type="text" name="chat_message" id="chat_box" value="" style="width: 370px; border-style: solid; border-color: #c9c7c7;" placeholder="Type message here...">
        <button class="border-0" type="submit" name="chat_send" style="padding-left: 10px;"><i class="bi bi-send fa-lg"></i></button>
      </form>
    </div>
  </div>
</div>

<!-- Hides scrollbar while allowing scrolling -->
<script>
  var chat_box = document.querySelector('#chat_box');
  chat_box.scrollTop = chat_box.scrollHeight - chat_box.clientHeight;
</script>

<!-- Retrieve sender's ID for incoming message -->
<script>
  var sender_ID = document.getElementById('chat_userID2').value;

  $.ajax({
  type: 'POST',
  url: 'index.php',
  data: {
    sender_ID: sender_ID
  }
</script>
