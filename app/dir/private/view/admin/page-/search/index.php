<?php
session_start();
require_once('../../../../initialize.php');
include(PRIVATE_SECURITY_PATH . '/dbcon.php');
include(ADMIN_COMPONENTS . '/header.php');
?>
<!-- Login session -->
<?php if (isset($_SESSION["userID"])): ?>

<!-- Search Result -->
<?php include ('search-result.php'); ?>

<!-- auto logout/login session -->
<?php else: ?>
<?php include(ADMIN_CONTENT . '/logged_out.php') ?>
<?php endif; ?>
<?php include(ADMIN_COMPONENTS . '/footer.php'); ?>
