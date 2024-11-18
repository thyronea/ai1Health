<?php
if(!isset($page_title)) {$page_title='Patient Chart';}
session_start();

if(isset($_SESSION["userID"])):{
    require_once('../../../initialize.php');
    include(PRIVATE_COMPONENTS_PATH . '/admin/header.php');
    include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
    include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
    include(PRIVATE_MODELS_PATH . '/admin/sessions.php');
    include(PRIVATE_COMPONENTS_PATH . '/admin/patientChart-navtab.php');
    $patientID = mysqli_real_escape_string($con, $_GET['patientID']);
    
    include('process/functions.php');
    include('layout.php');

    include(PRIVATE_COMPONENTS_PATH . '/admin/footer.php');
    include(PRIVATE_MODELS_PATH . '/password/vCode.php');
    include(PRIVATE_SCRIPTS_PATH . '/js.php');
    include('process/jquery.php');
}
else:{
    include(PRIVATE_VIEW_PATH . '/alerts/emergencyExit.php');
}
endif;
?>

