<!-- Modal -->
<div class="modal fade" id="thermometer-edit" tabindex="-1" aria-labelledby="thermometer-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="thermometer-edit-ModalLabel">Edit Thermometer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <form class="" action="process/sql.php" method="POST">
          <div class="form-group mb-2">
            <input type="text" name="thermometerID" id="thermID" class="form-control form-control-sm" hidden required>
          </div>
          <div class="form-group mb-2">
            <input type="text" name="engineID" id="therm_engineID" class="form-control form-control-sm" hidden required>
          </div>
          <div class="form-group mb-2">
            <select class="form-select form-select-sm" name="office" id="therm_office" required>
              <option disabled selected>Select Office</option>
              <?php
              $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
              $sql = "SELECT * FROM offices WHERE groupID='$groupID' ";
              $sql_run = mysqli_query($con, $sql);
              $office = mysqli_num_rows($sql_run);
              while ($office = mysqli_fetch_array($sql_run))
              {
                echo "<option value='". $office['name'] ."'>" .$office['name'] ."</option>" ;
              }
              ?>
              <option value="Back-up">Back-up</option>
            </select>
          </div>
          <div class="form-group mb-2">
            <select class="form-select form-select-sm" name="therm_location" id="therm_location" required>
              <option disabled selected>Select Location</option>
              <?php
              $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
              $sql = "SELECT * FROM storage WHERE groupID='$groupID' ";
              $sql_run = mysqli_query($con, $sql);
              $storage = mysqli_num_rows($sql_run);
              while ($storage = mysqli_fetch_array($sql_run))
              {
                echo "<option value='". htmlspecialchars(decryptthis($storage['name'], $key)) ."'>" .htmlspecialchars(decryptthis($storage['name'], $key)) ."</option>" ;
              }
              ?>
              <option value="Back-up">Back-up</option>
            </select>
          </div>
          <div class="form-group mb-2">
            <input type="text" name="therm_name" id="therm_name" class="form-control form-control-sm" placeholder="Name/Brand/Model" required>
          </div>

          <div class="row g-2 mb-3">
            <div class="col">
              <div class="form-group mb-2">
                <input type="text" name="therm_serial" id="therm_serial" class="form-control form-control-sm" placeholder="Serial Number" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group mb-2">
                <input type="date" name="therm_expiration" id="therm_expiration" class="form-control form-control-sm" required>
              </div>
            </div>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="submit" name="updatethermometer_btn" class="focus-ring btn btn-outline-secondary btn-sm">Update</button>
          </div>
        </form>
    </div>
  </div>
</div>
