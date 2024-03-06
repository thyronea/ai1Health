<?php
  $page_title = 'About';
  session_start();
  require_once('../../../private/initialize.php');
  include(PRIVATE_COMPONENTS_PATH . '/header.php');
  include(PRIVATE_COMPONENTS_PATH . '/navbar3.php');
  include(PUBLIC_PAGES_PATH . '/about/layout.php');
  include(PRIVATE_COMPONENTS_PATH . '/footer.php');
?>
