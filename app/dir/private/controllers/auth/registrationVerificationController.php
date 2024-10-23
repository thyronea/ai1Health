<?php
session_start();
include('dbcon.php');
require_once('../../../private/initialize.php');

// Registration email verification
if(isset($_GET['token'])){
    // Get token
    include(PRIVATE_MODELS_PATH . '/verification/tokenVerification.php');
    // Validate token
    include(PRIVATE_CONTROLLERS_PATH . '/routes/tokenValidation.php');
  }
  else {
    // Validation error
    include(PRIVATE_CONTROLLERS_PATH . '/routes/validationError.php');
  }
?>