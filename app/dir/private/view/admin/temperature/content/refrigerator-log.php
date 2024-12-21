<!-- Fridge Table -->
<div class="mt-3" align="center" style="text-align: center">
  <div class="card border-0" style="height:35rem; overflow: auto">
    <div class="card-body">
      <table class="table table-sm align-middle table-hover text-nowrap">
        <h5 style="color:red">Refrigerator Temperature Log - F&deg;</h5>
        <hr>
        <thead>
          <th style="text-align: left"><small>Date</small></th>
          <th style="text-align: left"><small>Time</small></th>
          <th style="text-align: left"><small>Storage Unit</small></th>
          <th style="text-align: left"><small>Initials</small></th>
          <th style="text-align: left"><small>Current</small></th>
          <th style="text-align: left"><small>Min</small></th>
          <th style="text-align: left"><small>Max</small></th>
          <th><small>Alarm</small></th>
        </thead>
        <tbody>
          <?php
          $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); // this code will only show users from the same groupID
          $query = "SELECT * FROM fridgetemp WHERE groupID='$groupID' ORDER BY id DESC";
          $query_run = mysqli_query($con, $query);

          if(mysqli_num_rows($query_run) > 0)
          {
            foreach($query_run as $fridge)
            {
              $refAlarm = htmlspecialchars($fridge['alarm']);
              ?>
              <tr>
                <td hidden><?=htmlspecialchars($fridge['id']);?></td>
                <td style="text-align: left"><small><?=htmlspecialchars($fridge['date']);?></td>
                <td style="text-align: left"><small><?= htmlspecialchars($fridge['time']);?></small></td>
                <td style="text-align: left"><small><?=htmlspecialchars(decryptthis($fridge['refrigerator'], $key));?></small></td>
                <td style="text-align: left"><small><?=htmlspecialchars($fridge['initials']);?></small></td>
                <?php
                  if($refAlarm == "0"){
                    ?>
                      <td style="text-align: left"><small><?=htmlspecialchars($fridge['current']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($fridge['min']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($fridge['max']);?></small></td>
                    <?php
                    $refAlarm = null;
                  }
                  if($refAlarm == "1" || $refAlarm == "6"){
                    ?>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($fridge['current']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($fridge['min']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($fridge['max']);?></small></td>
                    <?php
                    $refAlarm = "<i class='bi bi-x-octagon' style='color:red'></i>";
                  }
                  if($refAlarm == "2"){
                    ?>
                      <td style="text-align: left"><small><?=htmlspecialchars($fridge['current']);?></small></td>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($fridge['min']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($fridge['max']);?></small></td>
                    <?php
                    $refAlarm = "<i class='bi bi-x-octagon' style='color:red'></i>";
                  }
                  if($refAlarm == "3"){
                    ?>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($fridge['current']);?></small></td>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($fridge['min']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($fridge['max']);?></small></td>
                    <?php
                    $refAlarm = "<i class='bi bi-x-octagon' style='color:red'></i>";
                  }
                  if($refAlarm == "4" || $refAlarm == "5" || $refAlarm == "9" || $refAlarm == "10"){
                    ?>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($fridge['current']);?></small></td>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($fridge['min']);?></small></td>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($fridge['max']);?></small></td>
                    <?php
                    $refAlarm = "<i class='bi bi-x-octagon' style='color:red'></i>";
                  }
                  if($refAlarm == "7"){
                    ?>
                      <td style="text-align: left"><small><?=htmlspecialchars($fridge['current']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($fridge['min']);?></small></td>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($fridge['max']);?></small></td>
                    <?php
                    $refAlarm = "<i class='bi bi-x-octagon' style='color:red'></i>";
                  }
                  if($refAlarm == "8"){
                    ?>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($fridge['current']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($fridge['min']);?></small></td>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($fridge['max']);?></small></td>
                    <?php
                    $refAlarm = "<i class='bi bi-x-octagon' style='color:red'></i>";
                  }
                ?>
                <td><small><?=$refAlarm?></small></td>
              </tr>
              <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
