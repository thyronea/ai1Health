<?php
// Fetch array
$row = mysqli_fetch_array($verify_query_run);
// If account status is not verified, continue
if($row['status'] == "0"){

    // Use TOKEN to verify account, then update PROFILE status to 1 (verified)
    $clicked_token = $row['token'];
    $update_token_status = "UPDATE token SET status ='1' WHERE token='$clicked_token' LIMIT 1";
    $update_token_status_run = mysqli_query($con, $update_token_status);

    // Retrieves USERID for verification using TOKEN
    $getID = "SELECT * FROM token WHERE token='$clicked_token'";
    $getID_run = mysqli_query($con, $getID);
    $get_userID = mysqli_fetch_array($getID_run);
    $patientUserID = mysqli_real_escape_string($con, $get_userID["userID"]);
    
    // Updates PATIENTS status to 'Verified' using USERID to search
    $update_query = "UPDATE patients SET account_status ='Verified' WHERE patientID='$patientUserID' LIMIT 1";
    $update_query_run = mysqli_query($con, $update_query);

    if($update_query_run){
        $_SESSION['success'] = "Your account has been verified!";
        header("Location: /system/view/create-pw/?token=$token");
        exit(0);
    }
    else{
        $_SESSION['warning'] = "Verification failed!";
        header("Location: /system/view/create-pw/?token=$token");
        exit(0);
    }
    
}
else{
    $_SESSION['warning'] = "Email already verified! Please log in.";
    header("Location: /system/view/access/");
    exit(0);
}
?>