<div class="tab-pane fade" id="immunization-tab-pane" role="tabpanel" aria-labelledby="immunization-tab" tabindex="0">
  <div class="container user-select-none" align="center" style="animation: appear 1.5s ease">

    <div class="row flex-nowrap">
      <div class="col-md-12 mt-3">
        <div class="card shadow" style="height:41rem">
          <div class="card-body table-responsive" id="immunization">

            <div class="container mb-3">
              <div class="d-flex align-items-start"> 

                  <?php 
                    include(PRIVATE_COMPONENTS_PATH . '/admin/immunization-sidebar.php'); 
                  ?>
                  
                  <div class="col tab-content">
                      <?php 
                        include('immunization-schedule.php');
                        include('immunization-combination.php');
                        include('immunization-rsv.php');
                        include('immunization-hepb.php');
                        include('immunization-rota.php');
                        include('immunization-dtap.php');
                        include('immunization-hib.php');
                        include('immunization-pcv.php');
                        include('immunization-ipv.php');
                        include('immunization-mmr.php');
                        include('immunization-var.php');
                        include('immunization-hepa.php');
                        include('immunization-tdap.php');
                        include('immunization-hpv.php');
                        include('immunization-mcv.php');
                        include('immunization-menb.php');
                        include('immunization-covid.php');
                        include('immunization-flu.php');
                      ?>
                  </div>
                  
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>
