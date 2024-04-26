<div class="modal fade" id="patient-edit-contact-Modal" tabindex="-1" aria-labelledby="patient-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patient-edit-ModalLabel">Update Contact Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
          <form class="" action="process/demographic/update-patient-contact.php" method="post">
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="Last Name" required>
            <input type="text" class="form-control form-control-sm mt-2" name="phone" value="<?=htmlspecialchars(decryptthis($contact['phone'], $key));?>" placeholder="Phone Number" required>
            <input type="text" class="form-control form-control-sm mt-2" name="mobile" value="<?=htmlspecialchars(decryptthis($contact['mobile'], $key));?>" placeholder="Mobile Number" required>
            <input type="text" class="form-control form-control-sm mt-2" name="email" value="<?=htmlspecialchars(decryptthis($contact['email'], $key));?>" placeholder="Email Address" required>
            <button type="submit" name="patient_contactbtn" class="focus-ring btn btn-sm border mt-3">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
