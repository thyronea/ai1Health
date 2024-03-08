<!-- Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="editmodal-ModalLabel">User Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body" align="center">
        <form class="" action="process/user-edit.php" method="POST" enctype="multipart/form-data">

          <div class="form-group mb-2">
            <input type="text" name="engineID" id="engineID" class="form-control form-select-sm" hidden required>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2">
              <input type="text" name="fname" id="fname" class="form-control form-select-sm" required>
            </div>
            <div class="col form-group mb-2">
              <input type="text" name="lname" id="lname" class="form-control form-select-sm" required>
            </div>
          </div>
          <div class="row g-2">
            <div class="col-md-9 form-group mb-2">
              <input type="email" name="email" id="email" class="form-control form-select-sm" required>
            </div>
            <div class="col-md-3 dropdown mb-2">
              <select class="form-select form-select-sm" name="role" id="role" required>
                <option class="dropdown-item" disabled selected>select one</option>
                <option class="dropdown-item" value="User">User</option>
                <option class="dropdown-item" value="Admin">Admin</option>
              </select>
            </div>
          </div>

          <div class="form-group mt-4 mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#account-manager-Modal">Back</button>
            <button type="submit" name="update_btn" class="focus-ring btn btn-outline-secondary btn-sm">Update</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>
