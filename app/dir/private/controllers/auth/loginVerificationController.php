<?php
session_start();
$is_invalid = false;
include('dbcon.php');

// Login verification
if(isset($_POST['send_code']))
{
  include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
  include(PRIVATE_MODELS_PATH . '/verification/emailVerificationCred.php');

  if($status_token['status'] == "1")
  {
    include(PRIVATE_MODELS_PATH . '/verification/emailVerificationCode.php');
    include(PRIVATE_MODELS_PATH . '/verification/emailVerification.php');
    include(PRIVATE_CONTROLLERS_PATH . '/routes/loginCodeVerification.php');
  }
  else{
    include(PRIVATE_CONTROLLERS_PATH . '/routes/loginError.php');
  }
  // send invalid login message if password is incorrect
  $is_invalid = true;
}


?>
