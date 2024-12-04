<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$myuserID = mysqli_real_escape_string($con, $_SESSION['userID']);

$mydata = 
'<div class="mt-3" style="text-align: center;">';

    $query = " SELECT profile_image.filename, profile.userID, profile.fname FROM profile_image INNER JOIN profile 
    ON profile_image.userID=profile.userID WHERE profile.groupID='$groupID' AND profile.userID!='$myuserID' ";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0){

        // Check for new messages
        $msg = array();
        $sql = "SELECT * FROM chat WHERE receiver_ID='$myuserID' AND received='0' ";
        $sql_run = mysqli_query($con, $sql);

        if(mysqli_num_rows($sql_run) > 0){
            foreach($sql_run as $row){
                $sender = htmlspecialchars($row['sender_ID']);
                
                if(isset($msg[$sender])){
                    $msg[$sender]++;
                }
                else{
                    $msg[$sender] = 1;
                }
            }
        }
        
        foreach($query_run as $profile){
            
            $id = htmlspecialchars($profile['userID']);
            $image = htmlspecialchars($profile['filename']);
            $fname = htmlspecialchars($profile['fname']);
            
            $new_message = false;
            
            $mydata .= "   
             <div id='contacts' style='position: relative;' userid='$id' onclick='start_chat(event)'>
                <img src='../../../image/profile/$image'>
                <br>$fname";

                if(count($msg) > 0 && isset($msg[$id])){
                    $mydata .= "<div style='width: 20px; height: 20px; border-radius: 50%; background-color: orange; color: white; position: absolute; left: 35px; top: 0px;'>$msg[$id]</div>";
                }

            $mydata .= "    
            </div>";
        }
    }

$mydata .= '
</div>';

$info->message = $mydata;
$info->data_type = "contacts";
echo json_encode($info);

?>