<?php
session_start();
include('../../../../../security/dbcon.php'); // database connection
include('../../../../../security/encrypt_decrypt.php'); // Encrypt/Decrypt function

if(isset($_POST['submit_msg'])) {
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $sender_ID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $receiver_ID = mysqli_real_escape_string($con, $_POST['receiverID']);
  $message = mysqli_real_escape_string($con, $_POST['msg_content']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $date = mysqli_real_escape_string($con, $_POST['date']);

  // Encrypt Chat Data
  $encrypted_chat_message = encryptthis($message, $key);
  $encrypted_chat_time = encryptthis($time, $key);
  $encrypted_chat_date = encryptthis($date, $key);

  // Insert to Chat table
  $sql = "INSERT INTO chat (groupID, sender_id, receiver_id, message, time, date) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("ssssss", $groupID, $sender_ID, $receiver_ID, $encrypted_chat_message, $encrypted_chat_time, $encrypted_chat_date);
  $stmt->execute();

  if($stmt = $con->prepare($sql))
  {
    header("Location: ../../chat/index.php?userID=$receiver_ID");
    exit(0);
  }
  else
  {
    header("Location: ../../chat/index.php?userID=$receiver_ID");
    exit(0);
  }
}

?>
