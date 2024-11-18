<?php
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
?>