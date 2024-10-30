<div class="modal fade" id="add-sh-Modal" tabindex="-1" aria-labelledby="add-sh-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="add-sh-ModalLabel">Add Storage & Handling Unit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); ?>
        <form action="process/add-unit.php" method="POST">
          <div class="form-group mb-2 mt-2">
            <input type="text" name="engineID" id="unit_engineID" class="form-control form-control-sm" hidden required>
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
  document.getElementById("unit_engineID").value = randomNumber(7);
</script>