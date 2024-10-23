<?php
session_start();
require_once('../../../private/initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/auth/dbcon.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
include(PRIVATE_MODELS_PATH . '/logout/logoutCred.php');
include(PRIVATE_MODELS_PATH . '/verification/verificationCode.php');
include(PRIVATE_MODELS_PATH . '/logout/logoutProcess.php');
session_unset();
session_destroy();
header("Location: /system/view/exit/");
exit(0);
?>