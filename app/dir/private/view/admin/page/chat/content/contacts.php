<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);

$mydata = 
'<div class="mt-3" style="text-align: center;">';

    $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
    $query = " SELECT profile_image.filename, profile.userID, profile.fname
    FROM profile_image
    INNER JOIN profile 
    ON profile_image.userID=profile.userID WHERE profile.groupID='$groupID' AND profile.userID!='$userID' ";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0){
        
        foreach($query_run as $profile){
            
            $id = $profile['userID'];
            $image = $profile['filename'];
            $fname = htmlspecialchars(decryptthis($profile['fname'], $key));
            

            $mydata .="   
             <div id='contacts' userid='$id' onclick='start_chat(event)'>
                <img src='../../../image/profile/$image'>
                <br>$fname 
            </div>";
        }
    }

$mydata .= '
</div>';

$info->message = $mydata;
$info->data_type = "contacts";
echo json_encode($info);

?>