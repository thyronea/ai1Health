<!-- Add Document -->
<div class="modal fade" id="add-doc" tabindex="-1" aria-labelledby="add-docLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="add-docLabel">Upload File</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="form-group mb-2">
          <form class="" action="" method="post" enctype="multipart/form-data">
            <div class="row col-md-12 g-2">
              <div class="col col-md-10">
                <input type="file" name="docname" class="form-control form-select-sm" required>
              </div>
              <div class="col-md-2">
                <select class="col form-control form-select-sm" name="type"
                  data-bs-toggle="popover"
                  data-bs-placement="top"
                  data-bs-trigger="focus"
                  data-bs-content="File Type" required>
                  <option selected></option>
                  <option disabled>Select doc type</option>
                  <option value="pdf">pdf</option>
                  <option value="word">word</option>
                  <option value="csv">csv</option>
                  <option value="txt">txt</option>
                </select>
              </div>
            </div>
            <div class="form-group mt-4 mb-3" align="center">
              <button type="submit" name="upload_doc" class="focus-ring btn btn-outline-secondary btn-sm">Upload</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Delete Document -->
<div class="modal fade" id="filedeletemodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="filedeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title fs-5" id="filedeletemodal-ModalLabel">Delete File</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="" method="POST">
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
  