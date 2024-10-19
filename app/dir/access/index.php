<?php
$page_title = 'Sign In';
require_once('../private/initialize.php');
include(PRIVATE_SECURITY_PATH . '/verification-code-process.php');
include(PRIVATE_COMPONENTS_PATH . '/header.php');
include(PRIVATE_COMPONENTS_PATH . '/health-navbar.php');
include(PUBLIC_FORMS_PATH . '/sign-in-form.php');
include(PRIVATE_COMPONENTS_PATH . '/footer.php');
?>
