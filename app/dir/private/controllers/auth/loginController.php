<?php
session_start();
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');

// Send verification code
if(isset($_POST['send_code'])){
  
  // Check if email exist
  include(PRIVATE_MODELS_PATH . '/verification/emailVerificationProcess.php');

  // Process if account is verified
  if($status_token['status'] == "1"){

    // Update vcode
    include(PRIVATE_MODELS_PATH . '/password/vCode.php');
    // Message containing the updated vcode
    include(PRIVATE_MODELS_PATH . '/verification/vcodeMessage.php');
    // Send vcode to email
    include(PRIVATE_CONFIG_PATH . '/email.php');

    // Successful email validation; vcode will be sent to email for verification
    if($stmt->execute()){
      $_SESSION['success'] = "Code was sent to your email";
      header("Location: /public/view/verification/");
      exit(0);
    }
    // Error; email doesn't exist
    else{
      $_SESSION['warning'] = "Please register or verify your email address!";
      header("Location: /public/view/access/");
      exit(0);
    }
  }
  // Error; account is not verified
  else{
    $_SESSION['warning'] = "Please register or verify your email address!";
    header("Location: /public/view/access/");
    exit(0);
  }
}

// Login after code verification
if(isset($_POST['login_btn'])){

  // Validates vcode (sent to email)
  include(PRIVATE_MODELS_PATH . '/login/vCodeProcess.php');

  // Proceed if vcode is accurate
  if(mysqli_num_rows($login_query_run) > 0){

    // Entered password + salt code
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $password_salt = "$password$salt";

    // Proceed if password is accurate
    if(password_verify($password_salt, htmlspecialchars($user["password"]))){
        
        // Sessions user's information
        include(PRIVATE_MODELS_PATH . '/login/loginSession.php');
        // Sessions user's location
        include(PRIVATE_MODELS_PATH . '/login/loginLocationSession.php');
        // Updates vcode, sets status to "active", and logs activity 
        include(PRIVATE_MODELS_PATH . '/login/loginProcess.php');

        // Admin page for admin users
        if($_SESSION["role"] == 'Admin'){
          header("Location: /private/view/admin/dashboard/"); // If user type is "Admin", go to admin page
          exit(0);
        }
        // User page for regular users
        elseif($_SESSION["role"] =='User'){
          header("Location: /private/view/user/");  // If user type is "User", go to user page
          exit(0);
        }
    }
    // Error; password is inaccurate
    else{
      $_SESSION['warning'] = "Invalid Password!";
      header("Location: /public/view/verification/");
      exit(0);
    }
  }
  // Error; vcode is inaccurate
  else{
    $_SESSION['warning'] = "Invalid Verification Code!";
    header("Location: /public/view/verification/");
    exit(0);
  }
}
