<?php
if($stmt = $con->prepare($sql)) {
    $_SESSION['success'] = "Verify Email to Complete Registration!";
    header("Location: /system/view/access/");
    exit(0);
}
else {
    $_SESSION['warning'] = "Unable to Register User!";
    header("Location: /system/view/access/");
    exit(0);
}
?>