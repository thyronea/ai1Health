<?php
date_default_timezone_set('America/Los_Angeles');
$month = date('m');
$day = date('d');
$year = date('Y');
$today = $month . '/' . $day . '/' . $year;

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

    $message = $DATA_OBJ->find->message;
    $time = date("h:i:s A");
    $date = $today;
    $message_ID = rand(1000000,9999999);

    $msg_query = "SELECT * FROM chat WHERE sender_ID='$myuserID' AND receiver_ID='$userID' OR receiver_ID='$myuserID' AND sender_ID='$userID' LIMIT 1";
    $msg_query_run = mysqli_query($con, $msg_query);
    $msg = mysqli_fetch_array($msg_query_run);

    if(is_array($msg)){
        $message_ID = $msg['message_ID'];
    }
    
    $image = $img['filename']; // Receiver's profile image
    $fname = decryptthis($profile['fname'], $key); // Receiver's first name
    $my_image = $myimg['filename']; // Sender's profile image
    $my_fname = mysqli_real_escape_string($con, $_SESSION['fname']); // Sender's first name

    // Send message
    $send_query = "INSERT INTO chat (groupID, message_ID, sender_ID, receiver_ID, message, time, date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($send_query);
    $stmt->bind_param("sssssss", $groupID, $message_ID, $myuserID, $userID, $message, $time, $date);
    $stmt->execute();
    
    $mydata ="In conversation with:     
             <div id='active_contact'>
                <img src='../../../image/profile/$image'>
                $fname 
            </div>";
    
    $messages = "
            <div id='message_holder_parent' style='height: 540px;'>
                <div id='message_holder' style='height: 500px; overflow: auto'>";
                
                // View messages
                $view_msg_query = "SELECT * FROM chat WHERE message_ID='$message_ID' ";
                $view_msg_query_run = mysqli_query($con, $view_msg_query);

                if(mysqli_num_rows($view_msg_query_run) > 0){
                    foreach($view_msg_query_run as $view){
                        $sender = $view['sender_ID'];
                        $view_msg = $view['message'];
                        $view_time = $view['time'];
                        $view_date = $view['date'];
                        if($_SESSION['userID'] == $sender){
                            $messages .= message_right($my_image, $my_fname, $view_msg, $view_time, $view_date);
                        }
                        else{
                            $messages .= message_left($image, $fname, $view_msg, $view_time, $view_date);
                        }
                    }
                }

                


    $messages .= message_controller();     
            
    $info->user = $mydata;
    $info->messages = $messages;
    $info->data_type = "chat";
    echo json_encode($info);
}
else{
    $info->message = "Contact not found!";
    $info->data_type = "chat";
    echo json_encode($info);
}

?>