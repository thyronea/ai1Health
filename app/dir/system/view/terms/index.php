<?php
  $page_title = 'Terms of Use';
  session_start();
  require_once('../../../private/initialize.php');
  include(SYSTEM_COMPONENT_PATH . '/header.php');
  include(SYSTEM_CSS_PATH . '/styles.php');
  include(SYSTEM_COMPONENT_PATH . '/health-navbar.php');
  include(SYSTEM_PAGES_PATH . '/terms/layout.php');
  include(SYSTEM_COMPONENT_PATH . '/footer.php');
?>
