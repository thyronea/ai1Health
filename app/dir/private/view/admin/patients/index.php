<?php
if(!isset($page_title)) {$page_title='Patients';}
session_start();

if(isset($_SESSION["userID"])):{
    require_once('../../../initialize.php');
    include(PRIVATE_COMPONENTS_PATH . '/admin/header.php');
    include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
    include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
    include(PRIVATE_MODELS_PATH . '/admin/sessions.php');
    include(PRIVATE_COMPONENTS_PATH . '/admin/navtab.php');

    include(VIEW_ADMIN . '/patients/layout.php'); 
    
    include(PRIVATE_COMPONENTS_PATH . '/admin/footer.php');
    include(PRIVATE_MODELS_PATH . '/password/vCode.php');
    include(PRIVATE_SCRIPTS_PATH . '/js.php');
}
else:{
    include(PRIVATE_VIEW_PATH . '/alerts/emergencyExit.php');
}
endif;
?>


