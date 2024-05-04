<?php
session_start();
include('../../../../security/dbcon.php');
include('../../../../security/encrypt_decrypt.php');
include('../../components/header.php');
include('process/function.php');
include('process/api.php');
?>

<!-- Login session -->
<?php if (isset($_SESSION["userID"])): ?>

<!-- Encrypton and Decryption Keys-->  
<?php $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]); ?>
<?php $iz_key = mysqli_real_escape_string($con, $_SESSION["iz_key"]); ?>

<!-- Navtab -->
<?php include('components/navtab.php'); ?>
<!-- Navtab Result -->
<div class="tab-content">
  <?php include('content/snapshot/main.php'); ?>
  <?php include('content/demographic/main.php'); ?>
  <?php include('content/history/main.php'); ?>
  <?php include('content/notes/main.php'); ?>
  <?php include('content/vitals/main.php'); ?>
  <?php include('content/immunization/main.php'); ?>
</div>

<!-- auto logout/login session -->
<?php else: ?>
<?php include('../../content/logged_out.php') ?>
<?php endif; ?>

<?php include('../../components/footer.php'); ?>

