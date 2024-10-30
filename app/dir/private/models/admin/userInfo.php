<?php
if(isset($_GET['userID'])):{
  include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);

  $profile_query = "SELECT * FROM profile WHERE userID='$userID' ";
  $profile_query_run = mysqli_query($con, $profile_query);
  $profile = mysqli_fetch_assoc($profile_query_run);
  $fname = htmlspecialchars($profile['fname']);
  $lname = htmlspecialchars($profile['lname']);

  $diversity_query = "SELECT * FROM diversity WHERE userID='$userID' ";
  $diversity_query_run = mysqli_query($con, $diversity_query);
  $diversity = mysqli_fetch_assoc($diversity_query_run);
  $dob = htmlspecialchars(decryptthis($diversity['dob'], $key));
  $race = htmlspecialchars(decryptthis($diversity['race'], $key));
  $ethnicity = htmlspecialchars(decryptthis($diversity['ethnicity'], $key));
  $gender = htmlspecialchars(decryptthis($diversity['gender'], $key));

  $address_query = "SELECT * FROM address WHERE userID='$userID' ";
  $address_query_run = mysqli_query($con, $address_query);
  $address = mysqli_fetch_assoc($address_query_run);
  $address1 = htmlspecialchars(decryptthis($address['address1'], $key));
  $address2 = htmlspecialchars(decryptthis($address['address2'], $key));
  $city = htmlspecialchars(decryptthis($address['city'], $key));
  $state = htmlspecialchars(decryptthis($address['state'], $key));
  $zip = htmlspecialchars(decryptthis($address['zip'], $key));

  $contact_query = "SELECT * FROM contact WHERE userID='$userID' ";
  $contact_query_run = mysqli_query($con, $contact_query);
  $contact = mysqli_fetch_assoc($contact_query_run);
  $phone = htmlspecialchars(decryptthis($contact['phone'], $key));
  $mobile = htmlspecialchars(decryptthis($contact['mobile'], $key));
  $email = htmlspecialchars(decryptthis($contact['email'], $key));
}
else:{
  exit(0);
}
endif;
?>
