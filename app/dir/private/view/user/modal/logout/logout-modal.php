<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="logoutModal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="editmodal-ModalLabel">Exiting</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="process/sql.php" method="POST">
          <div class="form-group mt-3 mb-4">
            <p align="center">Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal" aria-label="Close">No</button>
            <a href="/../private/access/logout-process.php" class="btn btn-outline-secondary btn-sm" type="button">Yes</a>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
