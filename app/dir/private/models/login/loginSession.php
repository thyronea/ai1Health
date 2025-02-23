<?php
// Retrieves key for data decryption
$token_query = "SELECT * FROM token WHERE userID='$userID' ";
$token_query_run = mysqli_query($con, $token_query);
$token = mysqli_fetch_assoc($token_query_run);
$key = mysqli_real_escape_string($con, $token["dk_token"]);

// Retreived user's data for SESSION
$_SESSION["userID"] = htmlspecialchars($user["userID"]);
$_SESSION["engineID"] = htmlspecialchars($user["engineID"]);
$_SESSION["groupID"] = htmlspecialchars($user["groupID"]);
$_SESSION["dk_token"] = htmlspecialchars($token["dk_token"]);
$userID = htmlspecialchars($_SESSION['userID']);

// Retrieves user profile for data decryption
$profile_query = "SELECT * FROM profile WHERE userID='$userID' ";
$profile_query_run = mysqli_query($con, $profile_query);
$profile = mysqli_fetch_assoc($profile_query_run);

$fname = htmlspecialchars($profile["fname"]); // Decrypted first name
$lname = htmlspecialchars($profile["lname"]); // Decrypted last name

$_SESSION['fname'] = htmlspecialchars($profile["fname"]); // Retrieved first name for SESSION
$_SESSION['lname'] = htmlspecialchars($profile["lname"]); // Retrieved last name for SESSION
$_SESSION['email'] = htmlspecialchars(decryptthis($profile["email"], $key)); // Retrieved email for SESSION
$_SESSION['role'] = htmlspecialchars(decryptthis($profile["role"], $key)); // Retrieved role for SESSION
$_SESSION['location'] = htmlspecialchars(decryptthis($profile["location"], $key));
?>