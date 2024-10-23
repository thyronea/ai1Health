<?php
session_start();
include('dbcon.php');

if(isset($_POST['register_btn'])) {

  // User's credentials
  include(PRIVATE_MODELS_PATH . '/registration/registrationCred.php');

  // Email validation
  include(PRIVATE_MODELS_PATH . '/registration/emailValidation.php');

  // Email validation for existence
  if(mysqli_num_rows($check_admin_run) > 0) {
    include(PRIVATE_CONTROLLERS_PATH . '/routes/registrationEmailError.php');
  }
  else {
    // Send email confirmation
    include(PRIVATE_CONTROLLERS_PATH . '/auth/emailController.php');

    // Store auth credentials
    include(PRIVATE_MODELS_PATH . '/registration/registrationAuth.php');

    // Utilize encryption controller
    include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');

    // Process registration
    include(PRIVATE_MODELS_PATH . '/registration/registrationProcess.php');

    // View registration result
    include(PRIVATE_CONTROLLERS_PATH . '/routes/registrationEmailVerification.php');
  }
}
?>
