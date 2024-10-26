<?php
if($stmt = $con->prepare($contact)){
    $_SESSION['success'] = "Profile Successfully Completed!";
    header("Location: /private/view/admin/dashboard/");
    exit(0);
  }
  else{
    $_SESSION['warning'] = "Unable to Complete Profile!";
    header("Location: /private/view/admin/dashboard/");
    exit(0);
  }
?>