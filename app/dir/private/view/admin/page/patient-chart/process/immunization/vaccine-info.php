<?php
session_start();
include('../../../../../../security/dbcon.php');
include('../../../../../../security/encrypt_decrypt.php');
require '../../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);  
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$id = $_POST["x"];
$vaccine_info = "SELECT * FROM inventory WHERE groupID='$groupID' AND id='$id' ";
$vaccine_info_run = mysqli_query($con, $vaccine_info);
while($row = mysqli_fetch_array($vaccine_info_run)){
    $data['vaccines'] = $row["name"];
    $data['lot'] = decryptthis($row["lot"], $key);
    $data['ndc'] = decryptthis($row["ndc"], $key);
    $data['exp'] = $row["exp"];
    $data['funding_source'] = $row["funding_source"];
}
echo json_encode($data);

?>