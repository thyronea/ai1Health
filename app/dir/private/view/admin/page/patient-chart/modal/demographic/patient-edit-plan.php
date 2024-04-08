<?php
date_default_timezone_set('America/Los_Angeles');
$today = date('Y') . '-' . date('m') . '-' . date('d');
?>

<div class="modal fade" id="patient-edit-plan-Modal" tabindex="-1" aria-labelledby="patient-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patient-edit-ModalLabel">Update Health Plan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
          <form class="" action="process/update-patient-plan.php" method="post">
            <input type="date" name="date" class="form-control form-control-sm" value="<?php echo $today; ?>" hidden required>
            <input type="hidden" name="time" class="form-control form-control-sm" value="<?php echo date("h:i A"); ?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($plan['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($plan['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="First Name" required>
            <input type="text" class="form-control form-control-sm mt-2" name="health_plan" value="<?=htmlspecialchars(decryptthis($plan['health_plan'], $key));?>" placeholder="Health Plan" required>
            <input type="text" class="form-control form-control-sm mt-2" name="policy_number" value="<?=htmlspecialchars(decryptthis($plan['policy_number'], $key));?>" placeholder="Policy Number" required>
            <select class="form-select form-select-sm mt-2" name="status">
              <option selected value="<?=htmlspecialchars(decryptthis($plan['status'], $key));?>"><?=htmlspecialchars(decryptthis($plan['status'], $key));?></option>
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
            <button type="submit" name="patient_planbtn" class="focus-ring btn btn-sm border mt-3">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
