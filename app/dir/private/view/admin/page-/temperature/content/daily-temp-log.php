<?php
date_default_timezone_set('America/Los_Angeles');
$month = date('m');
$day = date('d');
$year = date('Y');
$today = $year . '-' . $month . '-' . $day;
?>

<div class="tab-pane fade" id="v-pills-log" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
  <div class="container px-3 mb-4">
    <div class="row row-col-md-12 m-2">

      <div class="card shadow">
        <div class="card-body">

          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link active" id="nav-templog-tab" data-bs-toggle="tab" data-bs-target="#nav-templog" type="button" role="tab" aria-controls="nav-templog" aria-selected="true" style="color:black;"><small>Log</small></button>
              <button class="nav-link" id="nav-reflog-tab" data-bs-toggle="tab" data-bs-target="#nav-reflog" type="button" role="tab" aria-controls="nav-reflog" aria-selected="false" style="color:black;"><small>Refrigerator</small></button>
              <button class="nav-link" id="nav-frzlog-tab" data-bs-toggle="tab" data-bs-target="#nav-frzlog" type="button" role="tab" aria-controls="nav-frzlog" aria-selected="false" style="color:black;"><small>Freezer</small></button>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-templog" role="tabpanel" aria-labelledby="nav-templog-tab" tabindex="0">
              <?php include('templog.php'); ?> <!-- record temperature -->
            </div>
            <div class="tab-pane fade" id="nav-reflog" role="tabpanel" aria-labelledby="nav-reflog-tab" tabindex="0">
              <?php include('refrigerator-log.php'); ?> <!-- view refrigerator's temp log -->
            </div>
            <div class="tab-pane fade" id="nav-frzlog" role="tabpanel" aria-labelledby="nav-frzlog-tab" tabindex="0">
              <?php include('freezer-log.php'); ?> <!-- view freezer's temp log -->
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>
