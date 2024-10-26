<?php
session_start();
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');

// Forgot password - Sends link to reset password
if(isset($_POST['forgot_pw']))
{
    include(PRIVATE_MODELS_PATH . '/password/passwordCred.php');

    if(mysqli_num_rows($check_email_run) > 0){
            include(PRIVATE_MODELS_PATH . '/password/newToken.php');

        if($update_token_run){
            include(PRIVATE_CONTROLLERS_PATH . '/auth/emailController.php');
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

// Reset password - Creates new password after verification
if(isset($_POST['reset_user_PW_btn']))
{
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


?>
