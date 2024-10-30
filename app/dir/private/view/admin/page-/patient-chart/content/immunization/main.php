<div class="tab-pane fade" id="immunization-tab-pane" role="tabpanel" aria-labelledby="immunization-tab" tabindex="0">
  <div class="container user-select-none" align="center">

    <div class="row flex-nowrap">
      <div class="col-md-12 mt-3">
        <div class="card shadow" style="background-image: linear-gradient(#f5f5f5, #ffffff); height:41rem">
          <div class="card-body table-responsive" id="immunization">

            <div class="container col-md-12 mb-3">
              <div class="d-flex align-items-start"> 
                  <div class="nav col-md-1 flex-column nav-pills me-3 mt-2" id="v-pills-tab" role="tablist">
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="modal" data-bs-target="#registryStatus" type="button">Registry</button>
                      <button class="active focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#schedule" type="button">Schedule</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#combination" type="button">Combo</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#rsv" type="button">RSV</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#hepb" type="button">Hep B</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#rota" type="button">Rotavirus</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#dtap" type="button">DTaP</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#hib" type="button">Hib</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#pcv" type="button">PCV</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#ipv" type="button">IPV</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#mmr" type="button">MMR</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#var" type="button">Varicella</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#hepa" type="button">Hep A</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#tdap" type="button">Tdap</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#hpv" type="button">HPV</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#mcv" type="button">MCV</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#menb" type="button">MenB</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#covid" type="button">COVID-19</button>
                      <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#flu" type="button">Influenza</button>
                  </div>
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
