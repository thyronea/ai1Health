<?php
session_start();
include('../../../../../../security/dbcon.php');
include('../../../../../../security/encrypt_decrypt.php');
require '../../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

// Decryption and Encryption Keys
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
$iz_key = mysqli_real_escape_string($con, $_SESSION["iz_key"]);

// Shot giver's information
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$userID = mysqli_real_escape_string($con, $_SESSION['userID']);
$email = mysqli_real_escape_string($con, $_SESSION['email']);
$fname = mysqli_real_escape_string($con, $_SESSION['fname']);
$lname = mysqli_real_escape_string($con, $_SESSION['lname']);

// Patient's information
$patientID = mysqli_real_escape_string($con, $_POST['patientID']);
$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$patient_fname = mysqli_real_escape_string($con, $_POST['patient_fname']);
$patient_lname = mysqli_real_escape_string($con, $_POST['patient_lname']);
$patient_dob = mysqli_real_escape_string($con, $_POST['patient_dob']);

// Vaccine's information
$vaccineID = mysqli_real_escape_string($con, $_POST['id']);
$uniqueID = mysqli_real_escape_string($con, $_POST['uniqueID']);
$vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
$manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
$lot = mysqli_real_escape_string($con, $_POST['lot']);
$ndc = mysqli_real_escape_string($con, $_POST['ndc']);
$exp = mysqli_real_escape_string($con, $_POST['exp']);
$site = mysqli_real_escape_string($con, $_POST['site']);
$route = mysqli_real_escape_string($con, $_POST['route']);
$vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
$administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
$comment = mysqli_real_escape_string($con, $_POST['comment']);
$date = mysqli_real_escape_string($con, $_POST['date']);
$time = mysqli_real_escape_string($con, $_POST['time']);
$value = mysqli_real_escape_string($con, "1");
$shot1 = mysqli_real_escape_string($con, "1");
$shot2 = mysqli_real_escape_string($con, "2");
$shot3 = mysqli_real_escape_string($con, "3");
$shot4 = mysqli_real_escape_string($con, "4");
$shot5 = mysqli_real_escape_string($con, "5");
$othershot = mysqli_real_escape_string($con, "0");

// Encrypt Admin Log Data
$fullname = "$fname $lname";
$action = htmlspecialchars("Administered");
$message = "$action $vaccine ($lot) to $patient_fname $patient_lname";
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_message = encryptthis($message, $key);


// Combo Vax
if(isset($_POST['administer_pediarix'])){ 
  $funding_source = mysqli_real_escape_string($con, $_POST['add_pediarix_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_pediarix_eligibility']);

  $combo_type = mysqli_real_escape_string($con, $_POST['combo_type']);
  $dtap_type = mysqli_real_escape_string($con, $_POST['dtap_type']);
  $dtap_vis = mysqli_real_escape_string($con, $_POST['dtap_vis']);
  $hepB_type = mysqli_real_escape_string($con, $_POST['hepB_type']);
  $hepB_vis = mysqli_real_escape_string($con, $_POST['hepB_vis']);
  $ipv_type = mysqli_real_escape_string($con, $_POST['ipv_type']);
  $ipv_vis = mysqli_real_escape_string($con, $_POST['ipv_vis']);

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    // Verify Combo series
    $verify_combo = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$combo_type' ";
    $combo_run =  mysqli_query($con, $verify_combo);
    if(mysqli_num_rows($combo_run)  >= 3){
      $_SESSION['warning'] = "$combo_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }

    // Verify DTaP series
    $verify_dtap = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$dtap_type' ";
    $dtap_run =  mysqli_query($con, $verify_dtap);
    if(mysqli_num_rows($dtap_run)  >= 4){
      $_SESSION['warning'] = "$dtap_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    // Verify Hep B series
    $verify_hepB = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$hepB_type' ";
    $hepB_run =  mysqli_query($con, $verify_hepB);
    if(mysqli_num_rows($hepB_run)  >= 4){
      $_SESSION['warning'] = "$hepB_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    // Verify IPV series
    $verify_ipv = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$ipv_type' ";
    $ipv_run =  mysqli_query($con, $verify_ipv);
    if(mysqli_num_rows($ipv_run)  >= 3){
      $_SESSION['warning'] = "$ipv_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }

    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $pediarix = htmlspecialchars("Pediarix");
      $patient_log = mysqli_real_escape_string($con, "$received $pediarix");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_dtap_vis = encryptthis_iz($dtap_vis, $iz_key);
      $encrypt_hepB_vis = encryptthis_iz($hepB_vis, $iz_key);
      $encrypt_ipv_vis = encryptthis_iz($ipv_vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      // Insert Pediarix 
      if(mysqli_num_rows($combo_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($combo_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($combo_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      
      // Insert DTaP 
      if(mysqli_num_rows($dtap_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 4){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot5, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      
      // Insert Hepatitis B
      if(mysqli_num_rows($hepB_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $hepB_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hepB_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($hepB_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $hepB_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hepB_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($hepB_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $hepB_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hepB_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // Insert IPV
      if(mysqli_num_rows($ipv_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($ipv_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($ipv_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($ipv_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      // verify if vaccine (per lot and ndc) count is zero. Delete then archive
      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];
      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        // deleted vaccine from inventory will be archived
        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz)){
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else{
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  }
}

if(isset($_POST['administer_pentacel'])){ 
  $funding_source = mysqli_real_escape_string($con, $_POST['add_pentacel_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_pentacel_eligibility']);

  $combo_type = mysqli_real_escape_string($con, $_POST['combo_type']);
  $dtap_type = mysqli_real_escape_string($con, $_POST['dtap_type']);
  $dtap_vis = mysqli_real_escape_string($con, $_POST['dtap_vis']);
  $ipv_type = mysqli_real_escape_string($con, $_POST['ipv_type']);
  $ipv_vis = mysqli_real_escape_string($con, $_POST['ipv_vis']);
  $hib_type = mysqli_real_escape_string($con, $_POST['hib_type']);
  $hib_vis = mysqli_real_escape_string($con, $_POST['hib_vis']);

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    // Verify Combo series
    $verify_combo = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$combo_type' ";
    $combo_run =  mysqli_query($con, $verify_combo);
    if(mysqli_num_rows($combo_run)  >= 4){
      $_SESSION['warning'] = "$combo_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    // Verify DTaP series
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$dtap_type' ";
    $dtap_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($dtap_run)  >= 4){
      $_SESSION['warning'] = "$dtap_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    // Verify IPV series
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$ipv_type' ";
    $ipv_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($ipv_run)  >= 4){
      $_SESSION['warning'] = "$hepB_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    // Verify Hib series
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$hib_type' ";
    $hib_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($hib_run)  >= 4){
      $_SESSION['warning'] = "$ipv_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $pediarix = htmlspecialchars("Pentacel");
      $patient_log = mysqli_real_escape_string($con, "$received $pediarix");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_dtap_vis = encryptthis_iz($dtap_vis, $iz_key);
      $encrypt_hib_vis = encryptthis_iz($hib_vis, $iz_key);
      $encrypt_ipv_vis = encryptthis_iz($ipv_vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      // Insert Pentacel 
      if(mysqli_num_rows($combo_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($combo_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($combo_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($combo_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // Insert DTaP 
      if(mysqli_num_rows($dtap_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 4){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot5, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // Insert Hib
      if(mysqli_num_rows($hib_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $hib_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hib_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($hib_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $hib_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hib_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($hib_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $hib_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hib_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($hib_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $hib_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hib_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // Insert IPV
      if(mysqli_num_rows($ipv_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($ipv_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($ipv_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($ipv_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      // verify if vaccine (per lot and ndc) count is zero. Delete then archive
      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];
      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        // deleted vaccine from inventory will be archived
        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  }
}

if(isset($_POST['administer_vaxelis'])){ 
  $funding_source = mysqli_real_escape_string($con, $_POST['add_vaxelis_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_vaxelis_eligibility']);

  $combo_type = mysqli_real_escape_string($con, $_POST['combo_type']);
  $dtap_type = mysqli_real_escape_string($con, $_POST['dtap_type']);
  $dtap_vis = mysqli_real_escape_string($con, $_POST['dtap_vis']);
  $ipv_type = mysqli_real_escape_string($con, $_POST['ipv_type']);
  $ipv_vis = mysqli_real_escape_string($con, $_POST['ipv_vis']);
  $hib_type = mysqli_real_escape_string($con, $_POST['hib_type']);
  $hib_vis = mysqli_real_escape_string($con, $_POST['hib_vis']);
  $hepB_type = mysqli_real_escape_string($con, $_POST['hepB_type']);
  $hepB_vis = mysqli_real_escape_string($con, $_POST['hepB_vis']);

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    // Verify Combo series
    $verify_combo = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$combo_type' ";
    $combo_run =  mysqli_query($con, $verify_combo);
    if(mysqli_num_rows($combo_run)  >= 3){
      $_SESSION['warning'] = "$combo_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    // Verify DTaP series
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$dtap_type' ";
    $dtap_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($dtap_run)  >= 4){
      $_SESSION['warning'] = "$dtap_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    // Verify IPV series
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$ipv_type' ";
    $ipv_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($ipv_run)  >= 4){
      $_SESSION['warning'] = "$hepB_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    // Verify Hib series
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$hib_type' ";
    $hib_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($hib_run)  >= 4){
      $_SESSION['warning'] = "$ipv_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    // Verify Hep B series
    $verify_hepB = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$hepB_type' ";
    $hepB_run =  mysqli_query($con, $verify_hepB);
    if(mysqli_num_rows($hepB_run)  >= 4){
      $_SESSION['warning'] = "$hepB_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $pediarix = htmlspecialchars("Vaxelis");
      $patient_log = mysqli_real_escape_string($con, "$received $pediarix");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_dtap_vis = encryptthis_iz($dtap_vis, $iz_key);
      $encrypt_ipv_vis = encryptthis_iz($ipv_vis, $iz_key);
      $encrypt_hib_vis = encryptthis_iz($hib_vis, $iz_key);
      $encrypt_hepB_vis = encryptthis_iz($hepB_vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      // Insert Vaxelis 
      if(mysqli_num_rows($combo_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($combo_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($combo_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      
      // Insert DTaP 
      if(mysqli_num_rows($dtap_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 4){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      
      // Insert Hepatitis B
      if(mysqli_num_rows($hepB_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $hepB_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hepB_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($hepB_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $hepB_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hepB_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($hepB_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $hepB_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hepB_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // Insert IPV
      if(mysqli_num_rows($ipv_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($ipv_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($ipv_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($ipv_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // Insert Hib
      if(mysqli_num_rows($hib_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $hib_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hib_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($hib_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $hib_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hib_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($hib_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $hib_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hib_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($hib_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $hib_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hib_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      // verify if vaccine (per lot and ndc) count is zero. Delete then archive
      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];
      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        // deleted vaccine from inventory will be archived
        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  }
}

if(isset($_POST['administer_quadracel'])){ 
  $funding_source = mysqli_real_escape_string($con, $_POST['add_quadracel_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_quadracel_eligibility']);

  $combo_type = mysqli_real_escape_string($con, $_POST['combo_type']);
  $dtap_type = mysqli_real_escape_string($con, $_POST['dtap_type']);
  $dtap_vis = mysqli_real_escape_string($con, $_POST['dtap_vis']);
  $ipv_type = mysqli_real_escape_string($con, $_POST['ipv_type']);
  $ipv_vis = mysqli_real_escape_string($con, $_POST['ipv_vis']);

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{

    // Verify Combo series
    $verify_combo = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$combo_type' ";
    $combo_run =  mysqli_query($con, $verify_combo);
    if(mysqli_num_rows($combo_run)  >= 1){
      $_SESSION['warning'] = "$combo_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    // Verify DTaP series
    $verify_dtap = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$dtap_type' ";
    $dtap_run =  mysqli_query($con, $verify_dtap);
    if(mysqli_num_rows($dtap_run)  >= 4){
      $_SESSION['warning'] = "$dtap_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    // Verify IPV series
    $verify_ipv = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$ipv_type' ";
    $ipv_run =  mysqli_query($con, $verify_ipv);
    if(mysqli_num_rows($ipv_run)  >= 3){
      $_SESSION['warning'] = "$ipv_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $pediarix = htmlspecialchars("Quadracel");
      $patient_log = mysqli_real_escape_string($con, "$received $pediarix");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_dtap_vis = encryptthis_iz($dtap_vis, $iz_key);
      $encrypt_ipv_vis = encryptthis_iz($ipv_vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      // Insert Quadracel 
      if(mysqli_num_rows($combo_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      
      // Insert DTaP 
      if(mysqli_num_rows($dtap_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 4){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot5, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      
      // Insert IPV
      if(mysqli_num_rows($ipv_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($ipv_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($ipv_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($ipv_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      // verify if vaccine (per lot and ndc) count is zero. Delete then archive
      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];
      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        // deleted vaccine from inventory will be archived
        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  }
}

if(isset($_POST['administer_kinrix'])){ 
  $funding_source = mysqli_real_escape_string($con, $_POST['add_kinrix_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_kinrix_eligibility']);

  $combo_type = mysqli_real_escape_string($con, $_POST['combo_type']);
  $dtap_type = mysqli_real_escape_string($con, $_POST['dtap_type']);
  $dtap_vis = mysqli_real_escape_string($con, $_POST['dtap_vis']);
  $ipv_type = mysqli_real_escape_string($con, $_POST['ipv_type']);
  $ipv_vis = mysqli_real_escape_string($con, $_POST['ipv_vis']);

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    // Verify Combo series
    $verify_combo = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$combo_type' ";
    $combo_run =  mysqli_query($con, $verify_combo);
    if(mysqli_num_rows($combo_run)  >= 1){
      $_SESSION['warning'] = "$combo_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    // Verify DTaP series
    $verify_dtap = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$dtap_type' ";
    $dtap_run =  mysqli_query($con, $verify_dtap);
    if(mysqli_num_rows($dtap_run)  >= 4){
      $_SESSION['warning'] = "$dtap_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    // Verify IPV series
    $verify_ipv = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$ipv_type' ";
    $ipv_run =  mysqli_query($con, $verify_ipv);
    if(mysqli_num_rows($ipv_run)  >= 3){
      $_SESSION['warning'] = "$ipv_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $pediarix = htmlspecialchars("Kinrix");
      $patient_log = mysqli_real_escape_string($con, "$received $pediarix");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_dtap_vis = encryptthis_iz($dtap_vis, $iz_key);
      $encrypt_ipv_vis = encryptthis_iz($ipv_vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      // Insert Kinrix 
      if(mysqli_num_rows($combo_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      
      // Insert DTaP 
      if(mysqli_num_rows($dtap_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($dtap_run) == 4){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot5, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      
      // Insert IPV
      if(mysqli_num_rows($ipv_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($ipv_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($ipv_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($ipv_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      // verify if vaccine (per lot and ndc) count is zero. Delete then archive
      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];
      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        // deleted vaccine from inventory will be archived
        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  }
}

if(isset($_POST['administer_proquad'])){ 
  $funding_source = mysqli_real_escape_string($con, $_POST['add_proquad_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_proquad_eligibility']);

  $combo_type = mysqli_real_escape_string($con, $_POST['combo_type']);
  $mmr_type = mysqli_real_escape_string($con, $_POST['mmr_type']);
  $mmr_vis = mysqli_real_escape_string($con, $_POST['mmr_vis']);
  $var_type = mysqli_real_escape_string($con, $_POST['var_type']);
  $var_vis = mysqli_real_escape_string($con, $_POST['var_vis']);

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    // Verify Combo series
    $verify_combo = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$combo_type' ";
    $combo_run =  mysqli_query($con, $verify_combo);
    if(mysqli_num_rows($combo_run)  >= 2){
      $_SESSION['warning'] = "$combo_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    // Verify MMR series
    $verify_mmr = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$mmr_type' ";
    $mmr_run =  mysqli_query($con, $verify_mmr);
    if(mysqli_num_rows($mmr_run)  >= 2){
      $_SESSION['warning'] = "$mmr_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    // Verify Varicella series
    $verify_var = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$var_type' ";
    $var_run =  mysqli_query($con, $verify_var);
    if(mysqli_num_rows($var_run)  >= 2){
      $_SESSION['warning'] = "$var_type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $pediarix = htmlspecialchars("Proquad");
      $patient_log = mysqli_real_escape_string($con, "$received $pediarix");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_mmr_vis = encryptthis_iz($mmr_vis, $iz_key);
      $encrypt_var_vis = encryptthis_iz($var_vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      // Insert Proquad 
      if(mysqli_num_rows($combo_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_mmr_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($combo_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_mmr_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      
      // Insert MMR 
      if(mysqli_num_rows($mmr_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $mmr_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_mmr_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($mmr_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $mmr_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_mmr_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      
      // Insert Varicella
      if(mysqli_num_rows($var_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $var_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_mmr_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      elseif(mysqli_num_rows($var_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $var_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_mmr_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      // verify if vaccine (per lot and ndc) count is zero. Delete then archive
      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];
      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        // deleted vaccine from inventory will be archived
        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  }
}

// Single Antigen
if(isset($_POST['administer_rsv'])){ 
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_rsv_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_rsv_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  > 0){
      $_SESSION['warning'] = "$type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $patient_log = mysqli_real_escape_string($con, "$received $type");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
      VALUES (?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($administer_iz);
      $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
      $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
      $stmt->execute();

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      // verify if vaccine (per lot and ndc) count is zero. Delete then archive
      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];
      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        // deleted vaccine from inventory will be archived
        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  }
}

if(isset($_POST['administer_hepB'])){ 
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_hepB_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_hepB_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  >= 3){
      $_SESSION['warning'] = "3 Dose Series for $type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Series Completion in Patient Log Data
      $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
      $sql_run =  mysqli_query($con, $verify_completion);
      if(mysqli_num_rows($sql_run)  >= 2){
        $received = htmlspecialchars("Received");
        $patient_log = mysqli_real_escape_string($con, "$received $type");
        $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
        $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
        $stmt = $con->prepare($patientlog);
        $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
        $stmt->execute();

        $complete = htmlspecialchars("Hep B Series is Complete");
        $complete_patient_log = mysqli_real_escape_string($con, "$complete");
        $encrypted_complete_patient_log = encryptthis($complete_patient_log, $key); // Encrypt Patient Log
        $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
        $stmt = $con->prepare($patientlog);
        $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_complete_patient_log);
        $stmt->execute();
      }
      else{
        // Insert Patient Log Data
        $received = htmlspecialchars("Received");
        $patient_log = mysqli_real_escape_string($con, "$received $type");
        $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
        $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
        $stmt = $con->prepare($patientlog);
        $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
        $stmt->execute();
      }

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);
      
      if(mysqli_num_rows($sql_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];

      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

if(isset($_POST['administer_rota'])){
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_rota_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_rota_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  >= 3){
      $_SESSION['warning'] = "2 Dose Series for $type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $patient_log = mysqli_real_escape_string($con, "$received $type");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      if(mysqli_num_rows($sql_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 1){
        $rv_brand = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
        $rv_brand_run = mysqli_query($con, $rv_brand);
        $rv_vaccine = mysqli_fetch_array($rv_brand_run);
        $verify_rv_vaccine = decryptthis($rv_vaccine['vaccine'], $iz_key);
        // Verify if the same brand is used
        if($vaccine !== $verify_rv_vaccine){
          $_SESSION['warning'] = "Unable to administer $vaccine because $verify_rv_vaccine was previously administered";
          header("Location: ../../../patient-chart/index.php?patientID=$patientID");
          exit(0);
        }
        else{
          $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
        }
      }
      if(mysqli_num_rows($sql_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];

      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

if(isset($_POST['administer_dtap'])){ 
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_dtap_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_dtap_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  >= 5){
      $_SESSION['warning'] = "5 Dose Series for $type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $patient_log = mysqli_real_escape_string($con, "$received $type");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      if(mysqli_num_rows($sql_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 4){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot5, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];

      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

if(isset($_POST['administer_hib'])){ 
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_hib_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_hib_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  >= 4){
      $_SESSION['warning'] = "4 Dose Series for $type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $patient_log = mysqli_real_escape_string($con, "$received $type");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      if(mysqli_num_rows($sql_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 1){
        $hib_brand = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
        $hib_brand_run = mysqli_query($con, $hib_brand);
        $hib_vaccine = mysqli_fetch_array($hib_brand_run);
        // Verify if the same brand is used
        $verify_hib_vaccine = decryptthis($hib_vaccine['vaccine'], $iz_key);
        if($vaccine !== $verify_hib_vaccine){
          $_SESSION['warning'] = "Unable to administer $vaccine because $verify_hib_vaccine was previously administered";
          header("Location: ../../../patient-chart/index.php?patientID=$patientID");
          exit(0);
        }
        else{
          $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
        }
      }
      if(mysqli_num_rows($sql_run) == 2){
        $hib_brand = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
        $hib_brand_run = mysqli_query($con, $hib_brand);
        $hib_vaccine = mysqli_fetch_array($hib_brand_run);
        $verify_hib_vaccine = decryptthis($hib_vaccine['vaccine'], $iz_key);
        // Verify if the same brand is used
        if($vaccine !== $verify_hib_vaccine){
          $_SESSION['warning'] = "Unable to administer $vaccine because $verify_hib_vaccine was previously administered";
          header("Location: ../../../patient-chart/index.php?patientID=$patientID");
          exit(0);
        }
        else{
          $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
        }
      }
      if(mysqli_num_rows($sql_run) == 3){
        $hib_brand = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
        $hib_brand_run = mysqli_query($con, $hib_brand);
        $hib_vaccine = mysqli_fetch_array($hib_brand_run);
        $verify_hib_vaccine = decryptthis($hib_vaccine['vaccine'], $iz_key);
        // Verify if the same brand is used
        if($vaccine !== $verify_hib_vaccine){
          $_SESSION['warning'] = "Unable to administer $vaccine because $verify_hib_vaccine was previously administered";
          header("Location: ../../../patient-chart/index.php?patientID=$patientID");
          exit(0);
        }
        else{
          $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
          VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $stmt = $con->prepare($administer_iz);
          $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
          $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
          $stmt->execute();
        }
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];

      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

if(isset($_POST['administer_pcv'])){ 
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_pcv_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_pcv_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  >= 4){
      $_SESSION['warning'] = "4 Dose Series for $type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $patient_log = mysqli_real_escape_string($con, "$received $type");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      if(mysqli_num_rows($sql_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];

      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

if(isset($_POST['administer_ipv'])){ 
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_ipv_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_ipv_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  >= 4){
      $_SESSION['warning'] = "3 Dose Series for $type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $patient_log = mysqli_real_escape_string($con, "$received $type");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      if(mysqli_num_rows($sql_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 3){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];

      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

if(isset($_POST['administer_mmr'])){ 
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_mmr_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_mmr_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  >= 2){
      $_SESSION['warning'] = "2 Dose Series for $type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $patient_log = mysqli_real_escape_string($con, "$received $type");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      if(mysqli_num_rows($sql_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];

      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

if(isset($_POST['administer_var'])){ 
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_var_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_var_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  >= 2){
      $_SESSION['warning'] = "2 Dose Series for $type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $patient_log = mysqli_real_escape_string($con, "$received $type");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      if(mysqli_num_rows($sql_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];

      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

if(isset($_POST['administer_hepa'])){ 
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_hepa_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_hepa_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  >= 2){
      $_SESSION['warning'] = "2 Dose Series for $type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $patient_log = mysqli_real_escape_string($con, "$received $type");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      if(mysqli_num_rows($sql_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];

      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

if(isset($_POST['administer_tdap'])){ 
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_tdap_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_tdap_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  >= 2){
      $_SESSION['warning'] = "2 Dose Series for $type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $patient_log = mysqli_real_escape_string($con, "$received $type");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
      VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($administer_iz);
      $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
      $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
      $stmt->execute();

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];

      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

if(isset($_POST['administer_hpv'])){ 
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_hpv_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_hpv_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  >= 3){
      $_SESSION['warning'] = "2 Dose Series for $type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $patient_log = mysqli_real_escape_string($con, "$received $type");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      if(mysqli_num_rows($sql_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 2){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];

      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

if(isset($_POST['administer_mcv'])){ 
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_mcv_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_mcv_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  >= 2){
      $_SESSION['warning'] = "2 Dose Series for $type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $patient_log = mysqli_real_escape_string($con, "$received $type");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      if(mysqli_num_rows($sql_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];

      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

if(isset($_POST['administer_menb'])){ 
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_menb_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_menb_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  >= 2){
      $_SESSION['warning'] = "2 Dose Series for $type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $patient_log = mysqli_real_escape_string($con, "$received $type");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      if(mysqli_num_rows($sql_run) <= 0){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }
      if(mysqli_num_rows($sql_run) == 1){
        $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
        VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($administer_iz);
        $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
        $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
        $stmt->execute();
      }

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];

      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

if(isset($_POST['administer_covid'])){ 
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_covid_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_covid_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  >= 100){
      $_SESSION['warning'] = "3 Dose Series for $type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $patient_log = mysqli_real_escape_string($con, "$received $type");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
      VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($administer_iz);
      $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $othershot, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
      $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
      $stmt->execute();

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];

      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

if(isset($_POST['administer_flu'])){ 
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['add_flu_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['add_flu_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
    $sql_run =  mysqli_query($con, $verify_completion);
    if(mysqli_num_rows($sql_run)  >= 100){
      $_SESSION['warning'] = "3 Dose Series for $type is already complete!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else{
      // Insert Admin Log Data
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
      $stmt->execute();

      // Insert Patient Log Data
      $received = htmlspecialchars("Received");
      $patient_log = mysqli_real_escape_string($con, "$received $type");
      $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
      $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
      $stmt = $con->prepare($patientlog);
      $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
      $stmt->execute();

      // insert to data_iz table (data visualization)
      $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($data);
      $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
      $stmt->execute();

      // encrypt data and insert to immunizaton table
      $patient_fullname = "$patient_fname $patient_lname";
      $encrypt_patient_name = encryptthis_iz($patient_fullname, $iz_key);
      $encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
      $encrypt_type = encryptthis_iz($type, $iz_key);
      $encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
      $encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
      $encrypt_lot = encryptthis_iz($lot, $iz_key);
      $encrypt_ndc = encryptthis_iz($ndc, $iz_key);
      $encrypt_exp = encryptthis_iz($exp, $iz_key);
      $encrypt_site = encryptthis_iz($site, $iz_key);
      $encrypt_route = encryptthis_iz($route, $iz_key);
      $encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
      $encrypt_vis = encryptthis_iz($vis, $iz_key);
      $encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
      $encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
      $encrypt_comment = encryptthis_iz($comment, $iz_key);

      $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,value,date,time) 
      VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($administer_iz);
      $stmt->bind_param("ssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $othershot, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
      $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment, $value, $date, $time);
      $stmt->execute();

      // update inventory
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);

      $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $verify_run = mysqli_query($con, $verify_inventory);
      $row = mysqli_fetch_array($verify_run);
      $zero = $row['doses'];

      if($zero == 0){
        // delete inventory
        $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // delete inventory from engine
        $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
        $delete_run = mysqli_query($con, $delete);

        // encrypt data and insert to admin_log table
        $action_ = htmlspecialchars("Archived");
        $message_ = "The last dose of $vaccine ($lot) was administered and archived";
        $encrypt_message_ = encryptthis($message_, $key);
        $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($activities);
        $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
        $stmt->execute();

        $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($archive);
        $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
        $stmt->execute();
      }

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

?>