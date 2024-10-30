<?php
session_start();
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
include(VENDOR_MAILER_PATH . '/Exception.php');
include(VENDOR_MAILER_PATH . '/PHPMailer.php');
include(VENDOR_MAILER_PATH . '/SMTP.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Send verification code
if(isset($_POST['send_code']))
{
   // Retrieves userID and passes to status_query to verify password
   $login_query = "SELECT * FROM admin WHERE email='$email' ";
   $login_query_run = mysqli_query($con, $login_query);
   $user = mysqli_fetch_assoc($login_query_run);
   $userID = htmlspecialchars($user["userID"]);
 
   // Retrieves account status for login verification
   $status_query = "SELECT * FROM token WHERE userID='$userID' ";
   $status_query_run = mysqli_query($con, $status_query);
   $status_token = mysqli_fetch_assoc($status_query_run);
   $key = htmlspecialchars($status_token["dk_token"]); // Used for data encryption and decryption
 
   // Retrieves ID from profile - Use to identify email receiver
   $profile_query = "SELECT * FROM profile WHERE userID='$userID' ";
   $profile_query_run = mysqli_query($con, $profile_query);
   $profile = mysqli_fetch_assoc($profile_query_run);
   $fname = htmlspecialchars(decryptthis($profile["fname"], $key));

  if($status_token['status'] == "1"){
    $vcode = rand(1000,9999); // Generates random verification token
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $subject = htmlspecialchars("Login Verification");
    $message = htmlspecialchars("
    Hello $fname,

    Your login verification code is: $vcode

    If you did not attempt to login, please contact admin.

    ");

    // Send email confirmation
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = "donotreply@ai1system.net";
    $mail->Password = "awxo vbxo hvix pitc";

    $mail->setFrom($email);
    $mail->addAddress($email);

    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();

    // stores vcode in token table for login verification
    $update_vcode = "UPDATE token SET v_code='$vcode' WHERE userID='$userID' ";
    $update_vcode_run = mysqli_query($con, $update_vcode);

    if($update_vcode_run){
      $_SESSION['success'] = "Code was sent to your email";
      header("Location: /system/view/verification/");// If user type is "Admin", go to admin page
      exit(0);
    }
    else{
      $_SESSION['warning'] = "Please register or verify your email address!";
      header("Location: /system/view/access/");
      exit(0);
    }
  }
  else{
    $_SESSION['warning'] = "Please register or verify your email address!";
    header("Location: /system/view/access/");
    exit(0);
  }
}

// Login after code verification
if(isset($_POST['login_btn']))
{
    include(PRIVATE_MODELS_PATH . '/login/loginCred.php');

  if(mysqli_num_rows($login_query_run) > 0)
  {
    if(password_verify(mysqli_real_escape_string($con, $_POST['password']), htmlspecialchars($user["password"])))
    {
        include(PRIVATE_MODELS_PATH . '/login/loginSession.php');

        include(PRIVATE_MODELS_PATH . '/login/loginLocationSession.php');

        include(PRIVATE_MODELS_PATH . '/login/loginProcess.php');

        include(PRIVATE_CONTROLLERS_PATH . '/routes/accessType.php');
    }
    else
    {
      include(PRIVATE_CONTROLLERS_PATH . '/routes/passwordError.php');
    }
  }
  else
  {
    include(PRIVATE_CONTROLLERS_PATH . '/routes/loginInvalidCode.php');
  }
}
