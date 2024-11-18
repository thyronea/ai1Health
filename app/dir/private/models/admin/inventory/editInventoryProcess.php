<?php
$id = mysqli_real_escape_string($con, $_POST['id']);
$manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
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
$org_message = "$type $name";
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_org_message = encryptthis($org_message, $key);
$activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activity);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
$stmt->execute();

// Update engine table
$inventory_engine = "Lot: $lot / Exp: $exp";
$engine  = "UPDATE engine SET keyword1=?, keyword2=?, keyword3=? WHERE id='$id' ";
$stmt = $con->prepare($engine);
$stmt->bind_param("sss", $name, $manufacturer, $id);
$stmt->execute();

// Encrypt Vaccine Data and update
$encrypt_storage = encryptthis($storage, $key);
$encrypt_lot = encryptthis($lot, $key);
$encrypt_manufacturer = encryptthis($manufacturer, $key);
$encrypt_ndc = encryptthis($ndc, $key);
$vaccines  = "UPDATE inventory SET storage=?, name=?, lot=?, doses=?, exp=?, manufacturer=?, ndc=?, funding_source=? WHERE id='$id' ";
$stmt = $con->prepare($vaccines);
$stmt->bind_param("ssssssss", $encrypt_storage, $name, $encrypt_lot, $doses, $exp, $encrypt_manufacturer, $encrypt_ndc, $source);
$stmt->execute();
?>