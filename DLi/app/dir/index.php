<?php
  $page_title = 'Home';
  session_start();
  require_once('private/initialize.php');
  include(PRIVATE_COMPONENTS_PATH . '/header.php');
  include(PRIVATE_COMPONENTS_PATH . '/navbar.php');
  include(PUBLIC_CONTENT_PATH . '/layout.php');
  include(PRIVATE_COMPONENTS_PATH . '/footer.php');
?>
