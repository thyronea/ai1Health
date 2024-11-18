<!-- Fridge Table -->
<div class="mt-3" align="center" style="text-align: center">
  <div class="card border-0" style="height:35rem; overflow: auto">
    <div class="card-body">
      <table class="table table-sm align-middle table-hover text-nowrap" style="text-align: left">
        <h5 style="color:red">Refrigerator Temperature Log - F&deg;</h5>
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
          $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); // this code will only show users from the same groupID
          $query = "SELECT * FROM fridgetemp WHERE groupID='$groupID' ORDER BY id DESC";
          $query_run = mysqli_query($con, $query);

          if(mysqli_num_rows($query_run) > 0)
          {
            foreach($query_run as $fridge)
            {
              ?>
              <tr>
                <td hidden><?=htmlspecialchars($fridge['id']);?></td>
                <td><small><?=htmlspecialchars($fridge['date']);?></td>
                <td><small><?= htmlspecialchars($fridge['time']);?></small></td>
                <td><small><?=htmlspecialchars(decryptthis($fridge['refrigerator'], $key));?></small></td>
                <td><small><?=htmlspecialchars($fridge['initials']);?></small></td>
                <td><small><?=htmlspecialchars($fridge['current']);?></small></td>
                <td><small><?=htmlspecialchars($fridge['min']);?></small></td>
                <td><small><?=htmlspecialchars($fridge['max']);?></small></td>
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
