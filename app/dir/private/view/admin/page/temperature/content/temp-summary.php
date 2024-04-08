<div class="tab-pane fade show active" id="v-pills-view-temp-summary" role="tabpanel" aria-labelledby="v-pills-view-temp-summary" tabindex="0">
  <div class="container px-3 mb-4">
    <div class="row m-2 mb-3">
      <div class="card col-md-12 shadow">
        <div class="card-body" align="center" style="text-align: center">

          <h5>Storage & Handling Summary</h5>

          <div class="row g-2 mt-3">

            <!-- Storage & Handling -->
            <div class="col-md-6">
              <div class="card mb-2">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <table class="table align-middle table-borderless table-sm table-hover text-nowrap" style="text-align: left">
                        <tbody align="center">
                          <thead>
                            <th>Storage Unit:</th>
                          </thead>
                          <?php
                          $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                          $query = "SELECT * FROM storage WHERE groupID='$groupID' ";
                          $query_run = mysqli_query($con, $query);

                          if(mysqli_num_rows($query_run) > 0)
                          {
                            foreach($query_run as $storage)
                            {
                              ?>
                              <tr>
                                <td hidden><small><?= htmlspecialchars($storage['id']);?></small></td>
                                <td hidden><small><?= htmlspecialchars($storage['engineID']);?></small></td>
                                <td hidden><small><?= htmlspecialchars($storage['groupID']);?></small></td>
                                <td hidden><small><?= htmlspecialchars($storage['location']);?></small></td>
                                <td hidden><small><?= htmlspecialchars(decryptthis($storage['position'], $key));?></small></td>
                                <td hidden><small><?= htmlspecialchars(decryptthis($storage['name'], $key));?></small></td>
                                <td hidden><small><?= htmlspecialchars($storage['type']);?></small></td>
                                <td hidden><small><?= htmlspecialchars(decryptthis($storage['grade'], $key));?></small></td>
                                <td><a type="button" class="focus-ring border-none text-decoration-none storage-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#storage-edit"><small><?= htmlspecialchars(decryptthis($storage['name'], $key));?></small></a></td>

                              </tr>
                              <?php
                            }
                          }
                          else
                          {
                          ?>
                              <tr>
                                <td colspan="6" align="center"><small>No Storage Unit Data Found</small></td>
                              </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="col">
                      <table class="table align-middle table-borderless table-sm table-hover text-nowrap" style="text-align: left">
                        <tbody align="center">
                          <thead>
                            <th>Thermometer:</th>
                          </thead>
                          <?php
                          $query = "SELECT * FROM thermometers WHERE groupID='$groupID' ";
                          $query_run = mysqli_query($con, $query);

                          if(mysqli_num_rows($query_run) > 0)
                          {
                            foreach($query_run as $thermometer)
                            {
                              ?>
                              <tr>
                                <td hidden><small><?= htmlspecialchars($thermometer['id']);?></small></td>
                                <td hidden><small><?= htmlspecialchars($thermometer['engineID']);?></small></td>
                                <td hidden><small><?= htmlspecialchars($thermometer['groupID']);?></small></td>
                                <td hidden><small><?= htmlspecialchars($thermometer['location']);?></small></td>
                                <td hidden><a type="button" class="focus-ring border-none text-decoration-none thermometer-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#thermometer-edit"><small><?=htmlspecialchars(decryptthis($thermometer['position'], $key));?></small></a></td>
                                <td ><a type="button" class="focus-ring border-none text-decoration-none thermometer-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#thermometer-edit"><small><?=htmlspecialchars(decryptthis($thermometer['name'], $key));?></small></a></td>
                                <td hidden><small><?=htmlspecialchars(decryptthis($thermometer['serial'], $key));?></small></td>
                                <td hidden><small><?=htmlspecialchars(decryptthis($thermometer['expiration'], $key));?></small></td>
                              </tr>
                              <?php
                            }
                          }
                          else
                          {
                          ?>
                              <tr>
                                <td colspan="6" align="center"><small>No Thermometer Data Found</small></td>
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

            <!-- Refrigerator -->
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <?php
                  $query_avg = "SELECT cast(AVG(current) AS DECIMAL(9,1)) FROM fridgetemp WHERE groupID='$groupID' ";
                  $query_avg_run = mysqli_query($con, $query_avg);
                  $avg = mysqli_fetch_array($query_avg_run);

                  $query_max = "SELECT MAX(max) FROM fridgetemp WHERE groupID='$groupID' ";
                  $query_max_run = mysqli_query($con, $query_max);
                  $max = mysqli_fetch_array($query_max_run);

                  $query_min = "SELECT MIN(min) FROM fridgetemp WHERE groupID='$groupID' ";
                  $query_min_run = mysqli_query($con, $query_min);
                  $min = mysqli_fetch_array($query_min_run);
                  ?>

                  <div class="row" style="text-align:left">
                    <h6 style="color:red">Refrigerator</h6>
                    <small>Average: <?=$avg['cast(AVG(current) AS DECIMAL(9,1))'];?>F&deg;</small>
                    <small>Highest: <?=$max['MAX(max)'];?>F&deg; </small>
                    <small>Lowest: <?=$min['MIN(min)'];?>F&deg;</small>
                  </div>

                </div>
              </div>
            </div>
            <!-- Freezer -->
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <?php
                  $query_avg = "SELECT cast(AVG(current) AS DECIMAL(9,1)) FROM freezertemp WHERE groupID='$groupID' ";
                  $query_avg_run = mysqli_query($con, $query_avg);
                  $avg = mysqli_fetch_array($query_avg_run);

                  $query_max = "SELECT MAX(max) FROM freezertemp WHERE groupID='$groupID' ";
                  $query_max_run = mysqli_query($con, $query_max);
                  $max = mysqli_fetch_array($query_max_run);

                  $query_min__ = "SELECT MIN(min) FROM freezertemp WHERE groupID='$groupID' ";
                  $query_min_run__ = mysqli_query($con, $query_min__);
                  $min = mysqli_fetch_array($query_min_run__);
                  ?>

                  <div class="row" style="text-align:left">
                    <h6 style="color:blue">Freezer</h6>
                    <small>Average: <?=$avg['cast(AVG(current) AS DECIMAL(9,1))'];?>F&deg;</small>
                    <small>Highest: <?=$max['MAX(max)'];?>F&deg;</small>
                    <small>Lowest: <?=$min['MIN(min)'];?>F&deg;</small>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="row m-2 g-2 mb-3">
      <div class="card shadow">
        <div class="card-body" align="center">
          <h5>Temp Chart</h5>
        </div>
      </div>
    </div>
  </div>
</div>
