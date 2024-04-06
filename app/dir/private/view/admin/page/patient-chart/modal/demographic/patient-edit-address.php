<div class="modal fade" id="patient-edit-address-Modal" tabindex="-1" aria-labelledby="patient-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patient-edit-ModalLabel">Update Address</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
          <form class="" action="process/update-patient-address.php" method="post">
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($address['userID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($address['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="groupID" value="<?=htmlspecialchars($address['groupID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="First Name" required>
            <input type="text" class="form-control form-control-sm mt-2" name="address1" value="<?=htmlspecialchars(decryptthis($address['address1'], $key));?>" required>
            <input type="text" class="form-control form-control-sm mt-2" name="address2" value="<?=htmlspecialchars(decryptthis($address['address2'], $key));?>" placeholder="Address 2">
            <input type="text" class="form-control form-control-sm mt-2" name="city" value="<?=htmlspecialchars(decryptthis($address['city'], $key));?>" placeholder="City" required>
            <input type="text" class="form-control form-control-sm mt-2" name="state" value="<?=htmlspecialchars(decryptthis($address['state'], $key));?>" required>
            <input type="text" class="form-control form-control-sm mt-2" name="zip" value="<?=htmlspecialchars(decryptthis($address['zip'], $key));?>" placeholder="Zip Code" required>
            <button type="submit" name="patient_addressbtn" class="focus-ring btn btn-sm border mt-3">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
