<?php
    $type = mysqli_real_escape_string($con, "Updated");
    $message = mysqli_real_escape_string($con, ": Password");
    $fullname = "$fname $lname";
    $act_message = "$type $fname $lname $message";
    $encrypt_fullname = encryptthis($fullname, $key);
    $encrypt_type = encryptthis($type, $key);
    $encrypt_act_message = encryptthis($act_message, $key);
    $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activity);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_act_message);
    $stmt->execute();
?>