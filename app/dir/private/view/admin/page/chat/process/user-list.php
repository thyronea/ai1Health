<?php
    // Database connection
    include('../../../../security/dbcon.php');

    // Query will select user's profile information within the group ID except the current user
    $myID = mysqli_real_escape_string($con, $_SESSION['userID']);
    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
    $sql = "SELECT * FROM profile WHERE groupID='$groupID' AND userID!='$myID' ";
    $sql_run = mysqli_query($con, $sql);

    while ($user = mysqli_fetch_array($sql_run)) {
        $userID = $user['userID'];
        $engineID = $user['engineID'];
        $groupID = $user['groupID'];
        $fname = decryptthis($user['fname'], $key);
        $lname = decryptthis($user['lname'], $key);
        $email = decryptthis($user['email'], $key);
        $role = decryptthis($user['role'], $key);
        $online = $user['online'];    

    ?>
        <li>
            <!-- Query result will show the following information: -->
            <div>
                <!-- User's image will be selected from the profile_image table via $userID -->
                <?php
                    $query = " SELECT * FROM profile_image WHERE userID='$userID' ";
                    $query_run = mysqli_query($con, $query);
                    while ($profile_img = mysqli_fetch_array($query_run)) {
                        ?>
                            <img id="user_list_image" src="../../../image/profile/<?php echo $profile_img['filename'];?>">
                        <?php
                    }
                ?>

                <!-- User's Online Status -->
                <?php
                    if($online == "1"){
                        ?>
                            <span><i class='fa fa-circle fa-xs' aria-hidden='true' style="color: green;"></i></span>
                        <?php
                    }
                    else {
                        ?>
                            <span><i class='fa fa-circle fa-xs' aria-hidden='true' style="color: red;"></i></span>
                        <?php
                   }
                ?>
                <!-- User's Name -->
                <a href="index.php?userID=<?=$userID;?>" style="color: #ffffff; text-decoration: none"><?=$fname;?></a>    
            </div>
        </li>
    <?php
    }
?>   
    