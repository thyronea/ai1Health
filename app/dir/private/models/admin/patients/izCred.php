<?php
// Patient's information
$patientID = mysqli_real_escape_string($con, $_POST['patientID']);
$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$patient_fname = mysqli_real_escape_string($con, $_POST['patient_fname']);
$patient_lname = mysqli_real_escape_string($con, $_POST['patient_lname']);
$patient_dob = mysqli_real_escape_string($con, $_POST['patient_dob']);

// Vaccine's information
$vaccineID = mysqli_real_escape_string($con, $_POST['id']);
$uniqueID = mysqli_real_escape_string($con, $_POST['uniqueID']);
$vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
$manufacturer = mysqli_real_escape_string($con, $_POST['manufacturer']);
$type = mysqli_real_escape_string($con, $_POST['type']);
$lot = mysqli_real_escape_string($con, $_POST['lot']);
$ndc = mysqli_real_escape_string($con, $_POST['ndc']);
$exp = mysqli_real_escape_string($con, $_POST['exp']);
$site = mysqli_real_escape_string($con, $_POST['site']);
$route = mysqli_real_escape_string($con, $_POST['route']);
$vis = mysqli_real_escape_string($con, $_POST['vis']);
$vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
$funding_source = mysqli_real_escape_string($con, $_POST['funding']);
$eligibility = mysqli_real_escape_string($con, $_POST['eligibility']);
$administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
$comment = mysqli_real_escape_string($con, $_POST['comment']);
$date = mysqli_real_escape_string($con, $_POST['date']);
$time = mysqli_real_escape_string($con, $_POST['time']);
$value = mysqli_real_escape_string($con, "1");
$shot = mysqli_real_escape_string($con, "1");
$othershot = mysqli_real_escape_string($con, "0");

// Encrypt Admin Log Data
$fullname = "$fname $lname";
$patientFullname = "$patient_fname $patient_lname";
$administered = htmlspecialchars("Administered");

// encrypt data and insert to immunizaton table
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_patient_name = encryptthis_iz($patientFullname, $iz_key);
$encrypt_dob = encryptthis_iz($patient_dob, $iz_key);
$encrypt_type = encryptthis_iz($type, $iz_key);
$encrypt_manufacturer = encryptthis_iz($manufacturer, $iz_key);
$encrypt_vaccine = encryptthis_iz($vaccine, $iz_key);
$encrypt_lot = encryptthis_iz($lot, $iz_key);
$encrypt_ndc = encryptthis_iz($ndc, $iz_key);
$encrypt_exp = encryptthis_iz($exp, $iz_key);
$encrypt_site = encryptthis_iz($site, $iz_key);
$encrypt_route = encryptthis_iz($route, $iz_key);
$encrypt_vis_given = encryptthis_iz($vis_given, $iz_key);
$encrypt_vis = encryptthis_iz($vis, $iz_key);
$encrypt_eligibility = encryptthis_iz($eligibility, $iz_key);
$encrypt_administered_by = encryptthis_iz($administered_by, $iz_key);
$encrypt_location = encryptthis_iz($location, $iz_key);
$encrypt_comment = encryptthis_iz($comment, $iz_key);

// Administered vaccine message
$administeredMessage = "$administered $vaccine ($lot) to $patientFullname";
$encrypted_administeredMessage = encryptthis($administeredMessage, $key);
?>