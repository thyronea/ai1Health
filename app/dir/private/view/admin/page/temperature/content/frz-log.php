<div class="tab-pane fade" id="v-pills-view-frz" role="tabpanel" aria-labelledby="v-pills-view-frz-tab" tabindex="0">
  <div class="container px-3 mb-4">
    <div class="row m-2">

      <!-- Fridge Table -->
      <div class="col">
        <div class="card col-md-12 shadow">
          <div class="card-body" align="center" style="text-align: center">
            <table class="table table-sm align-middle table-hover text-nowrap mt-4" style="text-align: left">
              <h5 style="color:blue">Freezer Temperature Log - F&deg;</small></h5>
              <hr>
              <thead>
                <th><small>Date</small></th>
                <th><small>Time</small></th>
                <th><small>Storage Unit</small></th>
                <th><small>Initials</small></th>
                <th><small>Current</small></th>
                <th><small>Min</small></th>
                <th><small>Max</small></th>
              </thead>
              <tbody>
                <?php
                $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']); // this code will only show users from the same groupID
                $query = "SELECT * FROM freezertemp WHERE groupID='$groupID' ORDER BY date DESC";
                $query_run = mysqli_query($con, $query);

                if(mysqli_num_rows($query_run) > 0)
                {
                  foreach($query_run as $freezer)
                  {
                    ?>
                    <tr>
                      <td hidden><?=htmlspecialchars(decryptthis($freezer['id'], $key));?></td>
                      <td><small><?=htmlspecialchars($freezer['date']);?></td>
                      <td><small><?= htmlspecialchars($freezer['time']);?></small></td>
                      <td><small><?=htmlspecialchars(decryptthis($freezer['freezer'], $key));?></small></td>
                      <td><small><?=htmlspecialchars($freezer['initials']);?></small></td>
                      <td><small><?=htmlspecialchars($freezer['current']);?></small></td>
                      <td><small><?=htmlspecialchars($freezer['min']);?></small></td>
                      <td><small><?=htmlspecialchars($freezer['max']);?></small></td>
                    </tr>
                    <?php
                  }
                }
                else
                {
                ?>
                  <tr>
                    <td colspan="6"><small>Log is empty</small></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
