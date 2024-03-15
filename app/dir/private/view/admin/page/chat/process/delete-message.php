<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$myuserID = mysqli_real_escape_string($con, $_SESSION['userID']);

$rowID = "null";
if(isset($DATA_OBJ->find->rowid)){
    $rowID = $DATA_OBJ->find->rowid;
}

$sql = "SELECT * FROM chat WHERE id='$rowID' AND groupID='$groupID' LIMIT 1";
$sql_run = mysqli_query($con, $sql);
$select = mysqli_fetch_array($sql_run);

if(is_array($select)){
    if($myuserID == $select['sender_ID']){
        $sender_deleted = "1";
        $sql = "UPDATE chat SET sender_deleted=? WHERE id='$rowID' AND groupID='$groupID' LIMIT 1";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $sender_deleted);
        $stmt->execute();
    }
    if($myuserID == $select['receiver_ID']){
        $receiver_deleted = "1";
        $sql = "UPDATE chat SET receiver_deleted=? WHERE id='$rowID' AND groupID='$groupID' LIMIT 1";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $receiver_deleted);
        $stmt->execute();
    }
}

?>