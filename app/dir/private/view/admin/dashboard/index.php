<?php
session_start();
require_once('../../../initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
include(PRIVATE_COMPONENTS_PATH . '/admin/header.php');

if(isset($_SESSION["userID"])){
    $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);

    include(PRIVATE_COMPONENTS_PATH . '/admin/navtab.php');
    include(PRIVATE_CONTENT_PATH . '/admin/layout.php'); 

    include(PRIVATE_CONTROLLERS_PATH . '/admin/profileController.php');

    include(PRIVATE_MODELS_PATH . '/password/vCode.php');
    include(PRIVATE_COMPONENTS_PATH . '/admin/footer.php');
    include(PRIVATE_SCRIPTS_PATH . '/js.php');
}
else{
    include(PRIVATE_CONTROLLERS_PATH . '/auth/logoutController.php');
}
?>
