<!-- Modal -->
<div class="modal fade" id="emergencydeletemodal" tabindex="-1" aria-labelledby="emergencydeletemodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title w-100 fs-5" id="emergencydeletemodalLabel">Delete Emergency Contact</h1>
      </div>

      <div class="modal-body">
        <form class="" action="process/demographic/delete-patient-emergency.php" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input class="form-control form-control-sm mb-2" type="hidden" name="patientID" id="emergency_patientID_">
            <input class="form-control form-control-sm mt-2" type="hidden" name="patient_fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" required>
            <input class="form-control form-control-sm mt-2" type="hidden" name="patient_lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" required>
            <input class="form-control form-control-sm mb-2" type="hidden" name="emergencyID" id="emergency_ID_">
            <input class="form-control form-control-sm mt-2" type="hidden" name="emergency_fname" id="emergency_fname_" required>
            <input class="form-control form-control-sm mt-2" type="hidden" name="emergency_lname" id="emergency_lname_" required>
            <!----------------------------------------------------->
            <input class="row border-0 text-center" type="" name="emergency_fname" id="emergency_fname__">
            <p align="center">will be permanently removed?</p>
          </div>
    
          <div class="form-group mb-3" align="center">
            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#patient-edit-emergency-Modal">No</button>
            <button type="submit" name="emergencydeletebtn" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
