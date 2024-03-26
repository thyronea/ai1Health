<div class="col-md-12">
  <!-- Header Alert -->
  <?php include('../../components/alert.php'); ?>

  <div class="card border-0 mb-3" style="overflow:auto">
    <div class="card-body table-responsive">

      <!-- Vaccine Search Box -->
      <div class="col-md-3 mt-5" hidden>
       <form class="" action="" method="get">
         <div class="input-group input-group-sm">
           <input type="text" name="patient" value="<?php if(isset($_GET['patient'])){echo $_GET['']; }?>" class="form-control" placeholder="Search for patient" required>
          <button type="submit" class="focus-ring btn btn-secondary border" name="button">Search</button>
        </div>
       </form>
      </div>

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
