<!-- Modal -->
<div class="modal fade" id="userdeletemodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userdeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="userdeletemodal-ModalLabel">Delete User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="process/user-delete.php" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input class="form-control mb-2" type="hidden" name="delete_userID" id="delete_userID">
            <input class="form-control mb-2" type="hidden" name="delete_engineID" id="delete_engineID">
            <input class="form-control mb-2" type="hidden" name="delete_fname" id="delete_fname">
            <input class="form-control mb-2" type="hidden" name="delete_lname" id="delete_lname">
            <!----------------------------------------------------->
            <p align="center">Access and data will be permanently removed.</p>
            <p align="center">Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#account-manager-Modal">No</button>
            <button type="submit" name="userdeletebtn" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
