<?php
  $page_title = 'Mutuor';
  session_start();
  require_once('../private/initialize.php');
  include(PRIVATE_COMPONENTS_PATH . '/header.php');
  include(PUBLIC_CONFIG_PATH . '/styles.php');
  include(PRIVATE_COMPONENTS_PATH . '/mutuor-navbar.php');
  include(PUBLIC_VIEW_PATH . '/mutuor/layout.php');
  include(PRIVATE_COMPONENTS_PATH . '/footer.php');
?>
