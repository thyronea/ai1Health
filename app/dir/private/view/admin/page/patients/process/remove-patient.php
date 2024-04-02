<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
require '../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

if(isset($_POST['remove_patient']))
{
    $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
    $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
    $email = mysqli_real_escape_string($con, $_SESSION['email']);
    $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
    $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
    $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
    $admin = mysqli_real_escape_string($con, "Admin");
    $type = mysqli_real_escape_string($con, "Removed");
    $message = mysqli_real_escape_string($con, "as new patient");

    // Generate new key for data decryption. IF THIS KEY IS SOME HOW BROKEN OR COMPROMISED, ALL DATA WILL BE LOST
    $newKey = md5(rand());
    $newGroupID = mysqli_real_escape_string($con, "0000000");
  
    // Retrieves patient's dk_token to decrypt patient's information
    $dk_token_query = "SELECT * FROM token WHERE userID='$patientID'";
    $dk_token_query_run = mysqli_query($con, $dk_token_query);
    $dk_token = mysqli_fetch_assoc($dk_token_query_run);
    $oldKey = htmlspecialchars($dk_token["dk_token"]); // Patient's Key
  
    // Retrieves patient's information for decryption
    $patient_query = "SELECT * FROM patients WHERE patientID='$patientID'";
    $patient_query_query_run = mysqli_query($con, $patient_query);
    $patient = mysqli_fetch_assoc($patient_query_query_run);
    $patients_fname = htmlspecialchars(decryptthis($patient["fname"], $oldKey));
    $patients_lname = htmlspecialchars(decryptthis($patient["lname"], $oldKey));
    $patients_suffix = htmlspecialchars(decryptthis($patient["suffix"], $oldKey));
    $patient_email = htmlspecialchars(decryptthis($patient["email"], $oldKey));
    $patients_role = htmlspecialchars(decryptthis($patient["role"], $oldKey));
  
    $diversity_query = "SELECT * FROM diversity WHERE userID='$patientID'";
    $diversity_query_query_run = mysqli_query($con, $diversity_query);
    $diversity = mysqli_fetch_assoc($diversity_query_query_run);
    $patients_dob = htmlspecialchars(decryptthis($diversity["dob"], $oldKey));
    $patients_gender = htmlspecialchars(decryptthis($diversity["gender"], $oldKey));
    $patients_race = htmlspecialchars(decryptthis($diversity["race"], $oldKey));
    $patients_ethnicity = htmlspecialchars(decryptthis($diversity["ethnicity"], $oldKey));
  
    $address_query = "SELECT * FROM address WHERE userID='$patientID'";
    $address_query_run = mysqli_query($con, $address_query);
    $address = mysqli_fetch_assoc($address_query_run);
    $patients_address1 = htmlspecialchars(decryptthis($address["address1"], $oldKey));
    $patients_address2 = htmlspecialchars(decryptthis($address["address2"], $oldKey));
    $patients_city = htmlspecialchars(decryptthis($address["city"], $oldKey));
    $patients_state = htmlspecialchars(decryptthis($address["state"], $oldKey));
    $patients_zip = htmlspecialchars(decryptthis($address["zip"], $oldKey));
  
    $contact_query = "SELECT * FROM contact WHERE userID='$patientID'";
    $contact_query_run = mysqli_query($con, $contact_query);
    $contact = mysqli_fetch_assoc($contact_query_run);
    $patients_phone = htmlspecialchars(decryptthis($contact["phone"], $oldKey));
    $patients_mobile = htmlspecialchars(decryptthis($contact["mobile"], $oldKey));
    $patients_email = htmlspecialchars(decryptthis($contact["email"], $oldKey));
  
    $patientlog_query = "SELECT * FROM patientlog WHERE patientID='$patientID'";
    $patientlog_query_run = mysqli_query($con, $patientlog_query);
    $patientlog = mysqli_fetch_assoc($patientlog_query_run);
    $patientlog_activity = htmlspecialchars(decryptthis($patientlog["activity"], $oldKey));

    // Encrypt Activities Data
    $fullname = "$fname $lname";
    $act_message = "$type: $patients_fname $patients_lname";
    $encrypted_fullname = encryptthis($fullname, $key);
    $encrypted_message = encryptthis($act_message, $key);

    // insert activity timestamp
    $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();
  
    // Sends email confirmation to patient
    $subject = mysqli_real_escape_string($con, "Account Status Update");
    $email_message = htmlspecialchars("
    Hello $patients_fname,
  
    You have been removed from:
    Group ID: $groupID
  
    If you did not request to be removed, please contact admin.
  
    Thank you!
    ");
  
    // Email Configuration
    include('../components/email-config.php');
  
    // stores data in email table
    $encrypted_admin = encryptthis($admin, $newKey);
    $encrypted_email = encryptthis($patients_email, $newKey);
    $encrypted_subject = encryptthis($subject, $newKey);
    $encrypted_message = encryptthis($email_message, $newKey);
    $send_message = "INSERT INTO email (userID, groupID, fromEmail, toEmail, subject, message) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($send_message);
    $stmt->bind_param("ssssss", $userID, $newGroupID, $encrypted_admin, $encrypted_email, $encrypted_subject, $encrypted_message);
    $stmt->execute();
  
    // Update admin info: group ID
    $update_patients  = "UPDATE admin SET groupID=? WHERE userID='$patientID' ";
    $stmt = $con->prepare($update_patients);
    $stmt->bind_param("s", $newGroupID);
    $stmt->execute();

    // Encrypt Data and Update Patient's information
    $encrypt_patients_fname = encryptthis($patients_fname, $newKey);
    $encrypt_patients_lname = encryptthis($patients_lname, $newKey);
    $encrypt_patients_suffix = encryptthis($patients_suffix, $newKey);
    $encrypt_patients_role = encryptthis($patients_role, $newKey);
    $update_patients  = "UPDATE patients SET groupID=?, fname=?, lname=?, suffix=?, role=? WHERE patientID='$patientID' ";
    $stmt = $con->prepare($update_patients);
    $stmt->bind_param("sssss", $newGroupID, $encrypt_patients_fname, $encrypt_patients_lname, $encrypt_patients_suffix, $encrypt_patients_role);
    $stmt->execute();
  
    $encrypt_patients_dob = encryptthis($patients_dob, $newKey);
    $encrypt_patients_race = encryptthis($patients_race, $newKey);
    $encrypt_patients_ethnicity = encryptthis($patients_ethnicity, $newKey);
    $update_diversity  = "UPDATE diversity SET groupID=?, dob=?, race=?, ethnicity=? WHERE userID='$patientID' ";
    $stmt = $con->prepare($update_diversity);
    $stmt->bind_param("ssss", $newGroupID, $encrypt_patients_dob, $encrypt_patients_race, $encrypt_patients_ethnicity);
    $stmt->execute();
  
    $encrypt_patients_address1 = encryptthis($patients_address1, $newKey);
    $encrypt_patients_address2 = encryptthis($patients_address2, $newKey);
    $encrypt_patients_city = encryptthis($patients_city, $newKey);
    $encrypt_patients_state = encryptthis($patients_state, $newKey);
    $encrypt_patients_zip = encryptthis($patients_zip, $newKey);
    $update_address  = "UPDATE address SET groupID=?, address1=?, address2=?, city=?, state=?, zip=? WHERE userID='$patientID' ";
    $stmt = $con->prepare($update_address);
    $stmt->bind_param("ssssss", $newGroupID, $encrypt_patients_address1, $encrypt_patients_address2, $encrypt_patients_city, $encrypt_patients_state, $encrypt_patients_zip);
    $stmt->execute();
  
    $encrypt_patients_phone = encryptthis($patients_phone, $newKey);
    $encrypt_patients_mobile = encryptthis($patients_mobile, $newKey);
    $encrypt_patients_email = encryptthis($patients_email, $newKey);
    $update_contact  = "UPDATE contact SET groupID=?, phone=?, mobile=?, email=?  WHERE userID='$patientID' ";
    $stmt = $con->prepare($update_contact);
    $stmt->bind_param("ssss", $newGroupID, $encrypt_patients_phone, $encrypt_patients_mobile, $encrypt_patients_email);
    $stmt->execute();
  
    $encrypt_patients_health_plan = encryptthis($patients_health_plan, $newKey);
    $encrypt_patients_policy_number = encryptthis($patients_policy_number, $newKey);
    $update_healthplan  = "UPDATE healthplan SET groupID=?WHERE patientID='$patientID' ";
    $stmt = $con->prepare($update_healthplan);
    $stmt->bind_param("s", $newGroupID);
    $stmt->execute();
  
    $encrypt_patientlog_activity = encryptthis($patientlog_activity, $newKey);
    $update_patientlog = "UPDATE patientlog SET groupID=?, activity=? WHERE patientID='$patientID' ";
    $stmt = $con->prepare($update_patientlog);
    $stmt->bind_param("ss", $newGroupID, $encrypt_patientlog_activity);
    $stmt->execute();
  
    // Update Patient's dk_token
    $updateKey = "UPDATE token SET groupID=?, dk_token=? WHERE userID='$patientID' ";
    $stmt = $con->prepare($updateKey);
    $stmt->bind_param("ss", $newGroupID, $newKey);
    $stmt->execute();
  
    if($stmt = $con->prepare($updateKey))
    {
      $_SESSION['success'] = "Successfully Removed Patient ID: $patientID!";
      header("Location: ../../patients/index.php");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Remove Patient ID: $patientID";
      header("Location: ../../patients/index.php");
      exit(0);
    }
  }

?>
