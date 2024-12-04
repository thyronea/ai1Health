<!-- Modal -->
<div class="modal fade" id="thermometer-edit" tabindex="-1" aria-labelledby="thermometer-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="thermometer-edit-ModalLabel">Edit Thermometer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
      <?php $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); ?>
        <form class="" action="process/edit-thermometer.php" method="POST">
          <div class="form-group mb-2">
            <input type="text" name="id" id="thermID" class="form-control form-control-sm" hidden required>
          </div>
          <div class="form-group mb-2">
            <input type="text" name="engineID" id="therm_engineID" class="form-control form-control-sm" hidden required>
          </div>
          <div class="form-group mb-2">
            <select class="form-select form-select-sm" name="location" id="therm_location" required>
              <option disabled selected>Select Location</option>
              <?php
              $sql = "SELECT * FROM location WHERE groupID='$groupID' ";
              $sql_run = mysqli_query($con, $sql);
              $location = mysqli_num_rows($sql_run);
              while ($location = mysqli_fetch_array($sql_run))
              {
                echo "<option value='". $location['name'] ."'>" .$location['name'] ."</option>" ;
              }
              ?>
            </select>
          </div>
          <div class="form-group mb-2">
            <select class="form-select form-select-sm" name="position" id="therm_position" required>
              <option disabled>Select Position</option>
              <?php
              $sql = "SELECT * FROM storage WHERE groupID='$groupID' ";
              $sql_run = mysqli_query($con, $sql);
              $storage = mysqli_num_rows($sql_run);
              while ($storage = mysqli_fetch_array($sql_run))
              {
                echo "<option value='". htmlspecialchars(decryptthis($storage['name'], $key)) ."'>" .htmlspecialchars(decryptthis($storage['name'], $key)) ."</option>" ;
              }
              ?>
              <option value="Back-up Thermometer">Back-up Thermometer</option>
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

<!--
Title: Edit Thermometer
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.thermometer-editbtn').on('click', function() {

      $('#thermometer-edit').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#thermID').val(data[0]);
      $('#therm_engineID').val(data[1]);
      $('#therm_groupID').val(data[2]);
      $('#therm_location').val(data[3]);
      $('#therm_position').val(data[4]);
      $('#therm_name').val(data[5]);
      $('#therm_serial').val(data[6]);
      $('#therm_expiration').val(data[7]);
    });
  });
</script>
