<?php
session_start();
include(PRIVATE_CONTROLLERS_PATH . '/auth/dbcon.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');

// Admin login
if(isset($_POST['admin_login_btn']))
{
    include(PRIVATE_MODELS_PATH . '/login/loginCred.php');

  if(mysqli_num_rows($login_query_run) > 0)
  {
    if(password_verify(mysqli_real_escape_string($con, $_POST['password']), htmlspecialchars($user["password"]))) // verify password
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
  $is_invalid = true; // send invalid login message if password is incorrect
}
