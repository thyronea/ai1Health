<?php
$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$link = mysqli_real_escape_string($con, "/private/view/admin/temperature/");
$type = mysqli_real_escape_string($con, "Added");
$inside = mysqli_real_escape_string($con, "inside the");
$at = mysqli_real_escape_string($con, "at");
$location = mysqli_real_escape_string($con, $_POST['location']);
$position = mysqli_real_escape_string($con, $_POST['position']);
$name = mysqli_real_escape_string($con, $_POST['thermName']);
$serial = mysqli_real_escape_string($con, $_POST['thermSerial']);
$expiration = mysqli_real_escape_string($con, $_POST['thermExpiration']);

 // Encrypt Thermometer Data
 $encrypt_positon = encryptthis($position, $key);
 $encrypt_name = encryptthis($name, $key);
 $encrypt_serial = encryptthis($serial, $key);
 $encrypt_expiration = encryptthis($expiration, $key);

 // Insert to thermometers table
 $fullname = "$fname $lname";
 $thermometer = "INSERT INTO thermometers (id, engineID, groupID, location, position, name, serial, expiration) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
 $stmt = $con->prepare($thermometer);
 $stmt->bind_param("ssssssss", $thermometerID, $engineID, $groupID, $location, $encrypt_positon, $encrypt_name, $encrypt_serial, $encrypt_expiration);
 $stmt->execute();

 // Insert to engine table
 $fullname = "$fname $lname";
 $positon_engine = "Inside the $position";
 $engine = "INSERT INTO engine (engineID, groupID, keyword1, keyword2, keyword3, link) VALUES (?, ?, ?, ?, ?, ?)";
 $stmt = $con->prepare($engine);
 $stmt->bind_param("ssssss", $engineID, $groupID, $name, $location, $positon_engine, $link);
 $stmt->execute();

 // Encrypt Activity Data
 $fullname = "$fname $lname";
 $org_message = "$type $name $inside $position $at $location";
 $encrypt_fullname = encryptthis($fullname, $key);
 $encrypt_org_message = encryptthis($org_message, $key);

 // Insert to activity table
 $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
 $stmt = $con->prepare($activity);
 $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
 $stmt->execute();
?>