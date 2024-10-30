<?php
include('process/scripts.php');
date_default_timezone_set('America/Los_Angeles');
$today = date('Y') . '-' . date('m') . '-' . date('d');
?>

<!-- Modal -->
<div class="modal fade" id="add-patient-Modal" tabindex="-1" aria-labelledby="add-patient-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="add-patient-ModalLabel">Patient Registration</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="process/add-new-patient.php" method="POST" enctype="multipart/form-data">

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
                        <option disabled selected>State</option>
                        <option value="CA">CA - California</option>
                        <option value="AL">AL - Alaska</option>
                        <option value="AZ">AZ - Arizona</option>
                        <option value="AR">AZ - Arkansas</option>
                        <option value="CO">CO - Colorado</option>
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


<script>
// Generate random patientID
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 5) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("patientID").value = randomNumber(7);

// Generate random engineID
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 5) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("engineID").value = randomNumber(7);

  // Generate random uniqueID
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 5) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("uniqueID").value = randomNumber(8);


</script>
