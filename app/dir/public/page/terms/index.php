<?php
  $page_title = 'Terms of Use';
  session_start();
  require_once('../../../private/initialize.php');
  include(PRIVATE_COMPONENTS_PATH . '/header.php');
  include(PRIVATE_COMPONENTS_PATH . '/navbar2.php');
  include(PUBLIC_PAGES_PATH . '/terms/layout.php');
  include(PRIVATE_COMPONENTS_PATH . '/footer.php');
?>
