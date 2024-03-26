<!-- Modal -->
<div class="modal fade" id="inventory-edit" tabindex="-1" aria-labelledby="inventory-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title w-100 fs-5" id="vaccine-edit-ModalLabel">Update Inventory</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <form class="" action="process/edit-inventory.php" method="POST">
          <div class="row g-2">
            <div class="col g-2" align="left">
              <small><p class="mt-1">Storage (Date & Time):</p></small>
            </div>
            <div class="col-md-8">
              <input style="background-color:white" type="text" name="doses" id="timestamp" placeholder="Date & Time of Storage" class="form-control form-control-sm mb-3 border-0" disabled required>
            </div>
          </div>
          <div class="row g-2">

              <input type="hidden" name="engineID" id="inventory_engineid" class="form-control form-control-sm" required>

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
                  <input type="text" name="doses" id="doses" placeholder="Number of Doses" class="form-control form-control-sm" required>
                </div>
              </div>

            </div>

          <div class="form-group mb-2" align="center">
            <button type="submit" name="update_inventory_btn" class="focus-ring btn btn-outline-secondary btn-sm">Update</button>
          </div>

        </form>

      </div>

    </div>
  </div>
</div>

<!--
Title: Edit Vaccine
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.vaccine-editbtn').on('click', function() {

      $('#vaccine-edit').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#inventory_engineid').val(data[0]);
      $('#groupid').val(data[1]);
      $('#doses').val(data[2]);
      $('#name').val(data[3]);
      $('#inventory_manufacturer').val(data[4]);
      $('#ndc').val(data[5]);
      $('#lot').val(data[6]);
      $('#exp').val(data[7]);
      $('#source').val(data[8]);
      $('#storage').val(data[9]);
      $('#timestamp').val(data[10]);
    });
  });
</script>
