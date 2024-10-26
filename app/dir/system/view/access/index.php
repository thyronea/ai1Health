<?php
$page_title = 'Sign In';
require_once('../../../private/initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/auth/loginController.php');
include(SYSTEM_COMPONENT_PATH . '/header.php');
include(SYSTEM_CONFIG_PATH . '/styles.php');
include(SYSTEM_COMPONENT_PATH . '/health-navbar.php');
include(SYSTEM_FORMS_PATH . '/login-form.php');
include(SYSTEM_COMPONENT_PATH . '/footer.php');
?>
