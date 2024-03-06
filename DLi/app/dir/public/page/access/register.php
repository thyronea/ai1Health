<?php
$page_title = 'Registration';
session_start();
require_once('../../../private/initialize.php');
include(PRIVATE_COMPONENTS_PATH . '/scripts.php');
include(PRIVATE_COMPONENTS_PATH . '/header.php');
include(PRIVATE_COMPONENTS_PATH . '/navbar2.php');
include(PUBLIC_CONTENT_PATH . '/registration-option.php');
include(PRIVATE_COMPONENTS_PATH . '/footer.php');
?>
