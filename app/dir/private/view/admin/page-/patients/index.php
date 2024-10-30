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
  $iz_key = mysqli_real_escape_string($con, $_SESSION["iz_key"]);  
?>

<!-- Navtab -->
<?php include('components/navtab-patients.php'); ?>
<!-- Navtab Result -->
<?php include('content/layout.php'); ?>



<!-- auto logout/login session -->
<?php else: ?>
<?php include('../../../content/logged_out.php') ?>
<?php endif; ?>

<?php include('../../components/footer.php'); ?>

<?php
// Update vcode - move this code inside "sql.php" and include the file directory on top.
if(isset($_SESSION["userID"])){
    $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
    $new_vcode = rand(1000,9999); // Generates random verification token
    $update_vcode = "UPDATE token SET v_code='$new_vcode' WHERE userID='$userID' ";
    $update_vcode_run = mysqli_query($con, $update_vcode);
  }
?>
