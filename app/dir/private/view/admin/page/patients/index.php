<?php
session_start();
include('../../../../security/dbcon.php');
include('../../../../security/encrypt_decrypt.php');
include('../../components/header.php');
?>

<!-- Login session -->
<?php if (isset($_SESSION["userID"])): ?>

<?php $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]); ?>

<!-- Navtab -->
<?php include('components/navtab-patients.php'); ?>
<!-- Navtab Result -->
<?php include('content/layout.php'); ?>



<!-- auto logout/login session -->
<?php else: ?>
<?php include(ADMIN_COMP_PATH . '/logged_out.php') ?>
<?php endif; ?>

<?php include('../../components/footer.php'); ?>
