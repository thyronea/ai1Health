<?php
$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$user_fname = mysqli_real_escape_string($con, $_POST['fname']);
$user_lname = mysqli_real_escape_string($con, $_POST['lname']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$role = mysqli_real_escape_string($con, $_POST['role']);
$location = mysqli_real_escape_string($con, $_POST['location']);
$type = mysqli_real_escape_string($con, "Updated");
$message = mysqli_real_escape_string($con, ": Account");

// Encrypt Activity Data and insert to Activities table
$user_fullname = "$fname $lname";
$act_message = "$type $user_fname $user_lname $message";
$encrypt_fullname = encryptthis($user_fullname, $key);
$encrypt_type = encryptthis($type, $key);
$encrypt_act_message = encryptthis($act_message, $key);
$activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activity);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_act_message);
$stmt->execute();

// Update engine table
$full_name = "$user_fname $user_lname";
$engine  = "UPDATE engine SET keyword1=?, keyword2=?, keyword3=? WHERE engineID='$engineID' ";
$stmt = $con->prepare($engine);
$stmt->bind_param("sss", $full_name, $role, $email);
$stmt->execute();

// Update users table
$users  = "UPDATE admin SET email=?, role=? WHERE engineID='$engineID' ";
$stmt = $con->prepare($users);
$stmt->bind_param("ss", $email, $role);
$stmt->execute();

// Encrypt Profile Data and insert to Profile table
$encrypt_user_email = encryptthis($email, $key);
$encrypt_role = encryptthis($role, $key);
$encrypt_user_location = encryptthis($location, $key);
$profile  = "UPDATE profile SET fname=?, lname=?, email=?, role=?, location=? WHERE engineID='$engineID' ";
$stmt = $con->prepare($profile);
$stmt->bind_param("sssss", $user_fname, $user_lname, $encrypt_user_email, $encrypt_role, $encrypt_user_location);
$stmt->execute();
?>