<?php
  $page_title = 'Mutuor';
  session_start();
  require_once('../private/initialize.php');
  include(PRIVATE_COMPONENTS_PATH . '/header.php');
  include(SYSTEM_CSS_PATH . '/styles.php');
  include(PRIVATE_COMPONENTS_PATH . '/mutuor-navbar.php');
  include(SYSTEM_PAGES_PATH . '/mutuor/layout.php');
  include(PRIVATE_COMPONENTS_PATH . '/footer.php');
?>
