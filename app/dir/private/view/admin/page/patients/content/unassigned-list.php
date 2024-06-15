<?php
    $unassigned = mysqli_real_escape_string($con, "1111111");
    $query = "SELECT * FROM patients INNER JOIN data_dob
    ON patients.patientID=data_dob.patientID WHERE data_dob.groupID='$unassigned'";
    $query_run = mysqli_query($con, $query);
    $searchnum = mysqli_num_rows($query_run);
    if($searchnum > 0)
    {
        foreach ($query_run as $patient){  
            $patient_dob = htmlspecialchars($patient['dob']);
            ?>
                <tr>
                    <td hidden><a type="button"class="text-decoration-none" style="color: black"><small><?=htmlspecialchars($patient['engineID']);?></small></a></td>
                    <td hidden><a class="text-decoration-none" style="color: black"><small><?= htmlspecialchars($patient['patientID']);?></small></a></td>
                    <td hidden><a type="button" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars($patient['fname']);?> <?=htmlspecialchars($patient['lname']);?></small></a></td>
                    <td hidden><a class="text-decoration-none" style="color: black"><small><?= htmlspecialchars($patient['email']); ?></small></a></td>
                    <td hidden><a class="text-decoration-none" style="color: black"><small><?= htmlspecialchars($patient['account_status']); ?></small></a></td>
                    <td hidden><a type="button" class="focus-ring text-decoration-none" style="color: black"><i class="bi bi-universal-access-circle"></i></a></td>
                    <td hidden><button type="button" class="focus-ring btn-outline-secondary btn btn-sm assignPatient" data-bs-toggle="modal" data-bs-target="#assignPatient">Assign <i class="bi bi-person-plus"></i></i></button></td>
                </tr>
                <tr>
                    <td hidden><a type="button" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars($patient['engineID']);?></small></a></td>
                    <td hidden><a type="button" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars($patient['patientID']);?></small></a></td>
                    <td>
                        <div class="card shadow" id="patients">
                            <div class="card-body">
                                <button type="button" href="../patient-chart/index.php?patientID=<?=htmlspecialchars($patient['patientID']);?>" class="btn border-0 text-decoration-none" style="color: black" disabled>
                                    <small>
                                    <div class="row" style="padding-left:15px;">
                                        <div class="col border" style="width:50px;height:50px;border-radius:50%;overflow:hidden">
                                            <?php
                                                $date = date('Y') . '-' . date('m') . '-' . date('d');
                                                $year = (date('Y') - date('Y', strtotime($patient_dob)));
                                                $dob = (date('m', strtotime($patient_dob)) . '/' . date('d', strtotime($patient_dob)) . '/' . date('Y', strtotime($patient_dob)));

                                                $userID = htmlspecialchars($patient['patientID']);
                                                $query = " SELECT * FROM profile_image WHERE userID='$userID' ";
                                                $result = mysqli_query($con, $query);
                                                if(mysqli_num_rows($result) > 0 ) {
                                                    foreach($result as $profile_img){
                                                    ?>
                                                    <img style="margin-left:-13px;width:50px;height:50px;border-radius:50%;" src="../../../image/profile/<?php echo $profile_img['filename'];?>">
                                                    <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                        <div class="col">
                                            <?= htmlspecialchars($patient['patientID']);?><br>
                                            <small><?=htmlspecialchars($dob);?> (<?=htmlspecialchars($year);?> years old)</small>
                                        </div>
                                    </div>
                                    </small>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td hidden><a type="button" href="../patient-chart/index.php?patientID=<?=htmlspecialchars($patient['patientID']);?>" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars(decryptthis($patient['email'], $key));?></small></a></td>
                    <td><button type="button" class="focus-ring border btn btn-sm shadow assignPatient" data-bs-toggle="modal" data-bs-target="#assignPatient" id="patients">Assign <i class="bi bi-person-plus"></i></button></td>
                </tr>
            <?php
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