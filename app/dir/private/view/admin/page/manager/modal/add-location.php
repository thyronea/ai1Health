<!-- Modal -->
<div class="modal fade" id="add-location-Modal" tabindex="-1" aria-labelledby="add-location-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="add-office-ModalLabel">Add Location</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form class="" action="process/location-add.php" method="POST">
          <div class="form-group mb-2 mt-2">
            <input type="text" name="engineID" id="office_engineID" class="form-control form-control-sm"  hidden required>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2 mt-2">
                <select class="form-select form-select-sm" name="poc" required>
                  <option disabled selected>Point of Contact</option>
                    <?php
                        $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                        $engineID = mysqli_real_escape_string($con, $_SESSION['engineID']);
                        $sql = "SELECT * FROM profile WHERE groupID='$groupID' ";
                        $sql_run = mysqli_query($con, $sql);
                        if(mysqli_num_rows($sql_run)){
                          foreach($sql_run as $row){
                            $fname = htmlspecialchars($row['fname']);
                            echo "<option value='". $fname ."'>" .$fname ."</option>" ;
                          }
                        }
                    ?>
                </select>
            </div>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2 mt-2">
              <input type="text" name="name" placeholder="Name of Location" class="form-control form-control-sm" required>
            </div>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2 mt-2">
              <input type="text" name="address1" placeholder="Address" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-4 form-group mb-2">
              <input type="text" name="address2" placeholder="Address 2" class="form-control form-control-sm">
            </div>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2">
              <input type="text" name="city" placeholder="City" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-2 dropdown mb-2">
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
            <div class="col-md-4 form-group mb-2">
              <input type="text" name="zip" placeholder="Zip" class="form-control form-control-sm" required>
            </div>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2">
              <input type="text" name="phone" placeholder="Phone Number" class="form-control form-control-sm" required>
            </div>
            <div class="col form-group mb-2">
              <input type="text" name="email" placeholder="Email Address" class="form-control form-control-sm" required>
            </div>
          </div>
          <div class="row g-2">
            <div class="mb-3">
              <input type="text" name="link" placeholder="Website Link" class="form-control form-control-sm">
            </div>
          </div>
      </div>
      <div class="modal-footer col d-flex justify-content-center form-group">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#account-manager-Modal">Back</button>
        <button type="submit" name="register_location" class="btn btn-outline-secondary btn-sm">Add</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Script for generating random Engine ID -->
<script>
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 9) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("office_engineID").value = randomNumber(7);
</script>