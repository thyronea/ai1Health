<!-- Add vaccine -->
<div class="modal fade" id="add-inventory-Modal" tabindex="-1" aria-labelledby="add-inventory-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="add-vaccine-ModalLabel">Add Inventory</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="" method="POST">

            <div class="main-form mt-3">

              <div class="col-md-3">
                <div class="form-group mb-3 mt-2">
                  <input type="hidden" name="engineID[]" id="inventory_engineID" class="form-control form-control-sm" required>
                </div>
              </div>

              <div class="row g-2">
                  <!-- Location -->
                  <div class="col">
                    <select class="form-group form-select form-select-sm" name="storage[]">
                      <option disabled selected>Storage Unit</option>
                      <?php
                      $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                      $sql = "SELECT * FROM storage WHERE groupID='$groupID' ";
                      $sql_run = mysqli_query($con, $sql);
                      $office = mysqli_num_rows($sql_run);
                      while ($storage = mysqli_fetch_array($sql_run))
                      {
                        echo "<option value='". htmlspecialchars(decryptthis($storage['name'], $key)) ."'>" .htmlspecialchars(decryptthis($storage['name'], $key)) ."</option>" ;
                      }
                      ?>
                    </select>
                  </div>
                  <!-- Manufacturer -->
                  <div class="col">
                      <div class="form-group mb-1">
                        <select class="form-select form-select-sm" name="manufacturer[]" required>
                          <option disabled selected>Manufacturer</option>
                          <option value="AstraZeneca">AstraZeneca</option>
                          <option value="GSK">GSK</option>
                          <option value="Merck">Merck</option>
                          <option value="Moderna">Moderna</option>
                          <option value="Pfizer">Pfizer</option>
                          <option value="Sanofi">Sanofi</option>
                          <option value="Seqirus">Seqirus</option>
                        </select>
                      </div>
                  </div>
                  <!-- Product -->
                  <div class="col">
                    <div class="form-group mb-2">

                          <select class="form-select form-select-sm" name="name[]" required>
                            <option disabled selected>Product</option>
                            <option disabled>DTaP</option>
                            <option value="DTaP - Daptacel Single Dose Vials">Daptacel (Single Dose Vials)</option>
                            <option value="DTaP - Infanrix Single Dose Vials">Infanrix (Single Dose Vials)</option>
                            <option value="DTaP - Infanrix Single Dose Syringes">Infanrix (Single Dose Syringes)</option>
                            <option disabled>DTaP/IPV</option>
                            <option value="DTaP/IPV - Kinrix Single Dose Vials">Kinrix (Single Dose Vials)</option>
                            <option value="DTaP/IPV - Kinrix Single Dose Syringes">Kinrix (Single Dose Syringes)</option>
                            <option value="DTaP/IPV - Quadracel Single Dose Vials">Quadracel (Single Dose Vials)</option>
                            <option value="DTaP/IPV - Quadracel Single Dose Syringes">Quadracel (Single Dose Syringes)</option>
                            <option disabled>DTaP/Hep-B/IPV</option>
                            <option value="DTaP/Hep-B/IPV - Pediarix Single Dose Syringes">Pediarix (Single Dose Syringes)</option>
                            <option disabled>DTaP/IPV/Hib</option>
                            <option value="DTaP/IPV/Hib - Pentacel Single Dose Vials">Pentacel (Single Dose Vials)</option>
                            <option disabled>DTaP/IPV/Hib/Hep-B</option>
                            <option value="DTaP/IPV/Hib/Hep-B - Vaxelis Single Dose Vials">Vaxelis (Single Dose Vials)</option>
                            <option value="DTaP/IPV/Hib/Hep-B - Vaxelis Single Dose Syringes">Vaxelis (Single Dose Syringes)</option>
                            <option disabled>Hepatitis A</option>
                            <option value="Hepatitis A - Vaqta Single Dose Vials">Vaqta (Single Dose Vials)</option>
                            <option value="Hepatitis A - Vaqta Single Dose Syringes">Vaqta (Single Dose Syringes)</option>
                            <option value="Hepatitis A - Havrix Single Dose Vials">Havrix (Single Dose Vials)</option>
                            <option value="Hepatitis A - Havrix Single Dose Syringes">Havrix (Single Dose Syringes)</option>
                            <option disabled>Hepatitis B</option>
                            <option value="Hepatitis B - Engerix B Single Dose Vials">Engerix B (Single Dose Vials)</option>
                            <option value="Hepatitis B - Engerix B Single Dose Syringes">Engerix B (Single Dose Syringes)</option>
                            <option value="Hepatitis B - Recombivax Single Dose Vials">Recombivax (Single Dose Vials)</option>
                            <option value="Hepatitis B - Recombivax Single Dose Syringes">Recombivax (Single Dose Syringes)</option>
                            <option disabled>Hib</option>
                            <option value="Hib - PedvaxHib Single Dose Vials">PedvaxHib B (Single Dose Vials)</option>
                            <option value="Hib - ActHIB Single Dose Vials">ActHIB (Single Dose Vials)</option>
                            <option value="Hib - Hiberix Single Dose Vials">Hiberix (Single Dose Vials)</option>
                            <option disabled>HPV</option>
                            <option value="HPV - Gardasil 9 Single Dose Syringes">Gardasil 9 (Single Dose Syringes)</option>
                            <option disabled>IPV</option>
                            <option value="IPV - IPOL 10 Dose Vials">IPOL (Single 10 Dose Vials)</option>
                            <option disabled>Meningococcal Conjugate</option>
                            <option value="MCV - Menactra Single Dose Vials">Menactra (Single Dose Vials)</option>
                            <option value="MCV - Menveo Single Dose Vials">Menveo (Single Dose Vials)</option>
                            <option value="MCV - MenQuadfi Single Dose Vials">MenQuadfi (Single Dose Vials)</option>
                            <option disabled>Meningococcal B</option>
                            <option value="MenB - Trumenba Single Dose Syringes">Trumenba (Single Dose Syringes)</option>
                            <option value="MenB - Bexsero Single Dose Syringes">Bexsero (Single Dose Syringes)</option>
                            <option disabled>MMR</option>
                            <option value="MMR - MMR-II Single Dose Vials">MMR-II (Single Dose Vials)</option>
                            <option value="MMR - Priorix Single Dose Vials">Priorix (Single Dose Vials)</option>
                            <option disabled>Pneumococcal Conjugate</option>
                            <option value="PCV - Prevnar Single Dose Syringes">Prevnar (Single Dose Syringes)</option>
                            <option value="PCV - Vaxneuvance Single Dose Syringes">Vaxneuvance (Single Dose Syringes)</option>
                            <option disabled>Rotavirus</option>
                            <option value="RV - RotaTeq Single Dose Tubes">RotaTeq (Single Dose Tubes)</option>
                            <option value="RV - Rotarix Single Dose Vials">Rotarix (Single Dose Vials)</option>
                            <option value="RV - Rotarix Single Oral Doses">Rotarix (Single Oral Doses)</option>
                            <option disabled>RSV</option>
                            <option value="RSV - Beyfortus 0.5 mL Single Dose Syringes">Beyfortus 0.5mL Single Dose Syringes</option>
                            <option value="RSV - Beyfortus 1.0 mL Single Dose Syringes">Beyfortus 1.0mL Single Dose Syringes</option>
                            <option disabled>Tdap</option>
                            <option value="Tdap - Boostrix Single Dose Vials">Boostrix (Single Dose Vials)</option>
                            <option value="Tdap - Boostrix Single Dose Syringes">Boostrix (Single Dose Syringes)</option>
                            <option value="Tdap - Adacel Single Dose Vials">Adacel (Single Dose Vials)</option>
                            <option value="Tdap - Adacel Single Dose Syringes">Adacel (Single Dose Syringes)</option>
                            <option disabled>Varicella</option>
                            <option value="Varicella - Varivax Single Dose Vials">Varivax (Single Dose Vials)</option>
                            <option disabled>MMRV</option>
                            <option value="MMRV - Proquad Single Dose Vials">Proquad (Single Dose Vials)</option>
                            <option disabled>Pneumococcal Polysaccharide</option>
                            <option value="PPSV23 - Pneumovax Single Dose Vials">Pneumovax (Single Dose Vials)</option>
                            <option value="PPSV23 - Pneumovax Single Dose Syringes">Pneumovax (Single Dose Syringes)</option>
                            <option disabled>TD</option>
                            <option value="TD - Tenivac Single Dose Vials">Tenivac (Single Dose Vials)</option>
                            <option value="TD - Tenivac Single Dose Syringes">Tenivac (Single Dose Syringes)</option>
                            <option disabled>COVID-19</option>
                            <option value="COVID-19 - Pfizer (6mo-4yrs) 3 Dose Vial">Pfizer 6mo-4yrs (3 Dose Vial - 30 Doses/10 Vials Per Box)</option>
                            <option value="COVID-19 - Pfizer (5yrs-11yrs) Single Dose Vials">Pfizer 5yrs-11yrs (Single Dose Vials)</option>
                            <option value="COVID-19 - Pfizer Comirnaty (12yrs-18yrs) Single Dose Vials">Pfizer Comirnaty 12yrs-18yrs (Single Dose Vials)</option>
                            <option value="COVID-19 - Moderna (6mo-11yrs) Single Dose Vials">Moderna 6mo-11yrs (Single Dose Vials)</option>
                            <option value="COVID-19 - Moderna Spikevax (12yrs-18yrs) Single Dose Vials">Moderna Spikevax 12yrs-18yrs (Single Dose Vials)</option>
                            <option disabled>Influenza</option>
                            <option value="Influenza - Fluarix Single Dose Syringes">Fluarix (Single Dose Syringes)</option>
                            <option value="Influenza - Flucelvax Single Dose Syringes">Flucelvax (Single Dose Syringes)</option>
                            <option value="Influenza - FluLaval Single Dose Syringes">FluLaval (Single Dose Syringes)</option>
                            <option value="Influenza - Fluzone Single Dose Syringes">Fluzone (Single Dose Syringes)</option>
                            <option value="Influenza - Flumist Intranasal Sprayer">Flumist (Intranasal Sprayer)</option>
                            <option value="other" name="other">Other</option>
                          </select>
                          <div id="div1"></div>
                        </div>
                  </div>
                  <!-- NDC -->
                  <div class="col">
                    <div class="form-group mb-1">
                      <input type="text" name="ndc[]" class="form-control form-control-sm" placeholder="NDC" required>
                    </div>
                  </div>
              </div>

              <div class="row g-2">
                <!-- Lot -->
                <div class="col-md-3">
                    <div class="form-group mb-1">
                        <input type="text" name="lot[]" class="form-control form-control-sm" placeholder="Lot" required>
                    </div>
                </div>
                <!-- Expiration -->
                <div class="col">
                    <div class="form-group mb-1">
                        <input type="date" name="exp[]" class="form-control form-control-sm" required>
                    </div>
                </div>
                <!-- Doses -->
                <div class="col">
                    <div class="form-group mb-1">
                        <input type="number" name="doses[]" class="form-control form-control-sm" placeholder="Doses" required>
                    </div>
                </div>
                <!-- Funding Source -->
                <div class="col">
                  <div class="form-group mb-3">
                      <select class="form-select form-select-sm" name="funding[]" required>
                        <option disabled selected>Source</option>
                        <option value="Private">Private</option>
                        <option value="Public">Public</option>
                      </select>
                    </div>
                </div>
              </div>

            </div>
            <div class="paste-new-forms"></div>

      </div>
      <div class="modal-footer col d-flex justify-content-center">
       <!-- <a href="javascript:void(0)" class="add-more-form focus-ring py-1 px-2 btn-outline border btn btn-sm" onclick="change();">More</a> -->
        <button type="submit" name="add_inventory" class="focus-ring py-1 px-2 btn-outline border btn btn-sm">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Scan vaccine -->
<div class="modal fade" id="scan-inventory-Modal" tabindex="-1" aria-labelledby="scan-inventory-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="scan-vaccine-ModalLabel">Scan Barcode</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="" method="POST">

            <div class="main-form mt-3">

              <div class="col-md-3">
                <div class="form-group mb-3 mt-2">
                  <input type="hidden" name="engineID" id="scan_inventory_engineID" class="form-control form-control-sm" required>
                </div>
              </div>

              <div class="row g-2 mb-1">
                  <!-- Location -->
                  <div class="col">
                    <select class="form-group form-select form-select-sm" name="storage">
                      <option disabled selected>Storage Unit</option>
                      <?php
                      $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                      $sql = "SELECT * FROM storage WHERE groupID='$groupID' ";
                      $sql_run = mysqli_query($con, $sql);
                      $office = mysqli_num_rows($sql_run);
                      while ($storage = mysqli_fetch_array($sql_run))
                      {
                        echo "<option value='". htmlspecialchars(decryptthis($storage['name'], $key)) ."'>" .htmlspecialchars(decryptthis($storage['name'], $key)) ."</option>" ;
                      }
                      ?>
                    </select>
                  </div>
                  <!-- Manufacturer -->
                  <div class="col">
                      <div class="form-group mb-1">
                        <select class="form-select form-select-sm" name="manufacturer" required>
                          <option disabled selected>Manufacturer</option>
                          <option value="AstraZeneca">AstraZeneca</option>
                          <option value="GSK">GSK</option>
                          <option value="Merck">Merck</option>
                          <option value="Moderna">Moderna</option>
                          <option value="Pfizer">Pfizer</option>
                          <option value="Sanofi">Sanofi</option>
                          <option value="Seqirus">Seqirus</option>
                        </select>
                      </div>
                  </div>
              </div>
              <div class="row g-2">
                  <!-- Product -->
                  <div class="col">
                    <div class="form-group mb-2">

                          <select class="form-select form-select-sm" name="name" required>
                            <option disabled selected>Product</option>
                            <option disabled>DTaP</option>
                            <option value="DTaP - Daptacel Single Dose Vials">Daptacel (Single Dose Vials)</option>
                            <option value="DTaP - Infanrix Single Dose Vials">Infanrix (Single Dose Vials)</option>
                            <option value="DTaP - Infanrix Single Dose Syringes">Infanrix (Single Dose Syringes)</option>
                            <option disabled>DTaP/IPV</option>
                            <option value="DTaP/IPV - Kinrix Single Dose Vials">Kinrix (Single Dose Vials)</option>
                            <option value="DTaP/IPV - Kinrix Single Dose Syringes">Kinrix (Single Dose Syringes)</option>
                            <option value="DTaP/IPV - Quadracel Single Dose Vials">Quadracel (Single Dose Vials)</option>
                            <option value="DTaP/IPV - Quadracel Single Dose Syringes">Quadracel (Single Dose Syringes)</option>
                            <option disabled>DTaP/Hep-B/IPV</option>
                            <option value="DTaP/Hep-B/IPV - Pediarix Single Dose Syringes">Pediarix (Single Dose Syringes)</option>
                            <option disabled>DTaP/IPV/Hib</option>
                            <option value="DTaP/IPV/Hib - Pentacel Single Dose Vials">Pentacel (Single Dose Vials)</option>
                            <option disabled>DTaP/IPV/Hib/Hep-B</option>
                            <option value="DTaP/IPV/Hib/Hep-B - Vaxelis Single Dose Vials">Vaxelis (Single Dose Vials)</option>
                            <option value="DTaP/IPV/Hib/Hep-B - Vaxelis Single Dose Syringes">Vaxelis (Single Dose Syringes)</option>
                            <option disabled>Hepatitis A</option>
                            <option value="Hepatitis A - Vaqta Single Dose Vials">Vaqta (Single Dose Vials)</option>
                            <option value="Hepatitis A - Vaqta Single Dose Syringes">Vaqta (Single Dose Syringes)</option>
                            <option value="Hepatitis A - Havrix Single Dose Vials">Havrix (Single Dose Vials)</option>
                            <option value="Hepatitis A - Havrix Single Dose Syringes">Havrix (Single Dose Syringes)</option>
                            <option disabled>Hepatitis B</option>
                            <option value="Hepatitis B - Engerix B Single Dose Vials">Engerix B (Single Dose Vials)</option>
                            <option value="Hepatitis B - Engerix B Single Dose Syringes">Engerix B (Single Dose Syringes)</option>
                            <option value="Hepatitis B - Recombivax Single Dose Vials">Recombivax (Single Dose Vials)</option>
                            <option value="Hepatitis B - Recombivax Single Dose Syringes">Recombivax (Single Dose Syringes)</option>
                            <option disabled>Hib</option>
                            <option value="Hib - PedvaxHib Single Dose Vials">PedvaxHib B (Single Dose Vials)</option>
                            <option value="Hib - ActHIB Single Dose Vials">ActHIB (Single Dose Vials)</option>
                            <option value="Hib - Hiberix Single Dose Vials">Hiberix (Single Dose Vials)</option>
                            <option disabled>HPV</option>
                            <option value="HPV - Gardasil 9 Single Dose Syringes">Gardasil 9 (Single Dose Syringes)</option>
                            <option disabled>IPV</option>
                            <option value="IPV - IPOL 10 Dose Vials">IPOL (Single 10 Dose Vials)</option>
                            <option disabled>Meningococcal Conjugate</option>
                            <option value="MCV - Menactra Single Dose Vials">Menactra (Single Dose Vials)</option>
                            <option value="MCV - Menveo Single Dose Vials">Menveo (Single Dose Vials)</option>
                            <option value="MCV - MenQuadfi Single Dose Vials">MenQuadfi (Single Dose Vials)</option>
                            <option disabled>Meningococcal B</option>
                            <option value="MenB - Trumenba Single Dose Syringes">Trumenba (Single Dose Syringes)</option>
                            <option value="MenB - Bexsero Single Dose Syringes">Bexsero (Single Dose Syringes)</option>
                            <option disabled>MMR</option>
                            <option value="MMR - MMR-II Single Dose Vials">MMR-II (Single Dose Vials)</option>
                            <option value="MMR - Priorix Single Dose Vials">Priorix (Single Dose Vials)</option>
                            <option disabled>Pneumococcal Conjugate</option>
                            <option value="PCV - Prevnar Single Dose Syringes">Prevnar (Single Dose Syringes)</option>
                            <option value="PCV - Vaxneuvance Single Dose Syringes">Vaxneuvance (Single Dose Syringes)</option>
                            <option disabled>Rotavirus</option>
                            <option value="RV - RotaTeq Single Dose Tubes">RotaTeq (Single Dose Tubes)</option>
                            <option value="RV - Rotarix Single Dose Vials">Rotarix (Single Dose Vials)</option>
                            <option value="RV - Rotarix Single Oral Doses">Rotarix (Single Oral Doses)</option>
                            <option disabled>RSV</option>
                            <option value="RSV - Beyfortus 0.5 mL Single Dose Syringes">Beyfortus 0.5mL Single Dose Syringes</option>
                            <option value="RSV - Beyfortus 1.0 mL Single Dose Syringes">Beyfortus 1.0mL Single Dose Syringes</option>
                            <option disabled>Tdap</option>
                            <option value="Tdap - Boostrix Single Dose Vials">Boostrix (Single Dose Vials)</option>
                            <option value="Tdap - Boostrix Single Dose Syringes">Boostrix (Single Dose Syringes)</option>
                            <option value="Tdap - Adacel Single Dose Vials">Adacel (Single Dose Vials)</option>
                            <option value="Tdap - Adacel Single Dose Syringes">Adacel (Single Dose Syringes)</option>
                            <option disabled>Varicella</option>
                            <option value="Varicella - Varivax Single Dose Vials">Varivax (Single Dose Vials)</option>
                            <option disabled>MMRV</option>
                            <option value="MMRV - Proquad Single Dose Vials">Proquad (Single Dose Vials)</option>
                            <option disabled>Pneumococcal Polysaccharide</option>
                            <option value="PPSV23 - Pneumovax Single Dose Vials">Pneumovax (Single Dose Vials)</option>
                            <option value="PPSV23 - Pneumovax Single Dose Syringes">Pneumovax (Single Dose Syringes)</option>
                            <option disabled>TD</option>
                            <option value="TD - Tenivac Single Dose Vials">Tenivac (Single Dose Vials)</option>
                            <option value="TD - Tenivac Single Dose Syringes">Tenivac (Single Dose Syringes)</option>
                            <option disabled>COVID-19</option>
                            <option value="COVID-19 - Pfizer (6mo-4yrs) 3 Dose Vial">Pfizer 6mo-4yrs (3 Dose Vial - 30 Doses/10 Vials Per Box)</option>
                            <option value="COVID-19 - Pfizer (5yrs-11yrs) Single Dose Vials">Pfizer 5yrs-11yrs (Single Dose Vials)</option>
                            <option value="COVID-19 - Pfizer Comirnaty (12yrs-18yrs) Single Dose Vials">Pfizer Comirnaty 12yrs-18yrs (Single Dose Vials)</option>
                            <option value="COVID-19 - Moderna (6mo-11yrs) Single Dose Vials">Moderna 6mo-11yrs (Single Dose Vials)</option>
                            <option value="COVID-19 - Moderna Spikevax (12yrs-18yrs) Single Dose Vials">Moderna Spikevax 12yrs-18yrs (Single Dose Vials)</option>
                            <option value="COVID-19 - Novavax (12yrs-18yrs) 5 Dose Vial - 10 Doses/2 Vials Per Box">Novavax 12yrs-18yrs (5 Dose Vial - 10 Doses/2 Vials Per Box)</option>
                            <option disabled>Influenza</option>
                            <option value="Influenza - Fluarix Single Dose Syringes">Fluarix (Single Dose Syringes)</option>
                            <option value="Influenza - Flucelvax Single Dose Syringes">Flucelvax (Single Dose Syringes)</option>
                            <option value="Influenza - FluLaval Single Dose Syringes">FluLaval (Single Dose Syringes)</option>
                            <option value="Influenza - Fluzone Single Dose Syringes">Fluzone (Single Dose Syringes)</option>
                            <option value="Influenza - Flumist Intranasal Sprayer">Flumist (Intranasal Sprayer)</option>
                            <option value="other" name="other">Other</option>
                          </select>
                          <div id="div1"></div>
                        </div>
                  </div>
                  <!-- Doses -->
                  <div class="col-md-3">
                    <div class="form-group mb-1">
                        <input type="number" name="doses" class="form-control form-control-sm" placeholder="Doses" required>
                    </div>
                  </div>
                  <!-- Funding Source -->
                  <div class="col-md-3">
                    <div class="form-group mb-3">
                        <select class="form-select form-select-sm" name="funding" required>
                          <option disabled selected>Source</option>
                          <option value="Private">Private</option>
                          <option value="Public">Public</option>
                        </select>
                    </div>
                  </div>
              </div>
                    
              <div class="row g-2">
                  <!-- Barcode -->      
                  <div class="col">
                        <div class="form-group mb-1">
                            <input type="text" name="barcode" class="form-control text-center form-control-sm" placeholder="Click Here Before Scanning" required>
                        </div>
                    </div>
              </div>

            </div>
            <div class="paste-new-forms"></div>

      </div>
      <div class="modal-footer col d-flex justify-content-center">
       <!-- <a href="javascript:void(0)" class="add-more-form focus-ring py-1 px-2 btn-outline border btn btn-sm" onclick="change();">More</a> -->
        <button type="submit" name="scan_inventory" class="focus-ring py-1 px-2 btn-outline border btn btn-sm">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit vaccine -->
<div class="modal fade" id="inventory-edit" tabindex="-1" aria-labelledby="inventory-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title w-100 fs-5" id="inventory-edit-ModalLabel">Update Inventory</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <form class="" action="" method="POST">
          <div class="row g-2">
            <div class="col g-2" align="left">
              <small><p class="mt-1">Storage (Date & Time):</p></small>
            </div>
            <div class="col-md-8">
              <input style="background-color:white" type="text" name="doses" id="timestamp" placeholder="Date & Time of Storage" class="form-control form-control-sm mb-3 border-0" disabled required>
            </div>
          </div>
          <div class="row g-2">

              <input type="hidden" name="id" id="inventory_id" class="form-control form-control-sm" required>

              <div class="col">
                <select class="form-group form-select form-select-sm" name="storage" id="storage">
                  <option selected disabled>Storage Unit</option>
                  <?php
                  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                  $sql = "SELECT * FROM storage WHERE groupID='$groupID' ";
                  $sql_run = mysqli_query($con, $sql);
                  $office = mysqli_num_rows($sql_run);
                  while ($storage = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". htmlspecialchars(decryptthis($storage['name'], $key)) ."'>" .htmlspecialchars(decryptthis($storage['name'], $key)) ."</option>" ;
                  }
                  ?>
                </select>
              </div>

              <div class="col-md-4">
                <div class="form-group mb-2">
                  <select class="form-select form-select-sm" name="manufacturer" id="inventory_manufacturer" required>
                    <option selected>Manufacturer</option>
                    <option value="GSK">GSK</option>
                    <option value="Merck">Merck</option>
                    <option value="Pfizer">Pfizer</option>
                    <option value="Sanofi">Sanofi</option>
                    <option value="Seqirus">Seqirus</option>
                    <option value="AstraZeneca">AstraZeneca</option>
                  </select>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group mb-2">
                  <input type="text" name="ndc" id="ndc" class="form-control form-control-sm" placeholder="NDC" required>
                </div>
              </div>

              <div class="col-md-8">
                <div class="form-group mb-2">
                  <!-- Vaccine Group -->
                  <select id="name" class="form-select form-select-sm" name="name" required>
                    <option selected>Select Vaccine</option>
                    <option disabled>DTaP</option>
                    <option value="DTaP - Daptacel Single Dose Vials">Daptacel (Single Dose Vials)</option>
                    <option value="DTaP - Infanrix Single Dose Vials">Infanrix (Single Dose Vials)</option>
                    <option value="DTaP - Infanrix Single Dose Syringes">Infanrix (Single Dose Syringes)</option>
                    <option disabled>DTaP/IPV</option>
                    <option value="DTaP/IPV - Kinrix Single Dose Vials">Kinrix (Single Dose Vials)</option>
                    <option value="DTaP/IPV - Kinrix Single Dose Syringes">Kinrix (Single Dose Syringes)</option>
                    <option value="DTaP/IPV - Quadracel Single Dose Vials">Quadracel (Single Dose Vials)</option>
                    <option value="DTaP/IPV - Quadracel Single Dose Syringes">Quadracel (Single Dose Syringes)</option>
                    <option disabled>DTaP/Hep-B/IPV</option>
                    <option value="DTaP/Hep-B/IPV - Pediarix Single Dose Syringes">Pediarix (Single Dose Syringes)</option>
                    <option disabled>DTaP/IPV/Hib</option>
                    <option value="DTaP/IPV/Hib - Pentacel Single Dose Vials">Pentacel (Single Dose Vials)</option>
                    <option disabled>DTaP/IPV/Hib/Hep-B</option>
                    <option value="DTaP/IPV/Hib/Hep-B - Vaxelis Single Dose Vials">Vaxelis (Single Dose Vials)</option>
                    <option value="DTaP/IPV/Hib/Hep-B - Vaxelis Single Dose Syringes">Vaxelis (Single Dose Syringes)</option>
                    <option disabled>Hepatitis A</option>
                    <option value="Hepatitis A - Vaqta Single Dose Vials">Vaqta (Single Dose Vials)</option>
                    <option value="Hepatitis A - Vaqta Single Dose Syringes">Vaqta (Single Dose Syringes)</option>
                    <option value="Hepatitis A - Havrix Single Dose Vials">Havrix (Single Dose Vials)</option>
                    <option value="Hepatitis A - Havrix Single Dose Syringes">Havrix (Single Dose Syringes)</option>
                    <option disabled>Hepatitis B</option>
                    <option value="Hepatitis B - Engerix B Single Dose Vials">Engerix B (Single Dose Vials)</option>
                    <option value="Hepatitis B - Engerix B Single Dose Syringes">Engerix B (Single Dose Syringes)</option>
                    <option value="Hepatitis B - Recombivax Single Dose Vials">Recombivax (Single Dose Vials)</option>
                    <option value="Hepatitis B - Recombivax Single Dose Syringes">Recombivax (Single Dose Syringes)</option>
                    <option disabled>Hib</option>
                    <option value="Hib - PedvaxHib Single Dose Vials">PedvaxHib B (Single Dose Vials)</option>
                    <option value="Hib - ActHIB Single Dose Vials">ActHIB (Single Dose Vials)</option>
                    <option value="Hib - Hiberix Single Dose Vials">Hiberix (Single Dose Vials)</option>
                    <option disabled>HPV</option>
                    <option value="HPV - Gardasil 9 Single Dose Syringes">Gardasil 9 (Single Dose Syringes)</option>
                    <option disabled>IPV</option>
                    <option value="IPV - IPOL 10  Dose Vial">IPOL (Single 10 Dose Vial)</option>
                    <option disabled>Meningococcal Conjugate</option>
                    <option value="MCV - Menactra Single Dose Vials">Menactra (Single Dose Vials)</option>
                    <option value="MCV - Menveo Single Dose Vials">Menveo (Single Dose Vials)</option>
                    <option value="MCV - MenQuadfi Single Dose Vials">MenQuadfi (Single Dose Vials)</option>
                    <option disabled>Meningococcal B</option>
                    <option value="MenB - Trumenba Single Dose Syringes">Trumenba (Single Dose Syringes)</option>
                    <option value="MenB - Bexsero Single Dose Syringes">Bexsero (Single Dose Syringes)</option>
                    <option disabled>MMR</option>
                    <option value="MMR - MMR-II Single Dose Vials">MMR-II (Single Dose Vials)</option>
                    <option value="MMR - Priorix Single Dose Vials">Priorix (Single Dose Vials)</option>
                    <option disabled>Pneumococcal Conjugate</option>
                    <option value="PCV - Prevnar Single Dose Syringes">Prevnar (Single Dose Syringes)</option>
                    <option value="PCV - Vaxneuvance Single Dose Syringes">Vaxneuvance (Single Dose Syringes)</option>
                    <option disabled>Rotavirus</option>
                    <option value="RV - RotaTeq Single Dose Tubes">RotaTeq (Single Dose Tubes)</option>
                    <option value="RV - Rotarix Single Dose Vials">Rotarix (Single Dose Vials)</option>
                    <option value="RV - Rotarix Single Oral Doses">Rotarix (Single Oral Doses)</option>
                    <option disabled>RSV</option>
                    <option value="RSV - Beyfortus 0.5 mL Single Dose Syringes">Beyfortus 0.5mL Single Dose Syringes</option>
                    <option value="RSV - Beyfortus 1.0 mL Single Dose Syringes">Beyfortus 1.0mL Single Dose Syringes</option>
                    <option disabled>Tdap</option>
                    <option value="Tdap - Boostrix Single Dose Vials">Boostrix (Single Dose Vials)</option>
                    <option value="Tdap - Boostrix Single Dose Syringes">Boostrix (Single Dose Syringes)</option>
                    <option value="Tdap - Adacel Single Dose Vials">Adacel (Single Dose Vials)</option>
                    <option value="Tdap - Adacel Single Dose Syringes">Adacel (Single Dose Syringes)</option>
                    <option disabled>Varicella</option>
                    <option value="Varicella - Varivax Single Dose Vials">Varivax (Single Dose Vials)</option>
                    <option disabled>MMRV</option>
                    <option value="MMRV - Proquad Single Dose Vials">Proquad (Single Dose Vials)</option>
                    <option disabled>Pneumococcal Polysaccharide</option>
                    <option value="PPSV23 - Pneumovax Single Dose Vials">Pneumovax (Single Dose Vials)</option>
                    <option value="PPSV23 - Pneumovax Single Dose Syringes">Pneumovax (Single Dose Syringes)</option>
                    <option disabled>TD</option>
                    <option value="TD - Tenivac Single Dose Vials">Tenivac (Single Dose Vials)</option>
                    <option value="TD - Tenivac Single Dose Syringes">Tenivac (Single Dose Syringes)</option>
                    <option disabled>COVID-19</option>
                    <option value="COVID-19 - Pfizer (6mo-4yrs) 3 Dose Vial">Pfizer 6mo-4yrs (3 Dose Vial - 30 Doses/10 Vials Per Box)</option>
                    <option value="COVID-19 - Pfizer (5yrs-11yrs) Single Dose Vials">Pfizer 5yrs-11yrs (Single Dose Vials)</option>
                    <option value="COVID-19 - Pfizer Comirnaty (12yrs-18yrs) Single Dose Vials">Pfizer Comirnaty 12yrs-18yrs (Single Dose Vials)</option>
                    <option value="COVID-19 - Moderna (6mo-11yrs) Single Dose Vials">Moderna 6mo-11yrs (Single Dose Vials)</option>
                    <option value="COVID-19 - Moderna Spikevax (12yrs-18yrs) Single Dose Vials">Moderna Spikevax 12yrs-18yrs (Single Dose Vials)</option>
                    <option value="COVID-19 - Novavax (12yrs-18yrs) 5 Dose Vial - 10 Doses/2 Vials Per Box">Novavax 12yrs-18yrs (5 Dose Vial - 10 Doses/2 Vials Per Box)</option>
                    <option disabled>Influenza</option>
                    <option value="Influenza - Fluarix Single Dose Syringes">Fluarix (Single Dose Syringes)</option>
                    <option value="Influenza - Flucelvax Single Dose Syringes">Flucelvax (Single Dose Syringes)</option>
                    <option value="Influenza - FluLaval Single Dose Syringes">FluLaval (Single Dose Syringes)</option>
                    <option value="Influenza - Fluzone Single Dose Syringes">Fluzone (Single Dose Syringes)</option>
                    <option value="Influenza - Flumist Intranasal Sprayer">Flumist (Intranasal Sprayer)</option>
                  </select>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group mb-2">
                  <input type="text" name="lot" id="lot" placeholder="Lot Number" class="form-control form-control-sm" required>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group mb-2">
                  <input type="date" name="exp" id="exp" class="form-control form-control-sm" required>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group mb-2">
                  <select class="form-select form-select-sm" id="source" name="source" required>
                    <option disabled selected>Select Funding Source</option>
                    <option value="Private">Private</option>
                    <option value="Public">Public</option>
                  </select>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group mb-4">
                  <input type="number" name="doses" id="doses" placeholder="Number of Doses" class="form-control form-control-sm" required>
                </div>
              </div>

            </div>

          <div class="form-group mb-2" align="center">
            <button type="button" class="focus-ring btn btn-outline-danger btn-sm inventorydeletebtn" data-bs-toggle="modal" data-bs-target="#inventorydeletemodal">Delete</button>
            <button type="submit" name="update_inventory_btn" class="focus-ring btn btn-outline-secondary btn-sm">Update</button>
          </div>

        </form>

      </div>

    </div>
  </div>
</div>

<!-- Delete vaccine -->
<div class="modal fade" id="inventorydeletemodal" tabindex="-1" aria-labelledby="inventorydeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title w-100 fs-5" id="vaccinedeletemodal-ModalLabel">Delete Inventory</h1>
      </div>

      <div class="modal-body">
        <form class="" action="" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input class="form-control mb-2" type="hidden" name="engineID" id="inventory_engineid">
            <input class="form-control mb-2" type="hidden" name="delete_vaccine_name" id="name_delete">
            <input class="form-control mb-2" type="hidden" name="delete_vaccine_lot" id="lot_delete">
            <!----------------------------------------------------->
            <p align="center">Vaccine will be permanently removed from inventory.</p>
            <p>Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-secondary btn-sm">No</button>
            <button type="submit" name="inventorydeletebtn" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- Inventory Report --->
<div class="modal fade" id="inventory-report-Modal" tabindex="-1" aria-labelledby="inventory-list-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="inventory-list-ModalLabel">Inventory Report</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="vaccineReportprintThis">
        <div class="card m-1 col-md-10 border-0">
          <div class="card-body">
            <div class="container">
              <div class="">
                <div class="row">
                  <!-- Private Inventory -->
                  <?php include('content/private-vaccine-inventory.php'); ?>

                  <!-- Public Inventory -->
                  <?php include('content/public-vaccine-inventory.php'); ?>

                </div>
              </div>
            </div>
            <!-- Inventory List -->
            <?php include('content/inventory-table.php'); ?>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="align-center col d-flex justify-content-center">
          <!-- Save Inventory -->
          <button title="Save Report" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none mb-2" style="text-align: left">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
              <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
            </svg>
          </button>
          <!-- Print Report -->
          <button title="Print Inventory Report" type="submit" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none mb-2" id="vaccineReportPrint" onClick="window.print()">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
              <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
              <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Vaccine Administered Report --->
<div class="modal fade" id="administered-list-Modal" tabindex="-1" aria-labelledby="administered-list-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="administered-list-ModalLabel">Vaccine Administered List</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card m-1 col-md-11 border-0" id="administeredReportprintThis">
          <div class="card-body">
                <div class="row">
                  <!-- Administered Report List -->
                  <table class="table table-sm table-hover table-borderless text-nowrap">
                    <thead>
                      <tr>
                        <th><small>Date</small></th>
                        <th><small>Patient Name</small></th>
                        <th hidden><small>Date of Birth</small></th>
                        <th><small>Vaccine</small></th>
                        <th hidden><small>Lot</small></th>
                        <th hidden><small>Expiration</small></th>
                        <th><small>Eligibility</small></th>
                        <th><small>Administered By</small></th>
                      </tr>
                    </thead>
                    <tbody align="left">

                        <?php
                        // Display provider table
                        $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                        $immunized = "SELECT * FROM immunization WHERE groupID='$groupID' ";
                        $immunized_run = mysqli_query($con, $immunized);
                        if(mysqli_num_rows($immunized_run) > 0 )
                        {
                          foreach ($immunized_run as $vaccine)
                          {
                          ?>
                          <tr>
                            <td><small><?= htmlspecialchars($vaccine['date']); ?></small></td>
                            <td><small><?= htmlspecialchars(decryptthis_iz($vaccine['name'], $iz_key)); ?></small></td>
                            <td hidden><small><?= htmlspecialchars(decryptthis_iz($vaccine['dob'], $iz_key)); ?></small></td>
                            <td><small><?= htmlspecialchars(decryptthis_iz($vaccine['vaccine'], $iz_key)); ?></small></td>
                            <td hidden><small><?= htmlspecialchars(decryptthis_iz($vaccine['lot'], $iz_key)); ?></small></td>
                            <td hidden><small><?= htmlspecialchars($vaccine['exp']); ?></small></td>
                            <td><small><?= htmlspecialchars(decryptthis_iz($vaccine['funding_source'], $iz_key)); ?></small></td>
                            <td><small><?= htmlspecialchars(decryptthis_iz($vaccine['administered_by'], $iz_key)); ?></small></td>
                          </tr>
                          <?php
                          }
                        }
                        else
                        {
                        ?>
                        <tr>
                          <td colspan="7" align="center"><small>No Record Found</small></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                  </table>

                </div>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="align-center col d-flex justify-content-center">
          <!-- Save Inventory -->
          <button title="Save Report" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none mb-2" style="text-align: left">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
              <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
            </svg>
          </button>
          <!-- Print Report -->
          <button title="Print Inventory Report" type="submit" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none mb-2" id="administeredReportPrint" onClick="window.print()">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
              <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
              <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>