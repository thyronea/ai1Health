<?php
  $page_title = 'Home';
  session_start();
  require_once('../../private/initialize.php');
  include(PUBLIC_COMPONENT_PATH . '/header.php');
  include(PUBLIC_CONFIG_PATH . '/styles.php');
  include(PUBLIC_COMPONENT_PATH . '/navbar.php');
  include(PUBLIC_CONTENT_PATH . '/layout.php');
  include(PUBLIC_COMPONENT_PATH . '/footer.php');
?>
