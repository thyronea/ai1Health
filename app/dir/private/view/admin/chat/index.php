<?php
if(!isset($page_title)) {$page_title='Chat';}
require_once('../../../initialize.php');
session_start();

if (isset($_SESSION["userID"])):{
  include(PRIVATE_COMPONENTS_PATH . '/admin/header.php');
  include('components/styles.php');
  include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
  include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
  include(PRIVATE_COMPONENTS_PATH . '/admin/navtab.php');
  include('process/api.php');
  include('content/layout.php');
  include('process/script.php');
  include(PRIVATE_MODELS_PATH . '/password/vCode.php');
  include(PRIVATE_COMPONENTS_PATH . '/admin/footer.php');
}
else:{
  include(VIEW_ALERTS . '/emergencyExit.php');
}
endif;
