<?php
  $page_title = 'About';
  session_start();
  require_once('../../../private/initialize.php');
  include(PRIVATE_COMPONENTS_PATH . '/header.php');
  include(PRIVATE_COMPONENTS_PATH . '/jb-navbar.php');
  include(PUBLIC_PAGES_PATH . '/job-board/layout.php');
  include(PRIVATE_COMPONENTS_PATH . '/footer.php');
?>
