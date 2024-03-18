<!-- Modal -->
<div class="modal fade" id="locationdeletemodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="locationdeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title fs-5" id="locationedeletemodal-ModalLabel">Delete Location</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="process/location-delete.php" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input class="form-control mb-2" type="hidden" name="delete_locationid" id="delete_locationID">
            <input class="form-control mb-2" type="hidden" name="delete_location_engineid" id="delete_location_engineID">
            <input class="form-control mb-2" type="hidden" name="delete_location_name" id="delete_location_name">
            <!----------------------------------------------------->
            <p align="center">Access and data will be permanently removed (including STORAGE UNITS AND THEROMETERS assigned to this location).</p>
            <p align="center">Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#account-manager-Modal">No</button>
            <button type="submit" name="locationdeletebtn" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
