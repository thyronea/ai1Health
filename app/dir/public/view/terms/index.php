<?php
  $page_title = 'Terms of Use';
  session_start();
  require_once('../../../private/initialize.php');
  include(PUBLIC_COMPONENT_PATH . '/header.php');
  include(PUBLIC_CONFIG_PATH . '/styles.php');
  include(PUBLIC_COMPONENT_PATH . '/health-navbar.php');
  include(PUBLIC_VIEW_PATH . '/terms/layout.php');
  include(PUBLIC_COMPONENT_PATH . '/footer.php');
?>
