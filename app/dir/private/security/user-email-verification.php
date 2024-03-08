<?php
session_start();
include('dbcon.php');

if(isset($_GET['token']))
{
  $token =$_GET['token'];
  $token_query = "SELECT userID, token, status FROM token WHERE token='$token' LIMIT 1";
  $token_query_run = mysqli_query($con, $token_query);

  if(mysqli_num_rows($token_query_run) > 0)
  {
    $row = mysqli_fetch_array($token_query_run);
    if($row['status'] == "0")
    {
      $clicked_token = mysqli_real_escape_string($con, $row['token']);
      $token_status = mysqli_real_escape_string($con, "1");
      $t_status  = "UPDATE token SET status=? WHERE token='$clicked_token' ";
      $stmt = $con->prepare($t_status);
      $stmt->bind_param("s", $token_status);
      $stmt->execute();

      $userID = mysqli_real_escape_string($con, $row['userID']);
      $user_status = mysqli_real_escape_string($con, "Verified");
      $user  = "UPDATE user SET account_status=? WHERE userID='$userID' ";
      $stmt = $con->prepare($user);
      $stmt->bind_param("s", $user_status);
      $stmt->execute();

      if($stmt = $con->prepare($t_status))
      {
        $_SESSION['success'] = "Your account has been verified!";
        header("Location: /public/page/user-login.php");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Verification failed!";
        header("Location: /public/page/user-login.php");
        exit(0);
      }
    }
    else
    {
      $_SESSION['warning'] = "Email already verified! Please log in.";
      header("Location: /public/page/user-login.php");
      exit(0);
    }
  }
  else {
    $_SESSION['warning'] = "This token does not exist";
    header("Location: /public/page/user-login.php");
  }
}
else {
  $_SESSION['warning'] = "Not allowed";
  header("Location: /public/page/user-login.php");
}

?>
