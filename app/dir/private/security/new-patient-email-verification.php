<?php
session_start();
include('dbcon.php');

if(isset($_GET['token']))
{
  $token = $_GET['token'];
  $verify_query = "SELECT token, status FROM token WHERE token='$token' LIMIT 1";
  $verify_query_run = mysqli_query($con, $verify_query);

  if(mysqli_num_rows($verify_query_run) > 0)
  {
    $row = mysqli_fetch_array($verify_query_run);
    if($row['status'] == "0")
    {
      $clicked_token = $row['token'];
      $update_token_status = "UPDATE token SET status ='1' WHERE token='$clicked_token' LIMIT 1";
      $update_token_status_run = mysqli_query($con, $update_token_status);

      // Retrieves userID for verification
      $getID = "SELECT * FROM token WHERE token='$clicked_token'";
      $getID_run = mysqli_query($con, $getID);
      $get_userID = mysqli_fetch_assoc($getID_run);
      $userID = mysqli_real_escape_string($con, $get_userID["userID"]);

      $update_query = "UPDATE patients SET account_status ='Verified' WHERE patientID='$userID' LIMIT 1";
      $update_query_run = mysqli_query($con, $update_query);

      if($update_query_run)
      {
        $_SESSION['success'] = "Your account has been verified!";
        header("Location: /public/page/password/create-user-pw.php?token=$token");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Verification failed!";
        header("Location: /public/page/password/create-user-pw.php?token=$token");
        exit(0);
      }
    }
    else
    {
      $_SESSION['warning'] = "Email already verified! Please log in.";
      header("Location: /public/page/access/sign-in.php");
      exit(0);
    }
  }
  else {
    $_SESSION['warning'] = "This email does not exist";
    header("Location: /public/page/access/sign-in.php");
  }
}
else {
  $_SESSION['warning'] = "Not allowed";
  header("Location: /public/page/access/sign-in.php");
}

?>
