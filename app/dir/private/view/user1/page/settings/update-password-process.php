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

    // Update token
    $update_token  = "UPDATE token SET token=? WHERE userID='$userID' ";
    $stmt = $con->prepare($update_token);
    $stmt->bind_param("s", $token);
    $stmt->execute();

    if($stmt = $con->prepare($update_token))
    {
      send_password_reset($userID, $fname, $lname, $email, $token);
      $_SESSION['success'] = "Link to reset password has been sent!";
      header("Location: /private/view/user/page/settings/index.php?userID=$userID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to reset password!";
      header("Location: /private/view/user/page/settings/index.php?userID=$userID");
      exit(0);
    }
  }
  else
  {
    $_SESSION['warning'] = "Invalid Password!";
    header("Location: /private/view/user/page/settings/index.php?userID=$userID");
    exit(0);
  }
}

?>
