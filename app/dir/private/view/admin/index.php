<?php
session_start();
require_once('../../initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/auth/dbcon.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
include(ADMIN_COMPONENTS . '/header.php');
include(ADMIN_PROCESS . '/sql.php');
?>
<!-- Login session -->
<?php if (isset($_SESSION["userID"])): ?>
<!-- Key -->
<?php $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]); ?>
<!-- Navtab -->
<?php include(ADMIN_COMPONENTS . '/navtab.php'); ?>
<!-- Page Layout -->
<?php include(ADMIN_CONTENT . '/layout.php'); ?>
<!-- Auto logout/login session -->
<?php else: ?>
<?php include(ADMIN_CONTENT . '/logged_out.php'); ?>
<?php endif; ?>
<?php include(ADMIN_COMPONENTS . '/footer.php'); ?>
