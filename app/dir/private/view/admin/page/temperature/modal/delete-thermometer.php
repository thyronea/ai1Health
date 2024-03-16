<!-- Modal -->
<div class="modal fade" id="thermometerdeletemodal" tabindex="-1" aria-labelledby="storagedeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="thermometerdeletemodal-ModalLabel">Delete Thermometer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="process/sql.php" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input class="form-control mb-2" type="hidden" name="thermometerID" id="delete_thermID">
            <input class="form-control mb-2" type="hidden" name="engineID" id="delete_therm_engineID">
            <input class="form-control mb-2" type="hidden" name="delete_thermometer_name" id="delete_therm_name">
            <!----------------------------------------------------->
            <p align="center">Thermometer will be permanently removed from database.</p>
            <p>Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-secondary btn-sm">No</button>
            <button type="submit" name="thermometerdeletebtn" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
