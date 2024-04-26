<div class="modal fade" id="patient-edit-name-Modal" tabindex="-1" aria-labelledby="patient-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patient-edit-ModalLabel">Update Patient Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
          <form class="" action="process/demographic/update-patient-info.php" method="post">
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="groupID" value="<?=htmlspecialchars($patient['groupID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="email" value="<?=htmlspecialchars(decryptthis($patient['email'], $key));?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="role" value="<?=htmlspecialchars(decryptthis($patient['role'], $key));?>" required>
            <input type="text" class="form-control form-control-sm mt-2" name="fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="text" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="Last Name" required>
            <input type="text" class="form-control form-control-sm mt-2" name="suffix" value="<?=htmlspecialchars(decryptthis($patient['suffix'], $key));?>" placeholder="Suffix">
            <input type="date" class="form-control form-control-sm mt-2" name="dob" value="<?=htmlspecialchars(decryptthis($diversity['dob'], $key));?>" required>
            <select class="form-select form-select-sm mt-2" name="gender">
              <option value="<?=htmlspecialchars(decryptthis($diversity['gender'], $key));?>"><?=htmlspecialchars(decryptthis($diversity['gender'], $key));?></option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
            <select class="form-select form-select-sm mt-2" name="race">
              <option value="<?=htmlspecialchars(decryptthis($diversity['race'], $key));?>"><?=htmlspecialchars(decryptthis($diversity['race'], $key));?></option>
              <option value="Hispanic or Latino">Hispanic or Latino</option>
              <option value="Not Hispanic or Latino">Not Hispanic or Latino</option>
            </select>
            <select class="form-select form-select-sm mt-2" name="ethnicity">
              <option value="<?=htmlspecialchars(decryptthis($diversity['ethnicity'], $key));?>"><?=htmlspecialchars(decryptthis($diversity['ethnicity'], $key));?></option>
              <option value="American Indian or Alaska Native">American Indian or Alaska Native</option>
              <option value="Asian">Asian</option>
              <option value="Black or African American">Black or African American</option>
              <option value="Native Hawaiian or Other Pacific Islander">Native Hawaiian or Other Pacific Islander</option>
              <option value="White">White</option>
            </select>
            <div class="col-auto mt-3">
              <label><small>Upload Image</small></label>
              <input class="form-control form-control-sm" type="file" name="patient_image">
            </div>
            <button type="submit" name="patient_edit_btn" class="focus-ring btn btn-sm border mt-3">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
