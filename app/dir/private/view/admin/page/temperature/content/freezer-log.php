<!-- Fridge Table -->
<div class="mt-3" align="center" style="text-align: center">
  <div class="card border-0" style="height:25rem; overflow: auto">
    <div class="card-body">
      <table class="table table-sm align-middle table-hover text-nowrap" style="text-align: left">
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
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
