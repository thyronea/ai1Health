<?php
// Check for incomplete profile
include(PRIVATE_MODELS_PATH . '/verification/profileValidation.php');

// If profile is incomplete; show profile modal form
if(empty($diversity_check['userID'])){
    // Header alert
    include(PRIVATE_VIEW_PATH . '/alerts/incompleteProfileAlert.php');
    // Profile form5 j  
    include(PRIVATE_VIEW_PATH . '/forms/incompleteProfileForm.php');
}

// Process profile
if(isset($_POST['admin_profile_btn'])){
  
  // Error if profile exist
  if(mysqli_num_rows($diversity_run) > 0){

      $_SESSION['warning'] = "Profile Already Exist!";
      header("Location: /private/view/admin/");
      exit(0);

  }
  // Proceed if profile is missing
  else{
      
      include(PRIVATE_MODELS_PATH . '/admin/profile/profileProcess.php');
      
      if($stmt = $con->prepare($contact)){
        $_SESSION['success'] = "Profile Successfully Completed!";
        header("Location: /private/view/admin/dashboard/");
        exit(0);
      }
      else{
          $_SESSION['warning'] = "Unable to Complete Profile!";
          header("Location: /private/view/admin/dashboard/");
          exit(0);
      }
    
    }
}
?>
