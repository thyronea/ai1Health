<!-- Modal -->
<div class="modal fade" id="add-doc" tabindex="-1" aria-labelledby="add-docLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="add-docLabel">Upload File</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="form-group mb-2">
          <form class="" action="process/add-file-process.php" method="post" enctype="multipart/form-data">
            <div class="row col-md-12 g-2">
              <div class="col col-md-10">
                <input type="file" name="docname" class="form-control form-select-sm" required>
              </div>
              <div class="col-md-2">
                <label><small>File Type</small></label>
                <select class="col form-control form-select-sm" name="type" required>
                  <option></option>
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
