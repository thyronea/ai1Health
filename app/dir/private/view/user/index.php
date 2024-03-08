<?php
session_start();
require_once('../../initialize.php');
include(PRIVATE_SECURITY_PATH . '/dbcon.php');
include(PRIVATE_SECURITY_PATH . '/encrypt_decrypt.php');
include(ADMIN_COMPONENTS . '/header.php');

if(isset($_SESSION["userID"])) // Login session
{
  include('components/navtab.php'); // Navtab
  include('components/alert.php'); // Header Alert
  include('content/menu.php'); // Content (Navtab result)

  // "Complete Profile" Modal Alert (for new users)
  include('modal/notification/complete-profile/main.php');
  include('modal/notification/complete-profile/alert-process.php');

  // Additional Modal
  include('modal/logout/logout-modal.php');
}
else
{
  include(ADMIN_CONTENT . '/logged_out.php'); // Exit session
}

include(ADMIN_COMPONENTS . '/footer.php');

?>
