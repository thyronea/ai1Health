<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);

if(isset($DATA_OBJ->find->userid)){
    $userID = $DATA_OBJ->find->userid;
    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
    $profile_query = "SELECT * FROM profile WHERE userID='$userID' AND groupID='$groupID' ";
    $profile_query_run = mysqli_query($con, $profile_query);
    $profile = mysqli_fetch_array($profile_query_run);

    $img_query = "SELECT * FROM profile_image WHERE userID='$userID' AND groupID='$groupID' ";
    $img_query_run = mysqli_query($con, $img_query);
    $img = mysqli_fetch_array($img_query_run);

    $myuserID = mysqli_real_escape_string($con, $_SESSION['userID']);
    $my_img_query = "SELECT * FROM profile_image WHERE userID='$myuserID' ";
    $my_img_query_run = mysqli_query($con, $my_img_query);
    $myimg = mysqli_fetch_array($my_img_query_run);

    $sender_ID = mysqli_real_escape_string($con, $_SESSION['userID']);
    $receiver_ID = $DATA_OBJ->find->userid;
    $message_query = "SELECT * FROM chat WHERE sender_ID='$sender_ID' AND receiver_ID='$receiver_ID' LIMIT 1";
    $message_query_run = mysqli_query($con, $message_query);
    $msg = mysqli_fetch_array($message_query_run);

    if($profile && $img && $myimg > 0){

        $fname = htmlspecialchars(decryptthis($profile['fname'], $key));
        $image = $img['filename'];
        $my_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
        $my_image = $myimg['filename'];

        if($msg == 0){
            $mydata = "
            Chatting with:
            <div id='active_contact'>
                <img src='../../../image/profile/$image'>
                $fname 
            </div>";
        
        $messages = "
            <div id='message_holder_parent' style='height: 540px;'>
                <div id='message_holder' style='height: 500px; overflow: auto'>
                    
                </div>
                
                <div style='display: flex; width: 100%; height: 40px;'>
                    <label for='file'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-paperclip mt-2' viewBox='0 0 16 16' style='color: black; cursor: pointer;'>
                            <path d='M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0z'/>
                        </svg>
                    </label>
                    <input type='file' id='message_file' name='file' style='display: none;'/>
                    <input type='text' id='message_text' style='flex: 6; border: solid thin #888' placeholder='Write message here...'/>
                    <input type='button' style='flex: 1; cursor: pointer;' value='send' onclick='send_message(event)'/>
                </div>
                
            </div>
            "; 
        }
        else {
        
            // Read sender's message from database
            $message_ID = $msg['message_ID'];  
            $send_message = "SELECT * FROM chat WHERE message_ID='$message_ID' AND sender_ID='$sender_ID' LIMIT 10";
            $send_message_run = mysqli_query($con, $send_message);
            $send_message_result = mysqli_fetch_array($send_message_run);
            $sender_message = $send_message_result['message'];

            // Read receiver's message from database
            $receive_message = "SELECT * FROM chat WHERE message_ID='$message_ID' AND receiver_ID='$receiver_ID' LIMIT 10";
            $receive_message_run = mysqli_query($con, $receive_message);
            $receive_message_result = mysqli_fetch_array($receive_message_run);
            $receiver_message = $receive_message_result['message'];

            // Read message from database
            $message = "SELECT * FROM chat WHERE message_ID='$message_ID' LIMIT 10";
            $message_run = mysqli_query($con, $receive_message);
            $message_result = mysqli_fetch_array($message_run);

            $mydata = "
                Chatting with:
                <div id='active_contact'>
                    <img src='../../../image/profile/$image'>
                    $fname 
                </div>";
            
            $messages = "
                <div id='message_holder_parent' style='height: 540px;'>
                    <div id='message_holder' style='height: 500px; overflow: auto'>";
                    
                        $messages .= message_left($image, $fname, $receiver_message);
                        $messages .= message_right($my_image, $my_fname, $sender_message);
                        
            $messages .= "
                    </div>
                    
                    <div style='display: flex; width: 100%; height: 40px;'>
                        <label for='file'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-paperclip mt-2' viewBox='0 0 16 16' style='color: black; cursor: pointer;'>
                                <path d='M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0z'/>
                            </svg>
                        </label>
                        <input type='file' id='message_file' name='file' style='display: none;'/>
                        <input type='text' id='message_text' style='flex: 6; border: solid thin #888' placeholder='Write message here...'/>
                        <input type='button' style='flex: 1; cursor: pointer;' value='send' onclick='send_message(event)'/>
                    </div>
                    
                </div>
                "; 
        }
               
        $info->user = $mydata;
        $info->messages = $messages;
        $info->data_type = "chat";
        echo json_encode($info);
    }
}
else{
    $info->message = "Contact not found!";
    $info->data_type = "chat";
    echo json_encode($info);
}
?>