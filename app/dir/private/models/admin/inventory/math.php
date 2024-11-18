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

// Sum of public vaccines
$query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' AND funding_source='Public' ";
$query_run = mysqli_query($con, $query);
$sumPublic = mysqli_fetch_assoc($query_run);

// Sum of private vaccines
$query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' AND funding_source='Private' ";
$query_run = mysqli_query($con, $query);
$sumPrivate = mysqli_fetch_assoc($query_run);

// Sum of ALL vaccines
$query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' ";
$query_run = mysqli_query($con, $query);
$sumAll = mysqli_fetch_assoc($query_run);

// Total Daptacel
$query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' AND name='Daptacel Single Dose Vials' ";
$query_run = mysqli_query($con, $query);
$daptacel = mysqli_fetch_array($query_run);

// Total Infanrix SDV
$query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' AND name='Infanrix Single Dose Vials' ";
$query_run = mysqli_query($con, $query);
$infanrixSDV = mysqli_fetch_array($query_run);

// Total Infanrix SDS
$query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' AND name='Infanrix Single Dose Syringes' ";
$query_run = mysqli_query($con, $query);
$infanrixSDS = mysqli_fetch_array($query_run);

// Total Kinrix SDV
$query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' AND name='Kinrix Single Dose Vials' ";
$query_run = mysqli_query($con, $query);
$kinrixSDV = mysqli_fetch_array($query_run);

// Total Kinrix SDS
$query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' AND name='Kinrix Single Dose Syringes' ";
$query_run = mysqli_query($con, $query);
$kinrixSDS = mysqli_fetch_array($query_run);

// Total Quadracel SDV
$query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' AND name='Quadracel Single Dose Vials' ";
$query_run = mysqli_query($con, $query);
$quadracelSDV = mysqli_fetch_array($query_run);

// Total Quadracel SDS
$query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' AND name='Quadracel Single Dose Syringes' ";
$query_run = mysqli_query($con, $query);
$quadracelSDS = mysqli_fetch_array($query_run);

// Total Pediarix SDV
$query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' AND name='Pediarix Single Dose Syringes' ";
$query_run = mysqli_query($con, $query);
$pediarixSDV = mysqli_fetch_array($query_run);

// Total Pentacel SDS
$query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' AND name='Pentacel Single Dose Vials' ";
$query_run = mysqli_query($con, $query);
$pentacelSDS = mysqli_fetch_array($query_run);

?>
