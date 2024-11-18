<?php
session_start();
require_once('../../../initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
include(PRIVATE_MODELS_PATH . '/admin/sessions.php'); 

$userID = "null";
if(isset($DATA_OBJ->find->userid)){
    $userID = $DATA_OBJ->find->userid;
}

$sql = "SELECT * FROM chat WHERE (sender_ID='$myuserID' AND receiver_ID='$userID') OR (receiver_ID='$myuserID' AND sender_ID='$userID') ORDER BY id";
$sql_run = mysqli_query($con, $sql);
$select = mysqli_fetch_array($sql_run);

if(is_array($select)){

    foreach($sql_run as $row){
        $id = $row['id'];
        $sender_ID = $row['sender_ID'];
        $receiver_ID = $row['receiver_ID'];
        $msg_deleted = "1";

        if($myuserID == $sender_ID){
            $sql = "UPDATE chat SET sender_deleted=? WHERE id='$id' AND groupID='$groupID' LIMIT 1";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $msg_deleted);
            $stmt->execute();
        }
        if($myuserID == $receiver_ID){
            $sql = "UPDATE chat SET receiver_deleted=? WHERE id='$id' AND groupID='$groupID' LIMIT 1";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $msg_deleted);
            $stmt->execute();
        }

    }
}

?>