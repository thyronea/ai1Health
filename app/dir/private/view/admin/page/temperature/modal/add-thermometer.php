<div class="modal fade" id="addThermometer" tabindex="-1" aria-labelledby="add-thermometer-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="add-thermometer-ModalLabel">Add Thermometer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="process/add-thermometer.php" method="POST">
        <?php $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); ?>
            <div class="thermometer-form mt-3 mb-3">
              <div class="col-md-2">
                <div class="form-group">
                    <input type="hidden" name="thermometerID" id="thermometerID" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <input type="hidden" name="engineID" id="thermometer_engineID" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                  <input type="hidden" name="groupID" value="<?=htmlspecialchars($_SESSION['groupID']); ?>" class="form-control">
                </div>
              </div>
              <div class="row mb-3 g-2">
                <div class="col">
                  <select class="form-group form-select form-select-sm" name="office" required>
                    <option disabled selected>Select Location</option>
                      <?php
                      $sql = "SELECT * FROM location WHERE groupID='$groupID' ";
                      $sql_run = mysqli_query($con, $sql);
                      while ($location = mysqli_fetch_array($sql_run))
                      {
                        echo "<option value='". $location['name'] ."'>" .$location['name'] ."</option>" ;
                      }
                      ?>
                  </select>
                </div>
                <div class="col">
                  <select class="form-group form-select form-select-sm" name="thermLocation[]" required>
                    <option disabled selected>Select Unit</option>
                    <?php
                    $sql = "SELECT * FROM storage WHERE groupID='$groupID' ";
                    $sql_run = mysqli_query($con, $sql);
                    while ($storage = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars(decryptthis($storage['name'], $key)) ."'>" .htmlspecialchars(decryptthis($storage['name'], $key)) ."</option>" ;
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="row mb-3 g-2">
                <div class="col-md-6">
                  <div class="form-group">
                      <input type="text" name="thermName[]" class="form-control form-control-sm" placeholder="Brand/Make/Model" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                      <input type="text" name="thermSerial[]" class="form-control form-control-sm" placeholder="Serial Number" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                      <input type="date" name="thermExpiration[]" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
            </div>

          <div class="paste-new-thermometer"></div>

          <div class="mt-3">
          <!--  <a type="button" href="javascript:void(0)" class="add-more-thermometer focus-ring py-1 px-2 btn-outline border btn btn-sm">More</a> -->
            <button type="submit" name="add_thermometer" class="focus-ring py-1 px-2 btn-outline border btn btn-sm">Add</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>
