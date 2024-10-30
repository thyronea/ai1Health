<?php
if($stmt->execute()){
  $_SESSION['success'] = "Code was sent to your email";
  header("Location: /system/view/verification/");
  exit(0);
}
else{
  $_SESSION['warning'] = "Please register or verify your email address!";
  header("Location: /system/view/access/");
  exit(0);
}
?>