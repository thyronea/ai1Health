<?php
if(mysqli_num_rows($check_token_run) > 0){
    // Update password
    include(PRIVATE_MODELS_PATH . '/password/updatePassword.php');

    if($stmt = $con->prepare($update_password)){
        $_SESSION['success'] = "Password successfully updated!";
        header("Location: /system/view/access/");
        exit(0);
    }
    else{
        $_SESSION['warning'] = "Unable to update password! Please try again.";
        header("Location: /system/view/reset-pw/?token=$token");
        exit(0);
    }
}
else{
    $_SESSION['warning'] = "Invalid Token!";
    header("Location: /system/view/reset-pw/?token=$token");
    exit(0);
}
?>