<div class="modal fade" id="patient-add-address-modal" tabindex="-1" aria-labelledby="patient-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patient-edit-ModalLabel">Add Address</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
          <form class="" action="" method="post">
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="fname" value="<?=htmlspecialchars($patient['fname']);?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars($patient['lname']);?>" placeholder="First Name" required>
            <input type="text" class="form-control form-control-sm mt-2" name="address1" placeholder="Address" required>
            <input type="text" class="form-control form-control-sm mt-2" name="address2" placeholder="Address 2">
            <input type="text" class="form-control form-control-sm mt-2" name="city" placeholder="City" required>
            <div class="row">
              <div class="col">
                <select class="form-select form-select-sm mt-2" name="state">
                  <option disabled selected>State</option>
                  <option class="dropdown-item" value="AL">AL</option>
                  <option class="dropdown-item" value="AK">AK</option>
                  <option class="dropdown-item" value="AR">AR</option>
                  <option class="dropdown-item" value="AZ">AZ</option>
                  <option class="dropdown-item" value="CA">CA</option>
                  <option class="dropdown-item" value="CO">CO</option>
                  <option class="dropdown-item" value="CT">CT</option>
                  <option class="dropdown-item" value="DC">DC</option>
                  <option class="dropdown-item" value="DE">DE</option>
                  <option class="dropdown-item" value="FL">FL</option>
                  <option class="dropdown-item" value="GA">GA</option>
                  <option class="dropdown-item" value="HI">HI</option>
                  <option class="dropdown-item" value="IA">IA</option>
                  <option class="dropdown-item" value="ID">ID</option>
                  <option class="dropdown-item" value="IL">IL</option>
                  <option class="dropdown-item" value="IN">IN</option>
                  <option class="dropdown-item" value="KS">KS</option>
                  <option class="dropdown-item" value="KY">KY</option>
                  <option class="dropdown-item" value="LA">LA</option>
                  <option class="dropdown-item" value="MA">MA</option>
                  <option class="dropdown-item" value="MD">MD</option>
                  <option class="dropdown-item" value="ME">ME</option>
                  <option class="dropdown-item" value="MI">MI</option>
                  <option class="dropdown-item" value="MN">MN</option>
                  <option class="dropdown-item" value="MO">MO</option>
                  <option class="dropdown-item" value="MS">MS</option>
                  <option class="dropdown-item" value="MT">MT</option>
                  <option class="dropdown-item" value="NC">NC</option>
                  <option class="dropdown-item" value="NE">NE</option>
                  <option class="dropdown-item" value="NH">NH</option>
                  <option class="dropdown-item" value="NJ">NJ</option>
                  <option class="dropdown-item" value="NM">NM</option>
                  <option class="dropdown-item" value="NV">NV</option>
                  <option class="dropdown-item" value="NY">NY</option>
                  <option class="dropdown-item" value="ND">ND</option>
                  <option class="dropdown-item" value="OH">OH</option>
                  <option class="dropdown-item" value="OK">OK</option>
                  <option class="dropdown-item" value="OR">OR</option>
                  <option class="dropdown-item" value="PA">PA</option>
                  <option class="dropdown-item" value="RI">RI</option>
                  <option class="dropdown-item" value="SC">SC</option>
                  <option class="dropdown-item" value="SD">SD</option>
                  <option class="dropdown-item" value="TN">TN</option>
                  <option class="dropdown-item" value="TX">TX</option>
                  <option class="dropdown-item" value="UT">UT</option>
                  <option class="dropdown-item" value="VT">VT</option>
                  <option class="dropdown-item" value="VA">VA</option>
                  <option class="dropdown-item" value="WA">WA</option>
                  <option class="dropdown-item" value="WI">WI</option>
                  <option class="dropdown-item" value="WV">WV</option>
                  <option class="dropdown-item" value="WY">WY</option>
                </select>
              </div>
              <div class="col">
                <input type="text" class="form-control form-control-sm mt-2" name="zip" placeholder="Zip Code" required>
              </div>
            </div>
            <button type="submit" name="add_patient_addressbtn" class="focus-ring btn btn-sm border mt-5">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
