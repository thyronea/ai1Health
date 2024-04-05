<!-- Modal -->
<div class="modal fade" id="delete_influenza" tabindex="-1" data-bs-backdrop="static" aria-labelledby="influenza_covid-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="influenza_covid-ModalLabel">Delete Influenza</h1>
      </div>

      <div class="modal-body">
        <form action="../process/sql.php" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="dob" value="<?=htmlspecialchars(decryptthis($diversity['dob'], $key));?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="id" id="delete_influenza_id" class="form-control form-control-sm" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="vaccine_name" id="delete_influenza_name" class="form-control form-control-sm" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="type" id="delete_influenza_type" class="form-control form-control-sm" required>
            <!----------------------------------------------------->
            <p align="center">Administered COVID-19 will be permanently removed.</p>
            <p align="center">Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal" aria-label="Close">No</button>
            <button type="submit" name="delete_administered_vaccine" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
