<?php
session_start();
include('../../../../security/dbcon.php');
include('../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
include('function.php');

if(isset($_POST['reset_password_btn']))
{
  // PatientID is called and used to fetch patient information
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  // GroupID is called and used to log activiy
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  // Generate new token and use for update
  $token = md5(rand());

  // Retrieves patient's password to verify entered password
  $user_query = "SELECT * FROM admin WHERE userID='$userID' ";
  $user_query_run = mysqli_query($con, $user_query);
  $user = mysqli_fetch_assoc($user_query_run);

  if(password_verify(mysqli_real_escape_string($con, $_POST['password']), htmlspecialchars($user["password"]))) // verify password
  {
    // Retrieves patient's fullname for sending email
    $user_query = "SELECT * FROM profile WHERE userID='$userID' ";
    $user_query_run = mysqli_query($con, $user_query);
    $profile = mysqli_fetch_assoc($user_query_run);

    $fname = htmlspecialchars(decryptthis($profile['fname'], $key));
    $lname = htmlspecialchars(decryptthis($profile['lname'], $key));
    $email = htmlspecialchars(decryptthis($profile['email'], $key));

    // Encrypt Activity Data and insert to Activities table
    $type = mysqli_real_escape_string($con, "Updated");
    $message = mysqli_real_escape_string($con, ": Password");
    $fullname = "$fname $lname";
    $act_message = "$type $fname $lname $message";
    $encrypt_fullname = encryptthis($fullname, $key);
    $encrypt_type = encryptthis($type, $key);
    $encrypt_act_message = encryptthis($act_message, $key);
    $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activity);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_act_message);
    $stmt->execute();

    // Update token
    $update_token  = "UPDATE token SET token=? WHERE userID='$userID' ";
    $stmt = $con->prepare($update_token);
    $stmt->bind_param("s", $token);
    $stmt->execute();

    if($stmt = $con->prepare($update_token))
    {
      send_password_reset($userID, $fname, $lname, $email, $token);
      $_SESSION['success'] = "Link to reset password has been sent!";
      header("Location: ../settings/index.php?userID=$userID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to reset password!";
      header("Location: ../settings/index.php?userID=$userID");
      exit(0);
    }
  }
  else
  {
    $_SESSION['warning'] = "Invalid Password!";
    header("Location: ../settings/index.php?userID=$userID");
    exit(0);
  }
}

?>
