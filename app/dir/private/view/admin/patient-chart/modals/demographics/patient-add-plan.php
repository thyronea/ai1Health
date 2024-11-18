<div class="modal fade" id="patient-add-plan-modal" tabindex="-1" aria-labelledby="patient-add-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patient-add-ModalLabel">Add Health Plan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
          <form class="" action="../process/sql.php" method="post">
            <input type="date" name="date" class="form-control form-control-sm" value="<?php echo $today; ?>" hidden required>
            <input type="hidden" name="time" class="form-control form-control-sm" value="<?php echo date("h:i A"); ?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="Last Name" required>
            <input type="text" class="form-control form-control-sm mt-2" name="health_plan" placeholder="Health Plan" required>
            <input type="text" class="form-control form-control-sm mt-2" name="policy_number" placeholder="Policy Number" required>
            <select class="form-select form-select-sm mt-2" name="status">
              <option disabled selected>Select one</option>
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
            <button type="submit" name="add_healthplan" class="focus-ring btn btn-sm border mt-3">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
