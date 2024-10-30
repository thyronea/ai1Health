<?php 
if($stmt = $con->prepare($update_token)){
    $_SESSION['success'] = "Link to reset password has been sent!";
    header("Location: /private/view/admin/settings/?userID=$userID");
    exit(0);
  }
else{
    $_SESSION['warning'] = "Unable to reset password!";
    header("Location: /private/view/admin/settings/?userID=$userID");
    exit(0);
}
?>