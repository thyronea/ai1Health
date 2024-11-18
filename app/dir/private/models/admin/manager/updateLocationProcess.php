<?php
$id = mysqli_real_escape_string($con, $_POST['id']);
$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$poc = mysqli_real_escape_string($con, $_POST['poc']);
$name = mysqli_real_escape_string($con, $_POST['name']);
$address1 = mysqli_real_escape_string($con, $_POST['address1']);
$address2 = mysqli_real_escape_string($con, $_POST['address2']);
$city = mysqli_real_escape_string($con, $_POST['city']);
$state = mysqli_real_escape_string($con, $_POST['state']);
$zip = mysqli_real_escape_string($con, $_POST['zip']);
$phone = mysqli_real_escape_string($con, $_POST['phone']);
$location_email = mysqli_real_escape_string($con, $_POST['location_email']);
$location_link = mysqli_real_escape_string($con, $_POST['location_link']);
$type = mysqli_real_escape_string($con, "Updated");

// Encrypt Activity Data and insert to Activities table
$fullname = htmlspecialchars("$fname $lname");
$org_message = htmlspecialchars("$type $name");
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_org_message = encryptthis($org_message, $key);
$fullname = "$fname $lname";
$activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activity);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
$stmt->execute();

// Edit engine table
$complete_address = "$address1 $address2 $city $state $zip";
$engine  = "UPDATE engine SET keyword1=?, keyword2=?, keyword3=? WHERE engineID='$id' ";
$stmt = $con->prepare($engine);
$stmt->bind_param("sss", $name, $complete_address, $location_email);
$stmt->execute();

$encrypt_poc = encryptthis($poc, $key);
$encrypt_name = encryptthis($name, $key);
$encrypt_address1 = encryptthis($address1, $key);
$encrypt_address2 = encryptthis($address2, $key);
$encrypt_city = encryptthis($city, $key);
$encrypt_state = encryptthis($state, $key);
$encrypt_zip = encryptthis($zip, $key);
$encrypt_phone = encryptthis($phone, $key);
$encrypt_email = encryptthis($location_email, $key);
$encrypt_link = encryptthis($location_link, $key);

$location  = "UPDATE location SET poc=?, name=?, address1=?, address2=?, city=?, state=?, zip=?, phone=?, email=?, link=? WHERE id='$id' ";
$stmt = $con->prepare($location);
$stmt->bind_param("ssssssssss", $poc, $name, $address1, $address2, $city, $state, $zip, $phone, $location_email, $location_link);
$stmt->execute();

$check_poc = "SELECT * FROM profile WHERE userID='$userID'";
$check_poc_run = mysqli_query($con, $check_poc);
$profile = mysqli_fetch_assoc($check_poc_run);
$profile_fname = decryptthis($profile['fname'], $key);
$profile_lname = decryptthis($profile['lname'], $key);
$fullName = htmlspecialchars("$profile_fname $profile_lname");

if($poc = $fullName){
    $updateProfileLoc  = "UPDATE profile SET location=? WHERE userID='$userID' ";
    $stmt = $con->prepare($updateProfileLoc);
    $stmt->bind_param("s", $encrypt_name);
    $stmt->execute();
}
?>