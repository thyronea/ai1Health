<?php
$token = md5(rand());
$salt = md5(rand());

$user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
$user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);

$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$patientID = mysqli_real_escape_string($con, $_POST['patientID']);
$uniqueID = mysqli_real_escape_string($con, $_POST['uniqueID']);

$date = mysqli_real_escape_string($con, $_POST['date']);
$time = mysqli_real_escape_string($con, $_POST['time']);

$fname = mysqli_real_escape_string($con, $_POST['fname']);
$lname = mysqli_real_escape_string($con, $_POST['lname']);
$suffix = mysqli_real_escape_string($con, $_POST['suffix']);

$dob = mysqli_real_escape_string($con, $_POST['dob']);
$gender = mysqli_real_escape_string($con, $_POST['gender']);
$race = mysqli_real_escape_string($con, $_POST['race']);
$ethnicity = mysqli_real_escape_string($con, $_POST['ethnicity']);

$address1 = mysqli_real_escape_string($con, $_POST['address1']);
$address2 = mysqli_real_escape_string($con, $_POST['address2']);
$city = mysqli_real_escape_string($con, $_POST['city']);
$state = mysqli_real_escape_string($con, $_POST['state']);
$zip = mysqli_real_escape_string($con, $_POST['zip']);

$phone = mysqli_real_escape_string($con, $_POST['phone']);
$mobile = mysqli_real_escape_string($con, $_POST['mobile']);
$patient_email = mysqli_real_escape_string($con, $_POST['email']);

$role = mysqli_real_escape_string($con, $_POST['role']);
$type = mysqli_real_escape_string($con, "Registered Patient");
$admin = mysqli_real_escape_string($con, "Admin");
$activity = mysqli_real_escape_string($con, "Account Created");

$patient_image = mysqli_real_escape_string($con, $_FILES['patient_image']['name']);
$filename = mysqli_real_escape_string($con, "default-profile-pic.jpeg");

$background_filename = mysqli_real_escape_string($con, "default-background.jpg");
$link = mysqli_real_escape_string($con, "/private/view/admin/patient-chart/?patientID=$patientID");
$subject = mysqli_real_escape_string($con, "Patient Registration Confirmation");
$message = htmlspecialchars("
Hello $fname,

Your Patient ID is $patientID.

TO COMPLETE YOUR REGISTRATION, PLEASE CLICK ON THE LINK BELOW:

http://localhost/private/controllers/admin/patientsController.php?token=$token

Please DO NOT share your Patient ID.
If you did not register, please contact admin.

Thank you!
");

// Check if patient's information exist
$checkpatient = "SELECT * FROM patients WHERE fname='$fname' AND email='$patient_email' OR lname='$lname' AND email='$patient_email' OR dob='$dob' AND email='$patient_email'";
$checkpatient_run = mysqli_query($con, $checkpatient);
?>