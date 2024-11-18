<div class="modal fade" id="patient-edit-phone-modal" tabindex="-1" aria-labelledby="patient-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patient-edit-ModalLabel">Update Phone Numbers</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
          <form class="row" action="" method="post">
          <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="Last Name" required>
            <div class="row">
              <div  class="col-md-1 mt-3">
                <i class="bi bi-telephone"></i>
              </div>
              <div class="col">
                <input type="text" class="form-control form-control-sm mt-2" name="phone" value="<?=htmlspecialchars(decryptthis($contact['phone'], $key));?>" placeholder="Phone Number" required>
              </div>
            </div>
            <div class="row mt-2">
              <div  class="col-md-1 mt-3">
                <i class="bi bi-phone"></i>
              </div>
              <div class="col">
                <input type="text" class="form-control form-control-sm mt-2" name="mobile" value="<?=htmlspecialchars(decryptthis($contact['mobile'], $key));?>" placeholder="Mobile Number" required>
              </div>
            </div>
            <div class="mt-4">
              <div class="col-md-2">
                <button type="submit" name="patient_phonetbtn" class="focus-ring btn btn-sm border">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
