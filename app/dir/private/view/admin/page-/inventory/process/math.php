<?php
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);

////////////////////////////////// INVENTORY COUNT (per dose) //////////////////////////////////////////////

// Count COVID Pfizer
$query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' AND name='COVID-19 - Pfizer-BioNTech' ";
$query_run = mysqli_query($con, $query);
$pd_covid_pfizer = mysqli_fetch_array($query_run);

// Count Engerix B SDV
$query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' AND name='Hepatitis B - Engerix B Single Dose Vials' ";
$query_run = mysqli_query($con, $query);
$pd_engerix_sdv = mysqli_fetch_array($query_run);

// Count Rotarix SDV
$query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' AND name='RV - Rotarix Single Dose Vials' ";
$query_run = mysqli_query($con, $query);
$pd_rotarix_sdv = mysqli_fetch_array($query_run);

////////////////////////////////// INVENTORY COUNT (total by type) //////////////////////////////////////////////

// Count Private Vaccines
$query = "SELECT count(*) FROM inventory WHERE groupID='$groupID' AND funding_source='Private' ";
$query_run = mysqli_query($con, $query);
$private = mysqli_fetch_array($query_run);

// Count Public Vaccines
$query = "SELECT count(*) FROM inventory WHERE groupID='$groupID' AND funding_source='Public' ";
$query_run = mysqli_query($con, $query);
$public = mysqli_fetch_array($query_run);

?>
