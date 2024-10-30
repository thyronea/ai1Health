<?php
session_start();
include('../../../../security/dbcon.php');
include('../../components/header.php');
?>

<!-- Login session -->
<?php if (isset($_SESSION["userID"])): ?>

<!-- Update vcode -->
<?php include('process/sql.php'); ?>

<!-- Navtab -->
<?php include('components/navtab.php'); ?>

<!-- Layout -->
<?php include('content/layout.php'); ?>

<!-- Auto logout/login session -->
<?php else: ?>
<?php include('../../content/logged_out.php') ?>
<?php endif; ?>

<?php include('../../components/footer.php'); ?>
