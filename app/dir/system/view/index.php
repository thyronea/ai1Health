<?php
  $page_title = 'Home';
  session_start();
  require_once('../../private/initialize.php');
  include(SYSTEM_COMPONENT_PATH . '/header.php');
  include(SYSTEM_CONFIG_PATH . '/styles.php');
  include(SYSTEM_COMPONENT_PATH . '/navbar.php');
  include(SYSTEM_CONTENT_PATH . '/layout.php');
  include(SYSTEM_COMPONENT_PATH . '/footer.php');
?>
