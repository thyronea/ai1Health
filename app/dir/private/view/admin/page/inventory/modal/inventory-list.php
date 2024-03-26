<?php
include('../../components/print.php');
 ?>

<div class="modal fade" id="inventory-list-Modal" tabindex="-1" aria-labelledby="inventory-list-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="inventory-list-ModalLabel">Inventory List</h1>
      </div>
      <div class="modal-body">
        <div class="card m-1 col-md-10 border-0" id="vaccineReportprintThis">
          <div class="card-body">
            <div class="container">
              <div class="">
                <div class="row">
                  <!-- Private Inventory -->
                  <?php include('content/private-vaccine-inventory.php'); ?>

                  <!-- Public Inventory -->
                  <?php include('content/public-vaccine-inventory.php'); ?>

                  <!-- Inventory List -->
                  <?php include('content/inventory-table.php'); ?>

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
          <button title="Print Inventory Report" type="submit" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none mb-2" id="vaccineReportPrint" onClick="window.print()">
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

<!-- Script to print Inventory List -->
<script>
  document.getElementById("vaccineReportPrint").onclick = function () {
    printElement(document.getElementById("vaccineReportprintThis"));
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
