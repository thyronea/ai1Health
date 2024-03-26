<div class="modal fade" id="patient-add-diversity-Modal" tabindex="-1" aria-labelledby="patient-add-diversity-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patient-add-diversity-ModalLabel">Add Diversity</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
          <form class="" action="../process/sql.php" method="post">
            <input type="hidden" class="form-control form-control-sm mb-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm" name="fname" value="<?=htmlspecialchars($patient['fname']);?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars($patient['lname']);?>" placeholder="Last Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="suffix" value="<?=htmlspecialchars($patient['suffix']);?>" placeholder="Suffix">
            <div class="" align="left">
              <label align="left"><small>Date of Birth</small></label>
            </div>
            <input class="form-control form-control-sm" type="date" name="dob" required>
            <div class="mt-2" align="left">
              <label align="left"><small>Gender</small></label>
            </div>
            <select class="form-select form-select-sm" name="gender" required>
              <option disabled selected></option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
            <div class="mt-2" align="left">
              <label align="left"><small>Race</small></label>
            </div>
            <select class="form-select form-select-sm" name="race" required>
              <option disabled selected></option>
              <option value="Hispanic or Latino">Hispanic or Latino</option>
              <option value="Not Hispanic or Latino">Not Hispanic or Latino</option>
            </select>
            <div class="mt-2" align="left">
              <label align="left"><small>Ethnicity</small></label>
            </div>
            <select class="form-select form-select-sm" name="ethnicity" required>
              <option disabled selected></option>
              <option value="American Indian or Alaska Native">American Indian or Alaska Native</option>
              <option value="Asian">Asian</option>
              <option value="Asian">Black or African American</option>
              <option value="Asian">Native Hawaiian or Other Pacific Islander</option>
              <option value="Asian">White</option>
            </select>
            <button type="submit" name="add_patient_diversity" class="focus-ring btn btn-sm border mt-3">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
