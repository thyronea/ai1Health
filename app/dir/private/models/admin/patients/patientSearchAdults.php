<?php
$query = "SELECT * FROM patients INNER JOIN data_dob
ON patients.patientID=data_dob.patientID WHERE data_dob.groupID='$groupID' AND (YEAR(NOW()) - YEAR(data_dob.dob)) BETWEEN 19 AND 100";
$query_run = mysqli_query($con, $query);
$searchnum = mysqli_num_rows($query_run);

if($searchnum > 0){
  foreach ($query_run as $patient){
    $patient_dob = htmlspecialchars($patient['dob']);
    include('../../admin/patients/content/patient-box.php');
  }
}
else{
 ?>
   <tr>
     <td colspan="5" align="center"><small>No Data Found</small></td>
   </tr>
 <?php
}
?>