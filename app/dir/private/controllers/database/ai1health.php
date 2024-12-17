<?php
// Create connection
$servername = "test"; 
$username = ""; 
$password = ""; 
$database = "";

$con = mysqli_connect($servername, $username, $password, $database);

// Check connection
if($con->connect_error){
  die("Connection failed: " . mysqli_connect_error());
}
