<?php
    $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
    $query = " SELECT * FROM profile_image WHERE userID='$userID' ";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0 ) {
        foreach($result as $pic){
            ?>
                <a href="../../../img/profile/<?=$pic['filename'];?>" target="_blank">
                    <img src="../../../img/profile/<?php echo $pic['filename'];?>" style="width:168px;height:168px;border-radius:50%;object-fit:cover;">
                </a>
            <?php
        }
    }
?>