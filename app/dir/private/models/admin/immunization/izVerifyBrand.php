<?php
$verify_brand = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
$verify_brand_run =  mysqli_query($con, $verify_brand);
$row = mysqli_fetch_assoc($verify_brand_run);
$brand = htmlspecialchars(decryptthis($row['vaccine'], $iz_key));
?>