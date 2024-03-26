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

// Assign Patient
if(isset($_POST['assign_patient']))
{
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $admin = mysqli_real_escape_string($con, "Admin");
  $type = mysqli_real_escape_string($con, "Added");
  $message = mysqli_real_escape_string($con, "as new patient");

  // Retrieves patient's dk_token to decrypt patient's information
  $dk_token_query = "SELECT * FROM token WHERE userID='$patientID'";
  $dk_token_query_run = mysqli_query($con, $dk_token_query);
  $dk_token = mysqli_fetch_assoc($dk_token_query_run);
  $oldKey = htmlspecialchars($dk_token["dk_token"]); // Patient's Key

  // Retrieves patient's information for decryption
  $patient_query = "SELECT * FROM patients WHERE patientID='$patientID'";
  $patient_query_query_run = mysqli_query($con, $patient_query);
  $patient = mysqli_fetch_assoc($patient_query_query_run);
  $patients_email = htmlspecialchars($patient["email"]);
  $patients_fname = htmlspecialchars(decryptthis($patient["fname"], $oldKey));
  $patients_lname = htmlspecialchars(decryptthis($patient["lname"], $oldKey));
  $patients_suffix = htmlspecialchars(decryptthis($patient["suffix"], $oldKey));
  $patients_role = htmlspecialchars(decryptthis($patient["role"], $oldKey));

  $diversity_query = "SELECT * FROM diversity WHERE patientID='$patientID'";
  $diversity_query_query_run = mysqli_query($con, $diversity_query);
  $diversity = mysqli_fetch_assoc($diversity_query_query_run);
  $patients_dob = htmlspecialchars(decryptthis($diversity["dob"], $oldKey));
  $patients_race = htmlspecialchars(decryptthis($diversity["race"], $oldKey));
  $patients_ethnicity = htmlspecialchars(decryptthis($diversity["ethnicity"], $oldKey));

  $address_query = "SELECT * FROM address WHERE patientID='$patientID'";
  $address_query_run = mysqli_query($con, $address_query);
  $address = mysqli_fetch_assoc($address_query_run);
  $patients_address1 = htmlspecialchars(decryptthis($address["address1"], $oldKey));
  $patients_address2 = htmlspecialchars(decryptthis($address["address2"], $oldKey));
  $patients_city = htmlspecialchars(decryptthis($address["city"], $oldKey));
  $patients_state = htmlspecialchars(decryptthis($address["state"], $oldKey));
  $patients_zip = htmlspecialchars(decryptthis($address["zip"], $oldKey));

  $contact_query = "SELECT * FROM contact WHERE patientID='$patientID'";
  $contact_query_run = mysqli_query($con, $contact_query);
  $contact = mysqli_fetch_assoc($contact_query_run);
  $patients_phone = htmlspecialchars(decryptthis($contact["phone"], $oldKey));
  $patients_mobile = htmlspecialchars(decryptthis($contact["mobile"], $oldKey));
  $patients_email = htmlspecialchars(decryptthis($contact["email"], $oldKey));

  $healthplan_query = "SELECT * FROM healthplan WHERE patientID='$patientID'";
  $healthplan_query_run = mysqli_query($con, $healthplan_query);
  $healthplan = mysqli_fetch_assoc($healthplan_query_run);
  $patients_health_plan = htmlspecialchars(decryptthis($healthplan["health_plan"], $oldKey));
  $patients_policy_number = htmlspecialchars(decryptthis($healthplan["policy_number"], $oldKey));

  $patientlog_query = "SELECT * FROM patientlog WHERE patientID='$patientID'";
  $patientlog_query_run = mysqli_query($con, $patientlog_query);
  $patientlog = mysqli_fetch_assoc($patientlog_query_run);
  $patientlog_activity = htmlspecialchars(decryptthis($patientlog["activity"], $oldKey));

  // Sends email confirmation to patient
  $subject = mysqli_real_escape_string($con, "Assigned to $office");
  $email_message = htmlspecialchars("
  Hello $patients_fname,

  You have been assigned to $office.
  Group ID: $groupID

  If you did not request to be assigned, please contact admin.

  Thank you!
  ");

  $mail = new PHPMailer(true);

  $mail->isSMTP();
  $mail->SMTPAuth = true;

  $mail->Host = "smtp.gmail.com";
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;

  $mail->Username = "thyrone.antonio@gmail.com";
  $mail->Password = "mhopftvkjlemevgn";

  $mail->setFrom($patients_email);
  $mail->addAddress($patients_email);

  $mail->Subject = $subject;
  $mail->Body = $email_message;

  $mail->send();

  // Encrypt Activity Data and insert
  $fullname = "$fname $lname";
  $assign_message = "$type $patients_fname $patients_lname $message";
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_user_office = encryptthis($office, $key);
  $encrypt_assign_message = encryptthis($assign_message, $key);
  $activity = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypt_user_office, $encrypt_fullname, $type, $encrypt_assign_message);
  $stmt->execute();

  // stores data in email table
  $encrypted_admin = encryptthis($admin, $key);
  $encrypted_email = encryptthis($patients_email, $key);
  $encrypted_subject = encryptthis($subject, $key);
  $encrypted_message = encryptthis($email_message, $key);
  $send_message = "INSERT INTO email (userID, groupID, fromEmail, toEmail, subject, message) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($send_message);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_admin, $encrypted_email, $encrypted_subject, $encrypted_message);
  $stmt->execute();

  // Encrypt Data and Update Patient's information
  $encrypt_patients_fname = encryptthis($patients_fname, $key);
  $encrypt_patients_lname = encryptthis($patients_lname, $key);
  $encrypt_patients_suffix = encryptthis($patients_suffix, $key);
  $encrypt_patients_role = encryptthis($patients_role, $key);
  $update_patients  = "UPDATE patients SET groupID=?, fname=?, lname=?, suffix=?, role=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_patients);
  $stmt->bind_param("sssss", $groupID, $encrypt_patients_fname, $encrypt_patients_lname, $encrypt_patients_suffix, $encrypt_patients_role);
  $stmt->execute();

  $encrypt_patients_dob = encryptthis($patients_dob, $key);
  $encrypt_patients_race = encryptthis($patients_race, $key);
  $encrypt_patients_ethnicity = encryptthis($patients_ethnicity, $key);
  $update_diversity  = "UPDATE diversity SET groupID=?, dob=?, race=?, ethnicity=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_diversity);
  $stmt->bind_param("ssss", $groupID, $encrypt_patients_dob, $encrypt_patients_race, $encrypt_patients_ethnicity);
  $stmt->execute();

  $encrypt_patients_address1 = encryptthis($patients_address1, $key);
  $encrypt_patients_address2 = encryptthis($patients_address2, $key);
  $encrypt_patients_city = encryptthis($patients_city, $key);
  $encrypt_patients_state = encryptthis($patients_state, $key);
  $encrypt_patients_zip = encryptthis($patients_zip, $key);
  $update_address  = "UPDATE address SET groupID=?, address1=?, address2=?, city=?, state=?, zip=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_address);
  $stmt->bind_param("ssssss", $groupID, $encrypt_patients_address1, $encrypt_patients_address2, $encrypt_patients_city, $encrypt_patients_state, $encrypt_patients_zip);
  $stmt->execute();

  $encrypt_patients_phone = encryptthis($patients_phone, $key);
  $encrypt_patients_mobile = encryptthis($patients_mobile, $key);
  $encrypt_patients_email = encryptthis($patients_email, $key);
  $update_contact  = "UPDATE contact SET groupID=?, phone=?, mobile=?, email=?  WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_contact);
  $stmt->bind_param("ssss", $groupID, $encrypt_patients_phone, $encrypt_patients_mobile, $encrypt_patients_email);
  $stmt->execute();

  $encrypt_patients_health_plan = encryptthis($patients_health_plan, $key);
  $encrypt_patients_policy_number = encryptthis($patients_policy_number, $key);
  $update_healthplan  = "UPDATE healthplan SET groupID=?, health_plan=?, policy_number=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_healthplan);
  $stmt->bind_param("sss", $groupID, $encrypt_patients_health_plan, $encrypt_patients_policy_number);
  $stmt->execute();

  $encrypt_patientlog_activity = encryptthis($patientlog_activity, $key);
  $update_patientlog  = "UPDATE patientlog SET groupID=?, activity=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_patientlog);
  $stmt->bind_param("ss", $groupID, $encrypt_patientlog_activity);
  $stmt->execute();

  // Update Patient's dk_token
  $updateKey  = "UPDATE token SET groupID=?, dk_token=? WHERE userID='$patientID' ";
  $stmt = $con->prepare($updateKey);
  $stmt->bind_param("ss", $groupID, $key);
  $stmt->execute();

  if($stmt = $con->prepare($update_patients))
  {
    $_SESSION['success'] = "Successfully Assigned Patient ID: $patientID!";
    header("Location: /HC/admin/pages/patients/index.php?patient=&button=");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Assign Patient ID: $patientID";
    header("Location: /HC/admin/pages/patients/index.php?patient=&button=");
    exit(0);
  }
}


?>
