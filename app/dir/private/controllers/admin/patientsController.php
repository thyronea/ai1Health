<?php

// 1. Add new patient - Collects patient's information and sends email for verification
if(isset($_POST['add_patient'])){

    // Collected patient demographics (will use name, email and dob for existence)
    include(PRIVATE_MODELS_PATH . '/admin/patients/addPatientCred.php');
  
    // If name + email or name + dob exist, patient will not be added
    if(mysqli_num_rows($checkpatient_run) > 0){
      $_SESSION['warning'] = "Patient Already Exist!";
      header("Location: /private/view/admin/patients/");
      exit(0);
    }
    else{
        // Send email confirmation (for validation)
        include(PRIVATE_CONFIG_PATH . '/newPatientEmail.php');
        // Add patient demographics
        include(PRIVATE_MODELS_PATH . '/admin/patients/addPatientProcess.php');
    
        if($stmt = $con->prepare($patient)){
            $_SESSION['success'] = "Successfully Added $fname $lname!";
            header("Location: /private/view/admin/patients/");
            exit(0);
        }
        else{
            $_SESSION['warning'] = "Unable to Add Patient!";
            header("Location: /private/view/admin/patients/");
            exit(0);
        }
    }
}

// 2. Verify TOKEN sent to email for validation
if(isset($_GET['token'])){

    session_start();
    require_once('../../initialize.php');
    include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
    
    // Get TOKEN from email (email has a link that will get the TOKEN once clicked)
    $token = $_GET['token'];
    $verify_query = "SELECT token, status FROM token WHERE token='$token' LIMIT 1";
    $verify_query_run = mysqli_query($con, $verify_query);
    
    // If TOKEN exist, continue
    if(mysqli_num_rows($verify_query_run) > 0){

        // Process token verification - Update profile and patient status to verified
        include(PRIVATE_MODELS_PATH . '/verification/newPatientVerification.php');
        
    }
    else {
        $_SESSION['warning'] = "This email does not exist";
        header("Location: /system/view/access/");
    }
}

?>