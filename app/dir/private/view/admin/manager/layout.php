<div class="container" style="animation: appear 1.5s ease">
  <div class="col-md-12">
    <div class="tab-content" id="v-pills-tabContent">

        <div class="d-flex align-items-st">
          <div class="container-fluid row flex-nowrap">
            <div class="row flex-nowrap">

              <?php include(PRIVATE_COMPONENTS_PATH . '/admin/manager-sidebar.php'); ?> 
            
              <main>
                <div class="row col d-flex justify-content-center">

                  <?php 
                    include(PRIVATE_VIEW_PATH . '/alerts/headerAlert.php');
                    include(PRIVATE_CONTROLLERS_PATH . '/admin/managerController.php');
                  ?>

                  <div class="card border-0 m-2" style="width: auto; height: auto; overflow: auto;">
                    <div class="card-body">
                          
                      <?php 
                        include(PRIVATE_MODELS_PATH . '/admin/manager/math.php');
                        include(PRIVATE_VIEW_PATH . '/charts/managersChart.php'); 
                      ?>
            
                    </div>
                  </div>  
                      
                </div>
              </main>
              
            </div>
          </div>
        </div>

    </div>
  </div>
</div>
