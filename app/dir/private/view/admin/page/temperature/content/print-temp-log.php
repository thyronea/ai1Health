<?php
include('../../components/print.php');
 ?>

<div class="tab-pane fade" id="v-pills-print-temp-log" role="tabpanel" aria-labelledby="v-pills-print-temp-log-tab" tabindex="0">
  <div class="container px-3 mb-4" id="tempLogPrintThis">
    <div class="row m-2">

      <!-- Refrigerator Summary -->
      <div class="col-md-3 mt-3">
        <div class="card border-0">
          <div class="card-body">
            <?php
            $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
            $query_avg = "SELECT cast(AVG(current) AS DECIMAL(9,1)) FROM fridgetemp WHERE groupID='$groupID' ";
            $query_avg_run = mysqli_query($con, $query_avg);
            $avg = mysqli_fetch_array($query_avg_run);

            $query_max = "SELECT MAX(max) FROM fridgetemp WHERE groupID='$groupID' ";
            $query_max_run = mysqli_query($con, $query_max);
            $max = mysqli_fetch_array($query_max_run);

            $query_min = "SELECT MIN(min) FROM fridgetemp WHERE groupID='$groupID' ";
            $query__min_run = mysqli_query($con, $query_min);
            $min = mysqli_fetch_array($query__min_run);
            ?>

            <div class="row" style="text-align:left">
              <h6 style="color:red">Refrigerator</h6>
              <small>Average: <?=$avg['cast(AVG(current) AS DECIMAL(9,1))']; ?>F&deg;</small>
              <small>Highest: <?=$max['MAX(max)']; ?>F&deg;</small>
              <small>Lowest: <?=$min['MIN(min)']; ?>F&deg;</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Fridge Table -->
      <div class="col">
        <div class="card col-md-12 shadow">
          <div class="card-body" align="center" style="text-align: center">
            <table class="table align-middle table-hover text-nowrap mt-4">
              <h4 style="color:red">Refrigerator Temperature Log - F&deg;</h4>
              <hr>
              <thead>
                <th><small>Date</small></th>
                <th><small>Time</small></th>
                <th><small>Initials</small></th>
                <th><small>Current</small></th>
                <th><small>Min</small></th>
                <th><small>Max</small></th>
                <th><small>SHOTS ID</small></th>
              </thead>
              <tbody>
                <?php
                $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']); // this code will only show users from the same groupID
                $query = "SELECT * FROM fridgetemp WHERE groupID='$groupID' ORDER BY date DESC";
                $query_run = mysqli_query($con, $query);

                if(mysqli_num_rows($query_run) > 0)
                {
                  foreach($query_run as $fridge)
                  {
                    ?>
                    <tr>

                      <td hidden><?= $fridge['id'];?></td>
                      <td><small><?= $fridge['date'];?></small></td>
                      <td><small><?= $fridge['time'];?></small></td>
                      <td><small><?= $fridge['initials'];?></small></td>
                      <td><small><?= $fridge['current'];?></small></td>
                      <td><small><?= $fridge['min'];?></small></td>
                      <td><small><?= $fridge['max'];?></small></td>
                      <td><small><?= $fridge['shots'];?></small></td>

                    </tr>
                    <?php
                  }
                }
                else
                {
                ?>
                    <tr>
                      <td colspan="6">Log is empty</td>
                    </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>


      <!-- Freezer Summary -->
      <div class="col-md-3 mt-5">
        <div class="card border-0">
          <div class="card-body">
            <?php
            $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
            $query_avg = "SELECT cast(AVG(current) AS DECIMAL(9,1)) FROM freezertemp WHERE groupID='$groupID' ";
            $query_avg_run = mysqli_query($con, $query_avg);
            $avg = mysqli_fetch_array($query_avg_run);

            $query_max = "SELECT MAX(max) FROM freezertemp WHERE groupID='$groupID' ";
            $query_max_run = mysqli_query($con, $query_max);
            $max = mysqli_fetch_array($query_max_run);

            $query_min = "SELECT MIN(min) FROM freezertemp WHERE groupID='$groupID' ";
            $query__min_run = mysqli_query($con, $query_min);
            $min = mysqli_fetch_array($query__min_run);
            ?>

            <div class="row" style="text-align:left">
              <h6 style="color:blue">Freezer</h6>
              <small>Average: <?=$avg['cast(AVG(current) AS DECIMAL(9,1))']; ?>F&deg;</small>
              <small>Highest: <?=$max['MAX(max)']; ?>F&deg;</small>
              <small>Lowest: <?=$min['MIN(min)']; ?>F&deg;</small>
            </div>
          </div>
        </div>
      </div>
      <!-- Fridge Table -->
      <div class="col">
        <div class="card col-md-12 shadow">
          <div class="card-body" align="center" style="text-align: center">
            <table class="table align-middle table-hover text-nowrap mt-4">
              <h4 style="color:blue">Freezer Temperature Log - F&deg;</h4>
              <hr>
              <thead>
                <th><small>Date</small></th>
                <th><small>Time</small></th>
                <th><small>Initials</small></th>
                <th><small>Current</small></th>
                <th><small>Min</small></th>
                <th><small>Max</small></th>
                <th><small>SHOTS ID</small></th>
              </thead>
              <tbody>
                <?php
                $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']); // this code will only show users from the same groupID
                $query = "SELECT * FROM freezertemp WHERE groupID='$groupID' ORDER BY date DESC";
                $query_run = mysqli_query($con, $query);

                if(mysqli_num_rows($query_run) > 0)
                {
                  foreach($query_run as $fridge)
                  {
                    ?>
                    <tr>

                      <td hidden><?= $fridge['id'];?></td>
                      <td><small><?= $fridge['date'];?></small></td>
                      <td><small><?= $fridge['time'];?></small></td>
                      <td><small><?= $fridge['initials'];?></small></td>
                      <td><small><?= $fridge['current'];?></small></td>
                      <td><small><?= $fridge['min'];?></small></td>
                      <td><small><?= $fridge['max'];?></small></td>
                      <td><small><?= $fridge['shots'];?></small></td>

                    </tr>
                    <?php
                  }
                }
                else
                {
                ?>
                    <tr>
                      <td colspan="6">Log is empty</td>
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

<!-- Hides background and print entire table on Vaccine Report -->
<!-- <?php include('scripts/print-tempLogs-script.php'); ?> -->
