<?php
    $patientID = htmlspecialchars($patient['patientID']);
    // $patientID = mysqli_real_escape_string($con, $_GET['patientID']);
    if(isset($_GET['patientID'])){
        $query = " SELECT * FROM profile_image WHERE userID='$patientID' ";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0 ) {
            foreach($result as $pic){
                ?>
                    <img src='../../../img/profile/<?php echo ($pic['filename'])?>' style='height: 130px; width: 130px;border-radius: 50%; object-fit:cover;'>
                <?php
            }
        }
    }
?>