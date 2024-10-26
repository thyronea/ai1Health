<?php
$_SESSION['warning'] = "Email not found! Please register!";
header("Location: /system/view/forgot-pw/");
exit(0);
?>