<?php
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);

// Count Administered Hep B
$query = "SELECT count(*) FROM immunization WHERE groupID='$groupID' AND type='Hepatitis B' ";
$query_run = mysqli_query($con, $query);
$hepB_value = mysqli_fetch_assoc($query_run);
$hepB_count = round($hepB_value['count(*)'] / 3 * 100);
?>