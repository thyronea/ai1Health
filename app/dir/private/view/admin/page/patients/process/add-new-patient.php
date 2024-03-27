<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
require '../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

if(isset($_POST['add_patient']))
{
  $token = md5(rand());
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $diversityID = mysqli_real_escape_string($con, $_POST['diversityID']);
  $addressID = mysqli_real_escape_string($con, $_POST['addressID']);
  $contactID = mysqli_real_escape_string($con, $_POST['contactID']);
  $type = mysqli_real_escape_string($con, "Registered Patient");
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $lname = mysqli_real_escape_string($con, $_POST['lname']);
  $suffix = mysqli_real_escape_string($con, $_POST['suffix']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $gender = mysqli_real_escape_string($con, $_POST['gender']);
  $race = mysqli_real_escape_string($con, $_POST['race']);
  $ethnicity = mysqli_real_escape_string($con, $_POST['ethnicity']);
  $address1 = mysqli_real_escape_string($con, $_POST['address1']);
  $address2 = mysqli_real_escape_string($con, $_POST['address2']);
  $city = mysqli_real_escape_string($con, $_POST['city']);
  $state = mysqli_real_escape_string($con, $_POST['state']);
  $zip = mysqli_real_escape_string($con, $_POST['zip']);
  $phone = mysqli_real_escape_string($con, $_POST['phone']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
  $patient_email = mysqli_real_escape_string($con, $_POST['email']);
  $role = mysqli_real_escape_string($con, $_POST['role']);
  $admin = mysqli_real_escape_string($con, "Admin");
  $status = mysqli_real_escape_string($con, "Account Created");
  $patient_image = mysqli_real_escape_string($con, $_FILES['patient_image']['name']);
  $subject = mysqli_real_escape_string($con, "Patient Registration Confirmation");
  $link = mysqli_real_escape_string($con, "pages/patients/content/patient-chart.php?engineID=$engineID");
  $message = htmlspecialchars("
  Hello $fname,

  Your Patient ID is $engineID.

  TO COMPLETE YOUR REGISTRATION, PLEASE CLICK ON THE LINK BELOW:
  http://localhost:8002/private/security/new-patient-email-verification.php?token=$token

  Please DO NOT share your Patient ID.
  If you did not register, please contact admin.

  Thank you!
  ");

  // Check if email exist
  $checkpatient = "SELECT * FROM patients WHERE email='$patient_email' ";
  $checkpatient_run = mysqli_query($con, $checkpatient);

  // If email exist, patient will not be added
  if(mysqli_num_rows($checkpatient_run) > 0)
  {
    $_SESSION['warning'] = "Patient Already Exist!";
    header("Location: /HC/admin/pages/patients/index.php?patient=&button=");
    exit(0);
  }
  else
  {
    // Verifies if image is already in database. If so, patient will not be added
    if(file_exists("upload/" . $_FILES["patient_image"]["name"]))
    {
      $_SESSION['warning'] = "Image Already Exist!";
      header("Location: /HC/admin/pages/patients/index.php");
      exit(0);
    }
    else
    {
      // Send email confirmation
      $mail = new PHPMailer(true);

      $mail->isSMTP();
      $mail->SMTPAuth = true;

      $mail->Host = "smtp.gmail.com";
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587;

      $mail->Username = "thyrone.antonio@gmail.com";
      $mail->Password = "mhopftvkjlemevgn";

      $mail->setFrom($patient_email);
      $mail->addAddress($patient_email);

      $mail->Subject = $subject;
      $mail->Body = $message;

      $mail->send();

      // stores data in token table
      $sql = "INSERT INTO token (userID, groupID, token, dk_token) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($sql);
      $stmt->bind_param("ssss", $patientID, $groupID, $token, $key);
      $stmt->execute();

      // Encrypt Patient Data and insert
      $encrypt_fname = encryptthis($fname, $key);
      $encrypt_lname = encryptthis($lname, $key);
      $encrypt_suffix = encryptthis($suffix, $key);
      $encrypt_patient_email = encryptthis($patient_email, $key);
      $encrypt_role = encryptthis($role, $key);
      $patient = "INSERT INTO patients (patientID, engineID, groupID, fname, lname, suffix, dob, email, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($patient);
      $stmt->bind_param("sssssssss", $patientID, $engineID, $groupID, $encrypt_fname, $encrypt_lname, $encrypt_suffix, $dob, $patient_email, $encrypt_role);
      $stmt->execute();

      // Encrypt Email Data and insert
      $encrypted_admin = encryptthis($admin, $key);
      $encrypted_patient_email = encryptthis($patient_email, $key);
      $encrypted_subject = encryptthis($subject, $key);
      $encrypted_message = encryptthis($message, $key);
      $send_message = "INSERT INTO email (userID, groupID, fromEmail, toEmail, subject, message) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($send_message);
      $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_admin, $encrypted_patient_email, $encrypted_subject, $encrypted_message);
      $stmt->execute();

      // Encrypt Patient's address Data and insert
      $encrypt_address1 = encryptthis($address1, $key);
      $encrypt_address2 = encryptthis($address2, $key);
      $encrypt_city = encryptthis($city, $key);
      $encrypt_state = encryptthis($state, $key);
      $encrypt_zip = encryptthis($zip, $key);
      $address = "INSERT INTO address (patientID, engineID, groupID, address1, address2, city, state, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($address);
      $stmt->bind_param("ssssssss", $patientID, $engineID, $groupID, $encrypt_address1, $encrypt_address2, $encrypt_city, $encrypt_state, $encrypt_zip);
      $stmt->execute();

      // Encrypt Patient's contact Data and insert
      $encrypt_phone = encryptthis($phone, $key);
      $encrypt_mobile = encryptthis($mobile, $key);
      $encrypt_patient_email = encryptthis($patient_email, $key);
      $contact = "INSERT INTO contact (patientID, engineID, groupID, phone, mobile, email) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($contact);
      $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $encrypt_phone, $encrypt_mobile, $encrypt_patient_email);
      $stmt->execute();

      // Encrypt Patient's diversity Data and insert
      $encrypt_dob = encryptthis($dob, $key);
      $encrypt_race = encryptthis($race, $key);
      $encrypt_ethnicity = encryptthis($ethnicity, $key);
      $diversity = "INSERT INTO diversity (patientID, engineID, groupID, dob, gender, race, ethnicity) VALUES (?, ?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($diversity);
      $stmt->bind_param("sssssss", $patientID, $engineID, $groupID, $encrypt_dob, $gender, $encrypt_race, $encrypt_ethnicity);
      $stmt->execute();

      // Encrypt Activities Data
      $fullname = "$user_fname $user_lname";
      $act_message = "$type: $fname $lname";
      $encrypted_fullname = encryptthis($fullname, $key);
      $encrypted_office = encryptthis($office, $key);
      $encrypted_message = encryptthis($act_message, $key);

      // insert activity timestamp
      $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
      $stmt->execute();

      // insert keywords to engine table
      $patient_fullname = "$fname $lname";
      $engine = "INSERT INTO engine (engineID, groupID, keyword1, keyword2, keyword3, link) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($engine);
      $stmt->bind_param("ssssss", $engineID, $groupID, $patient_fullname, $role, $office, $link);
      $stmt->execute();

      // Encrypt Patient's log Data
      $encrypt_status = encryptthis($status, $key);

      // insert to patient log
      $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypt_status);
      $stmt->execute();

      if($stmt = $con->prepare($patient))
      {
        move_uploaded_file($_FILES["patient_image"]["tmp_name"], "/HC/admin/pages/patients/upload/".$_FILES["patient_image"]["name"]);
        $_SESSION['success'] = "Patient Successfully Added!";
        header("Location: /HC/admin/pages/patients/index.php?patient=&button=");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Add Patient!";
        header("Location: /HC/admin/pages/patients/index.php?patient=&button=");
        exit(0);
      }
    }
  }
}

?>
