<?php
  session_start();
  include('../../../../security/dbcon.php');
  include('../../../../security/encrypt_decrypt.php');
  include('../../components/header.php');
?>
<!-- Login session -->
<?php if (isset($_SESSION["userID"])): ?>

<?php
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  include('components/styles.php');
  include('process/script.php');
  include('components/navtab.php');
?>

<?php include('content/layout.php');?>


<!-- auto logout/login session -->
<?php else: ?>
<?php include('../../content/logged_out.php') ?>
<?php endif; ?>

<?php include('../../components/footer.php'); ?>
