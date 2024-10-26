<?php 
session_start();
require_once('../../../initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
include(PRIVATE_COMPONENTS_PATH . '/admin/header.php');

if (isset($_SESSION["userID"])){
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);

  if (isset($_GET["userID"])){
    include(PRIVATE_VIEW_PATH . '/admin/profile/layout.php'); 
  }
  else{
    include(PRIVATE_CONTROLLERS_PATH . '/auth/logoutController.php');
  }
}
else{
  exit(0);
}

include(PRIVATE_COMPONENTS_PATH . '/admin/footer.php');
?>
