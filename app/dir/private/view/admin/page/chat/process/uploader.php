<?php
session_start();
$info = (object)[];
include('../../../../../security/dbcon.php');
require_once('autoload.php');
$userID = mysqli_real_escape_string($con, $_SESSION['userID']);
$filename = $_FILES["file"]["name"];
$tempname = $_FILES["docname"]["tmp_name"];
$folder = '../../../../docs';

$data_type = "";
if(isset($_POST['data_type'])){
    $data_type = $_POST['data_type'];
}

$destination = $folder . $_FILES['file']['name'];
move_uploaded_file($_FILES['file']['tmp_name']);

if($data_type == "send_image"){


}
elseif($data_type == "send_image"){
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
    $message = $DATA_OBJ->find->message; // Chat message
    $encrypted_message = encryptthis($message, $key); // encrypt message

    // Send message
    $send_query = "INSERT INTO chat (groupID, message_ID, sender_ID, receiver_ID, message, time, date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($send_query);
    $stmt->bind_param("sssssss", $groupID, $message_ID, $myuserID, $userID, $encrypted_message, $time, $date);
    $stmt->execute();

}

?>