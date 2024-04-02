<!-- Vaccine Result Table -->
<div class="col mb-3">

  <!-- Nav Tabs -->
  <div class="card shadow" style="height:33rem; overflow: auto">
   <div class="card-body">

     <ul class="nav nav-tabs" id="myTab" role="tablist">
       <li class="nav-item" role="presentation">
         <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="all-tab-pane" aria-selected="true" style="color:black;">
           <small>All</small>
         </button>
       </li>
       <li class="nav-item" role="presentation">
         <button class="nav-link" id="private-tab" data-bs-toggle="tab" data-bs-target="#pediatric-tab-pane" type="button" role="tab" aria-controls="pediatric-tab-pane" aria-selected="false" style="color:black;">
           <small>Pediatric</small>
         </button>
       </li>
       <li class="nav-item" role="presentation">
         <button class="nav-link" id="public-tab" data-bs-toggle="tab" data-bs-target="#adult-tab-pane" type="button" role="tab" aria-controls="adult-tab-pane" aria-selected="false" style="color:black;">
           <small>Adult</small>
         </button>
       </li>
       <li class="nav-item" role="presentation">
         <button class="nav-link" id="public-tab" data-bs-toggle="tab" data-bs-target="#unassigned-tab-pane" type="button" role="tab" aria-controls="unassigned-tab-pane" aria-selected="false" style="color:black;">
           <small>Unassigned</small>
         </button>
       </li>
     </ul>

     <!-- Nav Tab Content -->
     <div class="tab-content mt-3" id="myTabContent">

       <!-- All Patients -->
       <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab" tabindex="0">
         <table class="table table-sm table-hover table-borderless text-nowrap">
           <thead>
             <th></th>
           </thead>
           <tbody>

             <?php
                 $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                 $query = "SELECT * FROM patients WHERE groupID='$groupID' ";
                 $query_run = mysqli_query($con, $query);
                 $searchnum = mysqli_num_rows($query_run);
                 if($searchnum > 0)
                 {
                   foreach ($query_run as $patient)
                   {
                     ?>
                     <tr>
                       <td hidden><a type="button" href="../patient-chart/index.php?patientID=<?=htmlspecialchars($patient['patientID']);?>" target="_blank" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars($patient['engineID']);?></small></a></td>
                       <td><a type="button" href="../patient-chart/index.php?patientID=<?=htmlspecialchars($patient['patientID']);?>" target="_blank"  class="text-decoration-none" style="color: black"><small><?=htmlspecialchars($patient['patientID']);?></small></a></td>
                       <td><a type="button" href="../patient-chart/index.php?patientID=<?=htmlspecialchars($patient['patientID']);?>" target="_blank"  class="text-decoration-none" style="color: black"><small><?=htmlspecialchars(decryptthis($patient['fname'], $key));?> <?=htmlspecialchars(decryptthis($patient['lname'], $key));?></small></a></td>
                       <td hidden><a type="button" href="../patient-chart/index.php?patientID=<?=htmlspecialchars($patient['patientID']);?>" target="_blank"  class="text-decoration-none" style="color: black"><small><?=htmlspecialchars(decryptthis($patient['email'], $key));?></small></a></td>
                       <td><a type="button" href="../patient-chart/index.php?patientID=<?=htmlspecialchars($patient['patientID']);?>" target="_blank"  class="text-decoration-none" style="color: black"><small><?=htmlspecialchars($patient['account_status']);?></small></a></td>
                       <td hidden><?php echo '<img src="upload/'.$patient['image'].'" width="600px" height="500px" alt="image"/>'?></td>
                       <td hidden><a type="button" href="../patient-chart/index.php?patientID=<?=htmlspecialchars($patient['patientID']);?>" target="_blank"  class="focus-ring text-decoration-none" style="color: black"><i class="bi bi-universal-access-circle"></i></a></td>
                       <td><a type="button" class="focus-ring text-decoration-none patientdeletebtn" style="color: black" data-bs-toggle="modal" data-bs-target="#patientdeletemodal"><i class="bi bi-trash"></i></a></td>
                     </tr>
                     <?php
                   }
                 }
                else
                {
                  ?>
                    <tr>
                      <td colspan="5" align="center"><small>No Data Found</small></td>
                    </tr>
                  <?php
                }
             ?>

           </tbody>
         </table>
       </div>
       <!-- Pediatric Patients-->
       <div class="tab-pane fade" id="pediatric-tab-pane" role="tabpanel" aria-labelledby="pediatric-tab" tabindex="0">
         <table class="table table-sm table-hover table-borderless text-nowrap">
           <thead>
             <th></th>
           </thead>
           <tbody>

             <?php
                 $query = "SELECT * FROM patients INNER JOIN data_dob
                 ON patients.patientID=data_dob.patientID WHERE data_dob.groupID='$groupID' AND (YEAR(NOW()) - YEAR(data_dob.dob)) BETWEEN 0 AND 18";
                 $query_run = mysqli_query($con, $query);
                 $searchnum = mysqli_num_rows($query_run);
                 if($searchnum > 0)
                 {
                   foreach ($query_run as $peds)
                   {
                     ?>
                     <tr>
                       <td hidden><a type="button" href="../patient-chart/index.php?patientID=<?= htmlspecialchars($peds['patientID']); ?>" target="_blank" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars($peds['engineID']);?></small></a></td>
                       <td><a type="button" href="../patient-chart/index.php?patientID=<?= htmlspecialchars($peds['patientID']); ?>" target="_blank" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars($peds['patientID']);?></small></a></td>
                       <td><a type="button" href="../patient-chart/index.php?patientID=<?= htmlspecialchars($peds['patientID']); ?>" target="_blank" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars(decryptthis($peds['fname'], $key));?> <?=htmlspecialchars(decryptthis($peds['lname'], $key));?></small></a></td>
                       <td hidden><a type="button" href="../patient-chart/index.php?patientID=<?= htmlspecialchars($peds['patientID']); ?>" target="_blank" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars(decryptthis($peds['email'], $key));?></small></a></td>
                       <td><a type="button" href="../patient-chart/index.php?patientID=<?= htmlspecialchars($peds['patientID']); ?>" target="_blank" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars($peds['account_status']);?></small></a></td>
                       <td hidden><?php echo '<img src="upload/'.$patient['image'].'" width="600px" height="500px" alt="image"/>' ?></td>
                       <td hidden><a type="button" href="../patient-chart/index.php?patientID=<?= htmlspecialchars($peds['patientID']); ?>" target="_blank" class="focus-ring text-decoration-none" style="color: black"><i class="bi bi-universal-access-circle"></i></a></td>
                       <td><a type="button" class="focus-ring text-decoration-none patientdeletebtn" style="color: black" data-bs-toggle="modal" data-bs-target="#patientdeletemodal"><i class="bi bi-trash"></i></a></td>
                     </tr>
                     <?php
                   }
                 }
                else
                {
                  ?>
                    <tr>
                      <td colspan="5" align="center"><small>No Data Found</small></td>
                    </tr>
                  <?php
                }
             ?>

           </tbody>
         </table>
       </div>
       <!-- Adult Patients -->
       <div class="tab-pane fade" id="adult-tab-pane" role="tabpanel" aria-labelledby="adult-tab" tabindex="0">
         <table class="table table-sm table-hover table-borderless text-nowrap">
           <thead>
             <th></th>
           </thead>
           <tbody>

             <?php
                 $query = "SELECT * FROM patients INNER JOIN data_dob
                 ON patients.patientID=data_dob.patientID WHERE data_dob.groupID='$groupID' AND (YEAR(NOW()) - YEAR(data_dob.dob)) BETWEEN 19 AND 100";
                 $query_run = mysqli_query($con, $query);
                 $searchnum = mysqli_num_rows($query_run);
                 if($searchnum > 0)
                 {
                   foreach ($query_run as $adult)
                   {
                     ?>
                     <tr>
                       <td hidden><a type="button" href="../patient-chart/index.php?patientID=<?= htmlspecialchars($adult['patientID']); ?>" target="_blank" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars($adult['engineID']);?></small></a></td>
                       <td><a type="button" href="../patient-chart/index.php?patientID=<?= htmlspecialchars($adult['patientID']); ?>" target="_blank" class="text-decoration-none" style="color: black"><small><?= htmlspecialchars($adult['patientID']);?></small></a></td>
                       <td><a type="button" href="../patient-chart/index.php?patientID=<?= htmlspecialchars($adult['patientID']); ?>" target="_blank" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars(decryptthis($adult['fname'], $key));?> <?=htmlspecialchars(decryptthis($adult['lname'], $key));?></small></a></td>
                       <td hidden><a type="button" href="../patient-chart/index.php?patientID=<?= htmlspecialchars($adult['patientID']); ?>" target="_blank" class="text-decoration-none" style="color: black"><small><?=htmlspecialchars(decryptthis($adult['email'], $key));?></small></a></td>
                       <td><a type="button" href="../patient-chart/index.php?patientID=<?= htmlspecialchars($adult['patientID']); ?>" class="text-decoration-none" style="color: black"><small><?= htmlspecialchars($adult['account_status']); ?></small></a></td>
                       <td hidden><?php echo '<img src="upload/'.$adult['image'].'" width="600px" height="500px" alt="image"/>' ?></td>
                       <td hidden><a type="button" href="content/patient-chart.php?engineID=<?=htmlspecialchars($adult['patientID']);?>" class="focus-ring text-decoration-none" style="color: black"><i class="bi bi-universal-access-circle"></i></a></td>
                       <td><a type="button" class="focus-ring text-decoration-none patientdeletebtn" style="color: black" data-bs-toggle="modal" data-bs-target="#patientdeletemodal"><i class="bi bi-trash"></i></a></td>
                     </tr>
                     <?php
                   }
                 }
                else
                {
                  ?>
                    <tr>
                      <td colspan="5" align="center"><small>No Data Found</small></td>
                    </tr>
                  <?php
                }
             ?>

           </tbody>
         </table>
       </div>
       <!-- Unassigned Patients -->
       <div class="tab-pane fade" id="unassigned-tab-pane" role="tabpanel" aria-labelledby="adult-tab" tabindex="0">
         <table class="table table-sm table-borderless text-nowrap">
           <thead>
             <th>
               <small>Patient ID</small>
             </th>
             <th>
               <small>Status</small>
             </th>
           </thead>
           <tbody>

             <?php
                 $unassigned = mysqli_real_escape_string($con, "1111111");
                 $query = "SELECT * FROM patients WHERE groupID='$unassigned'";
                 $query_run = mysqli_query($con, $query);
                 $searchnum = mysqli_num_rows($query_run);
                 if($searchnum > 0)
                 {
                   foreach ($query_run as $unassigned)
                   {
                     ?>
                     <tr>
                       <td hidden><a type="button"class="text-decoration-none" style="color: black"><small><?=htmlspecialchars($unassigned['engineID']);?></small></a></td>
                       <td><a class="text-decoration-none" style="color: black"><small><?= htmlspecialchars($unassigned['patientID']);?></small></a></td>
                       <td><a class="text-decoration-none" style="color: black"><small><?= htmlspecialchars($unassigned['account_status']); ?></small></a></td>
                       <td hidden><a class="text-decoration-none" style="color: black"><small><?= htmlspecialchars(decryptthis($unassigned['email'], $key)); ?></small></a></td>
                       <td hidden><?php echo '<img src="upload/'.$adult['image'].'" width="600px" height="500px" alt="image"/>' ?></td>
                       <td hidden><a type="button" class="focus-ring text-decoration-none" style="color: black"><i class="bi bi-universal-access-circle"></i></a></td>
                       <td><button type="button" class="focus-ring btn-outline-secondary btn btn-sm assignPatient" data-bs-toggle="modal" data-bs-target="#assignPatient">Assign <i class="bi bi-person-plus"></i></i></button></td>
                     </tr>
                     <?php
                   }
                 }
                  else
                  {
                    ?>
                      <tr>
                        <td colspan="5" align="center"><small>No Data Found</small></td>
                      </tr>
                    <?php
                  }
             ?>

           </tbody>
         </table>
       </div>

     </div>

   </div>
  </div>
</div>
