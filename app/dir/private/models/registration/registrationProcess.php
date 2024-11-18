<?php

// stores password in admin table
$sql = "INSERT INTO admin (userID, engineID, groupID, email, role, password) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssssss", $userID, $engineID, $groupID, $email, $role, $password_hash);
$stmt->execute();

// stores tokens in token table
$sql = "INSERT INTO token (userID, groupID, token, dk_token, salt) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssss", $userID, $groupID, $token, $key, $salt);
$stmt->execute();

// Encrypt Profile Data
$encrypted_email = encryptthis($email, $key);
$encrypted_role = encryptthis($role, $key);

// stores user's profile in profile table (encrypted)
$sql = "INSERT INTO profile (userID, engineID, groupID, fname, lname, email, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssssss", $userID, $engineID, $groupID, $fname, $lname, $encrypted_email, $encrypted_role);
$stmt->execute();

// stores default profile image to profile_image table
$sql = "INSERT INTO profile_image (userID, groupID, filename) VALUES (?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sss", $userID, $groupID, $filename);
$stmt->execute();

// stores default background image to background_image table
$sql = "INSERT INTO background_image (userID, groupID, filename) VALUES (?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sss", $userID, $groupID, $background_filename);
$stmt->execute();

// stores data in engine table
$fullname = "$fname $lname"; // Person creating the new account
$link = mysqli_real_escape_string($con, "../../../../view/profile/index.php?userID=$userID"); // Link to user's profile
$engine = "INSERT INTO engine (engineID, groupID, keyword1, keyword2, keyword3, link) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($engine);
$stmt->bind_param("ssssss", $engineID, $groupID, $fullname, $role, $email, $link);
$stmt->execute();

// Encrypt Activities Data
$fullname = "$fname $lname";
$act_message = "$type $as $role";
$encrypted_fullname = encryptthis($fullname, $key);
$encrypted_fname = encryptthis($fname, $key);
$encrypted_lname = encryptthis($lname, $key);
$encrypted_message = encryptthis($act_message, $key);

// stores data in activity table
$activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activity);
$stmt->bind_param("sssss", $userID, $groupID,$encrypted_fullname, $type, $encrypted_message); // Will save as "$fname $lname Registered as new Admin"
$stmt->execute();

// Encrypt Email Data
$encrypted_admin = encryptthis($admin, $key);
$encrypted_email = encryptthis($email, $key);
$encrypted_subject = encryptthis($subject, $key);
$encrypted_message = encryptthis($message, $key);
$send_message = "INSERT INTO email (userID, groupID, fromEmail, toEmail, subject, message) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($send_message);
$stmt->bind_param("ssssss", $userID, $groupID, $encrypted_admin, $encrypted_email, $encrypted_subject, $encrypted_message);
$stmt->execute();
?>