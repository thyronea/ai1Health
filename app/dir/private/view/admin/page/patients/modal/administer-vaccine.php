<!-- Modal -->
<div class="modal fade" id="administer-Modal" tabindex="-1" aria-labelledby="administer-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="administer-ModalLabel">Administer Vaccine</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="../process/sql.php" method="POST" align="left">
            <div class="row mt-3">
              <div class="col-md-6">
                <label><small>Product:</small></label>
                <input type="hidden" class="form-control form-control-sm mt-2" name="id" value="<?=htmlspecialchars($patient['id']);?>" required>
                <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
                <input type="hidden" class="form-control form-control-sm mt-2" name="fname" value="<?=htmlspecialchars($patient['fname']);?>" placeholder="First Name" required>
                <input type="hidden" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars($patient['lname']);?>" placeholder="Last Name" required>
                <input type="hidden" class="form-control form-control-sm mt-2" name="dob" value="<?=htmlspecialchars($diversity['dob']);?>" placeholder="Date of Birth" required>
                <input type="hidden" class="form-control form-control-sm mt-2" name="type" value="Catch-up" required>
                <select id="vaccines" name="vaccine" class="form-select form-select-sm" required>
                  <option selected disabled>Select from inventory</option>
                  <?php
                  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='MMR - MMR-II Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $mmr2 = mysqli_num_rows($sql_run);
                  while ($mmr2 = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $mmr2['vaccine'] ."'>" .$mmr2['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='MMR - Priorix Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $priorix = mysqli_num_rows($sql_run);
                  while ($priorix = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $priorix['vaccine'] ."'>" .$priorix['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Varicella - Varivax Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $varicella = mysqli_num_rows($sql_run);
                  while ($varicella = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $varicella['vaccine'] ."'>" .$varicella['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Pfizer-BioNTech' ";
                  $sql_run = mysqli_query($con, $sql);
                  $pfizer = mysqli_num_rows($sql_run);
                  while ($pfizer = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $pfizer['vaccine'] ."'>" .$pfizer['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Moderna' ";
                  $sql_run = mysqli_query($con, $sql);
                  $moderna = mysqli_num_rows($sql_run);
                  while ($moderna = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $moderna['vaccine'] ."'>" .$moderna['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Novavax' ";
                  $sql_run = mysqli_query($con, $sql);
                  $novavax = mysqli_num_rows($sql_run);
                  while ($novavax = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $novavax['vaccine'] ."'>" .$novavax['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='DTaP - Daptacel Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $dap_SDV = mysqli_num_rows($sql_run);
                  while ($dap_SDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $dap_SDV['vaccine'] ."'>" .$dap_SDV['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='DTaP - Infanrix Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $infan_SDV = mysqli_num_rows($sql_run);
                  while ($infan_SDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $infan_SDV['vaccine'] ."'>" .$infan_SDV['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='DTaP - Infanrix Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $infan_SDS = mysqli_num_rows($sql_run);
                  while ($infan_SDS = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $infan_SDS['vaccine'] ."'>" .$infan_SDS['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Fluarix Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $fluarix = mysqli_num_rows($sql_run);
                  while ($fluarix = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $fluarix['vaccine'] ."'>" .$fluarix['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Flucelvax Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $flucelvax = mysqli_num_rows($sql_run);
                  while ($flucelvax = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $flucelvax['vaccine'] ."'>" .$flucelvax['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='FluLaval Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $flulaval = mysqli_num_rows($sql_run);
                  while ($flulaval = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $flulaval['vaccine'] ."'>" .$flulaval['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Fluzone Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $fluzone = mysqli_num_rows($sql_run);
                  while ($fluzone = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $fluzone['vaccine'] ."'>" .$fluzone['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Flumist Intranasal Sprayer' ";
                  $sql_run = mysqli_query($con, $sql);
                  $flumist = mysqli_num_rows($sql_run);
                  while ($flumist = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $flumist['vaccine'] ."'>" .$flumist['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Hepatitis A - Vaqta Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $vaqta_SDV = mysqli_num_rows($sql_run);
                  while ($vaqta_SDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $vaqta_SDV['vaccine'] ."'>" .$vaqta_SDV['vaccine'] ."</option>" ;
                  }
                  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Hepatitis A - Vaqta Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $vaqta_SDS = mysqli_num_rows($sql_run);
                  while ($vaqta_SDS = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $vaqta_SDS['vaccine'] ."'>" .$vaqta_SDS['vaccine'] ."</option>" ;
                  }
                  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Hepatitis A - Havrix Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $havrix_SDV = mysqli_num_rows($sql_run);
                  while ($havrix_SDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $havrix_SDV['vaccine'] ."'>" .$havrix_SDV['vaccine'] ."</option>" ;
                  }
                  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Hepatitis A - Havrix Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $havrix_SDS = mysqli_num_rows($sql_run);
                  while ($havrix_SDS = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $havrix_SDS['vaccine'] ."'>" .$havrix_SDS['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Hepatitis B - Engerix B Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $hepB_SDV = mysqli_num_rows($sql_run);
                  while ($hepB_SDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $hepB_SDV['vaccine'] ."'>" .$hepB_SDV['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Hepatitis B - Engerix B Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $hepB_SDS = mysqli_num_rows($sql_run);
                  while ($hepB_SDS = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $hepB_SDS['vaccine'] ."'>" .$hepB_SDS['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Hepatitis B - Recombivax Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $hepB_RSDV = mysqli_num_rows($sql_run);
                  while ($hepB_RSDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $hepB_RSDV['vaccine'] ."'>" .$hepB_RSDV['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Hepatitis B - Recombivax Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $hepB_RSDS = mysqli_num_rows($sql_run);
                  while ($hepB_RSDS = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $hepB_RSDS['vaccine'] ."'>" .$hepB_RSDS['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Hib - PedvaxHib Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $Pedvax_SDV = mysqli_num_rows($sql_run);
                  while ($Pedvax_SDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $Pedvax_SDV['vaccine'] ."'>" .$Pedvax_SDV['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Hib - ActHIB Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $ActHib_SDV = mysqli_num_rows($sql_run);
                  while ($ActHib_SDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $ActHib_SDV['vaccine'] ."'>" .$ActHib_SDV['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Hib - Hiberix Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $Hib_SDV = mysqli_num_rows($sql_run);
                  while ($Hib_SDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $Hib_SDV['vaccine'] ."'>" .$Hib_SDV['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='HPV - Gardasil 9 Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $hpv = mysqli_num_rows($sql_run);
                  while ($hpv = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $hpv['vaccine'] ."'>" .$hpv['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='IPV - IPOL 10 Dose Vial' ";
                  $sql_run = mysqli_query($con, $sql);
                  $ipv_DV = mysqli_num_rows($sql_run);
                  while ($ipv_DV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $ipv_DV['vaccine'] ."'>" .$ipv_DV ['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='MCV - Menactra Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $menactra_SDV = mysqli_num_rows($sql_run);
                  while ($menactra_SDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $menactra_SDV['vaccine'] ."'>" .$menactra_SDV['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='MCV - Menveo Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $menveo_SDV = mysqli_num_rows($sql_run);
                  while ($menveo_SDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $menveo_SDV['vaccine'] ."'>" .$menveo_SDV['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='MCV - MenQuadfi Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $menquadfi_SDV = mysqli_num_rows($sql_run);
                  while ($menquadfi_SDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $menquadfi_SDV['vaccine'] ."'>" .$menquadfi_SDV['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='PCV - Prevnar Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $prev_SDS = mysqli_num_rows($sql_run);
                  while ($prev_SDS = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $prev_SDS['vaccine'] ."'>" .$prev_SDS['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='PCV - Vaxneuvance Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $vax_SDS = mysqli_num_rows($sql_run);
                  while ($vax_SDS = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $vax_SDS['vaccine'] ."'>" .$vax_SDS['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='RV - RotaTeq Single Dose Tubes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $rv_SDT = mysqli_num_rows($sql_run);
                  while ($rv_SDT = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $rv_SDT['vaccine'] ."'>" .$rv_SDT['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='RV - Rotarix Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $rv_SDS = mysqli_num_rows($sql_run);
                  while ($rv_SDS = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $rv_SDS['vaccine'] ."'>" .$rv_SDS['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='RV - Rotarix Single Oral Doses' ";
                  $sql_run = mysqli_query($con, $sql);
                  $rv_SOD = mysqli_num_rows($sql_run);
                  while ($rv_SOD = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $rv_SOD['vaccine'] ."'>" .$rv_SOD['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Tdap - Boostrix Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $boostrix_SDV = mysqli_num_rows($sql_run);
                  while ($boostrix_SDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $boostrix_SDV['vaccine'] ."'>" .$boostrix_SDV['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Tdap - Boostrix Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $boostrix_SDS = mysqli_num_rows($sql_run);
                  while ($boostrix_SDS = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $boostrix_SDS['vaccine'] ."'>" .$boostrix_SDS['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Tdap - Adacel Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $adacel_SDV = mysqli_num_rows($sql_run);
                  while ($adacel_SDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $adacel_SDV['vaccine'] ."'>" .$adacel_SDV['vaccine'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM vaccines WHERE groupID='$groupID' AND vaccine='Tdap - Adacel Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $adacel_SDS = mysqli_num_rows($sql_run);
                  while ($adacel_SDS = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $adacel_SDS['vaccine'] ."'>" .$adacel_SDS['vaccine'] ."</option>" ;
                  }
                  ?>
                </select>
              </div>
              <div class="col">
                <label><small>Date:</small></label>
                <input type="date" name="date" class="form-control form-control-sm" value="<?php echo $today; ?>" required>
              </div>
              <div class="col">
                <label><small>Time:</small></label>
                <input type="" name="time" class="form-control form-control-sm" value="<?php echo date("h:i A"); ?>" required>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <label><small>Manufacturer:</small></label>
                <select class="form-select form-select-sm" name="manufacturer" required>
                  <option disabled selected>Select one</option>
                  <option value="GSK">GSK</option>
                  <option value="Merck">Merck</option>
                  <option value="Pfizer">Pfizer</option>
                  <option value="Sanofi">Sanofi</option>
                  <option value="Seqirus">Seqirus</option>
                  <option value="AstraZeneca">AstraZeneca</option>
                </select>
              </div>
              <div class="col">
                <label><small>NDC:</small></label>
                <input type="text" id="ndc" name="ndc" class="form-control form-control-sm" value="" required>
              </div>
              <div class="col">
                <label><small>Lot Number:</small></label>
                <input type="text" id="lot" name="lot" class="form-control form-control-sm" value="" required>
              </div>
              <div class="col">
                <label><small>Expiration Date:</small></label>
                <input type="date" id="exp" name="exp" class="form-control form-control-sm" value="" required>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <label><small>Site:</small></label>
                <select class="form-select form-select-sm" name="site" required>
                  <option selected value="L-Deltoid">L-Deltoid</option>
                  <option value="R-Deltoid">R-Deltoid</option>
                  <option value="L-Vastus Lateralis">L-Vastus Lateralis</option>
                  <option value="R-Vastus Lateralis">R-Vastus Lateralis</option>
                  <option value="L-Thigh">L-Thigh</option>
                  <option value="R-Thigh">R-Thigh</option>
                  <option value="Mouth">Mouth</option>
                </select>
              </div>
              <div class="col">
                <label><small>Route:</small></label>
                <select class="form-select form-select-sm" name="route" required>
                  <option selected value="Intramuscular">Intramuscular</option>
                  <option value="Subcutaneous">Subcutaneous</option>
                  <option value="Intranasal">Intranasal</option>
                  <option value="Oral">Oral</option>
                </select>
              </div>
              <div class="col">
                <label><small>VIS Given Date:</small></label>
                <input type="date" name="vis_given" class="form-control form-control-sm" value="<?php echo $today; ?>" required>
              </div>
              <div class="col">
                <label><small><a href="https://www.cdc.gov/vaccines/hcp/vis/current-vis.html" target="_blank" class="text-decoration-none">VIS Publication Date:</a></small></label>
                <input type="date" name="vis" class="form-control form-control-sm" value="" required>
              </div>
            </div>
            <hr class="mt-4">
            <div class="row mt-3">
              <div class="col">
                <label><small>Administered By:</small></label>
                <input type="text" name="administered_by" class="form-control form-control-sm" value="<?=$_SESSION["fname"];?> <?=$_SESSION["lname"];?>" placeholder="Given By" required>
              </div>
              <div class="col">
                <label><small>Funding Source:</small></label>
                <select class="form-select form-select-sm" name="funding_source">
                  <option disabled selected>Select one</option>
                  <option value="Private">Private</option>
                  <option value="State Program">State Program</option>
                  <option value="VFC Eligible - Medical/Medicaid">VFC Eligible - Medical/Medicaid</option>
                  <option value="VFC Eligible - Uninsured">VFC Eligible - Uninsured</option>
                  <option value="VFC Eligible - Underinsured">VFC Eligible - Underinsured</option>
                  <option value="VFC Eligible - Native American">VFC Eligible - Native American</option>
                  <option value="VFC Eligible - Alaskan Native">VFC Eligible - Alaskan Native</option>
                </select>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <label><small>Comment:</small></label>
                <textarea name="comment" class="form-control form-control-sm"></textarea>
              </div>
            </div>


          <div class="mt-4" align="center">
            <button type="submit" name="administer_vaccine" class="focus-ring py-1 px-2 btn-outline border btn btn-sm">Submit</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>
