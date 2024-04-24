<tr>
    <td hidden><a type="button" href="../patient-chart/index.php?patientID=<?=htmlspecialchars($patient['patientID']);?>" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars($patient['engineID']);?></small></a></td>
    <td hidden><a type="button" href="../patient-chart/index.php?patientID=<?=htmlspecialchars($patient['patientID']);?>" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars($patient['patientID']);?></small></a></td>
    <td>
       <div class="card shadow" id="patients">
            <div class="card-body">
                <a type="button" href="../patient-chart/index.php?patientID=<?=htmlspecialchars($patient['patientID']);?>" class="text-decoration-none" style="color: black">
                    <small>
                        <div class="row" style="padding-left:20px;">
                            <div class="col border" style="width:55px;height:50px;border-radius:50%;overflow:hidden">
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
                                          <img style="margin-left:-12px;width:50px;height:50px;border-radius:50%;" src="../../../image/profile/<?php echo $profile_img['filename'];?>">
                                        <?php
                                        }
                                    }
                                ?>
                            </div>
                            <div class="col">
                                <?=htmlspecialchars(decryptthis($patient['fname'], $key));?> <?=htmlspecialchars(decryptthis($patient['lname'], $key));?><br>
                                <small><?=htmlspecialchars($dob);?> (<?=htmlspecialchars($year);?> years old)</small>
                            </div>
                            <div class="col mt-2" style="left:450px; position:absolute">
                                <?php
                                    $status = "Not Verified";
                                    if($patient['account_status'] == $status){
                                        ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-exclamation" viewBox="0 0 16 16" style="color:red">
                                            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                                            <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5m0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                        </svg>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16" style="color:green">
                                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                                            <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                                        </svg>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </small>
                </a>
            </div>
        </div>
    </td>
    <td hidden><a type="button" href="../patient-chart/index.php?patientID=<?=htmlspecialchars($patient['patientID']);?>" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars(decryptthis($patient['email'], $key));?></small></a></td>
    <td hidden><a type="button" class="focus-ring text-decoration-none patientdeletebtn" style="color: black" data-bs-toggle="modal" data-bs-target="#patientdeletemodal"><i class="bi bi-trash"></i></a></td>
</tr>