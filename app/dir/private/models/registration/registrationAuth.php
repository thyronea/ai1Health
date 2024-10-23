<?php
// stores data in users table
$sql = "INSERT INTO admin (userID, engineID, groupID, email, role, password) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssssss", $userID, $engineID, $groupID, $email, $role, $password_hash);
$stmt->execute();

// stores data in token table
$sql = "INSERT INTO token (userID, groupID, token, dk_token) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssss", $userID, $groupID, $token, $key);
$stmt->execute();
?>