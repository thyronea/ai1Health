<tr>
    <td hidden><a type="hidden"><small><?=htmlspecialchars($patient['engineID']);?></small></a></td>
    <td hidden><a type="hidden"><small><?=htmlspecialchars($patient['patientID']);?></small></a></td>
    <td>
       <div class="card shadow" id="box">
            <div class="card-body">
                <a type="button" href="../../admin/patient-chart/?patientID=<?=$patientID?>" class="text-decoration-none" style="color: black">
                    <small>
                        <div class="row" style="padding-left:20px;">
                            <div class="col border" style="width:50px;height:50px;border-radius:50%;overflow:hidden">
                                <?php include(PRIVATE_MODELS_PATH . '/admin/patients/patientBoxImage.php'); ?>
                            </div>
                            <div class="col">
                                <?=$patientFname?> <?=$patientLname?><br>
                                <small><?=$dob?> (<?=$year?> years old)</small>
                            </div>
                            <div class="col mt-2" style="left:450px;top:22px;position:absolute">
                                <?php include(PRIVATE_MODELS_PATH . '/admin/patients/patientStatusIcon.php'); ?>
                            </div>
                        </div>
                    </small>
                </a>
            </div>
        </div>
    </td>
    <td hidden><a type="button" href="../patient-chart/?patientID=<?=$patientID?>" class="text-decoration-none" style="color: black"><small><?=$patientEmail?></small></a></td>
    <td hidden><a type="button" class="focus-ring text-decoration-none patientdeletebtn" style="color: black" data-bs-toggle="modal" data-bs-target="#patientdeletemodal"><i class="bi bi-trash"></i></a></td>
</tr>