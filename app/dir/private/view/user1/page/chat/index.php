<?php
  session_start();
  require_once('../../../../initialize.php');
  include(PRIVATE_SECURITY_PATH . '/dbcon.php');
  include(PRIVATE_SECURITY_PATH . '/encrypt_decrypt.php');
  include(ADMIN_COMPONENTS . '/header.php');
?>
<!-- Login session -->
<?php if (isset($_SESSION["userID"])): ?>

<?php
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  include('components/styles.php');
  include('components/navtab.php');
?>

<?php include('process/api.php');?>
<?php include('content/layout.php');?>
<?php include('process/script.php');?>
<?php include('../../modal/logout/logout-modal.php');?>
<!-- auto logout/login session -->
<?php else: ?>
<?php include('../../content/logged_out.php') ?>
<?php endif; ?>
<?php include('../../components/footer.php'); ?>
