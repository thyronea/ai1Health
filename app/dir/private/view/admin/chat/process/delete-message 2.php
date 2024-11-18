<?php
session_start();
require_once('../../../initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
include(PRIVATE_MODELS_PATH . '/admin/sessions.php'); 

$rowID = "null";
if(isset($DATA_OBJ->find->rowid)){
    $rowID = $DATA_OBJ->find->rowid;
}

$sql = "SELECT * FROM chat WHERE id='$rowID' AND groupID='$groupID' LIMIT 1";
$sql_run = mysqli_query($con, $sql);
$select = mysqli_fetch_array($sql_run);
$msg_deleted = "1";

if(is_array($select)){
    if($myuserID == $select['sender_ID']){
        $sender_deleted = "1";
        $sql = "UPDATE chat SET sender_deleted=? WHERE id='$rowID' AND groupID='$groupID' LIMIT 1";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $msg_deleted);
        $stmt->execute();
    }
    if($myuserID == $select['receiver_ID']){
        $sql = "UPDATE chat SET receiver_deleted=? WHERE id='$rowID' AND groupID='$groupID' LIMIT 1";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $msg_deleted);
        $stmt->execute();
    }
}

?>