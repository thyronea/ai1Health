<?php
if(!isset($page_title)) {$page_title='Settings';}
require_once('../../../initialize.php');
session_start();

if(isset($_SESSION["userID"])):{
    include(PRIVATE_COMPONENTS_PATH . '/admin/header.php');
    include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
    include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
    include(PRIVATE_MODELS_PATH . '/admin/profile/userInfo.php');

    include(PRIVATE_VIEW_PATH . '/admin/settings/layout.php');
    include(PRIVATE_COMPONENTS_PATH . '/admin/footer.php');
    include(PRIVATE_MODELS_PATH . '/password/vCode.php');
    include(PRIVATE_SCRIPTS_PATH . '/js.php');
}
else:{
    include(VIEW_ALERTS . '/emergencyExit.php');
}
endif;
?>
