<?php
$page_title = 'Job Board Sign In';
require_once('../../../private/initialize.php');
include(PRIVATE_SECURITY_PATH . '/verification-code-process.php');
include(PRIVATE_COMPONENTS_PATH . '/header.php');
include(PRIVATE_COMPONENTS_PATH . '/navbar2.php');
include(PUBLIC_FORMS_PATH . '/jb-sign-in-form.php');
include(PRIVATE_COMPONENTS_PATH . '/footer.php');
?>
