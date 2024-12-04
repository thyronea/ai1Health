<!-- Modal -->
<div class="modal fade" id="filedeletemodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="filedeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title fs-5" id="filedeletemodal-ModalLabel">Delete File</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="process/delete-file-process.php" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input class="form-control mb-2" type="hidden" name="file_ID" id="file_ID">
            <input class="form-control mb-2" type="hidden" name="file_userID" id="file_userID">
            <input class="form-control mb-2" type="hidden" name="file_groupID" id="file_groupID">
            <input class="form-control mb-2" type="hidden" name="file_docname" id="file_docname">
            <input class="form-control mb-2" type="hidden" name="file_type" id="file_type">
            <!----------------------------------------------------->
            <p align="center">File will be permanently deleted.</p>
            <p align="center">Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#account-settings-Modal">No</button>
            <button type="submit" name="filedeletebtn" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
