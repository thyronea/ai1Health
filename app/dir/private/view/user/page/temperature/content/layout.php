<div class="container" style="animation: appear 2s ease">
  <div class="row col-md-12">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="col-md-11">

        <div class="d-flex align-items-st">
          <div class="container-fluid">
            <div class="row flex-nowrap">

              <!-- Sidebar Menu Button -->
              <?php include('components/sidebar.php'); ?>

              <!-- Content and Modals -->
              <main>
                <div class="row m-2">
                  <div class="col-md-12">
                    <div class="row col d-flex justify-content-center" align="center">
                      <!-- Header Alert -->
                      <?php include('../../components/alert.php'); ?>
                      <!-- Contents -->
                      <div class="tab-content" id="v-pills-tabContent">
                        <?php include('content/daily-temp-log.php'); ?> <!-- Daily Temp Log -->
                        <?php include('content/temp-summary.php'); ?> <!-- View Temp Summary -->
                        <?php include('content/ref-log.php'); ?> <!-- View Refrigerator Logs -->
                        <?php include('content/frz-log.php'); ?> <!-- View Freezer Logs -->
                        <?php include('content/storage-handling-settings.php'); ?>
                        <?php include('content/print-temp-log.php'); ?>
                      </div>

                      <!-- Modals -->
                      <?php include('modal/add-thermometer.php'); ?>
                      <?php include('modal/add-unit.php'); ?>
                      <?php include('modal/edit-unit.php'); ?>
                      <?php include('modal/delete-unit.php'); ?>
                      <?php include('modal/delete-thermometer.php'); ?>
                      <?php include('modal/edit-thermometer.php'); ?>

                    </div>
                  </div>
              </main>

              </div>
            </div>
          </div>
        </div>

      </div>
   </div>
 </div>
</div>

<style>
  @keyframes appear {
    0%{opacity: 0;transform: translate(50px);}
    100%{opacity: 1;transform: translate(0px);}
}
</style>