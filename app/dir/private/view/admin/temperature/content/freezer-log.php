<!-- Fridge Table -->
<div class="mt-3" align="center" style="text-align: center">
  <div class="card border-0" style="height:35rem; overflow: auto">
    <div class="card-body">
      <table class="table table-sm align-middle table-hover text-nowrap">
        <h5 style="color:blue">Freezer Temperature Log - F&deg;</small></h5>
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
          $query = "SELECT * FROM freezertemp WHERE groupID='$groupID' ORDER BY id DESC";
          $query_run = mysqli_query($con, $query);

          if(mysqli_num_rows($query_run) > 0)
          {
            foreach($query_run as $freezer)
            {
              $frzAlarm = htmlspecialchars($freezer['alarm']);
              ?>
              <tr>
                <td hidden><?=htmlspecialchars($freezer['id']);?></td>
                <td style="text-align: left"><small><?=htmlspecialchars($freezer['date']);?></td>
                <td style="text-align: left"><small><?= htmlspecialchars($freezer['time']);?></small></td>
                <td style="text-align: left"><small><?=htmlspecialchars(decryptthis($freezer['freezer'], $key));?></small></td>
                <td style="text-align: left"><small><?=htmlspecialchars($freezer['initials']);?></small></td>
                <?php
                  if($frzAlarm == "0"){
                    ?>
                      <td style="text-align: left"><small><?=htmlspecialchars($freezer['current']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($freezer['min']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($freezer['max']);?></small></td>
                    <?php
                    $frzAlarm = null;
                  }
                  if($frzAlarm == "1" || $frzAlarm == "6"){
                    ?>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($freezer['current']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($freezer['min']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($freezer['max']);?></small></td>
                    <?php
                    $frzAlarm = "<i class='bi bi-x-octagon' style='color:red'></i>";
                  }
                  if($frzAlarm == "2"){
                    ?>
                      <td style="text-align: left"><small><?=htmlspecialchars($freezer['current']);?></small></td>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($freezer['min']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($freezer['max']);?></small></td>
                    <?php
                    $frzAlarm = "<i class='bi bi-x-octagon' style='color:red'></i>";
                  }
                  if($frzAlarm == "3"){
                    ?>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($freezer['current']);?></small></td>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($freezer['min']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($freezer['max']);?></small></td>
                    <?php
                    $frzAlarm = "<i class='bi bi-x-octagon' style='color:red'></i>";
                  }
                  if($frzAlarm == "4" || $frzAlarm == "5" || $frzAlarm == "9" || $frzAlarm == "10"){
                    ?>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($freezer['current']);?></small></td>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($freezer['min']);?></small></td>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($freezer['max']);?></small></td>
                    <?php
                    $frzAlarm = "<i class='bi bi-x-octagon' style='color:red'></i>";
                  }
                  if($frzAlarm == "7"){
                    ?>
                      <td style="text-align: left"><small><?=htmlspecialchars($freezer['current']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($freezer['min']);?></small></td>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($freezer['max']);?></small></td>
                    <?php
                    $frzAlarm = "<i class='bi bi-x-octagon' style='color:red'></i>";
                  }
                  if($frzAlarm == "8"){
                    ?>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($freezer['current']);?></small></td>
                      <td style="text-align: left"><small><?=htmlspecialchars($freezer['min']);?></small></td>
                      <td style="text-align: left; color:red"><small><?=htmlspecialchars($freezer['max']);?></small></td>
                    <?php
                    $frzAlarm = "<i class='bi bi-x-octagon' style='color:red'></i>";
                  }
                ?>
                <td><small><?=$frzAlarm?></small></td>
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
