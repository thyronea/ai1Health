<?php
session_start();
if (isset($_SESSION["userID"])):{
    require_once('../../../initialize.php');
    include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
    include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
    include(PRIVATE_COMPONENTS_PATH . '/admin/header.php');
    include('components/navtab.php');
    include('content/layout.php');
    include(PRIVATE_COMPONENTS_PATH . '/admin/footer.php');
}
else:{
    include(PRIVATE_CONTROLLERS_PATH . '/auth/logoutController.php');
}
endif;
