<?php
$patientID = htmlspecialchars($patient['patientID']);
$query = " SELECT * FROM profile_image WHERE userID='$patientID' ";
$query_run = mysqli_query($con, $query);
if(mysqli_num_rows($query_run) > 0 ) {
    foreach($query_run as $profile_img){
    ?>
      <img style="margin-left:-12px;width:50px;height:50px;border-radius:50%;" src="../../../img/profile/<?php echo $profile_img['filename'];?>">
    <?php
    }
}
?>