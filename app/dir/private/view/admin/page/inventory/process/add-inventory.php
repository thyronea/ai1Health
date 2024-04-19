<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');

if(isset($_POST['add_inventory']))
{
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $engineID = $_POST['engineID'];
  $name = $_POST['name'];
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
      $s_name = $name[$index];
      $s_doses = $doses[$index];
      $s_lot = $lot[$index];
      $s_exp = $exp[$index];
      $s_storage = $storage[$index];
      $s_manufacturer = $manufacturer[$index];
      $s_ndc = $ndc[$index];
      $s_funding = $funding[$index];

      // Encrypt Activity Data
      $fullname = "$fname $lname";
      $type = htmlspecialchars("Stored");
      $org_message = "$type $s_name - $s_lot";
      $encrypt_fullname = encryptthis($fullname, $key);
      $encrypt_org_message = encryptthis($org_message, $key);

      // stores data in activity table
      $fullname = "$fname $lname";
      $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activity);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
      $stmt->execute();

      // stores data in engine table
      $link = htmlspecialchars("pages/immunization/index.php?inventory=$s_lot");
      $vaccine_engine = "Lot: $s_lot / Exp: $s_exp";
      $engine = "INSERT INTO engine (engineID, groupID, keyword1, keyword2, keyword3, link) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($engine);
      $stmt->bind_param("ssssss", $s_engineID, $groupID, $s_name, $s_manufacturer, $vaccine_engine, $link);
      $stmt->execute();

      // Encrypt Vaccine Data
      $encrypt_name = encryptthis($s_name, $key);
      $encrypt_storage = encryptthis($s_storage, $key);
      $encrypt_lot = encryptthis($s_lot, $key);
      $encrypt_manufacturer = encryptthis($s_manufacturer, $key);
      $encrypt_ndc = encryptthis($s_ndc, $key);

      // stores data in vaccines table
      $inventory = "INSERT INTO inventory (engineID, groupID, storage, name, doses, lot, exp, manufacturer, ndc, funding_source) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($inventory);
      $stmt->bind_param("ssssssssss", $s_engineID, $groupID, $encrypt_storage, $s_name, $s_doses, $encrypt_lot, $s_exp, $encrypt_manufacturer, $encrypt_ndc, $s_funding);
      $stmt->execute();
  }

  if($stmt = $con->prepare($inventory))
  {
      $_SESSION['success'] = "Inventory Added Successfully";
      header("Location: ../../inventory/index.php");
      exit(0);
  }
  else
  {
      $_SESSION['warning'] = "Data Not Inserted";
      header("Location: ../../inventory/index.php");
      exit(0);
  }
}


?>