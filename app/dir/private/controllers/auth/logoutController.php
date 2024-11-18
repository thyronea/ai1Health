<?php
session_start();
require_once('../../../private/initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');

include(PRIVATE_MODELS_PATH . '/logout/logoutCred.php');
include(PRIVATE_MODELS_PATH . '/logout/logoutProcess.php');
include(PRIVATE_MODELS_PATH . '/password/vCode.php');

session_unset();
session_destroy();
header("Location: /system/view/exit/");
exit(0);
?>