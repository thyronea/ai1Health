<?php
$_SESSION['warning'] = "Unable to reset password!";
header("Location: /system/view/forgot-pw/");
exit(0);
?>