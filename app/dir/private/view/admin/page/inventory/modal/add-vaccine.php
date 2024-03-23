<!-- Modal -->
<div class="modal fade" id="add-vaccine-Modal" tabindex="-1" aria-labelledby="add-vaccine-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="add-vaccine-ModalLabel">Add Vaccine</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="process/sql.php" method="POST">

            <div class="main-form mt-3">

              <div class="col-md-3">
                <div class="form-group mb-3 mt-2">
                  <input type="hidden" name="engineID[]" id="vaccine_engineID" class="form-control form-control-sm" required>
                </div>
                  <div class="form-group mb-1">
                      <input type="hidden" name="groupID" value="<?=htmlspecialchars($_SESSION['group_id']); ?>" class="form-control form-control-sm">
                  </div>
              </div>

              <div class="row g-2">
                  <!-- Location -->
                  <div class="col">
                    <select class="form-group form-select form-select-sm" name="storage[]">
                      <option disabled selected>Storage Unit</option>
                      <?php
                      $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
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
                          <option value="GSK">GSK</option>
                          <option value="Merck">Merck</option>
                          <option value="Pfizer">Pfizer</option>
                          <option value="Sanofi">Sanofi</option>
                          <option value="Seqirus">Seqirus</option>
                          <option value="AstraZeneca">AstraZeneca</option>
                        </select>
                      </div>
                  </div>
                  <!-- Product -->
                  <div class="col">
                    <div class="form-group mb-2">

                          <select class="form-select form-select-sm" name="vaccine[]" required>
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
                            <option value="COVID-19 - Pfizer-BioNTech">Pfizer-BioNTech</option>
                            <option value="COVID-19 - Moderna">Moderna</option>
                            <option value="COVID-19 - Novavax">Novavax</option>
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
                        <input type="text" name="doses[]" class="form-control form-control-sm" placeholder="Doses" required>
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
        <a href="javascript:void(0)" class="add-more-form focus-ring py-1 px-2 btn-outline border btn btn-sm" onclick="change();">More</a>
        <button type="submit" name="add_vaccines" class="focus-ring py-1 px-2 btn-outline border btn btn-sm">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>
