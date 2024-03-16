<!-- Modal -->
<div class="modal fade" id="storage-edit" tabindex="-1" aria-labelledby="storage-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="storage-edit-ModalLabel">Edit Storage Unit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <form class="" action="process/sql.php" method="POST">
          <div class="form-group mb-2">
            <input type="text" name="storageID" id="unit_storageID" class="form-control" hidden required>
          </div>
          <div class="form-group mb-2">
            <input type="text" name="engineID" id="unit_engineID" class="form-control" hidden required>
          </div>
          <div class="form-group mb-2">
            <select class="form-select form-select-sm" name="office" id="unit_office">
              <option disabled selected>Select Office</option>
              <?php
              $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
              $sql = "SELECT * FROM offices WHERE groupID='$groupID' ";
              $sql_run = mysqli_query($con, $sql);
              $office = mysqli_num_rows($sql_run);
              while ($office = mysqli_fetch_array($sql_run))
              {
                echo "<option value='". htmlspecialchars($office['name']) ."'>" .htmlspecialchars($office['name']) ."</option>" ;
              }
              ?>
            </select>
          </div>
          <div class="form-group mb-2">
            <input type="text" name="unit_location" id="unit_location" class="form-control form-control-sm" placeholder="Location" required>
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
            <input type="text" name="unit_name" id="unit_name" class="form-control form-control-sm" placeholder="Name" required>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="submit" name="updatestorage_btn" class="focus-ring btn btn-outline-secondary btn-sm">Update</button>

          </div>
        </form>

      </div>
    </div>
  </div>
</div>
