<?php
session_start();
require_once('../../../initialize.php');
if(!isset($page_title)) {$page_title='Chat';}
include(PRIVATE_COMPONENTS_PATH . '/admin/header.php');
include('components/styles.php');

if (isset($_SESSION["userID"])):{
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
  include(PRIVATE_VIEW_PATH . '/alerts/emergencyExit.php');
}
endif;
