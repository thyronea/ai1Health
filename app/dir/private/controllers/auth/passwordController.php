<?php
session_start();
require_once('../../../private/initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');

// 1. Forgot password (Access page) - Sends link to reset password
if(isset($_POST['forgot_pw'])){
    include(PRIVATE_MODELS_PATH . '/password/passwordCred.php');

    if(mysqli_num_rows($check_email_run) > 0){
            include(PRIVATE_MODELS_PATH . '/password/newToken.php');

        if($update_token_run){
            include(PRIVATE_CONFIG_PATH . '/email.php');
            include(PRIVATE_CONTROLLERS_PATH . '/routes/pwResetLink.php');
        }
        else{
            // Error message
            include(PRIVATE_CONTROLLERS_PATH . '/routes/pwResetError.php');
        }
    }
    else{
        // Error message
        include(PRIVATE_CONTROLLERS_PATH . '/routes/pwEmailError.php');
    }
}

// 2. Reset password
if(isset($_POST['reset_user_PW_btn'])){
    include(PRIVATE_MODELS_PATH . '/password/newPassword.php');

    if(!empty($token)){
        // Retrieves patientID to update_password for update
        include(PRIVATE_MODELS_PATH . '/verification/tokenVerification.php');

        // Update password / Routes
        include(PRIVATE_MODELS_PATH . '/password/passwordProcess.php');
    }
    else{
        // Error message
        include(PRIVATE_CONTROLLERS_PATH . '/routes/pwEmailError.php');
    }
}

// Update password (Admin page) - Sends Link to reset password 
if(isset($_POST['reset_password_btn'])){
  include(PRIVATE_MODELS_PATH . '/password/adminPasswordCred.php');

  if(password_verify(mysqli_real_escape_string($con, $_POST['password']), htmlspecialchars($user["password"]))){ 
    
    include(PRIVATE_CONFIG_PATH . '/email.php');
    include(PRIVATE_MODELS_PATH . '/password/updateToken.php');
    include(PRIVATE_MODELS_PATH . '/password/adminPasswordLog.php');
    include(PRIVATE_CONTROLLERS_PATH . '/routes/adminUpdatePassword.php');
  }
  else{
    include(PRIVATE_CONTROLLERS_PATH . '/routes/adminUpdatePasswordError.php');
  }
}



?>
