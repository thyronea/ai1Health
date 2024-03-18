<div class="modal fade" id="add-sh-Modal" tabindex="-1" aria-labelledby="add-sh-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="add-sh-ModalLabel">Add Storage & Handling Unit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="process/sql.php" method="POST">

            <div class="sh-form mt-3 mb-3">
              <div class="col-md-2">
                <div class="form-group">
                    <input type="hidden" name="storageID" id="storageID" class="form-control">
                </div>
                <div class="form-group">
                    <input type="hidden" name="engineID" id="storage_engineID" class="form-control">
                </div>
                  <div class="form-group">
                      <input type="hidden" name="groupID" value="<?=htmlspecialchars($_SESSION['groupID']); ?>" class="form-control">
                  </div>
              </div>
                <div class="row g-2">
                  <div class="col">
                    <div class="form-group">
                      <select class="form-select form-select-sm" name="office" required>
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
                  </div>
                  <div class="col">
                      <div class="form-group">
                          <input type="text" name="unitLocation[]" class="form-control form-control-sm" placeholder="Location" required>
                      </div>
                  </div>
                </div>
                <div class="row g-2 mt-2">
                  <div class="col-md-3">
                      <div class="form-group">
                        <select class="form-select form-select-sm" name="unitType[]" required>
                          <option disabled selected>Storage Type</option>
                          <option value="Refrigerator">Refrigerator</option>
                          <option value="Freezer">Freezer</option>
                        </select>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                        <select class="form-select form-select-sm" name="unitGrade[]" required>
                          <option disabled selected>Grade</option>
                          <option value="Pharm-Grade">Pharm-Grade</option>
                          <option value="Household">Household</option>
                        </select>
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group">
                          <input type="text" name="unitName[]" class="form-control form-control-sm" placeholder="Brand/Make/Model" required>
                      </div>
                  </div>
                </div>
            </div>
            <div class="paste-new-sh"></div>
            <div class="mt-3">
          <!-- <a type="button" href="javascript:void(0)" class="add-more-sh focus-ring py-1 px-2 btn-outline border btn btn-sm">More</a> -->
              <button type="submit" name="add_unit" class="focus-ring py-1 px-2 btn-outline border btn btn-sm">Add</button>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>
