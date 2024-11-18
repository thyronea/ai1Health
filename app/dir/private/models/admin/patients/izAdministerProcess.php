<?php

$administer_iz = "INSERT INTO immunization (
uniqueID,
patientID,
groupID,
seriesID,
name,
dob,
type,
manufacturer,
vaccine,
lot,
ndc,
exp,
site,
route,
vis_given,
vis,
funding_source,
administered_by,
location,
comment,
value,
date,
time) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($administer_iz);
$stmt->bind_param("sssssssssssssssssssssss", $uniqueID, $patientID, $groupID, $shot, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_manufacturer, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
$exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_eligibility, $encrypt_administered_by, $encrypt_location, $encrypt_comment, $value, $date, $time);
$stmt->execute();
?>