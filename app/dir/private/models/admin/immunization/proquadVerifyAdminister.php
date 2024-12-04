<?php
// Verify MMR series
$verify_mmr = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$mmr_type' ";
$mmr_run =  mysqli_query($con, $verify_mmr);
if(mysqli_num_rows($mmr_run)  >= 2){
  $_SESSION['warning'] = "$mmr_type is already complete!";
  header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
  exit(0);
}
// Verify Varicella series
$verify_var = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$var_type' ";
$var_run =  mysqli_query($con, $verify_var);
if(mysqli_num_rows($var_run)  >= 2){
  $_SESSION['warning'] = "$var_type is already complete!";
  header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
  exit(0);
}

// Verify Combo series
$verify_combo = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$combo_type' ";
$combo_run =  mysqli_query($con, $verify_combo);
if(mysqli_num_rows($combo_run)  >= 2){
  $_SESSION['warning'] = "$combo_type is already complete!";
  header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
  exit(0);
}

else{

  // Insert Proquad 
  if(mysqli_num_rows($combo_run) <= 0){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_mmr_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  elseif(mysqli_num_rows($combo_run) == 1){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_mmr_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  
  // Insert MMR 
  if(mysqli_num_rows($mmr_run) <= 0){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $mmr_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_mmr_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  elseif(mysqli_num_rows($mmr_run) == 1){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $mmr_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_mmr_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  
  // Insert Varicella
  if(mysqli_num_rows($var_run) <= 0){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $var_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_mmr_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  elseif(mysqli_num_rows($var_run) == 1){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $var_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_mmr_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }

  // INSERTs to admin_log, patientLog, data_iz
  include(PRIVATE_MODELS_PATH . '/admin/immunization/izLog.php');

  // Deducts inventory and archives if at 0
  include(PRIVATE_MODELS_PATH . '/admin/immunization/izInventoryUpdate.php');

  if($stmt = $con->prepare($administer_iz)){
    $_SESSION['success'] = "$vaccine Was Successfully Administered!";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{
    $_SESSION['warning'] = "Unable to Administer $vaccine!";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
}
?>