<?php
$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);

$info = (object)[];

// Update vcode
if(isset($_SESSION["userID"])){
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $new_vcode = rand(1000,9999); // Generates random verification token
  $update_vcode = "UPDATE token SET v_code='$new_vcode' WHERE userID='$userID' ";
  $update_vcode_run = mysqli_query($con, $update_vcode);
}
elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "user_info"){
  include('user-info.php');
}
elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "contacts"){
  include('../content/contacts.php');
}
elseif(isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == "chat" || $DATA_OBJ->data_type == "chat_refresh")){
  include('../content/chat.php');
}
elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "settings"){
  include('../content/settings.php');
}
elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "send_message"){
  include('../process/send-message.php');
}
elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "delete_message"){
  include('../process/delete-message.php');
}
elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "delete_thread"){
  include('../process/delete-thread.php');
}

function message_left($chat_id, $seen_msg, $received_msg, $fname, $decrypted_msg, $view_time, $view_date){
  $b = "
    <div id='message_left'>
    <div>";
    
    if($seen_msg){
      $b .= "<i class='bi bi-eye fa-sm' style='color: green' title='Seen'></i>";
    }
    
    $b .= "</div>
      $fname:<br>
      $decrypted_msg<br>
      <span>$view_date $view_time</span> 
      <i id='trash' class='bi bi-trash' onclick='delete_message(event)' msgid='$chat_id' style='font-size: 0.75em;' title='Delete message'></i>
    </div>";

    return $b;  
}

function message_right($chat_id, $seen_msg, $received_msg, $my_fname, $decrypted_msg, $view_time, $view_date){
  $a = "
    <div id='message_right'>
    <div>";
    
    if($seen_msg){
      $a .= "<i class='bi bi-eye fa-sm' style='color: green' title='Seen'></i>";
    }
    
    $a .= "</div>
      $my_fname:<br>
      $decrypted_msg<br>
      <span>$view_date $view_time</span> 
      <i id='trash' class='bi bi-trash' onclick='delete_message(event)' msgid='$chat_id' style='font-size: 0.75em;' title='Delete message'></i>
    </div>";

    return $a;
}

function message_controller(){
  return "
    </div>
    <div style='display: flex; width: 100%; height: 40px;'>
        <span class='mt-2' onclick='delete_thread(event)' style='color: grey; cursor: pointer;' title='Delete Thread'>
          <svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
            <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z'/>
            <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z'/>
          </svg>
        </span>
        <label for='message_file' title='Attachment'>
            <svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-paperclip mt-2' viewBox='0 0 16 16' style='color: grey; cursor: pointer;'>
                <path d='M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0z'/>
            </svg>
        </label>
        <input type='file' id='message_file' onchange='send_image(this.files)' name='file' style='display: none;'/>
        <input type='text' id='message_text' onkeydown='enter(event)' style='flex: 6; border: solid thin #888' placeholder='Write message here...'/>
        <input type='button' style='flex: 1; cursor: pointer;' value='send' onclick='send_message(event)'/>
    </div>
  </div>";    
}

?>
