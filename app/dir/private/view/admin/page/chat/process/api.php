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
  include('../content/send-message.php');
}

function message_left($seen_msg, $received_msg, $fname, $decrypted_msg, $view_time, $view_date){
  $b = "
    <div id='message_left'>
    <div>";
    
    if($seen_msg){
      $b .= "<i class='bi bi-eye' style='color: green'></i>";
    }
    
    $b .= "</div>
      $fname:<br>
      $decrypted_msg<br>
      <span>$view_date $view_time</span> 
    </div>";

    return $b;  
}

function message_right($seen_msg, $received_msg, $my_fname, $decrypted_msg, $view_time, $view_date){
  $a = "
    <div id='message_right'>
    <div>";
    
    if($seen_msg){
      $a .= "<i class='bi bi-eye' style='color: green'></i>";
    }
    
    $a .= "</div>
      $my_fname:<br>
      $decrypted_msg<br>
      <span>$view_date $view_time</span> 
    </div>";

    return $a;
}

function message_controller(){
  return "
    </div>
    
    <div style='display: flex; width: 100%; height: 40px;'>
        <label for='message_file'>
            <svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-paperclip mt-2' viewBox='0 0 16 16' style='color: black; cursor: pointer;'>
                <path d='M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0z'/>
            </svg>
        </label>
        <input type='file' id='message_file' name='file' style='display: none;'/>
        <input type='text' id='message_text' onkeydown='enter(event)' style='flex: 6; border: solid thin #888' placeholder='Write message here...'/>
        <input type='button' style='flex: 1; cursor: pointer;' value='send' onclick='send_message(event)'/>
    </div>
  </div>";    
}

?>
