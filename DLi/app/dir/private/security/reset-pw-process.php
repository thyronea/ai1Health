<?php
session_start();
include('dbcon.php');


if(isset($_POST['reset_user_PW_btn']))
{
  $userID = mysqli_real_escape_string($con, $_POST['userID']);
  $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
  $token = mysqli_real_escape_string($con, $_POST['token']);

  if(!empty($token))
  {
    // Retrieves patientID and passes to update_password for update
    $check_token = "SELECT token FROM token WHERE token='$token' LIMIT 1";
    $check_token_run = mysqli_query($con, $check_token);
    $getID = mysqli_fetch_assoc($check_token_run);

    if(mysqli_num_rows($check_token_run) > 0)
    {
      // Update password
      $update_password  = "UPDATE admin SET password=? WHERE userID='$userID' ";
      $stmt = $con->prepare($update_password);
      $stmt->bind_param("s", $new_password);
      $stmt->execute();

      if($stmt = $con->prepare($update_password))
      {
        $_SESSION['success'] = "Password successfully updated!";
        header("Location: /public/page/access/sign-in.php");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to update password! Please try again.";
        header("Location: /public/page/password/reset-pw.php?token=$token");
        exit(0);
      }
    }
    else
    {
      $_SESSION['warning'] = "Invalid Token!";
      header("Location: /public/page/password/reset-pw.php?token=$token");
      exit(0);
    }
  }
  else
  {
    $_SESSION['warning'] = "Email not found! Please register!";
    header("Location: /public/page/access/register.php");
    exit(0);
  }
}


?>
