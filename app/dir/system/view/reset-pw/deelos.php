<?php
$page_title = 'Reset Password';
require_once('../../../private/initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/auth/passwordController.php');
include(SYSTEM_COMPONENT_PATH . '/header.php');
include(SYSTEM_CONFIG_PATH . '/styles.php');
include(SYSTEM_COMPONENT_PATH . '/health-navbar.php');
include(SYSTEM_FORMS_PATH . '/reset-pw-form.php');
include(SYSTEM_COMPONENT_PATH . '/footer.php');
?>
