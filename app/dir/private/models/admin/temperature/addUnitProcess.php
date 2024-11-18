<?php
$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$location = mysqli_real_escape_string($con, $_POST['location']);
$link = mysqli_real_escape_string($con, "/private/view/admin/temperature/");
$for = mysqli_real_escape_string($con, "for");
$activity_type = mysqli_real_escape_string($con, "Added");
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
?>