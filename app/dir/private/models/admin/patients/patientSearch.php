<?php
    $query = "SELECT * FROM patients INNER JOIN data_dob
    ON patients.patientID=data_dob.patientID WHERE data_dob.groupID='$groupID' ";
    $query_run = mysqli_query($con, $query);
    $searchnum = mysqli_num_rows($query_run);

    if($searchnum > 0){
        foreach ($query_run as $patient){

            $patientID = htmlspecialchars($patient['patientID']);
            $patientFname = htmlspecialchars(decryptthis($patient['fname'], $key));
            $patientLname = htmlspecialchars(decryptthis($patient['lname'], $key));
            $patientEmail = htmlspecialchars(decryptthis($patient['email'], $key));
            $patient_dob = htmlspecialchars($patient['dob']);
            
            $date = date('Y') . '-' . date('m') . '-' . date('d');
            $year = (date('Y') - date('Y', strtotime($patient_dob)));
            $dob = (date('m', strtotime($patient_dob)) . '/' . date('d', strtotime($patient_dob)) . '/' . date('Y', strtotime($patient_dob)));
            
            include(ADMIN_PATIENTS . '/content/patient-box.php');
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