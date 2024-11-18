<?php

$id = $_POST["x"];
$vaccine_info = "SELECT * FROM inventory WHERE groupID='$groupID' AND id='$id' ";
$vaccine_info_run = mysqli_query($con, $vaccine_info);

while($row = mysqli_fetch_array($vaccine_info_run)){
    $data['vaccines'] = $row["name"];
    $data['manufacturer'] = decryptthis($row["manufacturer"], $key);
    $data['lot'] = decryptthis($row["lot"], $key);
    $data['ndc'] = decryptthis($row["ndc"], $key);
    $data['exp'] = $row["exp"];
    $data['funding_source'] = $row["funding_source"];
}
echo json_encode($data);

?>