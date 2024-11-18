<?php
session_start();
require_once('../../../initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
include(PRIVATE_COMPONENTS_PATH . '/admin/header.php');
require_once(PRIVATE_MODELS_PATH . '/admin/sessions.php'); 
include('components/styles.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
?>

<!-- Login session -->
<?php if (isset($_SESSION["userID"])): ?>

<!-- Navtab -->
<?php include(PRIVATE_COMPONENTS_PATH . '/admin/navtab.php'); ?>

<!--Auto direct to homepage after 3 seconds-->
<meta http-equiv="refresh" content="3;url=index.php"/> <!-- Add this to load the most recent chat userID=<?=$get_ID["userID"];?> -->

<!-- Loader Image -->
<div class="loader_on" align="center">
  <img src="components/crazy-deelos.GIF" style="width: 40%; animation: appear 2s ease; animation: spinning_deelos 4s ease">
</div>



<!-- auto logout/login session -->
<?php else: ?>
<?php include(PRIVATE_VIEW_PATH . '/alerts/emergencyExit.php'); ?>
<?php endif; ?>

<?php include(PRIVATE_COMPONENTS_PATH . '/admin/footer.php'); ?>
