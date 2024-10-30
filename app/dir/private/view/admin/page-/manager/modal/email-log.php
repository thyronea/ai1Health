<?php
include('../../components/print.php');
include('../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
?>


<!-- Modal -->
<div class="modal fade" id="email-log-Modal" tabindex="-1" aria-labelledby="email-log-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="email-log-ModalLabel">Email Log</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="emailLogprintThis" class="modal-body">


        <table class="table align-middle table-sm table-hover">
          <thead class="text-nowrap">
            <th>Date & Time</th>
            <th>From</th>
            <th>To</th>
            <th>Message</th>
          </thead>
          <tbody align="center" style="text-align: left">
            <?php
            $groupID = $_SESSION["groupID"]; // this code will only show users from the same groupID
            $query = "SELECT * FROM email WHERE groupID='$groupID' ORDER BY timestamp DESC ";
            $query_run = mysqli_query($con, $query);

            if(mysqli_num_rows($query_run) > 0)
            {
              foreach($query_run as $activity)
              {
                ?>
                <tr>

                  <td hidden><?=htmlspecialchars($activity['id']);?></td>
                  <td><small><?=htmlspecialchars($activity['timestamp']);?></small></td>
                  <td ><small><?=htmlspecialchars(decryptthis($activity['fromEmail'], $key));?></small></td>
                  <td ><small><?=htmlspecialchars(decryptthis($activity['toEmail'], $key));?></small></td>
                  <td style="word-break: break-word;"><small><?=htmlspecialchars(decryptthis($activity['message'], $key));?></small></td>

                </tr>
                <?php
              }
            }
            else
            {
            ?>
                <tr>
                  <td colspan="6" align="center"><small>No User Data Found</small></td>
                </tr>
            <?php
            }
            ?>
          </tbody>
        </table>

      </div>

      <div class="modal-footer col d-flex justify-content-center">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#emailclearmodal">Clear</button>
        <button id="emailLogPrint" type="submit" class="btn btn-outline-secondary btn-sm" onClick="window.print()">Print</button>
      </div>

    </div>
  </div>
</div>

<!-- Script to print email log -->
<script>
  document.getElementById("emailLogPrint").onclick = function () {
    printElement(document.getElementById("emailLogprintThis"));
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
