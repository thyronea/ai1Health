<?php
// Count total pdf
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$query = "SELECT count(*) FROM docs WHERE groupID='$groupID' AND type='pdf' ";
$query_run = mysqli_query($con, $query);
$pdf = mysqli_fetch_array($query_run);

// Count total word
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$query = "SELECT count(*) FROM docs WHERE groupID='$groupID' AND type='word' ";
$query_run = mysqli_query($con, $query);
$word = mysqli_fetch_array($query_run);

// Count total csv
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$query = "SELECT count(*) FROM docs WHERE groupID='$groupID' AND type='csv' ";
$query_run = mysqli_query($con, $query);
$csv = mysqli_fetch_array($query_run);

// Count total txt
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$query = "SELECT count(*) FROM docs WHERE groupID='$groupID' AND type='txt' ";
$query_run = mysqli_query($con, $query);
$txt = mysqli_fetch_array($query_run);

?>
