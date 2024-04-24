<!-- Modal -->
<div class="modal fade" id="patientdeletemodal" tabindex="-1" aria-labelledby="patientdeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patientdeletemodal-ModalLabel" style="color:red">Remove Patient</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="../patients/process/remove-patient.php" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_name" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?> <?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_email" value="<?=htmlspecialchars(decryptthis($contact['email'], $key));?>" required>

            <!----------------------------------------------------->
            <p align="center">Patient will be removed from your group.</p>
            <p align="center">Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal" aria-label="Close">No</button>
            <button type="submit" name="remove_patient" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>