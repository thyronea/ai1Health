<?php

$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$patientID = mysqli_real_escape_string($con, $_GET['patientID']);

// Count Administered Hep B
$query = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='Hepatitis B' ";
$query_run = mysqli_query($con, $query);
$hepB_value = mysqli_fetch_assoc($query_run);
$hepB_count = round($hepB_value['count(*)'] / 3 * 100);

?>