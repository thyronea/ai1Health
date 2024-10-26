<?php
session_start();
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');

// Send verification code
if(isset($_POST['send_code']))
{
  include(PRIVATE_MODELS_PATH . '/verification/emailVerificationCred.php');

  if($status_token['status'] == "1")
  {
    include(PRIVATE_MODELS_PATH . '/verification/tokenUpdate.php');
    include(PRIVATE_MODELS_PATH . '/verification/emailVerification.php');
    include(PRIVATE_CONFIG_PATH . '/email.php');
    include(PRIVATE_CONTROLLERS_PATH . '/routes/loginCodeVerification.php');
  }
  else{
    include(PRIVATE_CONTROLLERS_PATH . '/routes/loginError.php');
  }
}

// Login after code verification
if(isset($_POST['login_btn']))
{
    include(PRIVATE_MODELS_PATH . '/login/loginCred.php');

  if(mysqli_num_rows($login_query_run) > 0)
  {
    if(password_verify(mysqli_real_escape_string($con, $_POST['password']), htmlspecialchars($user["password"])))
    {
        include(PRIVATE_MODELS_PATH . '/login/loginSession.php');

        include(PRIVATE_MODELS_PATH . '/login/loginLocationSession.php');

        include(PRIVATE_MODELS_PATH . '/login/loginProcess.php');

        include(PRIVATE_CONTROLLERS_PATH . '/routes/accessType.php');
    }
    else
    {
      include(PRIVATE_CONTROLLERS_PATH . '/routes/passwordError.php');
    }
  }
  else
  {
    include(PRIVATE_CONTROLLERS_PATH . '/routes/loginInvalidCode.php');
  }
}
