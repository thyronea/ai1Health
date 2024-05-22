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
$userID = mysqli_real_escape_string($con, $_SESSION['userID']);
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$email = mysqli_real_escape_string($con, $_SESSION['email']);
$fname = mysqli_real_escape_string($con, $_SESSION['fname']);
$lname = mysqli_real_escape_string($con, $_SESSION['lname']);

// Patient's information
$patientID = htmlspecialchars($_POST['patientID']);
$engineID = htmlspecialchars($_POST['engineID']);
$patient_fname = htmlspecialchars($_POST['patient_fname']);
$patient_lname = htmlspecialchars($_POST['patient_lname']);

// Vaccine's information
$shotID = htmlspecialchars($_POST['shotID']);
$uniqueID = htmlspecialchars($_POST['uniqueID']);
$vaccineID = htmlspecialchars($_POST['vaccineID']);
$vaccine = htmlspecialchars($_POST['vaccine']);
$lot = htmlspecialchars($_POST['lot']);
$ndc = htmlspecialchars($_POST['ndc']);
$exp = htmlspecialchars($_POST['exp']);
$site = htmlspecialchars($_POST['site']);
$route = htmlspecialchars($_POST['route']);
$vis_given = htmlspecialchars($_POST['vis_given']);
$vis = htmlspecialchars($_POST['vis']);
$administered_by = htmlspecialchars($_POST['administered_by']);
$comment = htmlspecialchars($_POST['comment']);

if(isset($_POST['update_rsv']))
{
  // Verify if Public-Eligibility type is selected
  $funding_source = mysqli_real_escape_string($con, $_POST['edit_rsv_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['edit_rsv_eligibility']);
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please choose an eligibility type if public inventory is selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }

  // Update inventory count if changing vaccine brand (per lot number and ndc)
  $vax_info = "SELECT * FROM immunization WHERE id='$shotID' AND patientID='$patientID' ";
  $vax_info_run = mysqli_query($con, $vax_info);
  $vax = mysqli_fetch_array($vax_info_run);
  if($lot && $ndc && $exp !== decryptthis_iz($vax['lot'],$iz_key) && decryptthis_iz($vax['ndc'],$iz_key) && $vax['lot']){
    // deduct 1 dose
    $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
  }

  // Encrypt Activities Data and insert
  $fullname = "$fname $lname";
  $type = "Updated";
  $p_fullname = "$patient_fname $patient_lname";
  $message = "Administered $vaccine";
  $act_message = "$type $p_fullname's $message";
  $encrypted_fullname = encryptthis($fullname, $key);
  $encrypted_message = encryptthis($act_message, $key);
  $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activities);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_message);
  $stmt->execute();

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
  $update  = "UPDATE immunization SET vaccine=?, lot=?, ndc=?, exp=?, site=?, route=?, vis_given=?, vis=?, funding_source=?, administered_by=?, comment=? 
  WHERE id='$shotID' AND patientID='$patientID' ";
  $stmt = $con->prepare($update);
  $stmt->bind_param("sssssssssss", $encrypt_vaccine, $encrypt_lot, $encrypt_ndc, $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility,  $encrypt_administered_by, $encrypt_comment);
  $stmt->execute();

  if($stmt = $con->prepare($update))
  {
    $_SESSION['success'] = "Administered $vaccine Successfully Updated!";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update Administered $vaccine";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
}

if(isset($_POST['update_hepB']))
{
  $funding_source = mysqli_real_escape_string($con, $_POST['edit_hepB_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['edit_hepB_eligibility']);

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{

    // Update inventory count if changing vaccine brand (per lot number and ndc)
    $vax_info = "SELECT * FROM immunization WHERE id='$shotID' AND patientID='$patientID' ";
    $vax_info_run = mysqli_query($con, $vax_info);
    $vax = mysqli_fetch_array($vax_info_run);
    if($lot && $ndc && $exp !== decryptthis_iz($vax['lot'],$iz_key) && decryptthis_iz($vax['ndc'],$iz_key) && $vax['lot']){
      // deduct 1 dose
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);
    }

    // Encrypt Activities Data and insert
    $fullname = "$fname $lname";
    $type = "Updated";
    $p_fullname = "$patient_fname $patient_lname";
    $message = "Administered $vaccine";
    $act_message = "$type $p_fullname's $message";
    $encrypted_fullname = encryptthis($fullname, $key);
    $encrypted_message = encryptthis($act_message, $key);
    $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

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
    $update  = "UPDATE immunization SET vaccine=?, lot=?, ndc=?, exp=?, site=?, route=?, vis_given=?, vis=?, funding_source=?, administered_by=?, comment=? 
    WHERE id='$shotID' AND patientID='$patientID' ";
    $stmt = $con->prepare($update);
    $stmt->bind_param("sssssssssss", $encrypt_vaccine, $encrypt_lot, $encrypt_ndc, $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment);
    $stmt->execute();

    if($stmt = $con->prepare($update))
    {
      $_SESSION['success'] = "Administered $vaccine Successfully Updated!";
      header("Location: ../../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Update Administered $vaccine";
      header("Location: ../../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
  }
}

if(isset($_POST['update_rota']))
{
  $funding_source = mysqli_real_escape_string($con, $_POST['edit_rota_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['edit_rota_eligibility']);

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{

    // Update inventory count if changing vaccine brand (per lot number and ndc)
    $vax_info = "SELECT * FROM immunization WHERE id='$shotID' AND patientID='$patientID' ";
    $vax_info_run = mysqli_query($con, $vax_info);
    $vax = mysqli_fetch_array($vax_info_run);
    if($lot && $ndc && $exp !== decryptthis_iz($vax['lot'],$iz_key) && decryptthis_iz($vax['ndc'],$iz_key) && $vax['lot']){
      // deduct 1 dose
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);
    }

    // Encrypt Activities Data and insert
    $fullname = "$fname $lname";
    $type = "Updated";
    $p_fullname = "$patient_fname $patient_lname";
    $message = "Administered $vaccine";
    $act_message = "$type $p_fullname's $message";
    $encrypted_fullname = encryptthis($fullname, $key);
    $encrypted_message = encryptthis($act_message, $key);
    $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

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
    $update  = "UPDATE immunization SET vaccine=?, lot=?, ndc=?, exp=?, site=?, route=?, vis_given=?, vis=?, funding_source=?, administered_by=?, comment=? 
    WHERE id='$shotID' AND patientID='$patientID' ";
    $stmt = $con->prepare($update);
    $stmt->bind_param("sssssssssss", $encrypt_vaccine, $encrypt_lot, $encrypt_ndc, $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment);
    $stmt->execute();

    if($stmt = $con->prepare($update))
    {
      $_SESSION['success'] = "Administered $vaccine Successfully Updated!";
      header("Location: ../../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Update Administered $vaccine";
      header("Location: ../../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
  }
}

if(isset($_POST['update_dtap']))
{
  $funding_source = mysqli_real_escape_string($con, $_POST['edit_dtap_funding']);
  $eligibility = mysqli_real_escape_string($con, $_POST['edit_dtap_eligibility']);

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{

    // Update inventory count if changing vaccine brand (per lot number and ndc)
    $vax_info = "SELECT * FROM immunization WHERE id='$shotID' AND patientID='$patientID' ";
    $vax_info_run = mysqli_query($con, $vax_info);
    $vax = mysqli_fetch_array($vax_info_run);
    if($lot && $ndc && $exp !== decryptthis_iz($vax['lot'],$iz_key) && decryptthis_iz($vax['ndc'],$iz_key) && $vax['lot']){
      // deduct 1 dose
      $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
      $deduct_run = mysqli_query($con, $deduct);
    }

    // Encrypt Activities Data and insert
    $fullname = "$fname $lname";
    $type = "Updated";
    $p_fullname = "$patient_fname $patient_lname";
    $message = "Administered $vaccine";
    $act_message = "$type $p_fullname's $message";
    $encrypted_fullname = encryptthis($fullname, $key);
    $encrypted_message = encryptthis($act_message, $key);
    $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

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
    $update  = "UPDATE immunization SET vaccine=?, lot=?, ndc=?, exp=?, site=?, route=?, vis_given=?, vis=?, funding_source=?, administered_by=?, comment=? 
    WHERE id='$shotID' AND patientID='$patientID' ";
    $stmt = $con->prepare($update);
    $stmt->bind_param("sssssssssss", $encrypt_vaccine, $encrypt_lot, $encrypt_ndc, $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_comment);
    $stmt->execute();

    if($stmt = $con->prepare($update))
    {
      $_SESSION['success'] = "Administered $vaccine Successfully Updated!";
      header("Location: ../../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Update Administered $vaccine";
      header("Location: ../../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
  }
}

?>