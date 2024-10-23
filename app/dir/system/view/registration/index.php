<?php
$page_title = 'Registration';
require_once('../../../private/initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/auth/registrationController.php');
include(SYSTEM_COMPONENT_PATH . '/header.php');
include(SYSTEM_CSS_PATH . '/styles.php');
include(SYSTEM_COMPONENT_PATH . '/health-navbar.php');
include(SYSTEM_FORMS_PATH . '/registration-form.php');
include(SYSTEM_COMPONENT_PATH . '/footer.php');
include(SYSTEM_SCRIPTS_PATH . '/registration.php');
?>
