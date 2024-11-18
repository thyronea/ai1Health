<?php 
if(!isset($page_title)) {$page_title='Profile';}
session_start();

if(isset($_SESSION["userID"])):{
    require_once('../../../initialize.php');
    include(PRIVATE_COMPONENTS_PATH . '/admin/header.php');
    include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
    include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
    include(PRIVATE_MODELS_PATH . '/admin/sessions.php');

    include(PRIVATE_VIEW_PATH . '/admin/profile/layout.php');

    include(PRIVATE_COMPONENTS_PATH . '/admin/footer.php');
    include(PRIVATE_MODELS_PATH . '/password/vCode.php'); 
}
else:{
    include(PRIVATE_CONTROLLERS_PATH . '/auth/logoutController.php');
}
endif;
?>
