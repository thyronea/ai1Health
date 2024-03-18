<!-- Modal -->
<div class="modal fade" id="office-edit" tabindex="-1" aria-labelledby="office-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="office-edit-ModalLabel">Edit Office</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="process/sql.php" method="POST">
          <div class="form-group mb-2 mt-2">
            <input type="text" name="userID" value="<?=htmlspecialchars($_SESSION['userID']);?>" class="form-control form-control-sm" hidden required>
          </div>
          <div class="form-group mb-2">
            <input type="text" name="officeID" id="officeid" class="form-control form-control-sm" hidden required>
          </div>
          <div class="form-group mb-2">
            <input type="text" name="engineID" id="office_engineid" class="form-control form-control-sm" hidden required>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2">
              <input type="text" name="name" id="name" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-4 form-group mb-2">
              <input type="text" name="pin" id="vfcPIN" class="form-control form-control-sm" required>
            </div>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2">
              <input type="text" name="address1" id="address1" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-4 form-group mb-2">
              <input type="text" name="address2" id="address2" class="form-control form-control-sm" placeholder="Address 2">
            </div>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2">
              <input type="text" name="city" id="city" class="form-control form-control-sm" placeholder="City" required>
            </div>
            <div class="col-md-2 dropdown mb-2">
              <select class="form-select form-select-sm" name="state" id="state" required>
                <option disabled>select one</option>
                <option value="AL">AL</option>
              	<option value="AK">AK</option>
              	<option value="AR">AR</option>
              	<option value="AZ">AZ</option>
              	<option value="CA">CA</option>
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
            <div class="col-md-4 form-group mb-3">
              <input type="text" name="zip" id="zip" class="form-control form-control-sm" placeholder="Zip" required>
            </div>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2">
              <input type="text" name="phone" id="phone" class="form-control form-control-sm" placeholder="Phone" required>
            </div>
            <div class="col form-group mb-2">
              <input type="text" name="office_email" id="office_email" class="form-control form-control-sm" placeholder="Email" required>
            </div>
          </div>
          <div class="row g-2">
            <div class="col fom-group mb-4">
              <input type="text" name="office_link" id="office_link" class="form-control form-control-sm" placeholder="Website Link" required>
            </div>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#account-settings-Modal">Back</button>
            <button type="submit" name="office_update_btn" class="btn btn-outline-secondary btn-sm">Update</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>
