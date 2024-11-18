<div class="modal fade" id="patient-info" tabindex="-1" data-bs-backdrop="static" aria-labelledby="patient-info-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patient-info-ModalLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

       <?php include('components/patient-chart-navtab.php'); ?>

       <div class="row flex-nowrap">



         <div class="tab-content" id="myTabContent">
           <?php include('content/patient-chart-snapshot.php'); ?>
           <?php include('content/patient-chart-demographic.php'); ?>
           <?php include('content/patient-chart-progress-notes.php'); ?>
         </div>

       </div>

      </div>

      <div class="modal-footer col d-flex justify-content-center mt-3">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
