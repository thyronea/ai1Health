<?php
$page_title = 'Login';
require_once('../../../private/initialize.php');
include(PRIVATE_ACCESS_PATH . '/login-process.php');
include(PRIVATE_COMPONENTS_PATH . '/header.php');
include(PRIVATE_COMPONENTS_PATH . '/health-navbar.php');
include(PUBLIC_FORMS_PATH . '/login-verification-form.php');
include(PRIVATE_COMPONENTS_PATH . '/footer.php');
?>
