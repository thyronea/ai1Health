<?php
// Display patient name from database to snapshot
if(isset($_GET['patientID'])){
    $query = "SELECT * FROM patients WHERE patientID='$patientID' AND groupID='$groupID' ";
    $query_run = mysqli_query($con, $query);
  
    if(mysqli_num_rows($query_run) > 0)
    {
      $patients = mysqli_fetch_array($query_run);
      foreach($query_run as $patient){
        $patientFname = htmlspecialchars(decryptthis($patient['fname'], $key));
        $patientLname = htmlspecialchars(decryptthis($patient['lname'], $key));
        $patientDob = htmlspecialchars(decryptthis($patient['dob'], $key));
        $patientDob = date('m/d/Y',strtotime($patientDob));
        $patientSuffix = htmlspecialchars(decryptthis($patient['suffix'], $key));
        $patientEmail = htmlspecialchars(decryptthis($patient['email'], $key));
        $patientRole = htmlspecialchars(decryptthis($patient['role'], $key));
        $patientStatus = htmlspecialchars($patient['account_status']);
      }
    }
  } 
  else{
    exit(0);
  } 
  
  // Display patient's health plan from database to snapshot
  if(isset($_GET['patientID'])){ 
    $query = "SELECT * FROM healthplan WHERE patientID='$patientID' AND groupID='$groupID' ";
    $query_run = mysqli_query($con, $query);
  
    if(mysqli_num_rows($query_run) > 0)
    {
      $plans = mysqli_fetch_array($query_run);
      foreach($query_run as $plan){}
    }
  }
  else{
    exit(0);
  } 
  
  // Display patient diversity from database to snapshot
  if(isset($_GET['patientID'])){
    $query = "SELECT * FROM diversity WHERE userID='$patientID' AND groupID='$groupID' ";
    $query_run = mysqli_query($con, $query);
  
    if(mysqli_num_rows($query_run) > 0)
    {
      $diverse = mysqli_fetch_array($query_run);
      foreach($query_run as $diversity){}
    }
  }
  else{
    exit(0);
  } 
  
  // Display patient address from database to snapshot
  if(isset($_GET['patientID'])){
    $query = "SELECT * FROM address WHERE userID='$patientID' AND groupID='$groupID' ";
    $query_run = mysqli_query($con, $query);
  
    if(mysqli_num_rows($query_run) > 0)
    {
      $add = mysqli_fetch_array($query_run);
      foreach($query_run as $address){}
    }
  }
  else{
    exit(0);
  } 
  
  // Display patient contact from database to snapshot
  if(isset($_GET['patientID'])){
    $query = "SELECT * FROM contact WHERE userID='$patientID' AND groupID='$groupID' ";
    $query_run = mysqli_query($con, $query);
  
    if(mysqli_num_rows($query_run) > 0)
    {
      $contacts = mysqli_fetch_array($query_run);
      foreach($query_run as $contact){}
    }
  }
  else{
    exit(0);
  } 
  
  // Display patient's emergency contact from database to demographic
  if(isset($_GET['patientID'])){
    $query = "SELECT * FROM emergency_contact WHERE patientID='$patientID' AND groupID='$groupID' ";
    $query_run = mysqli_query($con, $query);
  
    if(mysqli_num_rows($query_run) > 0)
    {
      $emergency = mysqli_fetch_array($query_run);
      foreach($query_run as $emergency_contact){}
    }
  }
  else{
    exit(0);
  } 
  
  // Display patient's profile image
  if(isset($_GET['patientID'])){
    $query = "SELECT * FROM profile_image WHERE userID='$patientID' AND groupID='$groupID' ";
    $query_run = mysqli_query($con, $query);
  
    if(mysqli_num_rows($query_run) > 0)
    {
      $emergency = mysqli_fetch_array($query_run);
      foreach($query_run as $image){}
    }
}
else{
    exit(0);
} 
?>