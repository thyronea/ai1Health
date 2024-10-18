<?php
$page_title = 'Forgot Password';
require_once('../private/initialize.php');
include(PRIVATE_ACCESS_PATH . '/login-process.php');
include(PRIVATE_COMPONENTS_PATH . '/header.php');
include('..//healthcare/navbar.php');
include(PUBLIC_FORMS_PATH . '/forgot-pw-form.php');
include(PRIVATE_COMPONENTS_PATH . '/footer.php');
?>
