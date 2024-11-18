<?php
// Encrypt Data (inactivated)
$encrypt_poc = encryptthis($poc, $key);
$encrypt_name = encryptthis($name, $key);
$encrypt_address1 = encryptthis($address1, $key);
$encrypt_address2 = encryptthis($address2, $key);
$encrypt_city = encryptthis($city, $key);
$encrypt_state = encryptthis($state, $key);
$encrypt_zip = encryptthis($zip, $key);
$encrypt_phone = encryptthis($phone, $key);
$encrypt_email = encryptthis($email, $key);
$encrypt_link = encryptthis($link, $key);

// If null location in profile, add as default location
$loc_check = "SELECT * FROM location WHERE groupID='$groupID'";
$loc_check_run = mysqli_query($con, $loc_check);
if(empty(mysqli_num_rows($loc_check_run))){
    $updateProfileLoc  = "UPDATE profile SET location=? WHERE userID='$userID' ";
    $stmt = $con->prepare($updateProfileLoc);
    $stmt->bind_param("s", $encrypt_name);
    $stmt->execute();
}

//Insert to location table
$sql = "INSERT INTO location (engineID, groupID, poc, name, address1, address2, city, state, zip, phone, email, link) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssssssssssss", $engineID, $groupID, $poc, $name, $address1, $address2, $city, $state, $zip, $phone, $email, $link);
$stmt->execute();

// Encrypt Activity Data
$fullname = "$fname $lname";
$org_message = "$type $name";
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_org_message = encryptthis($org_message, $key);

// insert activity timestamp
$fullname = "$fname $lname";
$activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activity);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
$stmt->execute();

// insert keywords to engine table
$address = "$address1 $address2 $city $state $zip";
$link = "https://www.google.com/maps/place/$address1 $address2 $city $state $zip";
$engine = "INSERT INTO engine (engineID, groupID, keyword1, keyword2, keyword3, link) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($engine);
$stmt->bind_param("ssssss", $engineID, $groupID, $name, $address, $email, $link);
$stmt->execute();
?>