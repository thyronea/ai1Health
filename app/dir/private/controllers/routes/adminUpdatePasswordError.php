<?php
$_SESSION['warning'] = "Invalid Password!";
header("Location: /private/view/admin/settings/?userID=$userID");
exit(0);
?>