<div class="col-md-12">
  <div class="card border-0">
    <div class="card-body">
    <h5 class="mb-3" style="text-align: left">Inventory List</h5>

    <!-- Total Dose -->
    <div class="row">
      <div class="col-md-2 mb-2" style="text-align: left">
        <small>Total Dose:</small>
      </div>
      <div class="col" align="left">
        <b>
          <?php
          $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
          $query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' ";
          $query_run = mysqli_query($con, $query);

          while($row = mysqli_fetch_array($query_run))
            echo htmlspecialchars($row['SUM(doses)']);
          ?>
        </b>
      </div>
    </div>

    <table class="table align-middle table-sm table-hover text-nowrap">
      <tbody>

        <?php
        $query = "SELECT * FROM inventory WHERE groupID='$groupID' ";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run) > 0)
        {
          foreach($query_run as $vaccine)
          {
            ?>
            <tr>

              <td hidden><small><?=htmlspecialchars($vaccine['engineID']);?></small></td>
              <td><small><?=htmlspecialchars($vaccine['name']);?></small></td>
              <td><small><?=htmlspecialchars($vaccine['doses']);?> <a>- doses</a></small></td>
              <td><small><?=htmlspecialchars(decryptthis($vaccine['lot'], $key));?></small></td>
              <td><small><?=htmlspecialchars($vaccine['exp']);?></small></td>
              <td><small><?=htmlspecialchars($vaccine['funding_source']);?></small></td>

            </tr>
            <?php
          }
        }
        else
        {
        ?>
            <tr>
              <td colspan="6"><small>No Record Found</small></td>
            </tr>
        <?php
        }
        ?>

      </tbody>
    </table>

      </div>
    </div>
  </div>
