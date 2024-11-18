<div class="modal fade" id="patient-edit-email-modal" tabindex="-1" aria-labelledby="patient-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patient-edit-ModalLabel">Update Email</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
          <form class="" action="" method="post">
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="Last Name" required>
            <input type="text" class="form-control form-control-sm mt-2" name="email" value="<?=htmlspecialchars(decryptthis($contact['email'], $key));?>" placeholder="Email Address" required>
            <button type="submit" name="edit_patient_emailbtn" class="focus-ring btn btn-sm border mt-4">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
