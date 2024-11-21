<?php 
if(!isset($page_title)) {$page_title='Search';}
require_once('../../../initialize.php');
session_start();

if(isset($_SESSION["userID"])):{
    include(PRIVATE_COMPONENTS_PATH . '/admin/header.php');
    include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
    include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
    include(PRIVATE_MODELS_PATH . '/admin/sessions.php');

    include(PRIVATE_VIEW_PATH . '/admin/search/layout.php');

    include(PRIVATE_COMPONENTS_PATH . '/admin/footer.php');
    include(PRIVATE_MODELS_PATH . '/password/vCode.php'); 
}
else:{
    include(VIEW_ALERTS . '/emergencyExit.php');
}
endif;
?>
