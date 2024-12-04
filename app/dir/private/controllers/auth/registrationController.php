<?php
session_start();
require_once('../../../private/initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');

// 1. Collects user's information then sends verficiation email
if(isset($_POST['register_btn'])) {

  // User's credentials (collected information from registration form)
  include(PRIVATE_MODELS_PATH . '/registration/registrationCred.php');
  // Email validation
  include(PRIVATE_MODELS_PATH . '/registration/emailValidation.php');

  // Error if email exist
  if(mysqli_num_rows($check_admin_run) > 0) {
    $_SESSION['warning'] = "This Email Already Exist!";
    header("Location: /public/view/access/");
    exit(0);
  }
  // Proceeds with registration
  else {
    // Send email confirmation
    include(PRIVATE_CONFIG_PATH . '/email.php');
    // Process registration
    include(PRIVATE_MODELS_PATH . '/registration/registrationProcess.php');

    // Successful email validation
    if($stmt->execute()){
      $_SESSION['success'] = "Verify Email to Complete Registration!";
      header("Location: /public/view/access/");
      exit(0);
    }
    // Error with collected information
    else{
        $_SESSION['warning'] = "Unable to Register User!";
        header("Location: /public/view/access/");
        exit(0);
    }
  }
}

// 2. Complete registration after email verification
if(isset($_GET['token'])){

  // Gets token from the link (once clicked)
  include(PRIVATE_MODELS_PATH . '/verification/tokenVerification.php');

  // Validate token
  if(mysqli_num_rows($token_query_run) > 0){

    // Fetch associated rows in token table
    $row = mysqli_fetch_array($token_query_run);

    // If status is 0 (unverified), update to 1 (verified) 
    if(htmlspecialchars($row['status']) == "0"){

      // Updates status after token validation
      include(PRIVATE_MODELS_PATH . '/verification/clickedToken.php');

      // Successful verification
      if($stmt->execute()){
        $_SESSION['success'] = "Your account has been verified!";
        header("Location: /public/view/access/");
        exit(0);
      }
      // Error if token is inaccurate
      else{
        $_SESSION['warning'] = "Verification failed!";
        header("Location: /public/view/access/");
        exit(0);
      }
    }
    // Error is account is already verified
    else{
        $_SESSION['warning'] = "Email already verified! Please log in.";
        header("Location: /public/view/access/");
        exit(0);
    }
  }
  // Error if token is null
  else{
    $_SESSION['warning'] = "This token does not exist";
    header("Location: /public/view/access/");
    exit(0);
  }
}

// 1. Admin - Create new user then sends verification email
if(isset($_POST['register_new_user'])){
  // User's information
  include(PRIVATE_MODELS_PATH . '/admin/manager/newUserCred.php');
  // Check if email exist
  include(PRIVATE_MODELS_PATH . '/registration/emailValidation.php');
  
  // If email exist
  if(mysqli_num_rows($check_admin_run) > 0){
    $_SESSION['warning'] = "This Email Already Exist!";
    header("Location: /private/view/admin/manager/");
    exit(0);
  }
  else{
    // Send verification email
    include(PRIVATE_CONFIG_PATH . '/email.php');
    // Add new user - process
    include(PRIVATE_MODELS_PATH . '/admin/manager/newUserProcess.php');

    // Add new user status
    if($stmt = $con->prepare($sql)){
      $_SESSION['success'] = "You have successfully registered a new user! An email has been sent for additional verification.";
      header("Location: /private/view/admin/manager/");
      exit(0);
    }
    else{
        $_SESSION['warning'] = "Unable to Register User!";
        header("Location: /private/view/admin/manager/");
        exit(0);
    }
  }
}

// 2. Create new password (Admin page) - New user creates new password after email verification
if(isset($_GET['nut'])){
  
  // Verification to register new user
  include(PRIVATE_MODELS_PATH . '/verification/nutVerification.php');

  if(mysqli_num_rows($nut_query_run) > 0){
    $row = mysqli_fetch_array($nut_query_run);
    if($row['status'] == "0"){
      
      // Update token status after registration email confirmation
      $clicked_token = $row['token'];
      $update_query = "UPDATE token SET status ='1' WHERE token='$clicked_token' LIMIT 1";
      $update_query_run = mysqli_query($con, $update_query);

      if($update_query_run){
        $_SESSION['success'] = "Your account has been verified!";
        header("Location: /public/view/create-pw/?token=$nut");
        exit(0);
      }
      else{
        $_SESSION['warning'] = "Verification failed!";
        header("Location: /public/view/create-pw/?token=$nut");
        exit(0);
      }
    }
    else{
      $_SESSION['warning'] = "Account already verified! Please log in.";
      header("Location: /public/view/access/");
      exit(0);
    }
  }
  else{
    $_SESSION['warning'] = "This token does not exist";
    header("Location: /public/view/access/");
  }
}

?>
