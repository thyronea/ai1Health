<?php
$verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
$verify_completion_run =  mysqli_query($con, $verify_completion);
?>