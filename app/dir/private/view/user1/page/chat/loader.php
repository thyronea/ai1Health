<?php
session_start();
require_once('../../../../initialize.php');
include(PRIVATE_SECURITY_PATH . '/dbcon.php');
include(PRIVATE_SECURITY_PATH . '/encrypt_decrypt.php');
include(ADMIN_COMPONENTS . '/header.php');
include('components/styles.php');
?>

<!-- Login session -->
<?php if (isset($_SESSION["userID"])): ?>

<!-- Encryption & Decryption Key -->
<?php $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]); ?>

<!-- Navtab -->
<?php include('components/navtab.php'); ?>

<!--Auto direct to homepage after 3 seconds-->
<meta http-equiv="refresh" content="3;url=index.php"/> <!-- Add this to load the most recent chat userID=<?=$get_ID["userID"];?> -->

<!-- Loader Image -->
<div class="loader_on" align="center">
  <img src="components/crazy-deelos.GIF" style="width: 40%; animation: appear 2s ease; animation: spinning_deelos 4s ease">
</div>



<!-- auto logout/login session -->
<?php else: ?>
<?php include('../../content/logged_out.php') ?>
<?php endif; ?>

<?php include('../../components/footer.php'); ?>
