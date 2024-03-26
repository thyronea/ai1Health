<div class="col-md-6">
  <div class="card border-0" style="overflow: auto;">
    <div class="card-body">

      <h5 class="mb-4" align="left">Public</h5>

      <!-- Total Dose -->
      <div class="row">
        <div class="col-md-3 mb-2" style="text-align: left">
          <small>Total Dose:</small>
        </div>
        <div class="col" align="left">
          <b>
            <?php
            $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
            $query = "SELECT SUM(doses) FROM inventory WHERE groupID='$groupID' AND funding_source='Public' ";
            $query_run = mysqli_query($con, $query);

            while($row = mysqli_fetch_array($query_run))
              echo htmlspecialchars($row['SUM(doses)']);
            ?>
          </b>
        </div>
      </div>

      <!-- Doses Count per Vaccine -->
      <div class="row">
        <div class="col-md-10">
          <table class="table align-middle table-sm table-hover text-nowrap">
            <tbody align="center" style="text-align: left">
              <?php
              $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); // this code will only show users from the same groupID
              $query = "SELECT * FROM inventory WHERE groupID='$groupID' AND funding_source='Public' ";
              $query_run = mysqli_query($con, $query);

              if(mysqli_num_rows($query_run) > 0)
              {
                foreach($query_run as $user)
                {
                  ?>
                  <tr>
                    <td hidden><<?= htmlspecialchars($user['id']);?></td>
                    <td><small><?=htmlspecialchars($user['name']);?>:</small></td>
                    <td><small><?=htmlspecialchars($user['doses']);?></small></td>
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
  </div>
</div>
