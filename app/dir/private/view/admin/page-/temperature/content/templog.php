<div class="card border-0 m-3">
  <div class="card-body">
    <?php $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); ?>

    <h5>Daily Temperature Log</h5>

    <form action="process/save-temp.php" method="POST">
        <!-- Refrigerator -->
        <div class="row g-2 mt-3">
          <div class="col-md-2">
            <div class="form-group mb-2" style="text-align: right; color: Red">
              <p>Refrigerator:</p>
            </div>
          </div>
          <!-- Date -->
          <div class="col-md-2">
            <div class="form-group mb-2">
              <input type="date" name="r_date" class="form-control form-control-sm mb-1" value="<?php echo $today; ?>" required>
            </div>
          </div>
          <!-- Time -->
          <div class="col-md-2">
            <div class="form-group mb-2">
              <input type="text" name="r_time" class="form-control form-control-sm mb-1" value="<?php echo date("h:i A"); ?>" required>
            </div>
          </div>
          <!-- Refrigerator -->
          <div class="col-md-2">
            <div class="form-group mb-2">
              <select class="form-select form-select-sm" name="refrigerator">
                <option disabled selected>Select Unit</option>
                <?php
                $ref = htmlspecialchars("Refrigerator");
                $sql = "SELECT * FROM storage WHERE groupID='$groupID' AND type='$ref' ";
                $sql_run = mysqli_query($con, $sql);
                $refrigerator = mysqli_num_rows($sql_run);
                while ($refrigerator = mysqli_fetch_array($sql_run))
                {
                  echo "<option value='". htmlspecialchars(decryptthis($refrigerator['name'], $key)) ."'>" .htmlspecialchars(decryptthis($refrigerator['name'], $key)) ."</option>" ;
                }
                ?>
              </select>
            </div>
          </div>
          <!-- Initials/Current/Min/Max -->
          <div class="col-md-4">
            <div class="input-group input-group-sm">
              <input type="text" name="r_initials" class="form-control" placeholder="Initials" required>
              <input type="text" name="r_current" class="form-control" placeholder="Current" required>
              <input type="text" name="r_min" class="form-control" placeholder="Min" required>
              <input type="text" name="r_max" class="form-control" placeholder="Max" required>
            </div>
          </div>

        </div>

        <!-- Freezer -->
        <div class="row g-2">
          <div class="col-md-2">
            <div class="form-group mb-2" style="text-align: right; color: Blue">
              <p>Freezer:</p>
            </div>
          </div>
          <!-- Date  -->
          <div class="col-md-2">
            <div class="form-group mb-2">
              <input type="date" name="f_date" class="form-control form-control-sm mb-1" value="<?php echo $today; ?>" required>
            </div>
          </div>
          <!-- Time  -->
          <div class="col-md-2">
            <div class="form-group mb-2">
              <input type="text" name="f_time" class="form-control form-control-sm mb-1" value="<?php echo date("h:i A"); ?>" required>
            </div>
          </div>
          <!-- Freezer  -->
          <div class="col-md-2">
            <div class="form-group mb-2">
              <select class="form-select form-select-sm" name="freezer" required>
                <option disabled selected>Select Unit</option>
                <?php
                $frz = htmlspecialchars("Freezer");
                $sql = "SELECT * FROM storage WHERE groupID='$groupID' AND type='$frz' ";
                $sql_run = mysqli_query($con, $sql);
                $freezer = mysqli_num_rows($sql_run);
                while ($freezer = mysqli_fetch_array($sql_run))
                {
                  echo "<option value='". htmlspecialchars(decryptthis($freezer['name'], $key)) ."'>" .htmlspecialchars(decryptthis($freezer['name'], $key)) ."</option>" ;
                }
                ?>
              </select>
            </div>
          </div>
          <!-- Initials/Current/Min/Max -->
          <div class="col-md-4">
            <div class="input-group input-group-sm">
              <input type="text" name="f_initials" class="form-control" placeholder="Initials" required>
              <input type="text" name="f_current" class="form-control" placeholder="Current" required>
              <input type="text" name="f_min" class="form-control" placeholder="Min" required>
              <input type="text" name="f_max" class="form-control" placeholder="Max" required>
            </div>
          </div>
        </div>



      <div class="form-group mt-3 mb-2" align="center">
        <button type="submit" name="save_temp_btn" class="focus-ring py-1 px-2 btn btn-sm border">
          Submit
        </button>
      </div>

    </form>
  </div>
</div>
