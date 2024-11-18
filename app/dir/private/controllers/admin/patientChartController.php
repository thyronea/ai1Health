<?php

// Send email to patient
if(isset($_POST['send_email'])):{
    $patientID = mysqli_real_escape_string($con, $_POST['userID']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $type = mysqli_real_escape_string($con, "Messaged");

    // Send email
    include(PRIVATE_CONFIG_PATH . '/send-email.php');
    // Send email process
    include(PRIVATE_MODELS_PATH . '/admin/patients/emailSend.php');
  
    if($stmt = $con->prepare($sql)){
      $_SESSION['success'] = "Email Successfully Sent to $email!";
      header("Location: ../../admin/patient-chart/?patientID=$patientID");
      exit(0);
    }
    else{
      $_SESSION['warning'] = "Unable to Send Email to $email!";
      header("Location: ../../admin/patient-chart/?patientID=$patientID");
    }
}endif;

// Upload patient's profile image
if(isset($_POST['add_patient_image'])):{
    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
    $maxsize = 2097152;
    $rand_hash = md5(rand()); 
    $rand_name = rand(1000,9999);
    $filename = $_FILES["patient_image"]["name"];
    $tempname = $_FILES["patient_image"]["tmp_name"];
    $folder = '../../../img/profile';
    $img_name = "$rand_name$filename";
  
    if(($_FILES['patient_image']['size'] >= $maxsize) || ($_FILES["patient_image"]["size"] == 0)) {
        $_SESSION['warning'] = "Unable to Upload Image. File must be less than 2MB";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
    }
    // If default image is used, update image in DB
    else{
        $default_pic = "default-profile-pic.jpeg";
        $check_image = "SELECT * FROM profile_image WHERE userID='$patientID' AND filename='$default_pic' ";
        $check_image_run = mysqli_query($con, $check_image);
  
        if(mysqli_num_rows($check_image_run) > 0 ) {
          $update_image  = "UPDATE profile_image SET filename=? WHERE userID='$patientID' ";
          $stmt = $con->prepare($update_image);
          $stmt->bind_param("s", $img_name);
          $stmt->execute();
      
          if(move_uploaded_file($tempname, "$folder/$img_name")) {
            $_SESSION['success'] = "Successfully Uploaded Image!";
            header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
            exit(0);
          }
          else {
            $_SESSION['warning'] = "Unable to Upload Image!";
            header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
            exit(0);
          }
        }
          // If other image is used, update image in DB and delete the image in directory folder (image)
        else{
          $check_image = "SELECT * FROM profile_image WHERE userID='$patientID' ";
          $check_image_run = mysqli_query($con, $check_image);
          $image = mysqli_fetch_assoc($check_image_run);
      
          unlink('../../../img/profile/'.$image['filename']);
          $update_image  = "UPDATE profile_image SET filename=? WHERE userID='$patientID' ";
          $stmt = $con->prepare($update_image);
          $stmt->bind_param("s", $img_name);
          $stmt->execute();
          
          if(move_uploaded_file($tempname, "$folder/$img_name")) {
            $_SESSION['success'] = "Successfully Uploaded Image!";
            header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
            exit(0);
          }
          else {
            $_SESSION['warning'] = "Unable to Upload Image!";
            header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
            exit(0);
          }
        }
    }
}endif;

// Update patient's name, dob and diversity
if(isset($_POST['patient_edit_btn'])):{

  // Update patient's name, dob and diversity
  include(PRIVATE_MODELS_PATH . '/admin/patients/updatePatientName.php');

  if($stmt = $con->prepare($patients)){
    $_SESSION['success'] = "Patient Successfully Updated!";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{
    $_SESSION['warning'] = "Unable to Update Patient Information";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
}endif;

// Add patient's contact information
if(isset($_POST['add_patient_contactbtn'])):{   
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $phone = mysqli_real_escape_string($con, $_POST['phone']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
  $patient_email = mysqli_real_escape_string($con, $_POST['email']);
  $type = mysqli_real_escape_string($con, "Added");
  $message = mysqli_real_escape_string($con, "Contact information");

  // Check if contact information exist
  $checkContact = "SELECT * FROM contact WHERE userID='$patientID'";
  $checkContact_run = mysqli_query($con, $checkContact);

  if(mysqli_num_rows($checkContact_run) > 0){
    $_SESSION['warning'] = "Patient's Contact Information Already Exist!";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{

    // Add patient's contact
    include(PRIVATE_MODELS_PATH . '/admin/patients/addPatientContact.php');

    if($stmt = $con->prepare($contact)){
        $_SESSION['success'] = "Patient's Contact Information was Successfully Added!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
    }
    else{
        $_SESSION['warning'] = "Unable to Add Patient's Contact Information";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
    }
  }
}endif;

// Update patient's email
if(isset($_POST['edit_patient_emailbtn'])){
  
  // Update patient's contact information process
  include(PRIVATE_MODELS_PATH . '/admin/patients/updatePatientEmail.php');
  
}
// Update patient's phone numbers
if(isset($_POST['patient_phonetbtn'])){
  
  // Update patient's contact information process
  include(PRIVATE_MODELS_PATH . '/admin/patients/updatePatientPhones.php');

}

// Add emergency contact
if(isset($_POST['add_patient_emergencybtn'])):{

  $engineID = mysqli_escape_string($con, $_POST['engineID']);
  $patientID = mysqli_escape_string($con, $_POST['patientID']);
  $patient_fname = mysqli_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_escape_string($con, $_POST['lname']);
  $emergency_fname = mysqli_escape_string($con, $_POST['emergency_fname']);
  $emergency_lname = mysqli_escape_string($con, $_POST['emergency_lname']);
  $emergency_phone = mysqli_escape_string($con, $_POST['emergency_phone']);
  $emergency_email = mysqli_escape_string($con, $_POST['emergency_email']);

  // Check if emergency contact exist
  $checkcontact = "SELECT * FROM emergency_contact WHERE patientID='$patientID' ";
  $checkcontact_run = mysqli_query($con, $checkcontact);
  $row = mysqli_fetch_array($checkcontact_run);
  
  if(mysqli_num_rows($checkcontact_run) > 0){

    // Decrypt existing emergency contact
    $checkPhone = htmlspecialchars(decryptthis($row['phone'], $key));
    $checkEmail = htmlspecialchars(decryptthis($row['email'], $key));

    // If emergency contact exist, check for information match. Error message if there's match
    if($emergency_email === $checkEmail || $emergency_phone === $checkPhone){
      $_SESSION['warning'] = "$emergency_fname $emergency_lname already exist as an emergency contact!";
      header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
      exit(0);
    }
    else{
      // Add emergency contact if no match
      include(PRIVATE_MODELS_PATH . '/admin/patients/addEmergencyContact.php');

      if($stmt = $con->prepare($addEmergency)){
        $_SESSION['success'] = "Emergency Contact Was Successfully Added!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
      }
      else{
        $_SESSION['warning'] = "Unable to Add Patient's Emergency Contact!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
      }
    }
    
  }
  else{

    // Add emergency contact process
    include(PRIVATE_MODELS_PATH . '/admin/patients/addEmergencyContact.php');

    if($stmt = $con->prepare($addEmergency)){
      $_SESSION['success'] = "Emergency Contact Was Successfully Added!";
      header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
      exit(0);
    }
    else{
      $_SESSION['warning'] = "Unable to Add Patient's Emergency Contact!";
      header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
      exit(0);
    }
  }
}endif;

// Edit emergency contact
if(isset($_POST['update_patient_emergencybtn'])):{
  
  // Update emergency contact process
  include(PRIVATE_MODELS_PATH . '/admin/patients/updateEmergencyContact.php');
}endif;

// Delete emergency contact
if(isset($_POST['emergencydeletebtn'])):{
  
  // Delete emergency contact process
  include(PRIVATE_MODELS_PATH . '/admin/patients/deleteEmergencyContact.php');

  if($stmt = $con->prepare($delete)){
    $_SESSION['success'] = "Successfully Deleted Emergency Contact!";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{
    $_SESSION['warning'] = "Unable to Delete Patient's Emergency Contact";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
}endif;

// Add patient's address
if(isset($_POST['add_patient_addressbtn'])):{
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $address1 = mysqli_real_escape_string($con, $_POST['address1']);
  $address2 = mysqli_real_escape_string($con, $_POST['address2']);
  $city = mysqli_real_escape_string($con, $_POST['city']);
  $state = mysqli_real_escape_string($con, $_POST['state']);
  $zip = mysqli_real_escape_string($con, $_POST['zip']);
  $type = mysqli_real_escape_string($con, "Added");

  // Check if address exist
  $checkaddress = "SELECT * FROM address WHERE userID='$patientID'";
  $checkaddress_run = mysqli_query($con, $checkaddress);

  if(mysqli_num_rows($checkaddress_run) > 0){
    $_SESSION['warning'] = "Patient's Address Already Exist!";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{
    // store activity data in activity table
    $fullname = "$fname $lname";
    $full_address = "$address1 $address2 $city $state $zip";
    $encrypt_fullname = encryptthis($fullname, $key);
    $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $full_address);
    $stmt->execute();

    // Encrypt Patient's address Data
    $encrypt_address1 = encryptthis($address1, $key);
    $encrypt_address2 = encryptthis($address2, $key);
    $encrypt_city = encryptthis($city, $key);
    $encrypt_state = encryptthis($state, $key);
    $encrypt_zip = encryptthis($zip, $key);

    //Insert to address table//
    $address = "INSERT INTO address (userID, engineID, groupID, address1, address2, city, state, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($address);
    $stmt->bind_param("ssssssss", $patientID, $engineID, $groupID, $encrypt_address1, $encrypt_address2, $encrypt_city, $encrypt_state, $encrypt_zip);
    $stmt->execute();

    if($stmt = $con->prepare($address))
    {
      $_SESSION['success'] = "$address1 $address2 $city $state $zip Successfully Added!";
      header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Add Patient's Address!";
      header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
      exit(0);
    }
  }
}endif;

// Edit patient's address
if(isset($_POST['patient_addressbtn'])):{
  
  // Update patient's address
  include(PRIVATE_MODELS_PATH . '/admin/patients/updateAddress.php');

  if($stmt = $con->prepare($address)){
    $_SESSION['success'] = "Patient's Address Successfully Updated!";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{
    $_SESSION['warning'] = "Unable to Update Patient's Address";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
}endif;

// Edit patient's health plan
if(isset($_POST['patient_planbtn'])):{ 

  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $health_plan = mysqli_real_escape_string($con, $_POST['health_plan']);
  $policy_number = mysqli_real_escape_string($con, $_POST['policy_number']);
  $status = mysqli_real_escape_string($con, $_POST['status']);

  // Check if healthplan exist
  $checkhealthplan = "SELECT * FROM healthplan WHERE patientID='$patientID'";
  $checkhealthplan_run = mysqli_query($con, $checkhealthplan);

  if(mysqli_num_rows($checkhealthplan_run) == 0){
    $_SESSION['warning'] = "Unable to update. Patient's healthplan doesn't exist!";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{
    
    // Update patient's health plan
    include(PRIVATE_MODELS_PATH . '/admin/patients/updatePlan.php');

    if($stmt = $con->prepare($healthplan)){
      $_SESSION['success'] = "Patient's Health Plan Successfully Updated!";
      header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
      exit(0);
    }
    else{
      $_SESSION['warning'] = "Unable to Update Patient's Health Plan Information";
      header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
      exit(0);
    }
  }
}endif;

// Add patient's divesity
if(isset($_POST['add_patient_diversity'])):{ 

  // Add patient's diversity process
  include(PRIVATE_MODELS_PATH . '/admin/patients/addPatientDiversity.php');
  
}endif;


// Assign Patient
if(isset($_POST['assign_patient'])):{

  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $admin = mysqli_real_escape_string($con, "Admin");
  $type = mysqli_real_escape_string($con, "Added");
  $activity_message = mysqli_real_escape_string($con, "as new patient");

  // Retrieves patient's dk_token to decrypt patient's information
  $dk_token_query = "SELECT * FROM token WHERE userID='$patientID'";
  $dk_token_query_run = mysqli_query($con, $dk_token_query);
  $dk_token = mysqli_fetch_assoc($dk_token_query_run);
  $oldKey = htmlspecialchars($dk_token["dk_token"]); // Patient's Key

  // Retrieves patient's information for decryption
  $patient_query = "SELECT * FROM patients WHERE patientID='$patientID'";
  $patient_query_run = mysqli_query($con, $patient_query);
  $patient = mysqli_fetch_assoc($patient_query_run);
  $email = htmlspecialchars(decryptthis($patient["email"], $oldKey));
  $patients_fname = htmlspecialchars(decryptthis($patient["fname"], $oldKey));
  $patients_lname = htmlspecialchars(decryptthis($patient["lname"], $oldKey));
  $patients_suffix = htmlspecialchars(decryptthis($patient["suffix"], $oldKey));
  $patients_role = htmlspecialchars(decryptthis($patient["role"], $oldKey));

  $diversity_query = "SELECT * FROM diversity WHERE userID='$patientID'";
  $diversity_query_run = mysqli_query($con, $diversity_query);
  $diversity = mysqli_fetch_assoc($diversity_query_run);
  $patients_dob = htmlspecialchars(decryptthis($diversity["dob"], $oldKey));
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

  $hp_query = "SELECT * FROM healthplan WHERE patientID='$patientID'";
  $hp_query_run = mysqli_query($con, $hp_query);
  $hp = mysqli_fetch_assoc($hp_query_run);
  $hp_health_plan = htmlspecialchars(decryptthis($hp["health_plan"], $oldKey));
  $hp_policy_number = htmlspecialchars(decryptthis($hp["policy_number"], $oldKey));
  $hp_status = htmlspecialchars(decryptthis($hp["status"], $oldKey));

  //$iz_query = "SELECT * FROM immunization WHERE patientID='$patientID'";
  //$iz_query_run = mysqli_query($con, $iz_query);
  //$iz = mysqli_fetch_assoc($iz_query_run);
  //$iz_uniqueID = htmlspecialchars($iz["uniqueID"]);
  //$iz_name = htmlspecialchars(decryptthis($iz["name"], $oldKey));
  //$iz_dob = htmlspecialchars(decryptthis($iz["dob"], $oldKey));
  //$iz_vaccine = htmlspecialchars(decryptthis($iz["vaccine"], $oldKey));
  //$iz_lot = htmlspecialchars(decryptthis($iz["lot"], $oldKey));
  //$iz_ndc = htmlspecialchars(decryptthis($iz["ndc"], $oldKey));
  //$iz_site = htmlspecialchars(decryptthis($iz["site"], $oldKey));
  //$iz_route = htmlspecialchars(decryptthis($iz["route"], $oldKey));
  //$iz_vis_given = htmlspecialchars(decryptthis($iz["vis_given"], $oldKey));
  //$iz_vis = htmlspecialchars(decryptthis($iz["vis"], $oldKey));
  //$iz_funding_source = htmlspecialchars(decryptthis($iz["funding_source"], $oldKey));
  //$iz_administered_by = htmlspecialchars(decryptthis($iz["administered_by"], $oldKey));
  //$iz_comment = htmlspecialchars(decryptthis($iz["comment"], $oldKey));

  $patientlog_query = "SELECT * FROM patientlog WHERE patientID='$patientID'";
  $patientlog_query_run = mysqli_query($con, $patientlog_query);
  $patientlog = mysqli_fetch_assoc($patientlog_query_run);
  $patientlog_activity = htmlspecialchars(decryptthis($patientlog["activity"], $oldKey));

  // Sends email confirmation to patient
  $subject = mysqli_real_escape_string($con, "Assigned to $groupID");
  $message = htmlspecialchars("
  Hello $patients_fname,

  You have been assigned to:
  Group ID: $groupID

  If you did not request to be assigned, please contact admin.

  Thank you!
  ");

  // Send email
  include(PRIVATE_CONFIG_PATH . '/send-email.php');

  // Encrypt Activity Data and insert
  $fullname = "$fname $lname";
  $assign_message = "$type $patients_fname $patients_lname $activity_message";
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_assign_message = encryptthis($assign_message, $key);
  $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_assign_message);
  $stmt->execute();

  // stores data in email table
  $encrypted_email = encryptthis($userEmail, $key);
  $encrypted_subject = encryptthis($subject, $key);
  $encrypted_message = encryptthis($message, $key);
  $encrypt_patients_email = encryptthis($email, $key);

  $send_message = "INSERT INTO email (userID, groupID, fromEmail, toEmail, subject, message) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($send_message);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_email, $encrypt_patients_email, $encrypted_subject, $encrypted_message);
  $stmt->execute();

  // Update admin info: group ID
  $update_patients  = "UPDATE admin SET groupID=? WHERE userID='$patientID' ";
  $stmt = $con->prepare($update_patients);
  $stmt->bind_param("s", $groupID);
  $stmt->execute();

  // Update background image: group ID
  $update_background  = "UPDATE background_image SET groupID=? WHERE userID='$patientID' ";
  $stmt = $con->prepare($update_background);
  $stmt->bind_param("s", $groupID);
  $stmt->execute();

  // Update profile image: group ID
  $update_profile  = "UPDATE profile_image SET groupID=? WHERE userID='$patientID' ";
  $stmt = $con->prepare($update_profile);
  $stmt->bind_param("s", $groupID);
  $stmt->execute();

  // Update data_dob: group ID
  $update_data_dob  = "UPDATE data_dob SET groupID=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_data_dob);
  $stmt->bind_param("s", $groupID);
  $stmt->execute();

  // Update data_ethnicity: group ID
  $update_data_ethnicity  = "UPDATE data_ethnicity SET groupID=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_data_ethnicity);
  $stmt->bind_param("s", $groupID);
  $stmt->execute();

  // Update data_gender: group ID
  $update_data_gender  = "UPDATE data_gender SET groupID=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_data_gender);
  $stmt->bind_param("s", $groupID);
  $stmt->execute();

  // Update data_race: group ID
  $update_data_race  = "UPDATE data_race SET groupID=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_data_race);
  $stmt->bind_param("s", $groupID);
  $stmt->execute();

  // Update engine: group ID
  $update_engine  = "UPDATE engine SET groupID=? WHERE engineID='$engineID' ";
  $stmt = $con->prepare($update_engine);
  $stmt->bind_param("s", $groupID);
  $stmt->execute();

  // Update healthplan: group ID
  $update_healthplan  = "UPDATE healthplan SET groupID=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_healthplan);
  $stmt->bind_param("s", $groupID);
  $stmt->execute();

  // Encrypt Data and Update Patient's information
  $encrypt_patients_fname = encryptthis($patients_fname, $key);
  $encrypt_patients_lname = encryptthis($patients_lname, $key);
  $encrypt_patients_suffix = encryptthis($patients_suffix, $key);
  $encrypt_patients_role = encryptthis($patients_role, $key);

  $update_patients  = "UPDATE patients SET groupID=?, fname=?, lname=?, suffix=?, email=?, role=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_patients);
  $stmt->bind_param("ssssss", $groupID, $encrypt_patients_fname, $encrypt_patients_lname, $encrypt_patients_suffix, $encrypt_patients_email, $encrypt_patients_role);
  $stmt->execute();

  $encrypt_patients_dob = encryptthis($patients_dob, $key);
  $encrypt_patients_race = encryptthis($patients_race, $key);
  $encrypt_patients_ethnicity = encryptthis($patients_ethnicity, $key);
  $update_diversity  = "UPDATE diversity SET groupID=?, dob=?, race=?, ethnicity=? WHERE userID='$patientID' ";
  $stmt = $con->prepare($update_diversity);
  $stmt->bind_param("ssss", $groupID, $encrypt_patients_dob, $encrypt_patients_race, $encrypt_patients_ethnicity);
  $stmt->execute();

  $encrypt_patients_address1 = encryptthis($patients_address1, $key);
  $encrypt_patients_address2 = encryptthis($patients_address2, $key);
  $encrypt_patients_city = encryptthis($patients_city, $key);
  $encrypt_patients_state = encryptthis($patients_state, $key);
  $encrypt_patients_zip = encryptthis($patients_zip, $key);
  $update_address  = "UPDATE address SET groupID=?, address1=?, address2=?, city=?, state=?, zip=? WHERE userID='$patientID' ";
  $stmt = $con->prepare($update_address);
  $stmt->bind_param("ssssss", $groupID, $encrypt_patients_address1, $encrypt_patients_address2, $encrypt_patients_city, $encrypt_patients_state, $encrypt_patients_zip);
  $stmt->execute();

  $encrypt_patients_phone = encryptthis($patients_phone, $key);
  $encrypt_patients_mobile = encryptthis($patients_mobile, $key);
  $update_contact  = "UPDATE contact SET groupID=?, phone=?, mobile=?, email=?  WHERE userID='$patientID' ";
  $stmt = $con->prepare($update_contact);
  $stmt->bind_param("ssss", $groupID, $encrypt_patients_phone, $encrypt_patients_mobile, $encrypt_patients_email);
  $stmt->execute();

  $encrypt_health_plan = encryptthis($hp_health_plan, $key);
  $encrypt_policy_number = encryptthis($hp_policy_number, $key);
  $encrypt_status = encryptthis($hp_status, $key);
  $update_healthplan  = "UPDATE healthplan SET groupID=?, health_plan=?, policy_number=?, status=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_healthplan);
  $stmt->bind_param("ssss", $groupID, $encrypt_health_plan, $encrypt_policy_number, $encrypt_status);
  $stmt->execute();

  $update_iz  = "UPDATE immunization SET groupID=?";
  $stmt = $con->prepare($update_iz);
  $stmt->bind_param("s", $groupID);
  $stmt->execute();

  $encrypt_patientlog_activity = encryptthis($patientlog_activity, $key);
  $update_patientlog  = "UPDATE patientlog SET groupID=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_patientlog);
  $stmt->bind_param("s", $groupID);
  $stmt->execute();

  // Update Patient's dk_token
  $updateKey  = "UPDATE token SET groupID=?, dk_token=? WHERE userID='$patientID' ";
  $stmt = $con->prepare($updateKey);
  $stmt->bind_param("ss", $groupID, $key);
  $stmt->execute();

  if($stmt->execute()){
    $_SESSION['success'] = "Successfully Assigned Patient ID: $patientID!";
    header("Location: /private/view/admin/patients/");
    exit(0);
  }
  else{
    $_SESSION['warning'] = "Unable to Assign Patient ID: $patientID";
    header("Location: /private/view/admin/patients/");
    exit(0);
  }
}endif;

// Unassign patient from group
if(isset($_POST['remove_patient'])):{

  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $email = mysqli_real_escape_string($con, $_POST['patient_email']);
  
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

  // Send email
  include(PRIVATE_CONFIG_PATH . '/send-email.php');
  

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

  if($stmt = $con->prepare($updateKey)){
    $_SESSION['success'] = "Successfully Removed $patients_fname $patients_lname!";
    header("Location: /private/view/admin/patients/");
    exit(0);
  }
  else{
    $_SESSION['warning'] = "Unable to Remove $patients_fname $patients_lname";
    header("Location: /private/view/admin/patients/");
    exit(0);
  }
}endif;
?>