<?php
  $page_title = 'AI1 Health';
  session_start();
  require_once('../../../private/initialize.php');
  include(PUBLIC_COMPONENT_PATH . '/header.php');
  include(PUBLIC_CONFIG_PATH . '/styles.php');
  include(PUBLIC_COMPONENT_PATH . '/health-navbar.php');
  include(PUBLIC_VIEW_PATH . '/healthcare/layout.php');
  include(PUBLIC_COMPONENT_PATH . '/footer.php');
?>
