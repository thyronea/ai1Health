<div class="col-md-12" style="animation: appear 1s ease">
  <!-- Header Alert -->
  <?php include('../../components/alert.php'); ?>

  <div class="card border-0 mb-3" style="overflow:auto">
    <div class="card-body table-responsive">

      <!-- SQL Math for Google Charts -->
      <?php include('process/math.php'); ?>

      <!-- Patient Chart & List -->
      <div class="row">

        <!-- Google Chart & Stat -->
        <div class="col">

          <!-- Patient Stat -->
          <div class="col-md-9 mb-4">
            <div class="row">

              <!-- All -->
              <div class="col">
                <div class="card shadow" style="border-radius: 50%">
                  <div class="card-body">
                    <a><small>All</small></a><hr>
                    <h3><?=$all['count(*)']; ?></h3>
                  </div>
                </div>
              </div>
              <!-- Pediatric -->
              <div class="col">
                <div class="card shadow" style="border-radius: 50%">
                  <div class="card-body">
                    <a><small>Pediatric</small></a><hr>
                    <h3><?=$peds['count(*)']; ?></h3>
                  </div>
                </div>
              </div>
              <!-- Adult -->
              <div class="col">
                <div class="card shadow" style="border-radius: 50%">
                  <div class="card-body">
                    <a><small>Adult</small></a><hr>
                    <h3><?=$adult['count(*)']; ?></h3>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Google Chart -->
          <div class="col">
            <div id="patientchart" style="width: 425px; height: 385px;"></div>
          </div>

        </div>

        <!-- Vaccine Result Table -->
        <?php include('patient-list.php'); ?>

      </div>


</div>

<style>
  @keyframes appear {
    0%{opacity: 0;transform: translate(50px);}
    100%{opacity: 1;transform: translate(0px);}
}
</style>
