<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$myuserID = mysqli_real_escape_string($con, $_SESSION['userID']);

$userID = "null";
if(isset($DATA_OBJ->find->userid)){
    $userID = $DATA_OBJ->find->userid;
}

$refresh = false;
$seen = false;
if($DATA_OBJ->data_type == "chat_refresh"){
    $refresh = true;
    $seen = $DATA_OBJ->find->seen;
}

$profile_query = "SELECT * FROM profile WHERE userID='$userID' AND groupID='$groupID' LIMIT 1";
$profile_query_run = mysqli_query($con, $profile_query);
$profile = mysqli_fetch_array($profile_query_run);

$img_query = "SELECT * FROM profile_image WHERE userID='$userID' AND groupID='$groupID' ";
$img_query_run = mysqli_query($con, $img_query);
$img = mysqli_fetch_array($img_query_run);

$my_img_query = "SELECT * FROM profile_image WHERE userID='$myuserID' ";
$my_img_query_run = mysqli_query($con, $my_img_query);
$myimg = mysqli_fetch_array($my_img_query_run);

if(is_array($profile)){

    $image = $img['filename']; // Receiver's profile image
    $fname = decryptthis($profile['fname'], $key); // Receiver's first name
    $my_image = $myimg['filename']; // Sender's profile image
    $my_fname = mysqli_real_escape_string($con, $_SESSION['fname']); // Sender's first name
    
    $mydata = "";
    if(!$refresh){
        $mydata ="In conversation with:     
             <div id='active_contact'>
                <img src='../../../image/profile/$image'>
                $fname 
            </div>";
    }
    
    $messages = "";
    if(!$refresh){
        $messages = "
            <div id='message_holder_parent' onclick='set_seen(event)' style='height: 540px;'>
                <div id='message_holder' style='height: 500px; overflow: auto'>";
    }
                 // View messages
                 $view_msg_query = "SELECT * FROM chat WHERE (sender_ID='$myuserID' AND receiver_ID='$userID') OR (receiver_ID='$myuserID' AND sender_ID='$userID') ORDER BY id";
                 $view_msg_query_run = mysqli_query($con, $view_msg_query);
 
                 if(mysqli_num_rows($view_msg_query_run) > 0){
                     foreach($view_msg_query_run as $view){
                         $chat_id = $view['id'];
                         $sender = $view['sender_ID'];
                         $receiver = $view['receiver_ID'];
                         $seen_msg = $view['seen'];
                         $received_msg = $view['received'];
                         $view_msg = decryptthis($view['message'], $key); // decrypt message
                         $view_time = $view['time'];
                         $view_date = $view['date'];
                         
                         // Update chat table when message is seen
                         if($myuserID == $receiver && $received_msg = 1 && $seen){
                            $update_received = "1";
                            $received_msg  = "UPDATE chat SET seen=? WHERE id='$chat_id' ";
                            $stmt = $con->prepare($received_msg);
                            $stmt->bind_param("s", $update_received);
                            $stmt->execute();
                         }

                         // Update chat table when message is received
                         if($myuserID == $receiver){
                            $update_received = "1";
                            $received_msg  = "UPDATE chat SET received=? WHERE id='$chat_id' ";
                            $stmt = $con->prepare($received_msg);
                            $stmt->bind_param("s", $update_received);
                            $stmt->execute();
                         }
                         
                         if($myuserID == $sender){
                             $messages .= message_right($seen_msg, $received_msg, $my_fname, $view_msg, $view_time, $view_date);
                         }
                         else{
                             $messages .= message_left($seen_msg, $received_msg, $fname, $view_msg, $view_time, $view_date);
                         }
                     }
                 }

                
    if(!$refresh){
        $messages .= message_controller(); 
    }             
            
    $info->user = $mydata;
    $info->messages = $messages;
    $info->data_type = "chat";
    if($refresh){
        $info->data_type = "chat_refresh";
    }
    echo json_encode($info);
}
else{
    
    
    // Preview chat
    $view_chat = "SELECT * FROM chat WHERE sender_ID='$myuserID' OR receiver_ID='$myuserID' GROUP BY message_ID ORDER BY timestamp DESC";
    $view_chat_run = mysqli_query($con, $view_chat);

    $mydata ="Preview Chat:<br>";    

    if(mysqli_num_rows($view_chat_run) > 0){
        
        foreach($view_chat_run as $preview){
            
            $msg_ID = $preview['message_ID'];
            $sender_ID = $preview['sender_ID'];

            if($sender_ID == $myuserID){
                $sender_ID = $preview['receiver_ID']; 
            }

            $msg_query = "SELECT * FROM chat WHERE message_ID='$msg_ID' AND sender_ID='$myuserID' OR receiver_ID='$myuserID' ORDER BY timestamp DESC LIMIT 1";
            $msg_query_run = mysqli_query($con, $msg_query);
            $msg = mysqli_fetch_array($msg_query_run);

            $img_query = "SELECT * FROM profile_image WHERE userID='$sender_ID' AND groupID='$groupID' ";
            $img_query_run = mysqli_query($con, $img_query);
            $img = mysqli_fetch_array($img_query_run);

            $profile_query = "SELECT * FROM profile WHERE userID='$sender_ID' AND groupID='$groupID' LIMIT 1";
            $profile_query_run = mysqli_query($con, $profile_query);
            $profile = mysqli_fetch_array($profile_query_run);

            $id = $profile['userID'];
            $fname = decryptthis($profile['fname'], $key); // Receiver's first name
            $image = $img['filename']; // Receiver's profile image
            $preview_msg = decryptthis($msg['message'], $key); // Decrypted chat message
            $preview_date = $msg['date']; // Message date
            $preview_time = $msg['time']; // Message time

            $mydata .="
                <div id='active_contact' userid='$id' onclick='start_chat(event)' style='cursor:pointer'>
                    <img src='../../../image/profile/$image'>
                    $fname<br>
                    <span style='font-size: 11px'>
                        $preview_msg<br>
                        $preview_date $preview_time
                    </span>
                </div>";

            
        }
    }

    $info->user = $mydata;
    $info->messages = "";
    $info->data_type = "chat";
    echo json_encode($info);
}

?>