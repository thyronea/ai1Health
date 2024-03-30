<div class="tab-pane fade" id="immunization-tab-pane" role="tabpanel" aria-labelledby="immunization-tab" tabindex="0">
  <div class="container user-select-none" align="center">

    <div class="row flex-nowrap">
      <div class="col-md-12 mt-3">
        <div class="card shadow">
          <div class="card-body table-responsive">

            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-history-tab" data-bs-toggle="tab" data-bs-target="#nav-history" type="button" role="tab" aria-controls="nav-history" aria-selected="true" style="color:black"><small>History</small></button>
                <button class="nav-link" id="nav-pediatric-tab" data-bs-toggle="tab" data-bs-target="#nav-pediatric" type="button" role="tab" aria-controls="nav-pediatric" aria-selected="false" style="color:black"><small>Pediatric</small></button>
                <button class="nav-link" id="nav-adolescent-tab" data-bs-toggle="tab" data-bs-target="#nav-adolescent" type="button" role="tab" aria-controls="nav-adolescent" aria-selected="false" style="color:black"><small>Adolescent</small></button>
              </div>
            </nav>

            <div class="tab-content" id="nav-tab">
              <!-- Immunization Chart Dash -->
              <?php include('immunization-history-table.php'); ?>
              <!-- Birth to 15 Months Schedule Table -->
              <?php include('pediatric-table-chart.php'); ?>
              <!-- 7 to 18 Years Schedule Table -->
              <?php include('adolescent-table-chart.php'); ?>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php include('../process/scripts.php'); ?>
