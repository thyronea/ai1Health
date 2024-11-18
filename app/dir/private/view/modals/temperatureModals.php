<!-- Add Thermomerter -->
<div class="modal fade" id="addThermometer" tabindex="-1" aria-labelledby="add-thermometer-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="add-thermometer-ModalLabel">Add Thermometer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="" method="POST">
        <?php $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); ?>
            <div class="thermometer-form mt-3 mb-3">
              <div class="col-md-2">
                <div class="form-group mb-3">
                    <input type="hidden" name="engineID" id="thermometer_engineID" class="form-control form-control-sm">
                </div>
              </div>
              <div class="row mb-3 g-2">
                <div class="col">
                  <label for="location"><small>Location</small></label>
                  <select class="form-group form-select form-select-sm" name="location" required>
                    <option></option>
                    <option disabled>Select Location</option>
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
                <label for="position"><small>Position</small></label>
                  <select class="form-group form-select form-select-sm" name="position" required>
                    <option></option>
                    <option disabled>Select Unit</option>
                    <?php
                    $sql = "SELECT * FROM storage WHERE groupID='$groupID' ";
                    $sql_run = mysqli_query($con, $sql);
                    while ($storage = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars(decryptthis($storage['name'], $key)) ."'>" .htmlspecialchars(decryptthis($storage['name'], $key)) ."</option>" ;
                    }
                    ?>
                    <option value="Back-up Thermometer">Back-up Thermometer</option>
                  </select>
                </div>
              </div>
              <div class="row mb-3 g-2">
                <div class="col-md-6">
                  <div class="form-group">
                      <input type="text" name="thermName" class="form-control form-control-sm text-center" placeholder="Brand/Make/Model" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                      <input type="text" name="thermSerial" class="form-control form-control-sm text-center" placeholder="Serial Number" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                      <input type="date" name="thermExpiration" class="form-control form-control-sm text-center" required>
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

<!--- Add Unit -->
<div class="modal fade" id="add-sh-Modal" tabindex="-1" aria-labelledby="add-sh-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="add-sh-ModalLabel">Add Storage & Handling Unit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); ?>
        <form action="" method="POST">
          <div class="form-group mb-2 mt-2">
            <input type="hidden" name="engineID" id="unit_engineID" class="form-control form-control-sm" required>
          </div>
            <div class="sh-form mt-3 mb-3">
                <div class="col-md-10 g-2">
                    <div class="form-group">
                      <label for="location"><small>Location</small></label>
                      <select class="form-select form-select-sm" name="location" required>
                        <option></option>
                        <?php
                        $sql = "SELECT * FROM location WHERE groupID='$groupID' ";
                        $sql_run = mysqli_query($con, $sql);
                        while ($location = mysqli_fetch_array($sql_run))
                        {
                          echo "<option value='". htmlspecialchars($location['name']) ."'>" .htmlspecialchars($location['name']) ."</option>" ;
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="unitPosition"><small>Position</small></label>
                        <input title="Where is the Storage & handling unit located?" type="text" name="unitPosition" class="form-control form-control-sm" required>
                    </div>
                    <div class="row g-2">
                      <div class="col">
                        <div class="form-group">
                          <label for="unitType"><small>Type</small></label>
                          <select class="form-select form-select-sm" name="unitType" required>
                          <option></option>
                            <option value="Refrigerator">Refrigerator</option>
                            <option value="Freezer">Freezer</option>
                          </select>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="unitGrade"><small>Grade</small></label>
                          <select class="form-select form-select-sm" name="unitGrade" required>
                          <option></option>
                            <option value="Pharm-Grade">Pharm-Grade</option>
                            <option value="Household">Household</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group mt-3">
                          <input type="text" name="unitName" class="form-control form-control-sm text-center" placeholder="Brand/Make/Model" required>
                      </div>
                  </div>

                </div>
            </div>
            <div class="paste-new-sh"></div>
            <div class="mt-3">
          <!-- <a type="button" href="javascript:void(0)" class="add-more-sh focus-ring py-1 px-2 btn-outline border btn btn-sm">More</a> -->
              <button type="submit" name="add_unit" class="focus-ring py-1 px-2 btn-outline border btn btn-sm mt-3">Add</button>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>

<!-- Edit Unit -->
<div class="modal fade" id="storage-edit" tabindex="-1" aria-labelledby="storage-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="storage-edit-ModalLabel">Edit Storage Unit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <?php $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); ?>
        <form class="" action="" method="POST">
          <div class="form-group mb-2">
            <input type="hidden" name="id" id="unit_storageID" class="form-control" required>
          </div>
          <div class="form-group mb-2">
            <input type="text" name="engineID" id="unitEngineID" class="form-control" hidden required>
          </div>
          <div class="form-group mb-2">
            <input type="text" name="groupID" id="unit_groupID" class="form-control" hidden required>
          </div>
          <div class="form-group mb-2">
            <select class="form-select form-select-sm" name="location" id="unit_location">
              <option disabled selected>Select Location</option>
              <?php
              $sql = "SELECT * FROM location WHERE groupID='$groupID' ";
              $sql_run = mysqli_query($con, $sql);
              while ($location = mysqli_fetch_array($sql_run))
              {
                echo "<option value='". htmlspecialchars($location['name']) ."'>" .htmlspecialchars($location['name']) ."</option>" ;
              }
              ?>
            </select>
          </div>
          <div class="form-group mb-2">
            <input type="text" name="position" id="unit_position" class="form-control form-control-sm" placeholder="Location" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" data-bs-content="Unit Location" required>
          </div>
          <div class="row g-2">
            <div class="col">
              <div class="form-group mb-2">
                <select class="form-select form-select-sm" name="unit_type" id="unit_type" placeholder="Type" required>
                  <option disabled selected>Select Unit Type</option>
                  <option value="Refrigerator">Refrigerator</option>
                  <option value="Freezer">Freezer</option>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group mb-2">
                <select class="form-select form-select-sm" name="unit_grade" id="unit_grade" placeholder="Grade" required>
                  <option disabled selected>Select Unit Grade</option>
                  <option value="Pharm-Grade">Pharm-Grade</option>
                  <option value="Household">Household</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <input type="text" name="unit_name" id="unit_name" class="form-control form-control-sm" placeholder="Name" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" data-bs-content="Brand & Model" required>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="submit" name="updatestorage_btn" class="focus-ring btn btn-outline-secondary btn-sm">Update</button>

          </div>
        </form>

      </div>
    </div>
  </div>
</div>

<!-- Delete Unit -->
<div class="modal fade" id="storagedeletemodal" tabindex="-1" aria-labelledby="storagedeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title fs-5" id="storagedeletemodal-ModalLabel">Delete Storage Unit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input class="form-control mb-2" type="hidden" name="id" id="delete_storage_storageID">
            <input class="form-control mb-2" type="hidden" name="engineID" id="delete_storage_engineID">
            <input class="form-control mb-2" type="hidden" name="delete_storage_location" id="delete_storage_location">
            <input class="form-control mb-2" type="hidden" name="delete_storage_name" id="delete_storage_name">
            <!----------------------------------------------------->
            <p align="center">Storage unit will be permanently removed from database.</p>
            <p>Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-secondary btn-sm">No</button>
            <button type="submit" name="storagedeletebtn" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- Delete Thermometer -->
<div class="modal fade" id="thermometerdeletemodal" tabindex="-1" aria-labelledby="storagedeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="thermometerdeletemodal-ModalLabel">Delete Thermometer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input class="form-control mb-2" type="hidden" name="id" id="delete_thermID">
            <input class="form-control mb-2" type="hidden" name="engineID" id="delete_therm_engineID">
            <input class="form-control mb-2" type="hidden" name="delete_thermometer_location" id="delete_therm_location">
            <input class="form-control mb-2" type="hidden" name="delete_thermometer_name" id="delete_therm_name">
            <!----------------------------------------------------->
            <p align="center">Thermometer will be permanently removed from database.</p>
            <p>Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-secondary btn-sm">No</button>
            <button type="submit" name="thermometerdeletebtn" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- Edit Thermometer -->
<div class="modal fade" id="thermometer-edit" tabindex="-1" aria-labelledby="thermometer-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="thermometer-edit-ModalLabel">Edit Thermometer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
      <?php $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); ?>
        <form class="" action="" method="POST">
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
