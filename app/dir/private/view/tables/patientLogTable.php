<table class="table table-borderless table-sm table-hover text-nowrap">
    <tbody align="center" style="text-align: left">
        <?php
          $patientID =  htmlspecialchars($patient['patientID']);
          $query = "SELECT * FROM patientlog WHERE patientID='$patientID' AND groupID='$groupID' ORDER BY id DESC ";
          $query_run = mysqli_query($con, $query);

          if(mysqli_num_rows($query_run) > 0){
            foreach($query_run as $patientLog){
              ?>
                <tr>
                  <td hidden><?=htmlspecialchars($patientLog['engineID']);?></td>
                  <td hidden><?=htmlspecialchars($patientLog['groupID']);?></td>
                  <td ><small><?=htmlspecialchars($patientLog['date']);?></small></td>
                  <td ><small><?=htmlspecialchars(decryptthis($patientLog['activity'], $iz_key));?></small></td>
                </tr>
              <?php
            }
          }
          else{
            ?>
              <tr>
                  <td colspan="6" align="center"><small>No Patient Data Found</small></td>
              </tr>
            <?php
          }
        ?>
    </tbody>
</table>