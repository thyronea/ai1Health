<?php
// Insert to admin table
$sql = "INSERT INTO admin (userID, engineID, groupID, email, role) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssss", $newID, $engineID, $groupID, $email, $role);
$stmt->execute();

// stores data in token table
$sql = "INSERT INTO token (userID, groupID, token, dk_token, salt) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssss", $newID, $groupID, $token, $key, $salt);
$stmt->execute();

// Encrypt Profile Data
$encrypted_email = encryptthis($email, $key);
$encrypted_role = encryptthis($role, $key);
$encrypted_location = encryptthis($location, $key);

// Store user's profile in profile table (encrypted)
$sql = "INSERT INTO profile (userID, engineID, groupID, fname, lname, email, role, location) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssssssss", $newID, $engineID, $groupID, $fname, $lname, $encrypted_email, $encrypted_role, $encrypted_location);
$stmt->execute();

// Insert default profile image to profile_image table
$sql = "INSERT INTO profile_image (userID, groupID, filename) VALUES (?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sss", $newID, $groupID, $filename);
$stmt->execute();

// Insert default background image to background_image table
$sql = "INSERT INTO background_image (userID, groupID, filename) VALUES (?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sss", $newID, $groupID, $background_filename);
$stmt->execute();

// Encrypt Activity Data
$fullname = htmlspecialchars("$admin_fname $admin_lname");
$act_message = htmlspecialchars("$type $fname $lname $as $role");
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_type = encryptthis($type, $key);
$encrypt_act_message = encryptthis($act_message, $key);

// insert activity timestamp
$activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activity);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_act_message);
$stmt->execute();

// Encrypt Email Data
$encrypted_admin = encryptthis($admin, $key);
$encrypted_email = encryptthis($email, $key);
$encrypted_subject = encryptthis($subject, $key);
$encrypted_message = encryptthis($message, $key);

// insert log to email table
$send_message = "INSERT INTO email (userID, groupID, fromEmail, toEmail, subject, message) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($send_message);
$stmt->bind_param("ssssss", $userID, $groupID, $encrypted_admin, $encrypted_email, $encrypted_subject, $encrypted_message);
$stmt->execute();

// insert keywords to engine table
$fullname = "$fname $lname"; // Person creating the account for
$link = mysqli_real_escape_string($con, "/private/view/profile/?userID=$newID"); // Link to user's profile
$engine = "INSERT INTO engine (engineID, groupID, keyword1, keyword2, keyword3, link) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($engine);
$stmt->bind_param("ssssss", $engineID, $groupID, $fullname, $role, $email, $link);
$stmt->execute();
?>