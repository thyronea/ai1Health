<?php
  $page_title = 'About';
  session_start();
  require_once('../../../private/initialize.php');
  include(SYSTEM_COMPONENT_PATH . '/header.php');
  include(SYSTEM_CSS_PATH . '/styles.php');
  include(SYSTEM_COMPONENT_PATH . '/health-navbar.php');
  include(SYSTEM_VIEW_PATH . '/healthcare/layout.php');
  include(SYSTEM_COMPONENT_PATH . '/footer.php');
?>
