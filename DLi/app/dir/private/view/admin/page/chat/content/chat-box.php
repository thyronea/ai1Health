<?php
    date_default_timezone_set('America/Los_Angeles');
    $month = date('m');
    $day = date('d');
    $year = date('Y');
    $today = $month . '/' . $day . '/' . $year;
?>

<!-- Chat Box Header -->
<div class="card-header" id='chat_box_header'>
    <?php
        $query = " SELECT * FROM profile_image WHERE userID='$chat_userID' ";
        $query_run = mysqli_query($con, $query);
        while ($profile_img = mysqli_fetch_array($query_run)) {
    ?>
        <div class="row col-md-12 g-2">
            <div class="col-md-2">
                <img id="chat_box_user_image" src="../../../image/profile/<?php echo $profile_img['filename'];?>">
            </div>
            <div class="col-md-4 mt-4">
                <form action="">
                    <div class="row">
                        <a href="../../../../view/profile/index.php?userID=<?=$chat_userID?>" target="_blank" style="color: black; text-decoration: none"><?=$chat_fname;?> <?=$chat_lname;?></a>
                    </div>
                    <div class="row">
                        <small><?=$total;?> Messages</small>
                    </div>
                </form>
            </div>
        </div>
    <?php
        }
    ?>
</div>
<!-- Main Chatboard -->
<div class="card border-0">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12" id="main_chat">
                <?php
                    // Update message
                    $chat_status = mysqli_real_escape_string($con, "read");
                    $update_message  = "UPDATE chat SET status=? WHERE sender_ID='$userID' AND receiver_ID='$chat_userID' ";
                    $stmt = $con->prepare($update_message);
                    $stmt->bind_param("s", $chat_status);
                    $stmt->execute();

                    $select_chat = "SELECT * FROM chat WHERE (sender_ID='$chat_userID' AND receiver_ID='$userID') 
                    OR (receiver_ID='$chat_userID' AND sender_ID='$userID') ORDER by timestamp ASC";
                    $run_chat = mysqli_query($con, $select_chat);

                    while ($row = mysqli_fetch_array($run_chat)){
                        $sender_ID = $row['sender_ID'];
                        $receiver_ID = $row['receiver_ID'];
                        $chat_content = decryptthis($row['message'], $key);
                        $chat_content = decryptthis($row['message'], $key);
                        $chat_time = decryptthis($row['time'], $key);
                        $chat_date = decryptthis($row['date'], $key);
                ?>
                
                    <?php
                        if($chat_userID == $sender_ID AND $userID == $receiver_ID){
                    ?>
                        <!-- Incoming Message -->
                        
                            <div id="incoming_chat_timestamp">
                                <small><span><?=$chat_date?></span></small>
                                <small><span><?=$chat_time?></span></small>
                            </div>
                            <div id="incoming">
                                <?php
                                    $query = " SELECT * FROM profile_image WHERE userID='$sender_ID' ";
                                    $query_run = mysqli_query($con, $query);
                                    while ($profile_img = mysqli_fetch_array($query_run)) {
                                        ?>
                                            <img id="incoming_chat_image" src="../../../image/profile/<?php echo $profile_img['filename'];?>">
                                        <?php
                                    }
                                ?>
                                <div id="incoming_chat">
                                    <?=$chat_content?>
                                </div><br><br>
                            </div>
                        
                    <?php
                        }
                        elseif($chat_userID == $receiver_ID AND $userID == $sender_ID){
                    ?>  
                        <!-- Outgoing Message  -->
                        
                            <div id="outgoing_chat_timestamp">
                                <small><?=$chat_date?></small>
                                <small><?=$chat_time?></small>
                            </div>
                            <div id="outgoing">
                                <div id="outgoing_chat">
                                    <?=$chat_content?>
                                </div>
                                <?php
                                    $query = " SELECT * FROM profile_image WHERE userID='$userID' ";
                                    $query_run = mysqli_query($con, $query);
                                    while ($profile_img = mysqli_fetch_array($query_run)) {
                                        ?>
                                            <img id="outgoing_chat_image" src="../../../image/profile/<?php echo $profile_img['filename'];?>">
                                        <?php
                                    }
                                ?><br><br>
                            </div><br><br><br><br>

                    <?php
                        }
                    ?>
                
                <?php
                    }     
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Chat Box Footer -->
<div class="card-footer" id="chat_box_footer">
    <div class="right-chat-textbox" align="center">
        <form action="process/chat-process.php" method="post"> <!-- action="process/chat-process.php" ADD THIS INSIDE form -->
            <div class="row col-md-10 mt-2">
                <div class="col">
                    <input class="border-0" type="hidden" name="receiverID" id="id" value="<?=$chat_userID?>">
                    <input class="border-0" type="hidden" name="time" value="<?php echo date("h:i:s A"); ?>">
                    <input class="border-0" type="hidden" name="date" value="<?php echo $today; ?>">
                    <input class="input-group" type="text" name="msg_content" placeholder="Write message here...........">
                </div>
                <div class="col-md-2">
                <button class="btn" name="submit_msg"><i class="fa fa-telegram" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Always show the newest message at the bottom -->
<script>
  var main_chat = document.querySelector('#main_chat');
  main_chat.scrollTop = main_chat.scrollHeight - main_chat.clientHeight;
</script>

<!-- Handle user's chat response -->
<script>
    $(document).on("click", '.submit', function(event) { 
        var to_user_id = $(this).attr('id');
        to_user_id = to_user_id.replace(/chatButton/g, "");
        sendMessage(to_user_id);
    });
</script>

<!-- Sending message -->
<script>
    function sendMessage(to_user_id) {
        message = $(".message-input input").val();
        $('.message-input input').val('');
        if($.trim(message) == '') {
            return false;
        }
        $.ajax({
            url:"process/chat-process.php",
            method:"POST",
            data:{to_user_id:to_user_id, chat_message:message, action:'insert_chat'},
            dataType: "json",
            success:function(response) {
                var resp = $.parseJSON(response);			
                $('#conversation').html(resp.conversation);				
                $(".messages").animate({ scrollTop: $('.messages').height() }, "fast");
            }
        });	
    }
</script>