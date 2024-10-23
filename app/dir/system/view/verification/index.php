<?php
$page_title = 'Login';
require_once('../../../private/initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/auth/loginController.php');
include(SYSTEM_COMPONENT_PATH . '/header.php');
include(SYSTEM_CSS_PATH . '/styles.php');
include(SYSTEM_COMPONENT_PATH . '/health-navbar.php');
include(SYSTEM_FORMS_PATH . '/login-verification-form.php');
include(SYSTEM_COMPONENT_PATH . '/footer.php');
?>
