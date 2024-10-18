<?php
  $page_title = 'Contact Us';
  session_start();
  require_once('../../../private/initialize.php');
  include(PRIVATE_COMPONENTS_PATH . '/header.php');
  include(PRIVATE_COMPONENTS_PATH . '/navbar2.php');
  include(PUBLIC_PAGES_PATH . '/contact-us/layout.php');
  include(PRIVATE_COMPONENTS_PATH . '/footer.php');
?>
