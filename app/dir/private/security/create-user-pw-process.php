<?php
session_start();
include('dbcon.php');


if(isset($_POST['createPW_btn']))
{
  $token = mysqli_real_escape_string($con, $_POST['token']);
  $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);

  if(!empty($token))
  {
      $check_token = "SELECT * FROM token WHERE token='$token' LIMIT 1";
      $check_token_run = mysqli_query($con, $check_token);
      $getID = mysqli_fetch_assoc($check_token_run);
      $userID = htmlspecialchars($getID["userID"]);

      if(mysqli_num_rows($check_token_run) > 0)
      {
          $update_password = "UPDATE patients SET password='$new_password' WHERE patientID='$userID' LIMIT 1";
          $update_password_run = mysqli_query($con, $update_password);

          $update_password = "UPDATE admin SET password='$new_password' WHERE userID='$userID' LIMIT 1";
          $update_password_run = mysqli_query($con, $update_password);

          if($update_password_run)
          {
            $_SESSION['success'] = "Password successfully created!";
            header("Location: /public/page/access/sign-in.php");
            exit(0);
          }
          else
          {
            $_SESSION['warning'] = "Unable to create password! Please try again.";
            header("Location: /public/page/password/create-user-pw.php?token=$token");
            exit(0);
          }
      }
      else
      {
        $_SESSION['warning'] = "Invalid Token!";
        header("Location: /public/page/password/create-user-pw.php?token=$token");
        exit(0);
      }
    }
  else
  {
    $_SESSION['warning'] = "Token not found! Please register!";
    header("Location: /public/page/access/user-registration.php");
    exit(0);
  }
}


?>
