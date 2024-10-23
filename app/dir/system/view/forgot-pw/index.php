<?php
$page_title = 'Forgot Password';
require_once('../../../private/initialize.php');
include(PRIVATE_ACCESS_PATH . '/login-process.php');
include(SYSTEM_COMPONENT_PATH . '/header.php');
include(SYSTEM_CSS_PATH . '/styles.php');
include(SYSTEM_COMPONENT_PATH . '/health-navbar.php');
include(SYSTEM_FORMS_PATH . '/forgot-pw-form.php');
include(SYSTEM_COMPONENT_PATH . '/footer.php');
?>
