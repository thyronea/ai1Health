<?php
// stores data in token table
$sql = "INSERT INTO token (userID, groupID, token, dk_token, salt) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssss", $patientID, $groupID, $token, $key, $salt);
$stmt->execute();

// Encrypt Patient Data and insert to admin
$patient = "INSERT INTO admin (userID, engineID, groupID, email, role) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($patient);
$stmt->bind_param("sssss", $patientID, $engineID, $groupID, $patient_email, $role);
$stmt->execute();

// Insert default profile image to profile_image table
$sql = "INSERT INTO profile_image (userID, groupID, filename) VALUES (?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sss", $patientID, $groupID, $filename);
$stmt->execute();

// Insert default background image to background_image table
$sql = "INSERT INTO background_image (userID, groupID, filename) VALUES (?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sss", $patientID, $groupID, $background_filename);
$stmt->execute();

// Encrypt Patient Data and insert
$encrypt_fname = encryptthis($fname, $key);
$encrypt_lname = encryptthis($lname, $key);
$encrypted_patient_email = encryptthis($patient_email, $key);
$encrypt_dob = encryptthis($dob, $key);
$encrypt_suffix = encryptthis($suffix, $key);
$encrypt_role = encryptthis($role, $key);
$patient = "INSERT INTO patients (patientID, engineID, groupID, fname, lname, dob, suffix, email, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($patient);
$stmt->bind_param("sssssssss", $patientID, $engineID, $groupID, $encrypt_fname, $encrypt_lname, $encrypt_dob, $encrypt_suffix, $encrypted_patient_email, $encrypt_role);
$stmt->execute();

// Encrypt Health Plan and insert
$encrypt_healthplan = encryptthis("N/A", $key);
$healthplan = "INSERT INTO healthplan (patientID, engineID, groupID, health_plan, policy_number, status) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($healthplan);
$stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $encrypt_healthplan, $encrypt_healthplan, $encrypt_healthplan);
$stmt->execute();

// Encrypt Email Data and insert
$encrypted_admin = encryptthis($admin, $key);
$encrypted_patient_email = encryptthis($patient_email, $key);
$encrypted_subject = encryptthis($subject, $key);
$encrypted_message = encryptthis($message, $key);
$send_message = "INSERT INTO email (userID, groupID, fromEmail, toEmail, subject, message) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($send_message);
$stmt->bind_param("ssssss", $userID, $groupID, $encrypted_admin, $encrypted_patient_email, $encrypted_subject, $encrypted_message);
$stmt->execute();

// Encrypt Patient's address Data and insert
$encrypt_address1 = encryptthis($address1, $key);
$encrypt_address2 = encryptthis($address2, $key);
$encrypt_city = encryptthis($city, $key);
$encrypt_state = encryptthis($state, $key);
$encrypt_zip = encryptthis($zip, $key);
$address = "INSERT INTO address (userID, engineID, groupID, address1, address2, city, state, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($address);
$stmt->bind_param("ssssssss", $patientID, $engineID, $groupID, $encrypt_address1, $encrypt_address2, $encrypt_city, $encrypt_state, $encrypt_zip);
$stmt->execute();

// Encrypt Patient's contact Data and insert
$encrypt_phone = encryptthis($phone, $key);
$encrypt_mobile = encryptthis($mobile, $key);
$encrypt_patient_email = encryptthis($patient_email, $key);
$contact = "INSERT INTO contact (userID, engineID, groupID, phone, mobile, email) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($contact);
$stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $encrypt_phone, $encrypt_mobile, $encrypt_patient_email);
$stmt->execute();

// Encrypt Patient's diversity Data and insert
$encrypt_dob = encryptthis($dob, $key);
$encrypt_gender = encryptthis($gender, $key);
$encrypt_race = encryptthis($race, $key);
$encrypt_ethnicity = encryptthis($ethnicity, $key);
$diversity = "INSERT INTO diversity (userID, engineID, groupID, dob, gender, race, ethnicity) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($diversity);
$stmt->bind_param("sssssss", $patientID, $engineID, $groupID, $encrypt_dob, $encrypt_gender, $encrypt_race, $encrypt_ethnicity);
$stmt->execute();

// Encrypt Activities Data and insert
$fullname = "$user_fname $user_lname";
$act_message = "$type: $fname $lname";
$encrypted_fullname = encryptthis($fullname, $key);
$encrypted_message = encryptthis($act_message, $key);
$activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activities);
$stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_message);
$stmt->execute();

// Insert keywords to engine table
$patient_fullname = "$fname $lname";
$engine = "INSERT INTO engine (engineID, groupID, keyword1, keyword2, keyword3, link) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($engine);
$stmt->bind_param("ssssss", $engineID, $groupID, $patient_fullname, $role, $groupID, $link);
$stmt->execute();

// Encrypt Patient's log Data and insert
$encrypt_activity = encryptthis($activity, $iz_key);
$patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($patientlog);
$stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypt_activity);
$stmt->execute();

// Insert to data_dob for count
$data_dob = "INSERT INTO data_dob (patientID, groupID, dob) VALUES (?, ?, ?)";
$stmt = $con->prepare($data_dob);
$stmt->bind_param("sss", $patientID, $groupID, $dob);
$stmt->execute();

// Insert to data_gender for count
$data_gender = "INSERT INTO data_gender (patientID, groupID, gender) VALUES (?, ?, ?)";
$stmt = $con->prepare($data_gender);
$stmt->bind_param("sss", $patientID, $groupID, $gender);
$stmt->execute();

// Insert to data_race for count
$data_race = "INSERT INTO data_race (patientID, groupID, race) VALUES (?, ?, ?)";
$stmt = $con->prepare($data_race);
$stmt->bind_param("sss", $patientID, $groupID, $race);
$stmt->execute();

// Insert to data_gender for count
$data_ethnicity = "INSERT INTO data_ethnicity (patientID, groupID, ethnicity) VALUES (?, ?, ?)";
$stmt = $con->prepare($data_ethnicity);
$stmt->bind_param("sss", $patientID, $groupID, $ethnicity);
$stmt->execute();
?>