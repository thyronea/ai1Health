<?php
session_start();
include(PRIVATE_SECURITY_PATH . '/dbcon.php');
include(PRIVATE_SECURITY_PATH . '/encrypt_decrypt.php');

// Admin login
if(isset($_POST['admin_login_btn']))
{
  $vcode1 = mysqli_real_escape_string($con, $_POST['vcode1']);
  $vcode2 = mysqli_real_escape_string($con, $_POST['vcode2']);
  $vcode3 = mysqli_real_escape_string($con, $_POST['vcode3']);
  $vcode4 = mysqli_real_escape_string($con, $_POST['vcode4']);
  $vcode = "$vcode1$vcode2$vcode3$vcode4";
  $type = mysqli_real_escape_string($con, "Signed in");
  $log = mysqli_real_escape_string($con, "Logged in");

  // Retrieves userID for verification
  $login_query = "SELECT * FROM token WHERE v_code='$vcode'";
  $login_query_run = mysqli_query($con, $login_query);
  $verification = mysqli_fetch_assoc($login_query_run);
  $userID = mysqli_real_escape_string($con, $verification["userID"]);
  $groupID = mysqli_real_escape_string($con, $verification["groupID"]);
  $key = mysqli_real_escape_string($con, $verification["dk_token"]); // Used for data encryption and decryption

  // Retrieves userID and passes to user_query
  $email_query = "SELECT * FROM profile WHERE userID='$userID' ";
  $email_query_run = mysqli_query($con, $email_query);
  $get_email = mysqli_fetch_assoc($email_query_run);
  $email = htmlspecialchars(decryptthis($get_email["email"], $key));

  // Retrieves password to verify entered password
  $user_query = "SELECT * FROM admin WHERE userID='$userID' ";
  $user_query_run = mysqli_query($con, $user_query);
  $user = mysqli_fetch_assoc($user_query_run);

  if(mysqli_num_rows($login_query_run) > 0)
  {
    if(password_verify(mysqli_real_escape_string($con, $_POST['password']), htmlspecialchars($user["password"]))) // verify password
    {

      // Retrieves key for data decryption
      $token_query = "SELECT * FROM token WHERE userID='$userID' ";
      $token_query_run = mysqli_query($con, $token_query);
      $token = mysqli_fetch_assoc($token_query_run);
      $key = mysqli_real_escape_string($con, $token["dk_token"]); // Gets key to decrypt and encrypt data

      // Retreived user's data for SESSION
      $_SESSION["userID"] = htmlspecialchars($user["userID"]);
      $_SESSION["engineID"] = htmlspecialchars($user["engineID"]);
      $_SESSION["groupID"] = htmlspecialchars($user["groupID"]);
      $_SESSION["dk_token"] = htmlspecialchars($token["dk_token"]);

      // Retrieves user profile for data decryption
      $profile_query = "SELECT * FROM profile WHERE userID='$userID' ";
      $profile_query_run = mysqli_query($con, $profile_query);
      $profile = mysqli_fetch_assoc($profile_query_run);
      $_SESSION['fname'] = htmlspecialchars($profile["fname"]); // Retrieved first name for SESSION
      $_SESSION['lname'] = htmlspecialchars($profile["lname"]); // Retrieved last name for SESSION
      $_SESSION['email'] = htmlspecialchars(decryptthis($profile["email"], $key)); // Retrieved email for SESSION
      $_SESSION['role'] = htmlspecialchars(decryptthis($profile["role"], $key)); // Retrieved role for SESSION
      $fname = htmlspecialchars($profile["fname"]); // Decrypted first name
      $lname = htmlspecialchars($profile["lname"]); // Decrypted last name

      // Encrypt Activities Data
      $fullname = "$fname $lname"; // Combines first and last name for encryption
      $encrypted_fullname = encryptthis($fullname, $key); // Full name encryption
      $encrypted_user_log = encryptthis($log, $key); // User Log encryption

      // Insert encrypted data in activities table
      $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activity);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_user_log);
      $stmt->execute();

      // updates vcode
      $new_vcode = rand(1000,9999); // Generates random verification token
      $update_vcode = "UPDATE token SET v_code='$new_vcode' WHERE userID='$userID' ";
      $update_vcode_run = mysqli_query($con, $update_vcode);

      // updates login status
      $status = mysqli_real_escape_string($con, "1");
      $update_status = "UPDATE profile SET online='$status' WHERE userID='$userID' ";
      $update_status_run = mysqli_query($con, $update_status);

      if($_SESSION["role"] == 'Admin')
      {
        header("Location: /private/view/admin/index.php"); // If user type is "Admin", go to admin page
        exit(0);
      }
      elseif($_SESSION["role"] =='User')
      {
        header("Location: /private/view/user/index.php");  // If user type is "User", go to user page
        exit(0);
      }
    }
    else
    {
      $_SESSION['warning'] = "Invalid Password!";
      header("Location: /public/page/access/login-verification.php");
      exit(0);
    }
  }
  else
  {
    $_SESSION['warning'] = "Invalid Verification Code!";
    header("Location: /public/page/access/login-verification.php");
    exit(0);
  }
  $is_invalid = true; // send invalid login message if password is incorrect
}
