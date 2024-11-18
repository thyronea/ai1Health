<?php
$r_date = mysqli_real_escape_string($con, $_POST['r_date']);
$r_time = mysqli_real_escape_string($con, $_POST['r_time']);
$refrigerator = mysqli_real_escape_string($con, $_POST['refrigerator']);
$r_initials = mysqli_real_escape_string($con, $_POST['r_initials']);
$r_current = mysqli_real_escape_string($con, $_POST['r_current']);
$r_min = mysqli_real_escape_string($con, $_POST['r_min']);
$r_max = mysqli_real_escape_string($con, $_POST['r_max']);
$f_date = mysqli_real_escape_string($con, $_POST['f_date']);
$f_time = mysqli_real_escape_string($con, $_POST['f_time']);
$freezer = mysqli_real_escape_string($con, $_POST['freezer']);
$f_initials = mysqli_real_escape_string($con, $_POST['f_initials']);
$f_current = mysqli_real_escape_string($con, $_POST['f_current']);
$f_min = mysqli_real_escape_string($con, $_POST['f_min']);
$f_max = mysqli_real_escape_string($con, $_POST['f_max']);
$type = mysqli_real_escape_string($con, "Logged");
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
$fullname = "$fname $lname";
$org_message = "$type: $r_current / $r_min / $r_max $and $f_current / $f_min / $f_max";
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_org_message = encryptthis($org_message, $key);

// Insert in activity table
$activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activity);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
$stmt->execute();
?>