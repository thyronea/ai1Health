<?php
include(PRIVATE_MODELS_PATH . '/admin/sessions.php'); 
include(PRIVATE_CONFIG_PATH . '/print.php');
include(PRIVATE_VIEW_PATH . '/modals/managerModals.php');  

// Edit user
if(isset($_POST['update_btn'])){
    // Process edit user
    include(PRIVATE_MODELS_PATH . '/admin/manager/userEditProcess.php');  
    // Process status (sucessful or unsuccessful)
    if($stmt->execute()){
        $_SESSION['success'] = "$user_fname $user_lname Successfully Updated!";
        header("Location: /private/view/admin/manager/");
        exit(0);
    }
    else{
        $_SESSION['warning'] = "Unable to Update $user_fname $user_lname!";
        header("Location: /private/view/admin/manager/");
        exit(0);
    }
}

// Delete user
if(isset($_POST['userdeletebtn'])){
    // Process delete user
    include(PRIVATE_MODELS_PATH . '/admin/manager/userDeleteProcess.php');  
    // Process status (sucessful or unsuccessful)
    if($stmt->execute()){
        $_SESSION['success'] = "Successfully Deleted $user_fname $user_lname!";
        header("Location: /private/view/admin/manager/");
        exit(0);
    }
    else{
        $_SESSION['warning'] = "Unable to Delete $user_fname $user_lname!";
        header("Location: /private/view/admin/manager/");
        exit(0);
    }
}

// Add new location
if(isset($_POST['register_location'])){ 
    // Location's info and address validation
    include(PRIVATE_MODELS_PATH . '/admin/manager/newLocationCred.php');  

    // If address exist - Error
    if(mysqli_num_rows($checkaddress_run) > 0){
        $_SESSION['warning'] = "This Location Already Exist!";
        header("Location: /private/view/admin/manager/");
        exit(0);
    }
    else{
        // Process new location
        include(PRIVATE_MODELS_PATH . '/admin/manager/newLocationProcess.php');  

        // Process status (sucessful or unsuccessful)
        if($stmt = $con->prepare($sql)){
            $_SESSION['success'] = "Location Successfully Added!";
            header("Location: /private/view/admin/manager/");
            exit(0);
        }
        else{
            $_SESSION['warning'] = "Unable to Add Location!";
            header("Location: /private/view/admin/manager/");
            exit(0);
        } 
    }
}

// Edit Location
if(isset($_POST['location_update_btn'])):{
    
  // Update location process
  include(PRIVATE_MODELS_PATH . '/admin/manager/updateLocationProcess.php');  

  // Process status (sucessful or unsuccessful)
  if($stmt = $con->prepare($sql)){
    $_SESSION['success'] = "Location Successfully Updated!";
    header("Location: /private/view/admin/manager/");
    exit(0);
    }
    else{
        $_SESSION['warning'] = "Unable to Update Location!";
        header("Location: /private/view/admin/manager/");
        exit(0);
    }
}endif;

// Delete Location
if(isset($_POST['locationdeletebtn'])):{
    // Delete location process
    include(PRIVATE_MODELS_PATH . '/admin/manager/deleteLocationProcess.php');  
    // Process status (sucessful or unsuccessful)
    if($stmt = $con->prepare($location)){
        $_SESSION['success'] = "Successfully Deleted $location_name!";
        header("Location: /private/view/admin/manager/");
        exit(0);
      }
      else{
        $_SESSION['warning'] = "Unable to Delete $location_name!";
        header("Location: /private/view/admin/manager/");
        exit(0);
      }
}endif;

// Send Email
if(isset($_POST['send_admin_email'])):{
    // Additional info for email receiver
    $admin_email = mysqli_real_escape_string($con, $_SESSION['email']);
    $fromName = "$fname $lname";
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $type = mysqli_real_escape_string($con, "Messaged");
  
    // Send email
    include(PRIVATE_CONFIG_PATH . '/send-email.php');
    // Send email process
    include(PRIVATE_MODELS_PATH . '/admin/manager/emailSend.php');  
    // Process status (sucessful or unsuccessful)
    if($stmt = $con->prepare($sql)){
        $_SESSION['success'] = "Email Successfully Sent to $email!";
        header("Location: /private/view/admin/manager/");
        exit(0);
      }
      else{
        $_SESSION['warning'] = "Unable to Send Email to $email!";
        header("Location: /private/view/admin/manager/");
      }
}endif;

// Clear Email Log
if(isset($_POST['clear_email'])){
    // Clear email log process
    include(PRIVATE_MODELS_PATH . '/admin/manager/emailClearLogProcess.php.php');  
    // Process status (sucessful or unsuccessful)
    if($sql_run){
        $_SESSION['success'] = "Successfully Cleared the Email Log!";
        header("Location: /private/view/admin/manager/");
        exit(0);
    }
    else{
        $_SESSION['warning'] = "Unable to Clear the Email Log!";
        header("Location: /private/view/admin/manager/");
        exit(0);
    }
}

// Clear Activity Log
if(isset($_POST['clear_activity'])){
    // Clear email log process
    include(PRIVATE_MODELS_PATH . '/admin/manager/activityClearLogProcess.php');  
    // Process status (sucessful or unsuccessful)
    if($sql_run){
        $_SESSION['success'] = "Successfully Cleared the Activity Log!";
        header("Location: /private/view/admin/manager/");
        exit(0);
    }
    else{
        $_SESSION['warning'] = "Unable to Clear the Activity Log!";
        header("Location: /private/view/admin/manager/");
        exit(0);
    }
}

?>