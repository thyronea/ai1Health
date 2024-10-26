<?php
session_start();
require_once('../../../private/initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');

// Collects user's information then sends verficiation email
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
    include(PRIVATE_CONFIG_PATH . '/email.php');

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

// Complete registration after email verification
if(isset($_GET['token'])){
  // Get token
  include(PRIVATE_MODELS_PATH . '/verification/tokenVerification.php');
  // Validate token
  include(PRIVATE_CONTROLLERS_PATH . '/routes/tokenValidation.php');
}
?>
