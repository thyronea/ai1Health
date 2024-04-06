<div class="modal fade" id="patient-add-address-Modal" tabindex="-1" aria-labelledby="patient-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patient-edit-ModalLabel">Add Address</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
          <form class="" action="process/add-patient-address.php" method="post">
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="fname" value="<?=htmlspecialchars($patient['fname']);?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars($patient['lname']);?>" placeholder="First Name" required>
            <input type="text" class="form-control form-control-sm mt-2" name="address1" placeholder="Address" required>
            <input type="text" class="form-control form-control-sm mt-2" name="address2" placeholder="Address 2">
            <input type="text" class="form-control form-control-sm mt-2" name="city" placeholder="City" required>
            <select class="form-select form-select-sm mt-2" name="state">
              <option disabled selected>State</option>
              <option value="CA">CA - California</option>
              <option value="AL">AL - Alaska</option>
              <option value="AZ">AZ - Arizona</option>
              <option value="AR">AZ - Arkansas</option>
              <option value="CO">CO - Colorado</option>
            </select>
            <input type="text" class="form-control form-control-sm mt-2" name="zip" placeholder="Zip Code" required>
            <button type="submit" name="add_patient_addressbtn" class="focus-ring btn btn-sm border mt-3">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
