<div class="container">
  <div class="container-fluid" align="center">
   <div class="row flex-nowrap">

     <?php include(PRIVATE_COMPONENTS_PATH . '/admin/inventory-sidebar.php'); ?>   

     <div class="col-md-12" style="animation: appear 1.5s ease">
        
        <?php 
          include(PRIVATE_CONFIG_PATH . '/print.php');
          include(PRIVATE_VIEW_PATH . '/alerts/headerAlert.php');
          include(PRIVATE_MODELS_PATH . '/admin/inventory/math.php');
          include(PRIVATE_CONTROLLERS_PATH . '/admin/inventoryController.php'); 
          include(PRIVATE_VIEW_PATH . '/modals/inventoryModals.php');
        ?>

        <div class="card border-0 mb-3" style="overflow:auto">
          <div class="card-body table-responsive">
  
              <div class="row">

                <?php 
                  include(PRIVATE_VIEW_PATH . '/charts/inventoryChart.php');
                  include('content/inventory-list.php');
                ?>

              </div>

          </div>
        </div>
      </div>
   </div>
  </div>
</div>
