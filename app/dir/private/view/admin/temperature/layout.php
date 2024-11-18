<div class="container" style="animation: appear 1.5s ease">
    <div class="tab-content col-md-11" id="v-pills-tabContent">
      
      <div class="d-flex align-items-st">
        <div class="container-fluid">
          <div class="row flex-nowrap">

            <?php include(PRIVATE_COMPONENTS_PATH . '/admin/temperature-sidebar.php'); ?> 

            <main>
              <div class="row col d-flex justify-content-center m-2" align="center">

                    <?php include(PRIVATE_VIEW_PATH . '/alerts/headerAlert.php'); ?>
                    <?php include(PRIVATE_CONTROLLERS_PATH . '/admin/temperatureController.php'); ?>   

                    <div class="tab-content" id="v-pills-tabContent">

                      <?php include('content/daily-temp-log.php'); ?>
                      <?php include('content/temp-summary.php'); ?>
                      <?php include('content/storage-handling-settings.php'); ?>
                      <?php include('content/print-temp-log.php'); ?>

                    </div>
                            
                    <?php include(PRIVATE_VIEW_PATH . '/modals/temperatureModals.php'); ?>

                </div>
              </main>

          </div>
        </div>
      </div>

    </div>
</div>