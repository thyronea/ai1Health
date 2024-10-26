<?php
// Check for incomplete profile
include(PRIVATE_MODELS_PATH . '/verification/profileValidation.php');

// Incomplete profile modal form
if(empty($diversity_check['userID'])){
    include(PRIVATE_VIEW_PATH . '/modal/incompleteProfileAlert.php');
    include(PRIVATE_VIEW_PATH . '/forms/incompleteProfileForm.php');
}

// Process profile
if(isset($_POST['admin_profile_btn'])){

  include(PRIVATE_MODELS_PATH . '/admin/profileCred.php');

  if(mysqli_num_rows($diversity_run) > 0){

    include(PRIVATE_CONTROLLERS_PATH . '/routes/profileExist.php');

  }
  else{
    
    include(PRIVATE_MODELS_PATH . '/admin/profileProcess.php');
    include(PRIVATE_CONTROLLERS_PATH . '/routes/profileStatus.php');
    
  }
}
?>
