<?php
  session_start();
  require_once('../../../../../private/initialize.php');
  include('../../../../security/dbcon.php');
  include('../../../../security/encrypt_decrypt.php');
  include('../../components/header.php');
  include('process/sql.php');
?>

<!-- Login session -->
<?php if (isset($_SESSION["engineID"])): ?>

<?php 
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]); 
  include('components/navtab.php'); 
  include('content/layout.php'); 
?>

<!-- auto logout/login session -->
<?php else: ?>
<?php include('../../content/logged_out.php') ?>
<?php endif; ?>

<?php include('../../components/footer.php'); ?>
