<?php
$_SESSION['warning'] = "Invalid Password!";
header("Location: /system/view/verification/");
exit(0);
?>