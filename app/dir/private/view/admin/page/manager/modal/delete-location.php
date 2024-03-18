<!-- Modal -->
<div class="modal fade" id="officedeletemodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="officedeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title fs-5" id="officedeletemodal-ModalLabel">Delete Office</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="process/sql.php" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input class="form-control mb-2" type="hidden" name="delete_officeid" id="delete_officeid">
            <input class="form-control mb-2" type="hidden" name="delete_office_engineid" id="delete_office_engineid">
            <input class="form-control mb-2" type="hidden" name="delete_office_name" id="delete_office_name">
            <!----------------------------------------------------->
            <p align="center">Access and data will be permanently removed (including STORAGE UNITS AND THEROMETERS assigned to this office).</p>
            <p align="center">Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#account-settings-Modal">No</button>
            <button type="submit" name="officedeletebtn" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
