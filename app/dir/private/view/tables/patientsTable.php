<!-- Patients Result Table -->
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

                <?php include(PRIVATE_MODELS_PATH . '/admin/patients/patientSearch.php'); ?>

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

                <?php include(PRIVATE_MODELS_PATH . '/admin/patients/patientSearchPeds.php'); ?>

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

                <?php include(PRIVATE_MODELS_PATH . '/admin/patients/patientSearchAdults.php'); ?>

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
              
              <?php include(PRIVATE_MODELS_PATH . '/admin/patients/patientSearchUnassigned.php'); ?>

            </tbody>
         </table>
       </div>

     </div>

   </div>
  </div>
</div>