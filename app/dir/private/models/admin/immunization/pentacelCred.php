<?php
$combo_type = mysqli_real_escape_string($con, $_POST['combo_type']);
$dtap_type = mysqli_real_escape_string($con, $_POST['dtap_type']);
$dtap_vis = mysqli_real_escape_string($con, $_POST['dtap_vis']);
$ipv_type = mysqli_real_escape_string($con, $_POST['ipv_type']);
$ipv_vis = mysqli_real_escape_string($con, $_POST['ipv_vis']);
$hib_type = mysqli_real_escape_string($con, $_POST['hib_type']);
$hib_vis = mysqli_real_escape_string($con, $_POST['hib_vis']);

$encrypt_dtap_vis = encryptthis_iz($dtap_vis, $iz_key);
$encrypt_hib_vis = encryptthis_iz($hib_vis, $iz_key);
$encrypt_ipv_vis = encryptthis_iz($ipv_vis, $iz_key);
?>