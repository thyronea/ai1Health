

<div class="tab-pane fade" id="v-pills-report" role="tabpanel" aria-labelledby="v-pills-report-tab" tabindex="0">
  <div class="card m-1 shadow col-md-10">
    <div class="card-body" id="vaccineReportprintThis">
      <h3 class="mb-5">Inventory Report</h3>
      <div class="container">
        <div class="">
          <div class="row">
            <!-- Private Inventory -->
            <?php include('private-vaccine-inventory.php'); ?>

            <!-- Public Inventory -->
            <?php include('public-vaccine-inventory.php'); ?>

            <!-- Inventory List -->
            <?php include('vaccine-table.php'); ?>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Hides background and print entire table on Vaccine Report -->
<?php include('scripts/print-vaccineReport-script.php'); ?>
