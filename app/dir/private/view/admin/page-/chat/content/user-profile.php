<div id="user_info" style="padding: 10px;">

    <?php
        $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
        $query = " SELECT * FROM profile_image WHERE userID='$userID' ";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0 ) {
            foreach($result as $profile_img){
            ?>
                <a href="../../../image/profile/<?=$profile_img['filename'];?>" target="_blank">
                    <img id="profile_image" src="../../../image/profile/<?php echo $profile_img['filename'];?>">
                </a>
            <?php
            }
        }
    ?><br>

    <span id="username">
        <a href="../../../../view/profile/index.php?userID=<?=$_SESSION['userID'];?>" target="_blank" style="color:white; text-decoration: none">
            <?=$_SESSION['fname'];?>
        </a>
    </span><br>

    

    <br>
    <br>
    <br>

    <div>
        <label id="label_chat" for="radio_chat">Chat <i class="bi bi-chat-dots float-end"></i></label>
        <label id="label_contacts" for="radio_contacts">Contacts <i class="bi bi-people float-end"></i></label>
    </div>

</div>