<?php
$_SESSION['warning'] = "Invalid Verification Code!";
header("Location: /system/view/verification/");
exit(0);
?>