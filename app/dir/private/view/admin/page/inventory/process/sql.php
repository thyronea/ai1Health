<?php
session_start();
include('../../../components/dbcon.php');
include('../../../components/encrypt_decrypt.php'); // encryption/decryption source

// Add Vaccines
if(isset($_POST['add_vaccines']))
{
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = htmlspecialchars($_POST['groupID']);
  $link = htmlspecialchars("pages/immunization/index.php?inventory=$s_lot");
  $type = htmlspecialchars("Stored");
  $engineID = $_POST['engineID'];
  $vaccine = $_POST['vaccine'];
  $doses = $_POST['doses'];
  $lot = $_POST['lot'];
  $exp = $_POST['exp'];
  $storage = $_POST['storage'];
  $manufacturer = $_POST['manufacturer'];
  $ndc = $_POST['ndc'];
  $funding = $_POST['funding'];

  foreach($engineID as $index => $engineIDs)
  {
      $s_engineID = $engineIDs;
      $s_storage = $storage[$index];
      $s_vaccine = $vaccine[$index];
      $s_doses = $doses[$index];
      $s_lot = $lot[$index];
      $s_exp = $exp[$index];
      $s_storage = $storage[$index];
      $s_manufacturer = $manufacturer[$index];
      $s_ndc = $ndc[$index];
      $s_funding = $funding[$index];

      // Encrypt Vaccine Data
      $encrypt_storage = encryptthis($s_storage, $key);
      $encrypt_lot = encryptthis($s_lot, $key);
      $encrypt_manufacturer = encryptthis($s_manufacturer, $key);
      $encrypt_ndc = encryptthis($s_ndc, $key);

      // stores data in vaccines table
      $vaccines = "INSERT INTO vaccines (engineID, groupID, storage, vaccine, doses, lot, exp, manufacturer, ndc, funding_source) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($vaccines);
      $stmt->bind_param("ssssssssss", $s_engineID, $groupID, $encrypt_storage, $s_vaccine, $s_doses, $encrypt_lot, $s_exp, $encrypt_manufacturer, $encrypt_ndc, $s_funding);
      $stmt->execute();

      // stores data in engine table
      $vaccine_engine = "Lot: $s_lot / Exp: $s_exp";
      $engine = "INSERT INTO engine (engineID, groupID, keyword1, keyword2, keyword3, link) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($engine);
      $stmt->bind_param("ssssss", $s_engineID, $groupID, $s_vaccine, $s_manufacturer, $office, $link);
      $stmt->execute();

      // Encrypt Activity Data
      $fullname = "$fname $lname";
      $org_message = "$type $s_vaccine";
      $encrypt_fullname = encryptthis($fullname, $key);
      $encrypt_user_office = encryptthis($office, $key);
      $encrypt_org_message = encryptthis($org_message, $key);

      // stores data in activity table
      $fullname = "$fname $lname";
      $activity = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activity);
      $stmt->bind_param("ssssss", $userID, $groupID, $encrypt_user_office, $encrypt_fullname, $type, $encrypt_org_message);
      $stmt->execute();

  }

  if($stmt = $con->prepare($vaccines))
  {
      $_SESSION['success'] = "Vaccines Added Successfully";
      header("Location: /HC/admin/pages/immunization/index.php?inventory=&button=");
      exit(0);
  }
  else
  {
      $_SESSION['warning'] = "Data Not Inserted";
      header("Location: /HC/admin/pages/immunization/index.php?inventory=&button=");
      exit(0);
  }
}

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
    $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
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
    $encrypt_user_office = encryptthis($office, $key);
    $encrypt_org_message = encryptthis($org_message, $key);
    $activity = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activity);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypt_user_office, $encrypt_fullname, $type, $encrypt_org_message);
    $stmt->execute();

    // Update engine table
    $engine  = "UPDATE engine SET keyword1=?, keyword2=?, keyword3=? WHERE engineID='$engineID' ";
    $stmt = $con->prepare($engine);
    $stmt->bind_param("sss", $vaccine, $manufacturer, $office);
    $stmt->execute();

    // Encrypt Vaccine Data and update
    $encrypt_storage = encryptthis($storage, $key);
    $encrypt_lot = encryptthis($lot, $key);
    $encrypt_manufacturer = encryptthis($manufacturer, $key);
    $encrypt_ndc = encryptthis($ndc, $key);
    $vaccines  = "UPDATE vaccines SET storage=?, vaccine=?, lot=?, doses=?, exp=?, manufacturer=?, ndc=?, funding_source=? WHERE engineID='$engineID' ";
    $stmt = $con->prepare($vaccines);
    $stmt->bind_param("ssssssss", $encrypt_storage, $vaccine, $encrypt_lot, $doses, $exp, $encrypt_manufacturer, $encrypt_ndc, $source);
    $stmt->execute();

    if($stmt = $con->prepare($vaccines))
    {
      $_SESSION['success'] = "Vaccine Inventory Successfully Updated!";
      header("Location: /HC/admin/pages/immunization/index.php?inventory=&button=");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Update Inventory!";
      header("Location: /HC/admin/pages/immunization/index.php?inventory=&button=");
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
