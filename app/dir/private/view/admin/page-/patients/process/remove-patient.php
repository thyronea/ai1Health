<?php

// 1. Retrieve patient's data for decryption
// 2. Generate new key for encryption
// 3. Update patient's data while using new group ID

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
    $patient_email = mysqli_real_escape_string($con, $_POST['patient_email']);
    
    $admin = mysqli_real_escape_string($con, "Admin");
    $type = mysqli_real_escape_string($con, "Removed Patient: ");
  
    // 1. Retrieve patient's demographic for decryption

    // Patient's Information
    $patient_query = "SELECT * FROM patients WHERE patientID='$patientID'";
    $patient_query_run = mysqli_query($con, $patient_query);
    $patient = mysqli_fetch_assoc($patient_query_run);
    $patients_fname = htmlspecialchars(decryptthis($patient["fname"], $key));
    $patients_lname = htmlspecialchars(decryptthis($patient["lname"], $key));
    $patients_suffix = htmlspecialchars(decryptthis($patient["suffix"], $key));
    $patients_email = htmlspecialchars(decryptthis($patient["email"], $key));
    $patients_role = htmlspecialchars(decryptthis($patient["role"], $key));

    // Patient's Diversity
    $diversity_query = "SELECT * FROM diversity WHERE userID='$patientID'";
    $diversity_query_run = mysqli_query($con, $diversity_query);
    $diversity = mysqli_fetch_assoc($diversity_query_run);
    $patients_dob = htmlspecialchars(decryptthis($diversity["dob"], $key));
    $patients_gender = htmlspecialchars(decryptthis($diversity["gender"], $key));
    $patients_race = htmlspecialchars(decryptthis($diversity["race"], $key));
    $patients_ethnicity = htmlspecialchars(decryptthis($diversity["ethnicity"], $key));
  
    // Patient's Address
    $address_query = "SELECT * FROM address WHERE userID='$patientID'";
    $address_query_run = mysqli_query($con, $address_query);
    $address = mysqli_fetch_assoc($address_query_run);
    $patients_address1 = htmlspecialchars(decryptthis($address["address1"], $key));
    $patients_address2 = htmlspecialchars(decryptthis($address["address2"], $key));
    $patients_city = htmlspecialchars(decryptthis($address["city"], $key));
    $patients_state = htmlspecialchars(decryptthis($address["state"], $key));
    $patients_zip = htmlspecialchars(decryptthis($address["zip"], $key));

    // Patient's Contact Information
    $contact_query = "SELECT * FROM contact WHERE userID='$patientID'";
    $contact_query_run = mysqli_query($con, $contact_query);
    $contact = mysqli_fetch_assoc($contact_query_run);
    $patients_phone = htmlspecialchars(decryptthis($contact["phone"], $key));
    $patients_mobile = htmlspecialchars(decryptthis($contact["mobile"], $key));
    $patients_email = htmlspecialchars(decryptthis($contact["email"], $key));

    // Patient's Health Plan
    $hp_query = "SELECT * FROM healthplan WHERE patientID='$patientID'";
    $hp_query_run = mysqli_query($con, $hp_query);
    $hp = mysqli_fetch_assoc($hp_query_run);
    $hp_health_plan = htmlspecialchars(decryptthis($hp["health_plan"], $key));
    $hp_policy_number = htmlspecialchars(decryptthis($hp["policy_number"], $key));
    $hp_status = htmlspecialchars(decryptthis($hp["status"], $key));

    // Patient's Immunization
    //$iz_query = "SELECT * FROM immunization WHERE patientID='$patientID'";
    //$iz_query_run = mysqli_query($con, $iz_query);
    //$iz = mysqli_fetch_assoc($iz_query_run);
    //$iz_uniqueID = htmlspecialchars($iz["uniqueID"]);
    //$iz_name = htmlspecialchars(decryptthis($iz["name"], $key));
    //$iz_dob = htmlspecialchars(decryptthis($iz["dob"], $key));
    //$iz_vaccine = htmlspecialchars(decryptthis($iz["vaccine"], $key));
    //$iz_lot = htmlspecialchars(decryptthis($iz["lot"], $key));
    //$iz_ndc = htmlspecialchars(decryptthis($iz["ndc"], $key));
    //$iz_site = htmlspecialchars(decryptthis($iz["site"], $key));
    //$iz_route = htmlspecialchars(decryptthis($iz["route"], $key));
    //$iz_vis_given = htmlspecialchars(decryptthis($iz["vis_given"], $key));
    //$iz_vis = htmlspecialchars(decryptthis($iz["vis"], $key));
    //$iz_funding_source = htmlspecialchars(decryptthis($iz["funding_source"], $key));
    //$iz_administered_by = htmlspecialchars(decryptthis($iz["administered_by"], $key));
    //$iz_comment = htmlspecialchars(decryptthis($iz["comment"], $key));
    
    // Patient's Log
    $patientlog_query = "SELECT * FROM patientlog WHERE patientID='$patientID'";
    $patientlog_query_run = mysqli_query($con, $patientlog_query);
    $patientlog = mysqli_fetch_assoc($patientlog_query_run);
    $patientlog_activity = htmlspecialchars(decryptthis($patientlog["activity"], $key));
  
    // Sends email confirmation to patient
    $subject = mysqli_real_escape_string($con, "Account Status Update");
    $message = htmlspecialchars("
    Hello $patients_fname,
  
    You have been removed from:
    Group ID: $groupID
  
    If you did not request to be removed, please contact admin.
  
    Thank you!
    ");
  
    // Email Configuration
    include('../components/email-config.php');
    

    // 2. Generate new key for decryption (IF THIS KEY IS SOME HOW BROKEN OR COMPROMISED, ALL DATA WILL BE LOST)
    $newKey = md5(rand());
    $newGroupID = mysqli_real_escape_string($con, "1111111");


    // 3. Update patient's data while using new group ID
  
    // stores data in email table
    $encrypted_admin = encryptthis($admin, $newKey);
    $encrypted_email = encryptthis($patients_email, $newKey);
    $encrypted_subject = encryptthis($subject, $newKey);
    $encrypted_message = encryptthis($message, $newKey);
    $send_message = "INSERT INTO email (userID, groupID, fromEmail, toEmail, subject, message) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($send_message);
    $stmt->bind_param("ssssss", $userID, $newGroupID, $encrypted_admin, $encrypted_email, $encrypted_subject, $encrypted_message);
    $stmt->execute();
  
    // Update admin info: group ID
    $update_patients  = "UPDATE admin SET groupID=? WHERE userID='$patientID' ";
    $stmt = $con->prepare($update_patients);
    $stmt->bind_param("s", $newGroupID);
    $stmt->execute();

    // Update background image: group ID
    $update_background  = "UPDATE background_image SET groupID=? WHERE userID='$patientID' ";
    $stmt = $con->prepare($update_background);
    $stmt->bind_param("s", $newGroupID);
    $stmt->execute();

    // Update profile image: group ID
    $update_profile  = "UPDATE profile_image SET groupID=? WHERE userID='$patientID' ";
    $stmt = $con->prepare($update_profile);
    $stmt->bind_param("s", $newGroupID);
    $stmt->execute();

    // Update data_dob: group ID
    $update_data_dob  = "UPDATE data_dob SET groupID=? WHERE patientID='$patientID' ";
    $stmt = $con->prepare($update_data_dob);
    $stmt->bind_param("s", $newGroupID);
    $stmt->execute();

    // Update data_ethnicity: group ID
    $update_data_ethnicity  = "UPDATE data_ethnicity SET groupID=? WHERE patientID='$patientID' ";
    $stmt = $con->prepare($update_data_ethnicity);
    $stmt->bind_param("s", $newGroupID);
    $stmt->execute();

    // Update data_gender: group ID
    $update_data_gender  = "UPDATE data_gender SET groupID=? WHERE patientID='$patientID' ";
    $stmt = $con->prepare($update_data_gender);
    $stmt->bind_param("s", $newGroupID);
    $stmt->execute();

    // Update data_race: group ID
    $update_data_race  = "UPDATE data_race SET groupID=? WHERE patientID='$patientID' ";
    $stmt = $con->prepare($update_data_race);
    $stmt->bind_param("s", $newGroupID);
    $stmt->execute();

    // Update engine: group ID
    $update_engine  = "UPDATE engine SET groupID=? WHERE engineID='$engineID' ";
    $stmt = $con->prepare($update_engine);
    $stmt->bind_param("s", $newGroupID);
    $stmt->execute();

    // Encrypt Data and Update Patient's information
    $encrypt_patients_fname = encryptthis($patients_fname, $newKey);
    $encrypt_patients_lname = encryptthis($patients_lname, $newKey);
    $encrypt_patients_suffix = encryptthis($patients_suffix, $newKey);
    $encrypt_patients_role = encryptthis($patients_role, $newKey);
    $update_patients  = "UPDATE patients SET groupID=?, fname=?, lname=?, suffix=?, email=?, role=? WHERE patientID='$patientID' ";
    $stmt = $con->prepare($update_patients);
    $stmt->bind_param("ssssss", $newGroupID, $encrypt_patients_fname, $encrypt_patients_lname, $encrypt_patients_suffix, $encrypted_email, $encrypt_patients_role);
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

    $encrypt_health_plan = encryptthis($hp_health_plan, $newKey);
    $encrypt_policy_number = encryptthis($hp_policy_number, $newKey);
    $encrypt_status = encryptthis($hp_status, $newKey);
    $update_healthplan  = "UPDATE healthplan SET groupID=?, health_plan=?, policy_number=?, status=? WHERE patientID='$patientID' ";
    $stmt = $con->prepare($update_healthplan);
    $stmt->bind_param("ssss", $newGroupID, $encrypt_health_plan, $encrypt_policy_number, $encrypt_status);
    $stmt->execute();

    $update_iz  = "UPDATE immunization SET groupID=? WHERE patientID='$patientID' ";
    $stmt = $con->prepare($update_iz);
    $stmt->bind_param("s", $newGroupID);
    $stmt->execute();

    $encrypt_patientlog_activity = encryptthis($patientlog_activity, $newKey);
    $update_patientlog = "UPDATE patientlog SET groupID=? WHERE patientID='$patientID' ";
    $stmt = $con->prepare($update_patientlog);
    $stmt->bind_param("s", $newGroupID);
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
