<div class="container">
  <div class="container-fluid" align="center">
    <div class="row flex-nowrap">
      
      <?php include(PRIVATE_COMPONENTS_PATH . '/admin/patients-sidebar.php'); ?>  

      <div class="col-md-12" style="animation: appear 1.5s ease">

        <?php 
          include(PRIVATE_VIEW_PATH . '/alerts/headerAlert.php'); 
          include(PRIVATE_MODELS_PATH . '/admin/patients/patientCount.php');
          include(PRIVATE_CONTROLLERS_PATH . '/admin/patientsController.php');
          include(PRIVATE_CONTROLLERS_PATH . '/admin/patientChartController.php');
        ?> 
        
        <div class="card border-0 mb-3" style="overflow:auto">
          <div class="card-body table-responsive">

            <div class="row">
              <div class="col">
                <?php 
                  include(PRIVATE_VIEW_PATH . '/admin/patients/content/patientCount.php');
                  include(PRIVATE_VIEW_PATH . '/charts/patientsChart.php'); 
                ?>  
              </div>
              <?php include(PRIVATE_VIEW_PATH . '/tables/patientsTable.php'); ?>
            </div>
          </div>
        </div>
      </div>

      <?php include(PRIVATE_VIEW_PATH . '/modals/patientsModals.php'); ?>

    </div>
  </div>
</div>
