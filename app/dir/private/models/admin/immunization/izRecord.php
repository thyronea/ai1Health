<?php
// IZ Record
if(isset($_GET['patientID'])){
    $iz_record = "SELECT * FROM immunization WHERE patientID='$patientID' ";
    $iz_record_run = mysqli_query($con, $iz_record);
    
    if(mysqli_num_rows($iz_record_run) > 0){
      foreach($iz_record_run as $iz_data){
        $iz_data_vaccine = htmlspecialchars(decryptthis($iz_data['vaccine'], $iz_key));
        $iz_data_lot = htmlspecialchars(decryptthis($iz_data['lot'], $iz_key));
        $iz_data_ndc = htmlspecialchars(decryptthis($iz_data['ndc'], $iz_key));
        $iz_data_site = htmlspecialchars(decryptthis($iz_data['lot'], $iz_key));
        $iz_data_route = htmlspecialchars(decryptthis($iz_data['route'], $iz_key));
        $iz_data_funding = htmlspecialchars(decryptthis($iz_data['funding_source'], $iz_key));
        $iz_data_exp = htmlspecialchars($iz_data['exp']);
        $iz_data_date = htmlspecialchars($iz_data['date']);
      }
    }
}
else{
    exit(0);
} 
?>