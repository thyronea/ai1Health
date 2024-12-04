<?php
  $page_title = 'Privacy Policy';
  session_start();
  require_once('../../../private/initialize.php');
  include(PUBLIC_COMPONENT_PATH . '/header.php');
  include(PUBLIC_CONFIG_PATH . '/styles.php');
  include(PUBLIC_COMPONENT_PATH . '/health-navbar.php');
  include('layout.php');
  include(PUBLIC_COMPONENT_PATH . '/footer.php');
?>
