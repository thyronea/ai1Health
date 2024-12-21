<?php
$r_date = mysqli_real_escape_string($con, $_POST['r_date']);
$r_time = mysqli_real_escape_string($con, $_POST['r_time']);
$ref_id = mysqli_real_escape_string($con, $_POST['refrigerator']);
$r_initials = mysqli_real_escape_string($con, $_POST['r_initials']);
$r_current = mysqli_real_escape_string($con, $_POST['r_current']);
$r_min = mysqli_real_escape_string($con, $_POST['r_min']);
$r_max = mysqli_real_escape_string($con, $_POST['r_max']);

$refLogDate = strtotime($r_date);
$refMonth = date("F",$refLogDate);
$refYear = date("Y",$refLogDate);
$refMonthYear = "$refMonth/$refYear";

$findRef = "SELECT * FROM storage WHERE groupID='$groupID' AND id='$ref_id'";
$findRef_run = mysqli_query($con, $findRef);
$refUnit = mysqli_fetch_assoc($findRef_run);
$refrigerator = htmlspecialchars(decryptthis($refUnit["name"], $key));

$findRefThermometer = "SELECT * FROM thermometers WHERE groupID='$groupID' AND locID='$ref_id'";
$findRefThermometer_run = mysqli_query($con, $findRefThermometer);
$r_therm = mysqli_fetch_assoc($findRefThermometer_run);
$rThermHighAlarm = htmlspecialchars($r_therm["highAlarm"]);
$rThermLowAlarm = htmlspecialchars($r_therm["lowAlarm"]);

if($r_current <= $rThermLowAlarm){
    $r_alarm = mysqli_real_escape_string($con, "1"); // If current temp is too low
}
elseif($r_min <= $rThermLowAlarm){
    $r_alarm = mysqli_real_escape_string($con, "2"); // If min temp is too low
}

elseif($r_current >= $rThermHighAlarm){
    $r_alarm = mysqli_real_escape_string($con, "6"); // If current temp is too high
}
elseif($r_max >= $rThermHighAlarm){
    $r_alarm = mysqli_real_escape_string($con, "7"); // If max temp is too high
}
else{
    $r_alarm = mysqli_real_escape_string($con, "0");
}

if($r_current <= $rThermLowAlarm && $r_min <= $rThermLowAlarm){
    $r_alarm = mysqli_real_escape_string($con, "3"); // if current AND min temps are too low at the same time
}
if($r_current <= $rThermLowAlarm && $r_min <= $rThermLowAlarm && $r_max <= $rThermLowAlarm){
    $r_alarm = mysqli_real_escape_string($con, "4"); // if current, min, AND max temps are too low at the same time
}
if($r_current <= $rThermLowAlarm && $r_min <= $rThermLowAlarm && $r_max >= $rThermHighAlarm){
    $r_alarm = mysqli_real_escape_string($con, "5"); // if current AND min temps are too low at the same time while max temp is too high
}
if($r_current >= $rThermHighAlarm && $r_max >= $rThermHighAlarm){
    $r_alarm = mysqli_real_escape_string($con, "8"); // if current AND max temps are too high at the same time
}
if($r_current >= $rThermHighAlarm && $r_min >= $rThermHighAlarm && $r_max >= $rThermHighAlarm){
    $r_alarm = mysqli_real_escape_string($con, "9"); // if current, min, AND max temps are too high at the same time
}
if($r_current >= $rThermHighAlarm && $r_min <= $rThermLowAlarm && $r_max >= $rThermHighAlarm){
    $r_alarm = mysqli_real_escape_string($con, "10"); // if current AND max temps are too high at the same time while min temp is too low
}

$f_date = mysqli_real_escape_string($con, $_POST['f_date']);
$f_time = mysqli_real_escape_string($con, $_POST['f_time']);
$frz_id = mysqli_real_escape_string($con, $_POST['freezer']);
$f_initials = mysqli_real_escape_string($con, $_POST['f_initials']);
$f_current = mysqli_real_escape_string($con, $_POST['f_current']);
$f_min = mysqli_real_escape_string($con, $_POST['f_min']);
$f_max = mysqli_real_escape_string($con, $_POST['f_max']);

$frzLogDate = strtotime($f_date);
$frzMonth = date("F",$refLogDate);
$frzYear = date("Y",$refLogDate);
$frzMonthYear = "$frzMonth/$frzYear";

$findFrz = "SELECT * FROM storage WHERE groupID='$groupID' AND id='$frz_id'";
$findFrz_run = mysqli_query($con, $findFrz);
$frzUnit = mysqli_fetch_assoc($findFrz_run);
$freezer = htmlspecialchars(decryptthis($frzUnit["name"], $key));

$findFrzThermometer = "SELECT * FROM thermometers WHERE groupID='$groupID' AND locID='$frz_id'";
$findFrzThermometer_run = mysqli_query($con, $findFrzThermometer);
$f_therm = mysqli_fetch_assoc($findFrzThermometer_run);
$fThermHighAlarm = htmlspecialchars($f_therm["highAlarm"]);
$fThermLowAlarm = htmlspecialchars($f_therm["lowAlarm"]);

if($f_current <= $fThermLowAlarm){
    $f_alarm = mysqli_real_escape_string($con, "1"); // If current temp is too low
}
elseif($f_min <= $fThermLowAlarm){
    $f_alarm = mysqli_real_escape_string($con, "2"); // If min temp is too low
}

elseif($f_current >= $fThermHighAlarm){
    $f_alarm = mysqli_real_escape_string($con, "6"); // If current temp is too high
}
elseif($f_max >= $fThermHighAlarm){
    $f_alarm = mysqli_real_escape_string($con, "7"); // If max temp is too high
}
else{
    $f_alarm = mysqli_real_escape_string($con, "0");
}

if($f_current <= $fThermLowAlarm && $f_min <= $fThermLowAlarm){
    $f_alarm = mysqli_real_escape_string($con, "3"); // if current AND min temps are too low at the same time
}
if($f_current <= $fThermLowAlarm && $f_min <= $fThermLowAlarm && $f_max <= $fThermLowAlarm){
    $f_alarm = mysqli_real_escape_string($con, "4"); // if current, min, AND max temps are too low at the same time
}
if($f_current <= $fThermLowAlarm && $f_min <= $fThermLowAlarm && $f_max >= $fThermHighAlarm){
    $f_alarm = mysqli_real_escape_string($con, "5"); // if current AND min temps are too low at the same time while max temp is too high
}
if($f_current >= $fThermHighAlarm && $f_max >= $fThermHighAlarm){
    $f_alarm = mysqli_real_escape_string($con, "8"); // if current AND max temps are too high at the same time
}
if($f_current >= $fThermHighAlarm && $f_min >= $fThermHighAlarm && $f_max >= $fThermHighAlarm){
    $f_alarm = mysqli_real_escape_string($con, "9"); // if current, min, AND max temps are too high at the same time
}
if($f_current >= $fThermHighAlarm && $f_min <= $fThermLowAlarm && $f_max >= $fThermHighAlarm){
    $f_alarm = mysqli_real_escape_string($con, "10"); // if current AND max temps are too high at the same time while min temp is too low
}

// Encrypt Refrigerator Temperature Data
$encrypt_refrigerator = encryptthis($refrigerator, $key);
$encrypt_r_initials = encryptthis($r_initials, $key);

// Insert in fridgetemp table
$fridgetemp = "INSERT INTO fridgetemp (groupID, refrigerator, monthYear, date, time, initials, current, min, max, alarm) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($fridgetemp);
$stmt->bind_param("ssssssssss", $groupID, $encrypt_refrigerator, $refMonthYear, $r_date, $r_time, $r_initials, $r_current, $r_min, $r_max, $r_alarm);
$stmt->execute();

// Encrypt Freezer Temperature Data
$encrypt_freezer = encryptthis($freezer, $key);
$encrypt_f_initials = encryptthis($f_initials, $key);

// Insert in freezertemp table
$freezertemp = "INSERT INTO freezertemp (groupID, freezer, monthYear, date, time, initials, current, min, max, alarm) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($freezertemp);
$stmt->bind_param("ssssssssss", $groupID, $encrypt_freezer, $frzMonthYear, $f_date, $f_time, $f_initials, $f_current, $f_min, $f_max, $f_alarm);
$stmt->execute();

// Encrypt Activity Data
$type = mysqli_real_escape_string($con, "Logged");
$and = mysqli_real_escape_string($con, "and");
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