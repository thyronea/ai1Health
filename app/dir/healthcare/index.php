<?php
  $page_title = 'About';
  session_start();
  require_once('../private/initialize.php');
  include(PRIVATE_COMPONENTS_PATH . '/header.php');
  include(PRIVATE_COMPONENTS_PATH . '/health-navbar.php');
  include(PUBLIC_PAGES_PATH . '/healthcare/layout.php');
  include(PRIVATE_COMPONENTS_PATH . '/footer.php');
?>
