<?php
$page_title = 'Reset Password';
require_once('../../../private/initialize.php');
include(PRIVATE_SECURITY_PATH . '/reset-pw-process.php');
include(PRIVATE_COMPONENTS_PATH . '/header.php');
include(PRIVATE_COMPONENTS_PATH . '/health-navbar.php');
include(PUBLIC_FORMS_PATH . '/reset-pw-form.php');
include(PRIVATE_COMPONENTS_PATH . '/footer.php');
?>
