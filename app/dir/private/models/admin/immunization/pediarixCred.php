<?php
$combo_type = mysqli_real_escape_string($con, $_POST['combo_type']);
$dtap_type = mysqli_real_escape_string($con, $_POST['dtap_type']);
$dtap_vis = mysqli_real_escape_string($con, $_POST['vis']);
$hepB_type = mysqli_real_escape_string($con, $_POST['hepB_type']);
$hepB_vis = mysqli_real_escape_string($con, $_POST['hepB_vis']);
$ipv_type = mysqli_real_escape_string($con, $_POST['ipv_type']);
$ipv_vis = mysqli_real_escape_string($con, $_POST['ipv_vis']);

$encrypt_dtap_vis = encryptthis_iz($dtap_vis, $iz_key);
$encrypt_hepB_vis = encryptthis_iz($hepB_vis, $iz_key);
$encrypt_ipv_vis = encryptthis_iz($ipv_vis, $iz_key);
?>