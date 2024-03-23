<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]); 

// Add Daily Temp
if(isset($_POST['save_temp_btn']))
{
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $r_date = htmlspecialchars($_POST['r_date']);
  $r_time = htmlspecialchars($_POST['r_time']);
  $refrigerator = htmlspecialchars($_POST['refrigerator']);
  $r_initials = htmlspecialchars($_POST['r_initials']);
  $r_current = htmlspecialchars($_POST['r_current']);
  $r_min = htmlspecialchars($_POST['r_min']);
  $r_max = htmlspecialchars($_POST['r_max']);
  $f_date = htmlspecialchars($_POST['f_date']);
  $f_time = htmlspecialchars($_POST['f_time']);
  $freezer = htmlspecialchars($_POST['freezer']);
  $f_initials = htmlspecialchars($_POST['f_initials']);
  $f_current = htmlspecialchars($_POST['f_current']);
  $f_min = htmlspecialchars($_POST['f_min']);
  $f_max = htmlspecialchars($_POST['f_max']);
  $type = htmlspecialchars("Logged");
  $and = mysqli_real_escape_string($con, "and");

  // Encrypt Refrigerator Temperature Data
  $encrypt_refrigerator = encryptthis($refrigerator, $key);
  $encrypt_r_initials = encryptthis($r_initials, $key);
  $encrypt_r_current = encryptthis($r_current, $key);
  $encrypt_r_min = encryptthis($r_min, $key);
  $encrypt_r_max = encryptthis($r_max, $key);

  // Insert in fridgetemp table
  $fridgetemp = "INSERT INTO fridgetemp (groupID, refrigerator, date, time, initials, current, min, max) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($fridgetemp);
  $stmt->bind_param("ssssssss", $groupID, $encrypt_refrigerator, $r_date, $r_time, $r_initials, $r_current, $r_min, $r_max);
  $stmt->execute();

  // Encrypt Freezer Temperature Data
  $encrypt_freezer = encryptthis($freezer, $key);
  $encrypt_f_initials = encryptthis($f_initials, $key);
  $encrypt_f_current = encryptthis($f_current, $key);
  $encrypt_f_min = encryptthis($f_min, $key);
  $encrypt_f_max = encryptthis($f_max, $key);

  // Insert in freezertemp table
  $freezertemp = "INSERT INTO freezertemp (groupID, freezer, date, time, initials, current, min, max) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($freezertemp);
  $stmt->bind_param("ssssssss", $groupID, $encrypt_freezer, $f_date, $f_time, $f_initials, $f_current, $f_min, $f_max);
  $stmt->execute();

  // Encrypt Activity Data
  $fullname = htmlspecialchars("$fname $lname");
  $org_message = htmlspecialchars("$type: $r_current / $r_min / $r_max $and $f_current / $f_min / $f_max");
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_user_office = encryptthis($office, $key);
  $encrypt_org_message = encryptthis($org_message, $key);

  // Insert in activity table
  $activity = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypt_user_office, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  if($stmt = $con->prepare($activity))
  {
    $_SESSION['success'] = "Temperature Logged Successfully";
    header("Location: /HC/admin/pages/temperature/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Data Error! Unable to ";
    header("Location: /HC/admin/pages/temperature/index.php");
    exit(0);
  }
}

// Add Storage Unit
if(isset($_POST['add_unit']))
{
  $user_office = trim(mysqli_real_escape_string($con, $_SESSION['office']));
  $fname = trim(mysqli_real_escape_string($con, $_SESSION['fname']));
  $lname = trim(mysqli_real_escape_string($con, $_SESSION['lname']));
  $email = trim(mysqli_real_escape_string($con, $_SESSION['email']));
  $userID = trim(mysqli_real_escape_string($con, $_SESSION['userID']));
  $storageID = htmlspecialchars($_POST['storageID']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $groupID = htmlspecialchars($_POST['groupID']);
  $office = htmlspecialchars($_POST['office']);
  $link = htmlspecialchars("pages/temperature/index.php");
  $for = htmlspecialchars("for");
  $activity_type = htmlspecialchars("Added");
  $location = $_POST['unitLocation'];
  $type = $_POST['unitType'];
  $grade = $_POST['unitGrade'];
  $name = $_POST['unitName'];

  foreach($location as $index => $locations)
  {
    $s_location = $locations;
    $s_type = $type[$index];
    $s_grade = $grade[$index];
    $s_name = $name[$index];

    // Encrypt Storage Data
    $encrypt_location = encryptthis($s_location, $key);
    $encrypt_grade = encryptthis($s_grade, $key);
    $encrypt_name = encryptthis($s_name, $key);

    // Insert to storage table
    $fullname = "$fname $lname";
    $storage = "INSERT INTO storage (storageID, engineID, groupID, office, location, type, grade, name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($storage);
    $stmt->bind_param("ssssssss", $storageID, $engineID, $groupID, $office, $encrypt_location, $s_type, $encrypt_grade, $encrypt_name);
    $stmt->execute();

    // Insert to engine table
    $fullname = "$fname $lname";
    $unit_engine = "$office - $s_type - $s_grade";
    $engine = "INSERT INTO engine (engineID, groupID, keyword1, keyword2, keyword3, link) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($engine);
    $stmt->bind_param("ssssss", $engineID, $groupID, $s_name, $unit_engine, $s_location, $link);
    $stmt->execute();

    // Encrypt Activity Data
    $fullname = htmlspecialchars("$fname $lname");
    $org_message = htmlspecialchars("$activity_type $s_type $s_name $for $office");
    $encrypt_fullname = encryptthis($fullname, $key);
    $encrypt_user_office = encryptthis($user_office, $key);
    $encrypt_org_message = encryptthis($org_message, $key);

    // Insert to activity table - organization
    $org_activity = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($org_activity);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypt_user_office, $encrypt_fullname, $type, $encrypt_org_message);
    $stmt->execute();
  }

  if($stmt = $con->prepare($storage))
  {
    $_SESSION['success'] = "Storage Unit Successfully Added!";
    header("Location: /HC/admin/pages/temperature/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Add Unit!";
    header("Location: /HC/admin/pages/temperature/index.php");
    exit(0);
  }
}

// Edit Storage Unit
if(isset($_POST['updatestorage_btn']))
{
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $storageID = htmlspecialchars($_POST['storageID']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $office = htmlspecialchars($_POST['office']);
  $unit_location = htmlspecialchars($_POST['unit_location']);
  $unit_type = htmlspecialchars($_POST['unit_type']);
  $unit_grade = htmlspecialchars($_POST['unit_grade']);
  $unit_name = htmlspecialchars($_POST['unit_name']);
  $type = htmlspecialchars("Updated");
  $for = htmlspecialchars("for");

  // Encrypt Activity Data and insert
  $fullname = htmlspecialchars("$fname $lname");
  $org_message = htmlspecialchars("$type $unit_location: $unit_name $for $office");
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_office = encryptthis($office, $key);
  $encrypt_org_message = encryptthis($org_message, $key);
  $org_activity = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($org_activity);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypt_office, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  // Update engine table
  $office_unit_grade = "$office - $unit_type - $unit_grade";
  $engine  = "UPDATE engine SET keyword1=?, keyword2=?, keyword3=? WHERE engineID='$engineID' ";
  $stmt = $con->prepare($engine);
  $stmt->bind_param("sss", $unit_name, $office_unit_grade, $unit_type);
  $stmt->execute();

  // Encrypt and update storage table
  $encrypt_location = encryptthis($unit_location, $key);
  $encrypt_grade = encryptthis($unit_grade, $key);
  $encrypt_name = encryptthis($unit_name, $key);
  $storage  = "UPDATE storage SET office=?, location=?, type=?, grade=?, name=? WHERE engineID='$engineID' ";
  $stmt = $con->prepare($storage);
  $stmt->bind_param("sssss", $office, $encrypt_location, $unit_type, $encrypt_grade, $encrypt_name);
  $stmt->execute();

  $query = "UPDATE storage SET office='$office', location='$encrypt_location', type='$unit_type', grade='$encrypt_grade', name='$encrypt_name'
  WHERE engineID='$engineID' ";

  $query_run = mysqli_query($con, $query);

  if($query_run)
  {
    $_SESSION['success'] = "$unit_name Successfully Updated!";
    header("Location: /HC/admin/pages/temperature/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update $unit_name!";
    header("Location: /HC/admin/pages/temperature/index.php");
    exit(0);
  }
}

// Delete Storage Unit
if(isset($_POST['storagedeletebtn']))
{
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $storage_name = htmlspecialchars($_POST['delete_storage_name']);
  $type = mysqli_real_escape_string($con, "Deleted");
  $from = mysqli_real_escape_string($con, "from");

  // Encrypt Activity Data and insert
  $fullname = htmlspecialchars("$fname $lname");
  $org_message = htmlspecialchars("$type $storage_name $from $office");
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_office = encryptthis($office, $key);
  $encrypt_org_message = encryptthis($org_message, $key);
  $org_activity = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($org_activity);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypt_office, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  // Delete from storage table
  $storage = "DELETE FROM storage WHERE engineID=? ";
  $stmt = $con->prepare($storage);
  $stmt->bind_param("s", $engineID);
  $stmt->execute();

  // Delete from engine table
  $engine = "DELETE FROM engine WHERE engineID=? ";
  $stmt = $con->prepare($engine);
  $stmt->bind_param("s", $engineID);
  $stmt->execute();

  if($stmt = $con->prepare($storage))
  {
    $_SESSION['success'] = "$storage_name Successfully Deleted";
    header("Location: /HC/admin/pages/temperature/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Delete $storage_name ";
    header("Location: /HC/admin/pages/temperature/index.php");
    exit(0);
  }
}

// Add Thermometer
if(isset($_POST['add_thermometer']))
{
  $user_office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $thermometerID = htmlspecialchars($_POST['thermometerID']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $groupID = htmlspecialchars($_POST['groupID']);
  $link = htmlspecialchars("pages/temperature/index.php");
  $type = htmlspecialchars("Added");
  $inside = htmlspecialchars("inside the");
  $at = htmlspecialchars("at");
  $office = $_POST['office'];
  $location = $_POST['thermLocation'];
  $name = $_POST['thermName'];
  $serial = $_POST['thermSerial'];
  $expiration = $_POST['thermExpiration'];

  foreach($location as $index => $locations)
  {
    $s_location = $locations;
    $s_name = $name[$index];
    $s_serial = $serial[$index];
    $s_expiration = $expiration[$index];

    // Encrypt Thermometer Data
    $encrypt_location = encryptthis($s_location, $key);
    $encrypt_name = encryptthis($s_name, $key);
    $encrypt_serial = encryptthis($s_serial, $key);
    $encrypt_expiration = encryptthis($s_expiration, $key);

    // Insert to thermometers table
    $fullname = "$fname $lname";
    $thermometer = "INSERT INTO thermometers (thermometerID, engineID, groupID, office, location, name, serial, expiration) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($thermometer);
    $stmt->bind_param("ssssssss", $thermometerID, $engineID, $groupID, $office, $encrypt_location, $encrypt_name, $encrypt_serial, $encrypt_expiration);
    $stmt->execute();

    // Insert to engine table
    $fullname = "$fname $lname";
    $location_engine = "Inside the $s_location";
    $engine = "INSERT INTO engine (engineID, groupID, keyword1, keyword2, keyword3, link) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($engine);
    $stmt->bind_param("ssssss", $engineID, $groupID, $s_name, $office, $location_engine, $link);
    $stmt->execute();

    // Encrypt Activity Data
    $fullname = htmlspecialchars("$fname $lname");
    $org_message = htmlspecialchars("$type $s_name $inside $s_location $at $office");
    $encrypt_fullname = encryptthis($fullname, $key);
    $encrypt_user_office = encryptthis($user_office, $key);
    $encrypt_org_message = encryptthis($org_message, $key);

    // Insert to activity table
    $activity = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activity);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypt_user_office, $encrypt_fullname, $type, $encrypt_org_message);
    $stmt->execute();
  }

  if($stmt = $con->prepare($thermometer))
  {
    $_SESSION['success'] = "$s_name in $s_location Successfully Added!";
    header("Location: /HC/admin/pages/temperature/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Add Thermometer!";
    header("Location: /HC/admin/pages/temperature/index.php");
    exit(0);
  }
}

// Edit Thermometer
if(isset($_POST['updatethermometer_btn']))
{
  $user_office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $type = htmlspecialchars("Updated");
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $thermometerID = htmlspecialchars($_POST['thermometerID']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $office = htmlspecialchars($_POST['office']);
  $therm_id = htmlspecialchars($_POST['therm_id']);
  $therm_location = htmlspecialchars($_POST['therm_location']);
  $therm_name = htmlspecialchars($_POST['therm_name']);
  $therm_serial = htmlspecialchars($_POST['therm_serial']);
  $therm_expiration = htmlspecialchars($_POST['therm_expiration']);

  // Encrypt Activity Data
  $fullname = htmlspecialchars("$fname $lname");
  $org_message = htmlspecialchars("$type $therm_name: $therm_serial");
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_user_office = encryptthis($user_office, $key);
  $encrypt_org_message = encryptthis($org_message, $key);

  // Insert to activity table
  $activity = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypt_user_office, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  // Update engine table
  $loc_message = "Inside the $therm_location";
  $engine  = "UPDATE engine SET keyword1=?, keyword2=?, keyword3=? WHERE engineID='$engineID' ";
  $stmt = $con->prepare($engine);
  $stmt->bind_param("sss", $therm_name, $office, $loc_message);
  $stmt->execute();

  // Encrypt Thermometer Data and update
  $encrypt_location = encryptthis($therm_location, $key);
  $encrypt_name = encryptthis($therm_name, $key);
  $encrypt_serial = encryptthis($therm_serial, $key);
  $encrypt_expiration = encryptthis($therm_expiration, $key);
  $thermometers  = "UPDATE thermometers SET office=?, location=?, name=?, serial=?, expiration=? WHERE thermometerID='$thermometerID' ";
  $stmt = $con->prepare($thermometers);
  $stmt->bind_param("sssss", $office, $encrypt_location, $encrypt_name, $encrypt_serial, $encrypt_expiration);
  $stmt->execute();

  if($stmt = $con->prepare($thermometers))
  {
    $_SESSION['success'] = "$therm_name Successfully Updated!";
    header("Location: /HC/admin/pages/temperature/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update $therm_name!";
    header("Location: /HC/admin/pages/temperature/index.php");
    exit(0);
  }
}

// Delete Thermometer
if(isset($_POST['thermometerdeletebtn']))
{
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $type = htmlspecialchars("Deleted");
  $from = htmlspecialchars("from");
  $thermometerID = htmlspecialchars($_POST['thermometerID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $thermometer_name = htmlspecialchars($_POST['delete_thermometer_name']);

  // Encrypt Activity Data
  $fullname = htmlspecialchars("$fname $lname");
  $org_message = htmlspecialchars("$type $thermometer_name $from $office");
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_user_office = encryptthis($office, $key);
  $encrypt_org_message = encryptthis($org_message, $key);

  // Insert to activity table
  $activity = "INSERT INTO activities (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypt_user_office, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  // Delete from thermometers table
  $thermometers = "DELETE FROM thermometers WHERE thermometerID=? ";
  $stmt = $con->prepare($thermometers);
  $stmt->bind_param("s", $thermometerID);
  $stmt->execute();

  // Delete from engine table
  $engine = "DELETE FROM engine WHERE engineID=? ";
  $stmt = $con->prepare($engine);
  $stmt->bind_param("s", $engineID);
  $stmt->execute();

  if($stmt = $con->prepare($thermometers))
  {
    $_SESSION['success'] = "$delete_thermometer_name Successfully Deleted";
    header("Location: /HC/admin/pages/temperature/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Delete $delete_thermometer_name ";
    header("Location: /HC/admin/pages/temperature/index.php");
    exit(0);
  }
}

?>
