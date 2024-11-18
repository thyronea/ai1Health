<?php
date_default_timezone_set('America/Los_Angeles');
$today = date('Y') . '-' . date('m') . '-' . date('d');
?>

<!-- Patient report -->
<div class="modal fade" id="patient-report-Modal" tabindex="-1" aria-labelledby="patient-report-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patient-report-ModalLabel">Patients Report</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

      </div>
    </div>
  </div>
</div>

<!-- Add new patient -->
<div class="modal fade" id="add-patient-Modal" tabindex="-1" aria-labelledby="add-patient-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="add-patient-ModalLabel">Patient Registration</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="" method="POST" enctype="multipart/form-data">

            <div class="main-form">
              <div class="row col-md-6 mb-2">
                <div class="col">
                  <input type="date" name="date" class="form-control form-control-sm" value="<?php echo $today; ?>" hidden required>
                </div>
                <div class="col">
                  <input type="" name="time" class="form-control form-control-sm" value="<?php echo date("h:i A"); ?>" hidden required>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                    <input type="hidden" name="patientID" id="patientID" class="form-control" >
                </div>
                <div class="form-group">
                    <input type="hidden" name="engineID" id="engineID" class="form-control" >
                </div>
                <div class="form-group">
                    <input type="hidden" name="uniqueID" id="uniqueID" class="form-control" >
                </div>
                </div>
              </div>
                <div class="col-md-10" style="text-align: left">
                  <div class="row g-2 mt-3 mb-2">
                    <div class="col">
                      <label><small>First Name</small></label>
                      <input class="form-control form-control-sm" type="text" name="fname" required>
                    </div>
                    <div class="col">
                      <label><small>Last Name</small></label>
                      <input class="form-control form-control-sm" type="text" name="lname" required>
                    </div>
                    <div class="col-md-2">
                      <label><small>Suffix</small></label>
                      <input class="form-control form-control-sm" type="text" name="suffix">
                    </div>
                    <div class="col-md-3">
                      <label><small>Date of Birth</small></label>
                      <input class="form-control form-control-sm" type="date" name="dob" required>
                    </div>
                  </div>
                  <div class="row g-2 mb-2">
                    <div class="col-md-2">
                      <select class="form-select form-select-sm" name="gender">
                        <option disabled selected>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                    <div class="col">
                      <select class="form-select form-select-sm" name="race">
                        <option disabled selected>Race</option>
                        <option value="Hispanic or Latino">Hispanic or Latino</option>
                        <option value="Not Hispanic or Latino">Not Hispanic or Latino</option>
                      </select>
                    </div>
                    <div class="col">
                      <select class="form-select form-select-sm" name="ethnicity">
                        <option disabled selected>Ethnicity</option>
                        <option value="American Indian or Alaska Native">American Indian or Alaska Native</option>
                        <option value="Asian">Asian</option>
                        <option value="Black or African American">Black or African American</option>
                        <option value="Hispanic or Latino">Hispanic or Latino</option>
                        <option value="Native Hawaiian or Other Pacific Islander">Native Hawaiian or Other Pacific Islander</option>
                        <option value="White">White</option>
                      </select>
                    </div>
                  </div>
                  <hr class="mt-4 mb-4">
                  <div class="row g-2 mb-2">
                    <div class="col">
                      <input class="form-control form-control-sm" type="text" name="address1" placeholder="Address" required>
                    </div>
                    <div class="col">
                      <input class="form-control form-control-sm" type="text" placeholder="Address 1" name="address2">
                    </div>
                  </div>
                  <div class="row g-2">
                    <div class="col-md-6">
                      <input class="form-control form-control-sm" type="text" name="city" placeholder="City" required>
                    </div>
                    <div class="col">
                      <select class="form-select form-select-sm" name="state" required>
                        <option value="CA" selected>CA</option>
                        <option value="AL">AL</option>
                        <option value="AK">AK</option>
                        <option value="AR">AR</option>
                        <option value="AZ">AZ</option>
                        <option value="CO">CO</option>
                        <option value="CT">CT</option>
                        <option value="DC">DC</option>
                        <option value="DE">DE</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>
                        <option value="HI">HI</option>
                        <option value="IA">IA</option>
                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>
                        <option value="KY">KY</option>
                        <option value="LA">LA</option>
                        <option value="MA">MA</option>
                        <option value="MD">MD</option>
                        <option value="ME">ME</option>
                        <option value="MI">MI</option>
                        <option value="MN">MN</option>
                        <option value="MO">MO</option>
                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>
                        <option value="NE">NE</option>
                        <option value="NH">NH</option>
                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NV">NV</option>
                        <option value="NY">NY</option>
                        <option value="ND">ND</option>
                        <option value="OH">OH</option>
                        <option value="OK">OK</option>
                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>
                        <option value="SD">SD</option>
                        <option value="TN">TN</option>
                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VT">VT</option>
                        <option value="VA">VA</option>
                        <option value="WA">WA</option>
                        <option value="WI">WI</option>
                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                      </select>
                    </div>
                    <div class="col">
                      <input class="form-control form-control-sm mb-2" type="text" name="zip" placeholder="Zip" required>
                    </div>
                  </div>
                  <hr class="mt-4">
                  <div class="row g-2 mb-4">
                    <div class="col-md-3">
                      <label><small>Home Phone</small></label>
                      <input class="form-control form-control-sm" type="text" name="phone" required>
                    </div>
                    <div class="col-md-3">
                      <label><small>Mobile Phone</small></label>
                      <input class="form-control form-control-sm" type="text" name="mobile" required>
                    </div>
                    <div class="col">
                      <label><small>Email Address</small></label>
                      <input class="form-control form-control-sm" type="text" name="email" required>
                    </div>
                    <div class="form-group mb-2" hidden>
                      <label>Role</label>
                      <input type="text" name="role" value="Patient" required>
                    </div>
                  </div>

                  <div class="col-auto">
                    <label><small>Upload Image</small></label>
                    <input class="form-control form-control-sm" type="file" name="patient_image">
                  </div>

                </div>
            </div>

            <div class="modal-footer col d-flex justify-content-center">
              <button type="submit" name="add_patient" class="focus-ring py-1 px-2 btn-outline border btn btn-sm mt-2 mb-2">Submit</button>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>

<!-- Assign patient -->
<div class="modal fade" id="assignPatient" tabindex="-1" aria-labelledby="assignPatient-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="assignPatient-ModalLabel" style="color:red">Assign Patient</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" id="engine_ID" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" id="patient_ID" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_email" id="patient_email" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_name" id="patient_name" required>

            <!----------------------------------------------------->
            <small>
              <p align="center">Patient will be added to your group.</p>
              <p align="center">Do you still want to proceed?</p>
            </small>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal" aria-label="Close">No</button>
            <button type="submit" name="assign_patient" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Remove patient -->
<div class="modal fade" id="patientdeletemodal" tabindex="-1" aria-labelledby="patientdeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patientdeletemodal-ModalLabel" style="color:red">Remove Patient</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" id="engine_id" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" id="patient_id" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_name" id="patient_name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_email" id="patients_email" required>

            <!----------------------------------------------------->
            <p align="center">Patient will be removed from your group.</p>
            <p align="center">Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal" aria-label="Close">No</button>
            <button type="submit" name="remove_patient" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>