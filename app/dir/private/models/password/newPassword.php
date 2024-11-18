<?php
$password = mysqli_real_escape_string($con, $_POST["new_password"]); 
$newSalt = password_hash(SHA1(rand()), PASSWORD_BCRYPT);
$salted_password = "$password$newSalt"; 
$new_password = password_hash($salted_password, PASSWORD_DEFAULT); 
$token = mysqli_real_escape_string($con, $_POST['token']);
?>