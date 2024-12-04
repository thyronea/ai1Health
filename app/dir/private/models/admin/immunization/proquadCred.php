<?php
$combo_type = mysqli_real_escape_string($con, $_POST['combo_type']);
$mmr_type = mysqli_real_escape_string($con, $_POST['mmr_type']);
$mmr_vis = mysqli_real_escape_string($con, $_POST['mmr_vis']);
$var_type = mysqli_real_escape_string($con, $_POST['var_type']);
$var_vis = mysqli_real_escape_string($con, $_POST['var_vis']);

$encrypt_mmr_vis = encryptthis_iz($mmr_vis, $iz_key);
$encrypt_var_vis = encryptthis_iz($var_vis, $iz_key);
?>