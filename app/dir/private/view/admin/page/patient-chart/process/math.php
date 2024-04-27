<?php

$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$patientID = mysqli_real_escape_string($con, $_GET['patientID']);

// Count Administered Hep B
$query = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='Hepatitis B' ";
$query_run = mysqli_query($con, $query);
$hepB_value = mysqli_fetch_assoc($query_run);
$hepB_count = round($hepB_value['count(*)'] / 3 * 100);

// Recommended date to administer the 2nd dose of Hep B
$query = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='Hepatitis B' ";
$query_run = mysqli_query($con, $query);
if(mysqli_num_rows($query_run) == 0){
    $message = "No Data Found";
}
if(mysqli_num_rows($query_run) > 0){
    $row = mysqli_fetch_assoc($query_run);
    $date = $row['date'];
    $date = strtotime("+2 months", strtotime($date));
    $date = date('m/d/Y',$date);
    $message = "2nd dose is due on $date";
}
if(mysqli_num_rows($query_run) == 2){
    $message = "Received 2nd dose";
}
if(mysqli_num_rows($query_run) == 3){
    $message = "Hepatitis B Series is Complete!";
}




?>