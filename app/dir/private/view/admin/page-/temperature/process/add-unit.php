<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]); 

// Add Storage Unit
if(isset($_POST['add_unit']))
{
  $fname = trim(mysqli_real_escape_string($con, $_SESSION['fname']));
  $lname = trim(mysqli_real_escape_string($con, $_SESSION['lname']));
  $email = trim(mysqli_real_escape_string($con, $_SESSION['email']));
  $userID = trim(mysqli_real_escape_string($con, $_SESSION['userID']));
  $groupID = trim(mysqli_real_escape_string($con, $_SESSION['groupID']));
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $location = htmlspecialchars($_POST['location']);
  $link = htmlspecialchars("pages/temperature/index.php");
  $for = htmlspecialchars("for");
  $activity_type = htmlspecialchars("Added");
  $position = $_POST['unitPosition'];
  $type = $_POST['unitType'];
  $grade = $_POST['unitGrade'];
  $name = $_POST['unitName'];

    // Encrypt Storage Data
    $encrypt_position = encryptthis($position, $key);
    $encrypt_grade = encryptthis($grade, $key);
    $encrypt_name = encryptthis($name, $key);

    // Insert to storage table
    $fullname = "$fname $lname";
    $storage = "INSERT INTO storage (engineID, groupID, location, name, position, type, grade) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($storage);
    $stmt->bind_param("sssssss", $engineID, $groupID, $location, $encrypt_name, $encrypt_position, $type, $encrypt_grade);
    $stmt->execute();

    // Insert to engine table
    $fullname = "$fname $lname";
    $unit_engine = "$location - $type - $grade";
    $engine = "INSERT INTO engine (engineID, groupID, keyword1, keyword2, keyword3, link) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($engine);
    $stmt->bind_param("ssssss", $engineID, $groupID, $name, $unit_engine, $position, $link);
    $stmt->execute();

    // Encrypt Activity Data
    $fullname = htmlspecialchars("$fname $lname");
    $org_message = htmlspecialchars("$activity_type $type $name $for $location");
    $encrypt_fullname = encryptthis($fullname, $key);
    $encrypt_org_message = encryptthis($org_message, $key);

    // Insert to activity table - organization
    $org_activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($org_activity);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
    $stmt->execute();
  

  if($stmt->execute())
  {
    $_SESSION['success'] = "Storage Unit Successfully Added!";
    header("Location: ../../temperature/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Add Unit!";
    header("Location: ../../temperature/index.php");
    exit(0);
  }
}

?>