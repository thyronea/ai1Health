<?php
include('../../components/print.php');
?>

<div class="modal fade" id="administered-list-Modal" tabindex="-1" aria-labelledby="administered-list-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="administered-list-ModalLabel">Vaccine Administered List</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card m-1 col-md-11 border-0" id="administeredReportprintThis">
          <div class="card-body">
            <div class="container">
              <div class="">
                <div class="row">
                  <!-- Administered Report List -->
                  <table class="table table-borderless table-hover">
                    <thead>
                      <tr>
                        <th><small>Date</small></th>
                        <th><small>Patient Name</small></th>
                        <th><small>Date of Birth</small></th>
                        <th><small>Vaccine</small></th>
                        <th><small>Lot</small></th>
                        <th><small>Expiration</small></th>
                        <th><small>Eligibility</small></th>
                      </tr>
                    </thead>
                    <tbody align="left">

                        <?php
                        // Display provider table
                        $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                        $immunized = "SELECT * FROM immunization WHERE groupID='$groupID' ";
                        $immunized_run = mysqli_query($con, $immunized);
                        if(mysqli_num_rows($immunized_run) > 0 )
                        {
                          foreach ($immunized_run as $vaccine)
                          {
                          ?>
                          <tr>
                            <td><small><?= htmlspecialchars($vaccine['date']); ?></small></td>
                            <td><small><?= htmlspecialchars(decryptthis($vaccine['name'], $key)); ?></small></td>
                            <td><small><?= htmlspecialchars(decryptthis($vaccine['dob'], $key)); ?></small></td>
                            <td><small><?= htmlspecialchars(decryptthis($vaccine['vaccine'], $key)); ?></small></td>
                            <td><small><?= htmlspecialchars(decryptthis($vaccine['lot'], $key)); ?></small></td>
                            <td><small><?= htmlspecialchars(decryptthis($vaccine['exp'], $key)); ?></small></td>
                            <td><?= htmlspecialchars(decryptthis($vaccine['funding_source'], $key)); ?></td>
                          </tr>
                          <?php
                          }
                        }
                        else
                        {
                        ?>
                        <tr>
                          <td colspan="7" align="center"><small>No Record Found</small></td>
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
      </div>
      <div class="modal-footer">
        <div class="align-center col d-flex justify-content-center">
          <!-- Save Inventory -->
          <button title="Save Report" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none mb-2" style="text-align: left">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
              <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
            </svg>
          </button>
          <!-- Print Report -->
          <button title="Print Inventory Report" type="submit" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none mb-2" id="administeredReportPrint" onClick="window.print()">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
              <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
              <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script to print Vaccine Administered List -->
<script>
  document.getElementById("administeredReportPrint").onclick = function () {
    printElement(document.getElementById("administeredReportprintThis"));
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
