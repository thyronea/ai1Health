<?php
if(mysqli_num_rows($token_query_run) > 0){
    $row = mysqli_fetch_array($token_query_run);
    if(htmlspecialchars($row['status']) == "0")
    {
      // Get token
      include(PRIVATE_MODELS_PATH . '/verification/tokenConfirmation.php');

      if($update_query_run)
      {
        $_SESSION['success'] = "Your account has been verified!";
        header("Location: /system/view/access/");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Verification failed!";
        header("Location: /system/view/access/");
        exit(0);
      }
    }
    else
    {
      $_SESSION['warning'] = "Email already verified! Please log in.";
      header("Location: /system/view/access/");
      exit(0);
    }
  }
  else {
    $_SESSION['warning'] = "This token does not exist";
    header("Location: /system/view/access/");
    exit(0);
  }
?>