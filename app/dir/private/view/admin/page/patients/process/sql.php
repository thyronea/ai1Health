<?php
session_start();
include('../../../components/dbcon.php');
include('../../../components/encrypt_decrypt.php'); // encryption/decryption source
// PHPMailer source code
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Delete vaccine from inventory when 0
if(isset($_GET['engineID']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $zero = mysqli_real_escape_string($con, "0");
  $vaccines = "DELETE FROM vaccines WHERE groupID=? AND doses=?  ";
  $stmt = $con->prepare($vaccines);
  $stmt->bind_param("ss", $groupID, $zero);
  $stmt->execute();
}

// Display Organization from database to snapshot
if(isset($_GET['engineID']))
{
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $engineID = mysqli_real_escape_string($con, $_GET['engineID']);
  $query = "SELECT * FROM organization WHERE groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $org = mysqli_fetch_array($query_run);
    foreach($query_run as $organization){}
  }
}

// Display patient name from database to snapshot
if(isset($_GET['engineID']))
{
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $engineID = mysqli_real_escape_string($con, $_GET['engineID']);
  $query = "SELECT * FROM patients WHERE engineID='$engineID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $patients = mysqli_fetch_array($query_run);
    foreach($query_run as $patient){}
  }
}

// Display patient diversity from database to snapshot
if(isset($_GET['engineID']))
{
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $engineID = mysqli_real_escape_string($con, $_GET['engineID']);
  $query = "SELECT * FROM diversity WHERE engineID='$engineID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $diverse = mysqli_fetch_array($query_run);
    foreach($query_run as $diversity){}
  }
}

// Display patient address from database to snapshot
if(isset($_GET['engineID']))
{
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $engineID = mysqli_real_escape_string($con, $_GET['engineID']);
  $query = "SELECT * FROM address WHERE engineID='$engineID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $add = mysqli_fetch_array($query_run);
    foreach($query_run as $address){}
  }
}

// Display patient contact from database to snapshot
if(isset($_GET['engineID']))
{
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $engineID = mysqli_real_escape_string($con, $_GET['engineID']);
  $query = "SELECT * FROM contact WHERE engineID='$engineID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $contact = mysqli_fetch_array($query_run);
    foreach($query_run as $contacts){}
  }
}

// Display patient's health plan from database to snapshot
if(isset($_GET['engineID']))
{
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $id = mysqli_real_escape_string($con, $_GET['engineID']);
  $query = "SELECT * FROM healthplan WHERE engineID='$engineID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $plans = mysqli_fetch_array($query_run);
    foreach($query_run as $plan){}
  }
}

// Display patient's emergency contact from database to demographic
if(isset($_GET['engineID']))
{
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $id = mysqli_real_escape_string($con, $_GET['engineID']);
  $query = "SELECT * FROM emergency_contact WHERE engineID='$engineID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $emergency = mysqli_fetch_array($query_run);
    foreach($query_run as $emergency_contact){}
  }
}

// Add New Patient
if(isset($_POST['add_patient']))
{
  $token = md5(rand());
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
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
  http://localhost/HC/private/process/new-patient-email-verification.php?token=$token

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

// Delete Patient
if(isset($_POST['delete_patient']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $activity_type = mysqli_real_escape_string($con, "Deleted");
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_name = mysqli_real_escape_string($con, $_POST['patient_name']);
  $type = mysqli_real_escape_string($con, "Account");

  // Encrypt Activities Data
  $fullname = "$fname $lname";
  $act_message = "$activity_type $patient_name's $type";
  $encrypted_fullname = encryptthis($fullname, $key);
  $encrypted_office = encryptthis($office, $key);
  $encrypted_message = encryptthis($act_message, $key);

  // insert activity timestamp
  $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activities);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
  $stmt->execute();

  // Delete from engine table
  $engine = "DELETE FROM engine WHERE engineID=?";
  $stmt = $con->prepare($engine);
  $stmt->bind_param("s", $engineID);
  $stmt->execute();

  // Delete from patients table
  $patients = "DELETE FROM patients WHERE patientID=?";
  $stmt = $con->prepare($patients);
  $stmt->bind_param("s", $patientID);
  $stmt->execute();

  // Delete from token table
  $token = "DELETE FROM token WHERE userID=?";
  $stmt = $con->prepare($token);
  $stmt->bind_param("s", $patientID);
  $stmt->execute();

  if($stmt = $con->prepare($patients))
  {
    $_SESSION['success'] = "Successfully Deleted $patient_name's $type!";
    header("Location: /HC/admin/pages/patients/index.php?patient=&button=");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Delete $patient_name's $type!";
    header("Location: /HC/admin/pages/patients/index.php?patient=&button=");
    exit(0);
  }
}

// Edit Patient - Name and Diversity
if(isset($_POST['patient_editbtn']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $groupID = mysqli_real_escape_string($con, $_POST['groupID']);
  $patient_email = mysqli_real_escape_string($con, $_POST['email']);
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $lname = mysqli_real_escape_string($con, $_POST['lname']);
  $suffix = mysqli_real_escape_string($con, $_POST['suffix']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $gender = mysqli_real_escape_string($con, $_POST['gender']);
  $race = mysqli_real_escape_string($con, $_POST['race']);
  $ethnicity = mysqli_real_escape_string($con, $_POST['ethnicity']);
  $message = mysqli_real_escape_string($con, "profile");
  $type = mysqli_real_escape_string($con, "Updated");

  // Encrypt Activities Data and insert
  $fullname = "$fname $lname";
  $act_message = "$type $fullname's $message";
  $encrypted_fullname = encryptthis($fullname, $key);
  $encrypted_office = encryptthis($office, $key);
  $encrypted_message = encryptthis($act_message, $key);
  $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activities);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
  $stmt->execute();

  // Encrypt Patient's diversity Data and update
  $encrypt_dob = encryptthis($dob, $key);
  $encrypt_race = encryptthis($race, $key);
  $encrypt_ethnicity = encryptthis($ethnicity, $key);
  $diversity  = "UPDATE diversity SET dob=?, gender=?, race=?, ethnicity=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($diversity);
  $stmt->bind_param("ssss", $encrypt_dob, $gender, $encrypt_race, $encrypt_ethnicity);
  $stmt->execute();

  // Encrypt Patient Data and update
  $encrypt_fname = encryptthis($fname, $key);
  $encrypt_lname = encryptthis($lname, $key);
  $encrypt_suffix = encryptthis($suffix, $key);
  $patients  = "UPDATE patients SET fname=?, lname=?, suffix=?, dob=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($patients);
  $stmt->bind_param("ssss", $encrypt_fname, $encrypt_lname, $encrypt_suffix, $dob);
  $stmt->execute();

  if($stmt = $con->prepare($patients))
  {
    $_SESSION['success'] = "Patient Successfully Updated!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update Patient Information";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
}

// Add Patient - diversity
if(isset($_POST['add_patient_diversity']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $gender = mysqli_real_escape_string($con, $_POST['gender']);
  $race = mysqli_real_escape_string($con, $_POST['race']);
  $ethnicity = mysqli_real_escape_string($con, $_POST['ethnicity']);
  $type = mysqli_real_escape_string($con, "Added");
  $message = mysqli_real_escape_string($con, "Diversity");

  // Check if address exist
  $checkdiversity = "SELECT * FROM diversity WHERE patientID='$patientID'";
  $checkdiversity_run = mysqli_query($con, $checkdiversity);

  if(mysqli_num_rows($checkdiversity_run) > 0)
  {
    $_SESSION['warning'] = "Patient's Diversity Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {

    // Encrypt Activities Data and insert
    $fullname = "$user_fname $user_lname";
    $act_message = "$type $fullname's $message";
    $encrypted_fullname = encryptthis($fullname, $key);
    $encrypted_office = encryptthis($office, $key);
    $encrypted_message = encryptthis($act_message, $key);
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Encrypt Data and insert in diversity table
    $encrypt_dob= encryptthis($dob, $key);
    $encrypt_race = encryptthis($race, $key);
    $encrypt_ethnicity = encryptthis($ethnicity, $key);
    $diversity = "INSERT INTO diversity (patientID, engineID, groupID, dob, gender, race, ethnicity) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($diversity);
    $stmt->bind_param("sssssss", $patientID, $engineID, $groupID, $encrypt_dob, $gender, $encrypt_race, $encrypt_ethnicity);
    $stmt->execute();

    // Update patient's dob in patient's table
    $update_dob  = "UPDATE patients SET dob=? WHERE patientID='$patientID' ";
    $stmt = $con->prepare($update_dob);
    $stmt->bind_param("s", $dob);
    $stmt->execute();

    if($stmt = $con->prepare($diversity))
    {
      $_SESSION['success'] = "Patient's Address was Successfully Added!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Add Patient's Address!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Edit Patient - Address
if(isset($_POST['patient_addressbtn']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $addressID = mysqli_real_escape_string($con, $_POST['addressID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $lname = mysqli_real_escape_string($con, $_POST['lname']);
  $address1 = mysqli_real_escape_string($con, $_POST['address1']);
  $address2 = mysqli_real_escape_string($con, $_POST['address2']);
  $city = mysqli_real_escape_string($con, $_POST['city']);
  $state = mysqli_real_escape_string($con, $_POST['state']);
  $zip = mysqli_real_escape_string($con, $_POST['zip']);
  $type = mysqli_real_escape_string($con, "Updated");
  $message = mysqli_real_escape_string($con, "Address");

  // Encrypt Activities Data and insert
  $fullname = "$fname $lname";
  $act_message = "$type $fullname's $message";
  $encrypted_fullname = encryptthis($fullname, $key);
  $encrypted_office = encryptthis($office, $key);
  $encrypted_message = encryptthis($act_message, $key);
  $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activities);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
  $stmt->execute();

  // Encrypt Patient's diversity Data and update
  $encrypt_address1 = encryptthis($address1, $key);
  $encrypt_address2 = encryptthis($address2, $key);
  $encrypt_city = encryptthis($city, $key);
  $encrypt_state = encryptthis($state, $key);
  $encrypt_zip = encryptthis($zip, $key);
  $address  = "UPDATE address SET address1=?, address2=?, city=?, state=?, zip=? WHERE id='$addressID' ";
  $stmt = $con->prepare($address);
  $stmt->bind_param("sssss", $encrypt_address1, $encrypt_address2, $encrypt_city, $encrypt_state, $encrypt_zip);
  $stmt->execute();

  if($stmt = $con->prepare($address))
  {
    $_SESSION['success'] = "Patient's Address Successfully Updated!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update Patient's Address";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
}

// Add Patient - Contact
if(isset($_POST['add_patient_contactbtn']))
{
  $token = md5(rand());
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $lname = mysqli_real_escape_string($con, $_POST['lname']);
  $phone = mysqli_real_escape_string($con, $_POST['phone']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
  $patient_email = mysqli_real_escape_string($con, $_POST['email']);
  $role = mysqli_real_escape_string($con, $_POST['role']);
  $type = mysqli_real_escape_string($con, "Added");
  $message = mysqli_real_escape_string($con, "Contact information");

  // Encrypt Activities Data and insert
  $fullname = "$user_fname $user_lname";
  $act_message = "$type $fname $lname's $message";
  $encrypted_fullname = encryptthis($fullname, $key);
  $encrypted_office = encryptthis($office, $key);
  $encrypted_message = encryptthis($act_message, $key);
  $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activities);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
  $stmt->execute();

  // Encrypt Patient's contact Data and insert
  $encrypt_phone = encryptthis($phone, $key);
  $encrypt_mobile = encryptthis($mobile, $key);
  $encrypt_patient_email = encryptthis($patient_email, $key);
  $contact = "INSERT INTO contact (patientID, engineID, groupID, phone, mobile, email) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($contact);
  $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $encrypt_phone, $encrypt_mobile, $encrypt_patient_email);
  $stmt->execute();

  if($stmt = $con->prepare($contact))
  {
    $_SESSION['success'] = "Patient's Contact Information was Successfully Added!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Add Patient's Contact Information";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
}

// Edit Patient - Contact
if(isset($_POST['patient_contactbtn']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $lname = mysqli_real_escape_string($con, $_POST['lname']);
  $phone = mysqli_real_escape_string($con, $_POST['phone']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $type = mysqli_real_escape_string($con, "Updated");
  $message = mysqli_real_escape_string($con, "Contact Information");

  // Encrypt Activities Data and insert
  $fullname = "$fname $lname";
  $act_message = "$type $fullname's $message";
  $encrypted_fullname = encryptthis($fullname, $key);
  $encrypted_office = encryptthis($office, $key);
  $encrypted_message = encryptthis($act_message, $key);
  $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activities);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
  $stmt->execute();

  // Encrypt Contact Data and update
  $encrypted_phone = encryptthis($phone, $key);
  $encrypted_mobile = encryptthis($mobile, $key);
  $encrypted_email = encryptthis($email, $key);
  $contact  = "UPDATE contact SET phone=?, mobile=?, email=? WHERE id='$contactID' ";
  $stmt = $con->prepare($contact);
  $stmt->bind_param("sss", $encrypted_phone, $encrypted_mobile, $encrypted_email);
  $stmt->execute();

  $update_email  = "UPDATE patients SET email=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_email);
  $stmt->bind_param("s", $email);
  $stmt->execute();

  if($stmt = $con->prepare($contact))
  {
    $_SESSION['success'] = "Patient's Contact Information was Successfully Updated!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update Patient's Contact Information";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
}

// Add Patient - Address
if(isset($_POST['add_patient_addressbtn']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $patientID = htmlspecialchars($_POST['patientID']);
  $type = htmlspecialchars("Added");
  $fname = htmlspecialchars($_POST['fname']);
  $lname = htmlspecialchars($_POST['lname']);
  $address1 = htmlspecialchars($_POST['address1']);
  $address2 = htmlspecialchars($_POST['address2']);
  $city = htmlspecialchars($_POST['city']);
  $state = htmlspecialchars($_POST['state']);
  $zip = htmlspecialchars($_POST['zip']);

  // Check if address exist
  $checkaddress = "SELECT * FROM address WHERE patientID='$patientID'";
  $checkaddress_run = mysqli_query($con, $checkaddress);
  if(mysqli_num_rows($checkaddress_run) > 0)
  {
    $_SESSION['warning'] = "Patient's Address Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // store activity data in activity table
    $fullname = "$user_fname $user_lname";
    $full_address = "$address1 $address2 $city $state $zip";
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $office, $fullname, $type, $full_address);
    $stmt->execute();

    // Encrypt Patient's address Data
    $encrypt_address1 = encryptthis($address1, $key);
    $encrypt_address2 = encryptthis($address2, $key);
    $encrypt_city = encryptthis($city, $key);
    $encrypt_state = encryptthis($state, $key);
    $encrypt_zip = encryptthis($zip, $key);

    //Insert to address table//
    $address = "INSERT INTO address (patientID, engineID, groupID, address1, address2, city, state, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($address);
    $stmt->bind_param("ssssssss", $patientID, $engineID, $groupID, $encrypt_address1, $encrypt_address2, $encrypt_city, $encrypt_state, $encrypt_zip);
    $stmt->execute();

    if($stmt = $con->prepare($address))
    {
      $_SESSION['success'] = "Patient's Address was Successfully Added!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Add Patient's Address!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Add Patient - Emergency Contact
if(isset($_POST['add_patient_emergencybtn']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $lname = mysqli_real_escape_string($con, $_POST['lname']);
  $emergency_fname = mysqli_real_escape_string($con, $_POST['emergency_fname']);
  $emergency_lname = mysqli_real_escape_string($con, $_POST['emergency_lname']);
  $emergency_phone = mysqli_real_escape_string($con, $_POST['emergency_phone']);
  $emergency_email = mysqli_real_escape_string($con, $_POST['emergency_email']);
  $message = mysqli_real_escape_string($con, "Emergency Contact");
  $link = mysqli_real_escape_string($con, "pages/patients/content/patient-chart.php?engineID=$engineID");
  $type = mysqli_real_escape_string($con, "Added");

  // Encrypt Activities Data
  $full_info = "$fname $lname''s $message";
  $fullname = "$user_fname $user_lname";
  $act_message = "$type $full_info";
  $encrypted_fullname = encryptthis($fullname, $key);
  $encrypted_office = encryptthis($office, $key);
  $encrypted_message = encryptthis($act_message, $key);

  // insert activity timestamp
  $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activities);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
  $stmt->execute();

  // Encrypt Patient's emergency contact Data
  $encrypt_emergency_fname = encryptthis($emergency_fname, $key);
  $encrypt_emergency_lname = encryptthis($emergency_lname, $key);
  $encrypt_emergency_phone = encryptthis($emergency_phone, $key);
  $encrypt_emergency_email = encryptthis($emergency_email, $key);
  $encrypt_full_info = encryptthis($full_info, $key);

  // insert to emergency_contact table
  $emergency_contact = "INSERT INTO emergency_contact (patientID, engineID, groupID, fname, lname, phone, email, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($emergency_contact);
  $stmt->bind_param("ssssssss", $patientID, $engineID, $groupID, $encrypt_emergency_fname, $encrypt_emergency_lname, $encrypt_emergency_phone, $encrypt_emergency_email, $encrypt_full_info);
  $stmt->execute();

  if($stmt = $con->prepare($emergency_contact))
  {
    $_SESSION['success'] = "Emergency Contact Successfully Added!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update Patient Information";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
}

// Edit Patient - Emergency Contact
if(isset($_POST['patient_emergencybtn']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $id = mysqli_real_escape_string($con, $_POST['id']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $lname = mysqli_real_escape_string($con, $_POST['lname']);
  $emergency_fname = mysqli_real_escape_string($con, $_POST['emergency_fname']);
  $emergency_lname = mysqli_real_escape_string($con, $_POST['emergency_lname']);
  $emergency_phone = mysqli_real_escape_string($con, $_POST['emergency_phone']);
  $emergency_email = mysqli_real_escape_string($con, $_POST['emergency_email']);
  $type = mysqli_real_escape_string($con, "Updated");
  $message = mysqli_real_escape_string($con, "emergency contact");

  // Encrypt Activities Data and insert
  $fullname = "$user_fname $user_lname";
  $act_message = "$type $fname $lname's $message";
  $encrypted_fullname = encryptthis($fullname, $key);
  $encrypted_office = encryptthis($office, $key);
  $encrypted_message = encryptthis($act_message, $key);
  $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activities);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
  $stmt->execute();

  // Encrypt Patient's emergency contact Data and update
  $encrypt_emergency_fname = encryptthis($emergency_fname, $key);
  $encrypt_emergency_lname = encryptthis($emergency_lname, $key);
  $encrypt_emergency_phone = encryptthis($emergency_phone, $key);
  $encrypt_emergency_email = encryptthis($emergency_email, $key);
  $emergency_contact  = "UPDATE emergency_contact SET fname=?, lname=?, phone=?, email=? WHERE id='$id' ";
  $stmt = $con->prepare($emergency_contact);
  $stmt->bind_param("ssss", $encrypt_emergency_fname, $encrypt_emergency_lname, $encrypt_emergency_phone, $encrypt_emergency_email);
  $stmt->execute();

  if($stmt = $con->prepare($emergency_contact))
  {
    $_SESSION['success'] = "Patient Successfully Updated!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update Patient Information";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
}

// Add New Health Plan
if(isset($_POST['add_healthplan']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = htmlspecialchars($_POST['patientID']);
  $healthplanID = htmlspecialchars($_POST['healthplanID']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $date = htmlspecialchars($_POST['date']);
  $time = htmlspecialchars($_POST['time']);
  $fname = htmlspecialchars($_POST['fname']);
  $lname = htmlspecialchars($_POST['lname']);
  $health_plan = htmlspecialchars($_POST['health_plan']);
  $policy_number = htmlspecialchars($_POST['policy_number']);
  $status = htmlspecialchars($_POST['status']);
  $message = htmlspecialchars("$health_plan for $fname $lname");
  $fullname = htmlspecialchars("$user_fname $user_lname");
  $type = htmlspecialchars("Added");

  // Check if healthplan exist
  $checkhealthplan = "SELECT * FROM healthplan WHERE patientID='$patientID'";
  $checkhealthplan_run = mysqli_query($con, $checkhealthplan);
  if(mysqli_num_rows($checkhealthplan_run) > 0)
  {
    $_SESSION['warning'] = "Patient's Healthplan Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Encrypt Activities Data
    $fullname = "$user_fname $user_lname";
    $act_message = "$type $healthplan for $fname $lname";
    $encrypted_fullname = encryptthis($fullname, $key);
    $encrypted_office = encryptthis($office, $key);
    $encrypted_message = encryptthis($act_message, $key);

    // insert activity timestamp
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Encrypt Patient's log Data
    $log_message = "$type $health_plan";
    $encrypt_log_message = encryptthis($log_message, $key);
    $encrypt_emergency_fname = encryptthis($emergency_fname, $key);
    $encrypt_emergency_lname = encryptthis($emergency_lname, $key);
    $encrypt_emergency_phone = encryptthis($emergency_phone, $key);
    $encrypt_emergency_email = encryptthis($emergency_email, $key);
    $encrypt_health_plan = encryptthis($health_plan, $key);

    // insert to patient log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypt_log_message);
    $stmt->execute();

    // Encrypt healthplan data and insert
    $encrypt_emergency_health_plan = encryptthis($health_plan, $key);
    $encrypt_emergency_policy_number = encryptthis($policy_number, $key);
    $encrypt_status = encryptthis($status, $key);
    $healthplan = "INSERT INTO healthplan (patientID, engineID, groupID, health_plan, policy_number, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($healthplan);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $encrypt_emergency_health_plan, $encrypt_emergency_policy_number, $encrypt_status);
    $stmt->execute();

    if($stmt = $con->prepare($healthplan))
    {
      $_SESSION['success'] = "Health Plan Successfully Added!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Add Health Plan";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Edit Patient - Health Plan
if(isset($_POST['patient_planbtn']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $lname = mysqli_real_escape_string($con, $_POST['lname']);
  $healthplanID = mysqli_real_escape_string($con, $_POST['healthplanID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $health_plan = mysqli_real_escape_string($con, $_POST['health_plan']);
  $policy_number = mysqli_real_escape_string($con, $_POST['policy_number']);
  $status = mysqli_real_escape_string($con, $_POST['status']);
  $type = mysqli_real_escape_string($con, "Updated");
  $message = mysqli_real_escape_string($con, "Health Plan");

  // Check if healthplan exist
  $checkhealthplan = "SELECT * FROM healthplan WHERE patientID='$patientID'";
  $checkhealthplan_run = mysqli_query($con, $checkhealthplan);
  if(mysqli_num_rows($checkhealthplan_run) == 0)
  {
    $_SESSION['warning'] = "Unable to update. Patient's healthplan doesn't exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Encrypt Activities Data and insert
    $fullname = "$user_fname $user_lname";
    $act_message = "$type $fname $lname's $message";
    $encrypted_fullname = encryptthis($fullname, $key);
    $encrypted_office = encryptthis($office, $key);
    $encrypted_message = encryptthis($act_message, $key);
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Encrypt Patient's health plan Data
    $encrypt_health_plan = encryptthis($health_plan, $key);
    $encrypt_policy_number = encryptthis($policy_number, $key);
    $encrypt_status = encryptthis($status, $key);
    $healthplan  = "UPDATE healthplan SET health_plan=?, policy_number=?, status=? WHERE patientID='$patientID' ";
    $stmt = $con->prepare($healthplan);
    $stmt->bind_param("sss", $encrypt_health_plan, $encrypt_policy_number, $encrypt_status);
    $stmt->execute();

    if($stmt = $con->prepare($healthplan))
    {
      $_SESSION['success'] = "Patient Successfully Updated!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Update Patient Information";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 1st Hep B
if(isset($_POST['hepB_1st']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 1st Hep B");

  // Check if 1st HepB exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='1st Hep B' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "1st Dose of Hep B Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$vaccine Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 2nd Hep B
if(isset($_POST['hepB_2nd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 2nd Hep B");

  // Check if 2nd HepB exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='2nd Hep B' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "2nd Dose of Hep B Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$vaccine Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 3rd Hep B
if(isset($_POST['hepB_3rd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 3rd Hep B");

  // Check if 3rd HepB exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='3rd Hep B' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "3rd Dose of Hep B Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$vaccine Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 1st Rotavirus
if(isset($_POST['rv_1st']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 1st Rotavirus");

  // Check if 1st RV exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='1st Rotavirus' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "1st Dose of Rotavirus Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$vaccine Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 2nd Rotavirus
if(isset($_POST['rv_2nd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 2nd Rotavirus");

  // Check if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='2nd Rotavirus' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "2nd Dose of Rotavirus Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$vaccine Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 3rd Rotavirus
if(isset($_POST['rv_3rd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 3rd Rotavirus");

  // Check if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='3rd Rotavirus' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "3rd Dose of Rotavirus Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$vaccine Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 1st DTaP
if(isset($_POST['DTaP_1st']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 1st DTaP");

  // Check if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='1st DTaP' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "1st Dose of DTaP Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$vaccine Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 2nd DTaP
if(isset($_POST['DTaP_2nd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 2nd DTaP");

  // Check if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='2nd DTaP' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "2nd Dose of DTaP Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$vaccine Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 3rd DTaP
if(isset($_POST['DTaP_3rd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 3rd DTaP");

  // Check if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='3rd DTaP' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "3rd Dose of DTaP Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$vaccine Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 4th DTaP
if(isset($_POST['DTaP_4th']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 4th DTaP");

  // Check if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='4th DTaP' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "4th Dose of DTaP Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$vaccine Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 5th DTaP
if(isset($_POST['DTaP_5th']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 5th DTaP");

  // Check if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='5th DTaP' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "5th Dose of DTaP Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$vaccine Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 1st Hib
if(isset($_POST['Hib_1st']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 1st Hib");

  // Check if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='1st Hib' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "1st Dose of Hib Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 2nd Hib
if(isset($_POST['Hib_2nd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 2nd Hib");

  // Check if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='2nd Hib' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "2nd Dose of Hib Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 3rd Hib
if(isset($_POST['Hib_3rd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 3rd Hib");

  // Check if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='3rd Hib' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "3rd Dose of Hib Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 4th Hib
if(isset($_POST['Hib_4th']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 4th Hib");

  // Check if 4th Hib exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='4th Hib' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "4th Dose of Hib Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 1st PCV
if(isset($_POST['PCV_1st']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 1st PCV");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='1st PCV' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "1st Dose of PCV Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 2nd PCV
if(isset($_POST['PCV_2nd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 2nd PCV");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='2nd PCV' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "2nd Dose of PCV Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 3rd PCV
if(isset($_POST['PCV_3rd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 3rd PCV");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='3rd PCV' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "3rd Dose of PCV Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 4th PCV
if(isset($_POST['PCV_4th']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 4th PCV");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='4th PCV' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "4th Dose of PCV Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 1st IPV
if(isset($_POST['IPV_1st']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 1st IPV");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='1st IPV' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "1st Dose of IPV Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 2nd IPV
if(isset($_POST['IPV_2nd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 2nd IPV");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='2nd IPV' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "2nd Dose of IPV Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 3rd IPV
if(isset($_POST['IPV_3rd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 3rd IPV");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='3rd IPV' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "3rd Dose of IPV Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 4th IPV
if(isset($_POST['IPV_4th']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 4th IPV");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='4th IPV' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "4th Dose of IPV Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer COVID-19
if(isset($_POST['covid']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received COVID-19");

  // Insert Activity Data
  $fullname = "$fname $lname"; // Bind first and last name
  $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
  $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
  $encrypted_office = encryptthis($office, $key); // Encrypt office
  $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
  $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
  $stmt = $con->prepare($activities);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
  $stmt->execute();

  // Insert Patient Log Data
  $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
  $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
  $stmt = $con->prepare($patientlog);
  $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
  $stmt->execute();

  // Insert Immunization Data
  $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
  $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
  $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
  $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
  $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
  $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
  $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
  $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
  $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
  $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
  $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
  $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
  $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
  $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
  $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
  $immunization = "INSERT INTO immunization
  (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $stmt = $con->prepare($immunization);
  $stmt->bind_param("ssssssssssssssssssss",
  $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
  $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
  $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
  $stmt->execute();

  // Manage inventory
  $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
  $deduct_run = mysqli_query($con, $deduct);
  $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
  $delete_run = mysqli_query($con, $delete);

  if($stmt = $con->prepare($immunization))
  {
    $_SESSION['success'] = "$iz_type Was Successfully Documented!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Document";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
}

// Administer Influenza
if(isset($_POST['flu']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received Flu Vaccine");

  // Insert Activity Data
  $fullname = "$fname $lname"; // Bind first and last name
  $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
  $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
  $encrypted_office = encryptthis($office, $key); // Encrypt office
  $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
  $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
  $stmt = $con->prepare($activities);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
  $stmt->execute();

  // Insert Patient Log Data
  $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
  $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
  $stmt = $con->prepare($patientlog);
  $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
  $stmt->execute();

  // Insert Immunization Data
  $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
  $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
  $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
  $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
  $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
  $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
  $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
  $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
  $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
  $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
  $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
  $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
  $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
  $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
  $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
  $immunization = "INSERT INTO immunization
  (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $stmt = $con->prepare($immunization);
  $stmt->bind_param("ssssssssssssssssssss",
  $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
  $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
  $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
  $stmt->execute();

  // Manage inventory
  $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
  $deduct_run = mysqli_query($con, $deduct);
  $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
  $delete_run = mysqli_query($con, $delete);

  if($stmt = $con->prepare($immunization))
  {
    $_SESSION['success'] = "$iz_type Was Successfully Documented!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Document";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
}

// Administer 1st MMR
if(isset($_POST['mmr_1st']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 1st MMR");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='1st MMR' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "1st Dose of MMR Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 2nd MMR
if(isset($_POST['mmr_2nd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 2nd MMR");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='2nd MMR' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "2nd Dose of MMR Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 1st Varicella
if(isset($_POST['varicella_1st']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 1st Varicella");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='1st Varicella' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "1st Dose of Varicella Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$iz_type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 2nd Varicella
if(isset($_POST['varicella_2nd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 2nd Varicella");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='2nd Varicella' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "2nd Dose of Varicella Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$iz_type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 1st Hep A
if(isset($_POST['hepA_1st']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 1st Hep A");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='1st Hep A' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "1st Dose of Hep A Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 2nd Hep A
if(isset($_POST['hepA_2nd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 2nd Hep A");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='2nd Hep A' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "2nd Dose of Hep A Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer Tdap
if(isset($_POST['tdap']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received Tdap");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='Tdap' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "Tdap Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$iz_type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 1st Meningococcal
if(isset($_POST['mcv_1st']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 1st MCV");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='1st MCV' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "1st Dose of MCV Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer 2nd Meningococcal
if(isset($_POST['mcv_2nd']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received 2nd MCV");

  // Verify if shot exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='2nd MCV' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    $_SESSION['warning'] = "2nd Dose of MCV Already Exist!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $immunization = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($immunization);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($immunization))
    {
      $_SESSION['success'] = "$type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer HPV
if(isset($_POST['hpv']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $iz_type = mysqli_real_escape_string($con, $_POST['type']);
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $type = mysqli_real_escape_string($con, "Administered");
  $message = mysqli_real_escape_string($con, "Received HPV");

  // Check if 1st HPV exist
  $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='1st HPV' ";
  $check_run = mysqli_query($con, $check);
  if(mysqli_num_rows($check_run) > 0)
  {
    // Check if 2nd HPV exist
    $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='2nd HPV' ";
    $check_run = mysqli_query($con, $check);
    if(mysqli_num_rows($check_run) > 0)
    {
      // Check if 3rd HPV exist
      $check = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='3rd HPV' ";
      $check_run = mysqli_query($con, $check);
      if(mysqli_num_rows($check_run) > 0)
      {
        $_SESSION['warning'] = "HPV Already Exist!";
        header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
        exit(0);
      }
      else
      {
        // Insert Activity Data
        $fullname = "$fname $lname"; // Bind first and last name
        $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
        $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
        $encrypted_office = encryptthis($office, $key); // Encrypt office
        $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
        $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
        $stmt = $con->prepare($activities);
        $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
        $stmt->execute();

        // Insert Patient Log Data
        $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
        $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
        $stmt = $con->prepare($patientlog);
        $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
        $stmt->execute();

        // Insert Immunization Data
        $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
        $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
        $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
        $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
        $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
        $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
        $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
        $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
        $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
        $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
        $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
        $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
        $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
        $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
        $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
        $HPV_1 = "INSERT INTO immunization
        (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $con->prepare($HPV_1);
        $stmt->bind_param("ssssssssssssssssssss",
        $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
        $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
        $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
        $stmt->execute();

        // Manage inventory
        $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
        $deduct_run = mysqli_query($con, $deduct);
        $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
        $delete_run = mysqli_query($con, $delete);

        if($stmt = $con->prepare($HPV_1))
        {
          $_SESSION['success'] = "$iz_type Was Successfully Documented!";
          header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
          exit(0);
        }
        else
        {
          $_SESSION['warning'] = "Unable to Document";
          header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
          exit(0);
        }
      }
    }
    else
    {
      // Insert Activity Data
      $fullname = "$fname $lname"; // Bind first and last name
      $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
      $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
      $encrypted_office = encryptthis($office, $key); // Encrypt office
      $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
      $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
      $stmt = $con->prepare($activities);
      $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
      $stmt->execute();

      // Insert Patient Log Data
      $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // Insert Immunization Data
      $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
      $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
      $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
      $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
      $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
      $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
      $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
      $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
      $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
      $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
      $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
      $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
      $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
      $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
      $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
      $HPV_2 = "INSERT INTO immunization
      (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
      VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $stmt = $con->prepare($HPV_2);
      $stmt->bind_param("ssssssssssssssssssss",
      $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
      $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
      $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
      $stmt->execute();

      // Manage inventory
      $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);
      $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
      $delete_run = mysqli_query($con, $delete);

      if($stmt = $con->prepare($HPV_2))
      {
        $_SESSION['success'] = "$iz_type Was Successfully Documented!";
        header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Document";
        header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
        exit(0);
      }
    }
  }
  else
  {
    // Insert Activity Data
    $fullname = "$fname $lname"; // Bind first and last name
    $act_message = "$type $iz_type to $patient_fname $patient_lname"; // Bind strings to create a message
    $encrypted_fullname = encryptthis($fullname, $key); // Encrypt fullname
    $encrypted_office = encryptthis($office, $key); // Encrypt office
    $encrypted_message = encryptthis($act_message, $key);// Encrypt binded message
    $activities = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to activities table
    $stmt = $con->prepare($activities);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_office, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($message, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // Insert Immunization Data
    $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
    $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
    $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
    $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
    $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
    $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
    $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
    $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
    $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
    $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
    $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
    $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
    $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
    $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
    $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
    $HPV_3 = "INSERT INTO immunization
    (patientID, engineID, groupID, name, dob, type, vaccine, date, time, manufacturer, ndc, lot, exp, site, route, vis_given, vis, administered_by, funding_source, comment)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($HPV_3);
    $stmt->bind_param("ssssssssssssssssssss",
    $patientID, $engineID, $groupID, $encrypted_fullname, $encrypted_dob, $iz_type, $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer,
    $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp, $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis,
    $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
    $stmt->execute();

    // Manage inventory
    $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM vaccines WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($HPV_3))
    {
      $_SESSION['success'] = "$iz_type Was Successfully Documented!";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Document";
      header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
      exit(0);
    }
  }
}

// Administer Any Vaccine
if(isset($_POST['administer_vaccine']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $type = htmlspecialchars("Administered");
  $patientID = htmlspecialchars($_POST['patientID']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $patient_fname = htmlspecialchars($_POST['fname']);
  $patient_lname = htmlspecialchars($_POST['lname']);
  $dob = htmlspecialchars($_POST['dob']);
  $iz_type = htmlspecialchars($_POST['type']);
  $vaccine = htmlspecialchars($_POST['vaccine']);
  $date = htmlspecialchars($_POST['date']);
  $time = htmlspecialchars($_POST['time']);
  $manufacturer = htmlspecialchars($_POST['manufacturer']);
  $ndc = htmlspecialchars($_POST['ndc']);
  $lot = htmlspecialchars($_POST['lot']);
  $exp = htmlspecialchars($_POST['exp']);
  $site = htmlspecialchars($_POST['site']);
  $route = htmlspecialchars($_POST['route']);
  $vis_given = htmlspecialchars($_POST['vis_given']);
  $vis = htmlspecialchars($_POST['vis']);
  $administered_by = htmlspecialchars($_POST['administered_by']);
  $funding_source = htmlspecialchars($_POST['funding_source']);
  $comment = htmlspecialchars($_POST['comment']);
  $message = htmlspecialchars("Received $vaccine");

  // insert to activity log
  $activity = "INSERT INTO activities (userID, groupID, location, user, type, activity)
  VALUES ('$userID', '$groupID', '$office', '$fname $lname', '$type', '$iz_type to $patient_fname $patient_lname ' )";
  $activity_run = mysqli_query($con, $activity);

  // insert to patient log
  $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity)
  VALUES ('$patientID', '$engineID', '$groupID', '$date', '$time', '$message')";
  $patientlog_run = mysqli_query($con, $patientlog);

  // deduct 1 from vaccines table
  $deduct = "UPDATE vaccines SET doses=doses-1 WHERE groupID='$groupID' AND vaccine='$vaccine' ";
  $deduct_run = mysqli_query($con, $deduct);

  // insert to immunization table//
  $query = "INSERT INTO immunization (patientID,engineID,groupID,name,dob,type,vaccine,date,time,manufacturer,ndc,lot,exp,site,route,vis_given,vis,administered_by,funding_source,comment)
  VALUES ('$patientID','$engineID','$groupID','$patient_fname $patient_lname','$dob','$iz_type','$vaccine','$date','$time','$manufacturer','$ndc','$lot','$exp','$site','$route','$vis_given','$vis','$administered_by','$funding_source','$comment')";
  $query_run = mysqli_query($con, $query);

  if($query_run)
  {
    $_SESSION['success'] = "$type Was Successfully Documented!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Document";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
}

// Edit Administered Vaccine
if(isset($_POST['edit_administered_vaccine']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $type = htmlspecialchars("Updated");
  $id = htmlspecialchars($_POST['id']);
  $patientID = htmlspecialchars($_POST['patientID']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $patient_fname = htmlspecialchars($_POST['fname']);
  $patient_lname = htmlspecialchars($_POST['lname']);
  $dob = htmlspecialchars($_POST['dob']);
  $iz_type = htmlspecialchars($_POST['type']);
  $vaccine = htmlspecialchars($_POST['vaccine']);
  $date = htmlspecialchars($_POST['date']);
  $time = htmlspecialchars($_POST['time']);
  $manufacturer = htmlspecialchars($_POST['manufacturer']);
  $ndc = htmlspecialchars($_POST['ndc']);
  $lot = htmlspecialchars($_POST['lot']);
  $exp = htmlspecialchars($_POST['exp']);
  $site = htmlspecialchars($_POST['site']);
  $route = htmlspecialchars($_POST['route']);
  $vis_given = htmlspecialchars($_POST['vis_given']);
  $vis = htmlspecialchars($_POST['vis']);
  $administered_by = htmlspecialchars($_POST['administered_by']);
  $funding_source = htmlspecialchars($_POST['funding_source']);
  $comment = htmlspecialchars($_POST['comment']);

  // Encrypt Activity Data and insert
  $fullname = "$fname $lname";
  $iz_message = "$type $patient_fname $patient_lname's administered $vaccine";
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_user_office = encryptthis($office, $key);
  $encrypt_org_message = encryptthis($iz_message, $key);
  $activity = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypt_user_office, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  // Encrpty Administered Data and update
  $patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
  $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
  $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
  $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
  $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
  $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
  $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
  $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
  $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
  $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
  $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
  $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
  $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
  $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
  $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment$patient_fullname = "$patient_fname $patient_lname"; // Bind patient's first and last name
  $encrypted_fullname = encryptthis($patient_fullname, $key); // Encrypt patient's fullname
  $encrypted_dob = encryptthis($dob, $key); // Encrypt patient's dob
  $encrypted_iz_vaccine = encryptthis($vaccine, $key); // Encrypt vaccine brand
  $encrypted_iz_manufacturer = encryptthis($manufacturer, $key); // Encrypt vaccine's manufacturer
  $encrypted_iz_ndc = encryptthis($ndc, $key); // Encrypt vaccine's ndc code
  $encrypted_iz_lot = encryptthis($lot, $key); // Encrypt vaccine's lot number
  $encrypted_iz_exp = encryptthis($exp, $key); // Encrypt vaccine's expiration date
  $encrypted_iz_site = encryptthis($site, $key); // Encrypt vaccine's administration site
  $encrypted_iz_route = encryptthis($route, $key); // Encrypt vaccine's administration route
  $encrypted_iz_vis_given = encryptthis($vis_given, $key); // Encrypt vaccine's vis give date
  $encrypted_iz_vis = encryptthis($vis, $key); // Encrypt vaccine's vis
  $encrypted_iz_administered_by = encryptthis($administered_by, $key); // Encrypt vaccine's shot giver
  $encrypted_iz_funding_source = encryptthis($funding_source, $key); // Encrypt vaccine's funding source
  $encrypted_iz_comment = encryptthis($comment, $key); // Encrypt comment
  $immunization  = "UPDATE immunization SET vaccine=?, date=?, time=?, manufacturer=?, ndc=?, lot=?, exp=?, site=?,
  route=?, vis_given=?, vis=?, administered_by=?, funding_source=?, comment=? WHERE id='$id' ";
  $stmt = $con->prepare($immunization);
  $stmt->bind_param("ssssssssssssss", $encrypted_iz_vaccine, $date, $time, $encrypted_iz_manufacturer, $encrypted_iz_ndc, $encrypted_iz_lot, $encrypted_iz_exp,
  $encrypted_iz_site, $encrypted_iz_route, $encrypted_iz_vis_given, $encrypted_iz_vis, $encrypted_iz_administered_by, $encrypted_iz_funding_source, $encrypted_iz_comment);
  $stmt->execute();

  if($stmt = $con->prepare($immunization))
  {
    $_SESSION['success'] = "Successfully Updated $iz_type!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update $iz_type";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
}

// Delete Administered Vaccine
if(isset($_POST['delete_administered_vaccine']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $type = htmlspecialchars("Deleted");
  $id = htmlspecialchars($_POST['id']);
  $vaccine_name = htmlspecialchars($_POST['vaccine_name']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $patient_fname = htmlspecialchars($_POST['fname']);
  $patient_lname = htmlspecialchars($_POST['lname']);
  $activity_type = htmlspecialchars($_POST['type']);

  // Encrypt Activity Data and insert
  $fullname = "$fname $lname";
  $delete_message = "$type $patient_fname $patient_lname's administered $vaccine_name";
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_user_office = encryptthis($office, $key);
  $encrypt_org_message = encryptthis($delete_message, $key);
  $activity = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypt_user_office, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  $dli = "DELETE FROM immunization WHERE id=? ";
  $stmt = $con->prepare($dli);
  $stmt->bind_param("s", $id);
  $stmt->execute();

  if($stmt = $con->prepare($dli))
  {
    $_SESSION['success'] = "Administered $vaccine_name Successfully Deleted!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Delete Administered $vaccine_name!";
    header("Location: /HC/admin/pages/patients/content/patient-chart.php?engineID=$engineID");
    exit(0);
  }
}
