<?php
// Verify DTaP series
$verify_dtap = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$dtap_type' ";
$dtap_run =  mysqli_query($con, $verify_dtap);
if(mysqli_num_rows($dtap_run)  >= 4){
  $_SESSION['warning'] = "$dtap_type is already complete!";
  header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
  exit(0);
}
// Verify Hep B series
$verify_hepB = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$hepB_type' ";
$hepB_run =  mysqli_query($con, $verify_hepB);
if(mysqli_num_rows($hepB_run)  >= 4){
  $_SESSION['warning'] = "$hepB_type is already complete!";
  header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
  exit(0);
}
// Verify IPV series
$verify_ipv = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$ipv_type' ";
$ipv_run =  mysqli_query($con, $verify_ipv);
if(mysqli_num_rows($ipv_run)  >= 3){
  $_SESSION['warning'] = "$ipv_type is already complete!";
  header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
  exit(0);
}

// Verify Combo series
$verify_combo = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$combo_type' ";
$combo_run =  mysqli_query($con, $verify_combo);
if(mysqli_num_rows($combo_run)  >= 3){
  $_SESSION['warning'] = "$combo_type is already complete!";
  header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
  exit(0);
}

else{

  // Insert Pediarix 
  if(mysqli_num_rows($combo_run) <= 0){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  elseif(mysqli_num_rows($combo_run) == 1){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  elseif(mysqli_num_rows($combo_run) == 2){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $combo_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  
  // Insert DTaP 
  if(mysqli_num_rows($dtap_run) <= 0){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  elseif(mysqli_num_rows($dtap_run) == 1){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  elseif(mysqli_num_rows($dtap_run) == 2){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  elseif(mysqli_num_rows($dtap_run) == 3){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  elseif(mysqli_num_rows($dtap_run) == 4){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot5, $encrypt_patient_name, $encrypt_dob, $dtap_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_dtap_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  
  // Insert Hepatitis B
  if(mysqli_num_rows($hepB_run) <= 0){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $hepB_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hepB_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  elseif(mysqli_num_rows($hepB_run) == 1){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $hepB_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hepB_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  elseif(mysqli_num_rows($hepB_run) == 2){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $hepB_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_hepB_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }

  // Insert IPV
  if(mysqli_num_rows($ipv_run) <= 0){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot1, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  elseif(mysqli_num_rows($ipv_run) == 1){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot2, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  elseif(mysqli_num_rows($ipv_run) == 2){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot3, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
    $stmt->execute();
  }
  elseif(mysqli_num_rows($ipv_run) == 3){
    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,seriesID,name,dob,type,manufacturer,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,location,comment,value,date,time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot4, $encrypt_patient_name, $encrypt_dob, $ipv_type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_ipv_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
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