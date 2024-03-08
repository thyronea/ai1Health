<?php 
    if(isset($_GET['userID'])){
        $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
        $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
        $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
        $get_userID = $_GET['userID'];
        $sql = "SELECT * FROM profile WHERE userID='$get_userID' AND groupID='$groupID' ";
        $query = mysqli_query($con, $sql);
        $chat_user = mysqli_fetch_array($query); 
        $chat_userID = $chat_user['userID'];
        $chat_fname = decryptthis($chat_user['fname'], $key);
        $chat_lname = decryptthis($chat_user['lname'], $key);
    }

    $messages = "SELECT * FROM chat WHERE (sender_ID='$userID' AND receiver_ID='$chat_userID' ) 
    OR (receiver_ID='$userID' AND sender_ID='$chat_userID')";
    $run_messages = mysqli_query($con, $messages);
    $total = mysqli_num_rows($run_messages);
?>