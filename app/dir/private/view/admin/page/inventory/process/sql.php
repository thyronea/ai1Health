<?php
session_start();
include('../../../components/dbcon.php');
include('../../../components/encrypt_decrypt.php'); // encryption/decryption source



// Edit Vaccine
if(isset($_POST['update_vaccine_btn']))
{
    $office = mysqli_real_escape_string($con, $_SESSION['office']);
    $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
    $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
    $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
    $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
    $email = mysqli_real_escape_string($con, $_SESSION['email']);
    $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
    $manufacturer = htmlspecialchars($_POST['manufacturer']);
    $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $lot = mysqli_real_escape_string($con, $_POST['lot']);
    $exp = mysqli_real_escape_string($con, $_POST['exp']);
    $source = mysqli_real_escape_string($con, $_POST['source']);
    $doses = mysqli_real_escape_string($con, $_POST['doses']);
    $storage = mysqli_real_escape_string($con, $_POST['storage']);
    $type = mysqli_real_escape_string($con, "Updated");

    // Encrypt Activity Data and insert
    $fullname = "$fname $lname";
    $org_message = "$type $vaccine";
    $encrypt_fullname = encryptthis($fullname, $key);
    $encrypt_org_message = encryptthis($org_message, $key);
    $activity = "INSERT INTO activity_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activity);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
    $stmt->execute();

    // Update engine table
    $inventory_engine = "Lot: $lot / Exp: $exp";
    $engine  = "UPDATE engine SET keyword1=?, keyword2=?, keyword3=? WHERE engineID='$engineID' ";
    $stmt = $con->prepare($engine);
    $stmt->bind_param("sss", $vaccine, $manufacturer, $inventory_engine);
    $stmt->execute();

    // Encrypt Vaccine Data and update
    $encrypt_storage = encryptthis($storage, $key);
    $encrypt_lot = encryptthis($lot, $key);
    $encrypt_manufacturer = encryptthis($manufacturer, $key);
    $encrypt_ndc = encryptthis($ndc, $key);
    $vaccines  = "UPDATE inventory SET storage=?, vaccine=?, lot=?, doses=?, exp=?, manufacturer=?, ndc=?, funding_source=? WHERE engineID='$engineID' ";
    $stmt = $con->prepare($vaccines);
    $stmt->bind_param("ssssssss", $encrypt_storage, $vaccine, $encrypt_lot, $doses, $exp, $encrypt_manufacturer, $encrypt_ndc, $source);
    $stmt->execute();

    if($stmt = $con->prepare($vaccines))
    {
      $_SESSION['success'] = "Vaccine Inventory Successfully Updated!";
      header("Location: ../../inventory/index.php?inventory=&button=");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Update Inventory!";
      header("Location: ../../inventory/index.php?inventory=&button=");
      exit(0);
    }
  }

// Delete Vaccine
if(isset($_POST['vaccinedeletebtn']))
{
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $type = htmlspecialchars("Deleted");
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $vaccine_name = mysqli_real_escape_string($con, $_POST['delete_vaccine_name']);

  // Encrypt Activity Data
  $fullname = "$fname $lname";
  $org_message = "$type $vaccine_name";
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_user_office = encryptthis($office, $key);
  $encrypt_org_message = encryptthis($org_message, $key);

  // Insert to activity table
  $activity = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypt_user_office, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  // Delete from engine table
  $engine = "DELETE FROM engine WHERE engineID=? ";
  $stmt = $con->prepare($engine);
  $stmt->bind_param("s", $engineID);
  $stmt->execute();

  // Delete from vaccines table
  $vaccines = "DELETE FROM vaccines WHERE engineID=? ";
  $stmt = $con->prepare($vaccines);
  $stmt->bind_param("s", $engineID);
  $stmt->execute();

  if($stmt = $con->prepare($vaccines))
  {
    $_SESSION['success'] = "Vaccines Successfully Deleted";
    header("Location: /HC/admin/pages/immunization/index.php?inventory=&button=");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Delete Vaccines";
    header("Location: /HC/admin/pages/immunization/index.php?inventory=&button=");
    exit(0);
  }
}
?>
