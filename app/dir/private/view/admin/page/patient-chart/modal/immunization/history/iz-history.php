<?php
include('../../components/print.php');
?>

<div class="modal fade" id="iz_history" tabindex="-1" aria-labelledby="iz_historyLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h1 class="modal-title w-100 fs-5" id="iz_historyLabel">Immunization History</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="iz_record_printThis">
                 <table class="table table-sm table-borderless text-nowrap">
                  <tbody>
                    <?php
                      $query = "SELECT * FROM immunization WHERE groupID='$groupID' AND patientID='$patientID' ORDER BY id DESC";
                      $query_run = mysqli_query($con, $query);
                      $searchnum = mysqli_num_rows($query_run);
                      if($searchnum > 0)
                      {
                        foreach ($query_run as $vaccine)
                        {
                          $admin_date = strtotime($vaccine['date']);
                          $admin_date = date('m/d/Y',$admin_date);
                          $exp_date = strtotime($vaccine['exp']);
                          $exp_date = date('m/d/Y',$exp_date);
                          ?>
                            <tr>
                              <td>
                                <div class="card border" align="left" id="iz-record">
                                  <div class="card-body">
                                  <small>
                                    <div class="mb-2">Administered on: <?=htmlspecialchars($admin_date);?></div>
                                    <div class="row"><h6><?=htmlspecialchars(decryptthis($vaccine['vaccine'], $iz_key));?></h6></div>
                                    <div class="row col-md-12">
                                      <div class="col">NDC: <?=htmlspecialchars(decryptthis($vaccine['ndc'], $iz_key));?></div>
                                      <div class="col">Lot: <?=htmlspecialchars(decryptthis($vaccine['lot'], $iz_key));?></div>
                                      <div class="col">Exp: <?=htmlspecialchars($exp_date);?></div>
                                    </div>
                                    <div class="row col-md-12">
                                      <div class="col">Location: (Insert clinicals Name)</div>
                                      <div class="col">Site: <?=htmlspecialchars(decryptthis($vaccine['site'], $iz_key));?></div>
                                      <div class="col">Route: <?=htmlspecialchars(decryptthis($vaccine['route'], $iz_key));?></div>
                                    </div>
                                  </small>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          <?php
                        }
                      }
                      else
                      {
                        ?>
                          <tr>
                            <td colspan="5" align="center"><small>No Data Found</small></td>
                          </tr>
                        <?php
                      }
                    ?>
                  </tbody>
                 </table>
            </div>
            <div class="modal-footer col d-flex justify-content-center">
              <button type="submit" class="btn btn-outline-secondary btn-sm" id="iz_record_Print" onClick="window.print()">Print</button>
            </div>
        </div>
  </div>
</div>

<!-- Script to print IZ record -->
<script>
  document.getElementById("iz_record_Print").onclick = function () {
    printElement(document.getElementById("iz_record_printThis"));
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

