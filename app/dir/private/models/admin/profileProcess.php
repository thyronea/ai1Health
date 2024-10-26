<?php
// Encrypt diversity data and insert
$encrypt_dob = encryptthis($dob, $key);
$encrypt_gender = encryptthis($gender, $key);
$encrypt_race = encryptthis($race, $key);
$encrypt_ethnicity = encryptthis($ethnicity, $key);
$diversity = "INSERT INTO diversity (userID, engineID, groupID, dob, gender, race, ethnicity) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($diversity);
$stmt->bind_param("sssssss", $userID, $engineID, $groupID, $encrypt_dob, $encrypt_gender, $encrypt_race, $encrypt_ethnicity);
$stmt->execute();

// Encrypt Patient's address Data and insert
$encrypt_address1 = encryptthis($address1, $key);
$encrypt_address2 = encryptthis($address2, $key);
$encrypt_city = encryptthis($city, $key);
$encrypt_state = encryptthis($state, $key);
$encrypt_zip = encryptthis($zip, $key);
$address = "INSERT INTO address (userID, engineID, groupID, address1, address2, city, state, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($address);
$stmt->bind_param("ssssssss", $userID, $engineID, $groupID, $encrypt_address1, $encrypt_address2, $encrypt_city, $encrypt_state, $encrypt_zip);
$stmt->execute();

// Encrypt Patient's contact Data and insert
$encrypt_phone = encryptthis($phone, $key);
$encrypt_mobile = encryptthis($mobile, $key);
$encrypt_patient_email = encryptthis($email, $key);
$contact = "INSERT INTO contact (userID, engineID, groupID, phone, mobile, email) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($contact);
$stmt->bind_param("ssssss", $userID, $engineID, $groupID, $encrypt_phone, $encrypt_mobile, $encrypt_patient_email);
$stmt->execute();
?>