<!-- Modal -->
<div class="modal fade" id="storage-edit" tabindex="-1" aria-labelledby="storage-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="storage-edit-ModalLabel">Edit Storage Unit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <?php $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); ?>
        <form class="" action="process/edit-unit.php" method="POST">
          <div class="form-group mb-2">
            <input type="text" name="id" id="unit_storageID" class="form-control"  hidden required>
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
            <input type="text" name="position" id="unit_position" class="form-control form-control-sm" placeholder="Location" required>
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

<!--
Title: Edit Unit
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.storage-editbtn').on('click', function() {

      $('#storage-edit').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#unit_storageID').val(data[0]);
      $('#unitEngineID').val(data[1]);
      $('#unit_groupID').val(data[2]);
      $('#unit_location').val(data[3]);
      $('#unit_name').val(data[4]);
      $('#unit_position').val(data[5]);
      $('#unit_type').val(data[6]);
      $('#unit_grade').val(data[7]);
    });
  });
</script>
