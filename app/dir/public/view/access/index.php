<?php
$page_title = 'Sign In';
require_once('../../../private/initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/auth/loginController.php');
include(PUBLIC_COMPONENT_PATH . '/header.php');
include(PUBLIC_CONFIG_PATH . '/styles.php');
include(PUBLIC_COMPONENT_PATH . '/health-navbar.php');
include(PUBLIC_FORMS_PATH . '/login-form.php');
include(PUBLIC_COMPONENT_PATH . '/footer.php');
?>
