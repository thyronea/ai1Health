<div class="container" style="animation: appear 2s ease">
  <div class="row col-md-12">
    <div class="tab-content"id="v-pills-tabContent">

      <div class="col-md-12">
        <div class="d-flex align-items-st">
          <div class="container-fluid">
            <div class="row flex-nowrap">

              <?php 
                include(PRIVATE_COMPONENTS_PATH . '/admin/documents-sidebar.php');
                include(PRIVATE_MODELS_PATH . '/admin/documents/math.php');
              ?>
                 
              
              <main>
                <div class="row m-2">
                  <div class="col-md-12">
                    <div class="row col d-flex justify-content-center">

                      <?php include(PRIVATE_VIEW_PATH . '/alerts/headerAlert.php'); ?> 

                      <div class="card border-0 m-2" style="width: auto; height: auto; overflow: auto;">
                        <div class="card-body">

                          <div class="col-md-12">
                            <div class="row g-2">
                              <div class="col">
                                
                                <?php include(PRIVATE_VIEW_PATH . '/charts/documentsChart.php'); ?> 

                              </div>
                              <div class="col" style="height: 32rem; overflow:auto;">
                                <div class="card border-0">
                                  <div class="card-body">
                                    
                                    <?php include(PRIVATE_VIEW_PATH . '/tables/documentsTable.php'); ?> 

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                      
                      <?php include(PRIVATE_CONTROLLERS_PATH . '/admin/documentController.php'); ?>
                       
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
</div>