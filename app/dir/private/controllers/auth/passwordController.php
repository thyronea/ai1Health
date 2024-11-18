<?php
session_start();
require_once('../../../private/initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');

// 1. Forgot password (public page) - Sends link to reset password
if(isset($_POST['forgot_pw'])):{

    include(PRIVATE_MODELS_PATH . '/password/passwordCred.php');

    if(mysqli_num_rows($check_email_run) > 0){

            include(PRIVATE_MODELS_PATH . '/password/newToken.php');

        if($update_token_run){
            
            include(PRIVATE_CONFIG_PATH . '/email.php');

            $_SESSION['success'] = "Link to reset password has been sent!";
            header("Location: /system/view/access/");
            exit(0);

        }
        else{
            // Error message
            $_SESSION['warning'] = "Unable to reset password!";
            header("Location: /system/view/forgot-pw/");
            exit(0);
        }
    }
    else{
        // Error message
        $_SESSION['warning'] = "Unable to reset password!";
        header("Location: /system/view/forgot-pw/");
        exit(0);
    }
}endif;

// 2. Reset password
if(isset($_POST['reset_user_PW_btn'])):{

    // New created password
    include(PRIVATE_MODELS_PATH . '/password/newPassword.php');

    if(!empty($token)){

        // Retrieves patientID to update_password for update
        include(PRIVATE_MODELS_PATH . '/verification/tokenVerification.php');

        // Proceed if token is accurate
        if(mysqli_num_rows($check_token_run) > 0){

            // Update password
            include(PRIVATE_MODELS_PATH . '/password/updatePassword.php');

            if($stmt->execute()){
                $_SESSION['success'] = "Password successfully updated!";
                header("Location: /system/view/access/");
                exit(0);
            }
            else{
                $_SESSION['warning'] = "Unable to update password! Please try again.";
                header("Location: /system/view/create-pw/?token=$token");
                exit(0);
            }
        }
        // Error; token is inaccurate
        else{
            $_SESSION['warning'] = "Invalid Token!";
            header("Location: /system/view/create-pw/?token=$token");
            exit(0);
        }
    }
    // Error; token does not exist
    else{
        $_SESSION['warning'] = "Unable to reset password!";
        header("Location: /system/view/forgot-pw/");
        exit(0);
    }
}endif;

// 1. Update password (Admin page) - Sends Link to reset password 
if(isset($_POST['reset_password_btn'])):{

    // Fetch salt and entered password for validation
    include(PRIVATE_MODELS_PATH . '/password/passwordCheck.php');

    // Verifies password accuracy
    if(password_verify($password_salt, $currentPassword)){ 

        include(PRIVATE_MODELS_PATH . '/admin/sessions.php');
        // Email message containing token for verification
        include(PRIVATE_MODELS_PATH . '/password/resetPasswordEmail.php');
        // Send email
        include(PRIVATE_CONFIG_PATH . '/email.php');
        // Update token
        include(PRIVATE_MODELS_PATH . '/password/updateToken.php');
        // Activity log
        include(PRIVATE_MODELS_PATH . '/password/adminPasswordLog.php');
        
        // Successful password validation; Send email to verify password change request
        if($stmt = $con->prepare($update_token)){

            $_SESSION['success'] = "Link to reset password has been sent!";
            header("Location: /private/view/admin/settings/?userID=$userID");
            exit(0);
        
        }
        // Error; Invalid email address, token or session information
        else{
            
            $_SESSION['warning'] = "Unable to reset password!";
            header("Location: /private/view/admin/settings/?userID=$userID");
            exit(0);
        
        }

    }
    // Error; Invalid password
    else{
        $_SESSION['warning'] = "Invalid Password!";
        header("Location: /private/view/admin/settings/?userID=$userID");
        exit(0);
    }
}endif;

// 2. Creates password after email verification
if(isset($_POST['create_new_pw'])){

    // New password and salt code
    include(PRIVATE_MODELS_PATH . '/password/newPassword.php');

    // If token is valid (sent to user's email)
    if(!empty($token)){

        // Retrieves patientID to update_password for update
        include(PRIVATE_MODELS_PATH . '/verification/tokenVerification.php');

        // Update password / Routes
        if(mysqli_num_rows($check_token_run) > 0){
            
            // Process password update
            include(PRIVATE_MODELS_PATH . '/password/updatePassword.php');
            
            // Successfull update
            if($stmt = $con->prepare($update_password)){
                    $_SESSION['success'] = "Password successfully updated!";
                    header("Location: /system/view/access/");
                    exit(0);
            }
            // Error; Invalid userID
            else{
                $_SESSION['warning'] = "Unable to update password! Please try again.";
                header("Location: /system/view/create-pw/?token=$token");
                exit(0);
            }
        }
        // Error; Invalid token
        else{
            $_SESSION['warning'] = "Invalid Token!";
            header("Location: /system/view/create-pw/?token=$token");
            exit(0);
        }

    }
    else{
        // Error; Token does not exist
        $_SESSION['warning'] = "Unable to reset password!";
        header("Location: /system/view/forgot-pw/");
        exit(0);

    }
}



?>
