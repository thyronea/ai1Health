<style>
  #patients:hover{
    background-color: #e6effc;
    transition: all 1s ease;
  }
</style>

<!-- Vaccine Result Table -->
<div class="col mb-3">

  <!-- Nav Tabs -->
  <div class="card shadow" style="height:33rem; overflow: hidden">
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
         <table class="table align-middle table table-sm table-borderless text-nowrap">
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
                    $patient_dob = htmlspecialchars(decryptthis($patient['dob'], $key));
                    include('patient-list.php');
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
         <table class="table align-middle table-sm table-borderless text-nowrap">
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
                   foreach ($query_run as $patient)
                   {
                    $patient_dob = htmlspecialchars($patient['dob']);
                    include('patient-list.php');
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
         <table class="table align-middle table-sm table-borderless text-nowrap">
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
                   foreach ($query_run as $patient)
                   {
                     $patient_dob = htmlspecialchars($patient['dob']);
                     include('patient-list.php');
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
         <table class="table align-middle table-sm table-borderless text-nowrap">
           <thead>
            <th></th>
           </thead>
           <tbody>

             <?php include('unassigned-list.php');?>

           </tbody>
         </table>
       </div>

     </div>

   </div>
  </div>
</div>
