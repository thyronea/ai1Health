<?php
session_start();
include('../../../../../security/dbcon.php');

$mydata = 'Settings go here';

$info->message = $mydata;
$info->data_type = "settings";
echo json_encode($info);

?>