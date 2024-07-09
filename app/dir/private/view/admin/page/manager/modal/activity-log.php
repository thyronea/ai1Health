<?php
include('../../components/print.php');
?>


<!-- Modal -->
<div class="modal fade" id="activity-log-Modal" tabindex="-1" aria-labelledby="user-log-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="activity-log-ModalLabel">Activity Log</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="activityLogprintThis">


        <table class="table align-middle table-sm table-hover text-nowrap">
          <thead>
            <th>Date & Time</th>
            <th>User</th>
            <th>Activity</th>
          </thead>
          <tbody align="center" style="text-align: left">
            <?php
            $groupID = htmlspecialchars($_SESSION["groupID"]); // this code will only show users from the same groupID
            $query = "SELECT * FROM admin_log WHERE groupID='$groupID' ORDER BY timestamp DESC ";
            $query_run = mysqli_query($con, $query);

            if(mysqli_num_rows($query_run) > 0)
            {
              foreach($query_run as $activity)
              {
                ?>
                <tr>
                  <td hidden><?= $activity['id'];?></td>
                  <td ><small><?= $activity['timestamp'];?></small></td>
                  <td ><small><?= htmlspecialchars(decryptthis($activity['user'], $key));?></small></td>
                  <td ><small><?= htmlspecialchars(decryptthis($activity['activity'], $key));?></small></td>
                </tr>
                <?php
              }
            }
            else
            {
            ?>
                <tr>
                  <td colspan="6" align="center">No User Data Found</td>
                </tr>
            <?php
            }
            ?>
          </tbody>
        </table>

      </div>

      <div class="modal-footer col d-flex justify-content-center">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#activityclearmodal">Clear</button>
        <button type="submit" class="btn btn-outline-secondary btn-sm" id="activityLogPrint" onClick="window.print()">Print</button>
      </div>

    </div>
  </div>
</div>

<!-- Script to print activity log -->
<script>
  document.getElementById("activityLogPrint").onclick = function () {
    printElement(document.getElementById("activityLogprintThis"));
  };

  function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
  }
</script>
