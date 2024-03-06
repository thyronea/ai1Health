<!-- Modal -->
<div class="modal fade" id="activityclearmodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="activityclear-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title fs-5" id="activityclear-ModalLabel">Clear Activity Log</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="process/clear-activity-log.php" method="POST">
          <div class="form-group mt-3 mb-5">
            <p align="center">Activity log will be permanently cleared.</p>
            <p align="center">Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#activity-log-Modal">No</button>
            <button type="submit" name="clear_activity" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
