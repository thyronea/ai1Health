<?php
include(PRIVATE_SECURITY_PATH . '/dbcon.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
$userID = mysqli_real_escape_string($con, $_SESSION['userID']);
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);

if(isset($_GET['userID']))
{
  // Fetches patient's first name, last name, suffix and dob
  $patients_query = "SELECT * FROM profile WHERE userID='$userID' ";
  $patients_query_run = mysqli_query($con, $patients_query);
  $profile = mysqli_fetch_assoc($patients_query_run);
  $fname = htmlspecialchars($profile['fname']);
  $lname = htmlspecialchars($profile['lname']);
  $role = htmlspecialchars(decryptthis($profile['role'], $key));

  // Fetches user's diversity
  $diversity_query = "SELECT * FROM diversity WHERE userID='$userID' ";
  $diversity_query_run = mysqli_query($con, $diversity_query);
  $diversity = mysqli_fetch_assoc($diversity_query_run);
  $dob = htmlspecialchars(decryptthis($diversity['dob'], $key));
  $race = htmlspecialchars(decryptthis($diversity['race'], $key));
  $ethnicity = htmlspecialchars(decryptthis($diversity['ethnicity'], $key));
  $gender = htmlspecialchars($diversity['gender']);

  // Fetches user's address information
  $address_query = "SELECT * FROM address WHERE userID='$userID' ";
  $address_query_run = mysqli_query($con, $address_query);
  $address = mysqli_fetch_assoc($address_query_run);
  $address1 = htmlspecialchars(decryptthis($address['address1'], $key));
  $address2 = htmlspecialchars(decryptthis($address['address2'], $key));
  $city = htmlspecialchars(decryptthis($address['city'], $key));
  $state = htmlspecialchars(decryptthis($address['state'], $key));
  $zip = htmlspecialchars(decryptthis($address['zip'], $key));

  // Fetches user's contact information
  $contact_query = "SELECT * FROM contact WHERE userID='$userID' ";
  $contact_query_run = mysqli_query($con, $contact_query);
  $contact = mysqli_fetch_assoc($contact_query_run);
  $phone = htmlspecialchars(decryptthis($contact['phone'], $key));
  $mobile = htmlspecialchars(decryptthis($contact['mobile'], $key));
  $email = htmlspecialchars(decryptthis($contact['email'], $key));
}
?>
