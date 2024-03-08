<?php
session_start();
include('../../../../security/dbcon.php');

$info = (object)[];

    $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
    $query = "SELECT * FROM profile WHERE userID='$userID' ";
    $query_run = mysqli_query($con, $query);
    $result = mysqli_fetch_array($query_run);

    if(is_array($result)) {
        $result = $result[0];
        $result->data_type = "user_info";
        echo json_encode($result);
    }

?>