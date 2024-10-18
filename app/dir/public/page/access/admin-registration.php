<?php
$page_title = 'Registration';
require_once('../../../private/initialize.php');
include(PRIVATE_ACCESS_PATH . '/admin-registration.php');
include(PRIVATE_COMPONENTS_PATH . '/header.php');
include(PRIVATE_COMPONENTS_PATH . '/health-navbar.php');
include(PUBLIC_FORMS_PATH . '/admin-registration-form.php');
include(PRIVATE_COMPONENTS_PATH . '/footer.php');
?>
