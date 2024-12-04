<div class="modal fade" id="registryStatus" tabindex="-1" aria-labelledby="registryStatusLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h1 class="modal-title w-100 fs-5" id="registryStatusLabel">Immunization Registry Status</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="iz_record_printThis">
                <?php include('process/soap/request-status.php');?>
                <?php include('process/soap/submitMsg-status.php');?>
            </div>
        </div>
  </div>
</div>

