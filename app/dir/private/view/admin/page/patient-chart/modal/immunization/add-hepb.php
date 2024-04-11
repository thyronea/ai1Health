<?php $hepB_vis = date('2023') . '-' . date('05') . '-' . date('12'); ?>

<div class="modal fade" id="administer_hepb" tabindex="-1" aria-labelledby="administer_hepbLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="administer_hepbLabel">Administer Hep B</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
          <form class="" action="process/update-patient-contact.php" method="post">
          <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="Last Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_dob" value="<?=htmlspecialchars(decryptthis($diversity['dob'], $key));?>" placeholder="Date of Birth" required>
            
            <div class="row mb-2">
              <div class="col">
                <input type="date" name="date" class="form-control form-control-sm" value="<?php echo $today; ?>" required>
              </div>
              <div class="col">
                <input type="" name="time" class="form-control form-control-sm" value="<?php echo date("h:i A"); ?>" required>
              </div>
            </div>
            <select id="vaccines" name="vaccine" class="form-select form-select-sm mb-2" required>
              <option selected>Select from inventory</option>
                  <?php
                  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                  $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Hepatitis B - Engerix B Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $hepB_SDV = mysqli_num_rows($sql_run);
                  while ($hepB_SDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". htmlspecialchars($hepB_SDV['name']) ."'>" .htmlspecialchars($hepB_SDV['name']) ."</option>" ;
                  }
                  $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Hepatitis B - Engerix B Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $hepB_SDS = mysqli_num_rows($sql_run);
                  while ($hepB_SDS = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $hepB_SDS['name'] ."'>" .$hepB_SDS['name'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Hepatitis B - Recombivax Single Dose Vials' ";
                  $sql_run = mysqli_query($con, $sql);
                  $hepB_RSDV = mysqli_num_rows($sql_run);
                  while ($hepB_RSDV = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $hepB_RSDV['name'] ."'>" .$hepB_RSDV['name'] ."</option>" ;
                  }
                  $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Hepatitis B - Recombivax Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $hepB_RSDS = mysqli_num_rows($sql_run);
                  while ($hepB_RSDS = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". $hepB_RSDS['vaccine'] ."'>" .$hepB_RSDS['vaccine'] ."</option>" ;
                  }
                  ?>
             </select>

             <div class="col mb-2">
                <input type="text" id="ndc" name="ndc" class="form-control form-control-sm" value="" placeholder="NDC" required>
             </div>
             <div class="col mb-2">
                <input type="text" id="lot" name="lot" class="form-control form-control-sm" value="" placeholder="Lot Number" required>
             </div>

             <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Expiration Date:</small></label>
                </div>
                <div class="col">
                  <input type="date" id="exp" name="exp" class="form-control form-control-sm" value="" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Site:</small></label>
                </div>
                <div class="col">
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
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Route:</small></label>
                </div>
                <div class="col">
                  <select class="form-select form-select-sm" name="route" required>
                    <option selected value="Intramuscular">Intramuscular</option>
                    <option value="Subcutaneous">Subcutaneous</option>
                    <option value="Intranasal">Intranasal</option>
                    <option value="Oral">Oral</option>
                  </select>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>VIS Given:</small></label>
                </div>
                <div class="col">
                  <input type="date" name="vis_given" class="form-control form-control-sm" value="<?php echo $today; ?>" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small><a href="https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf" target="_blank" class="text-decoration-none">VIS Publication Date:</a></small></label>
                </div>
                <div class="col">
                  <input type="date" name="vis" class="form-control form-control-sm" value="<?php echo $hepB_vis; ?>" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Administered By:</small></label>
                </div>
                <div class="col">
                  <input type="text" name="administered_by" class="form-control form-control-sm" value="<?=htmlspecialchars($_SESSION["fname"]);?> <?=htmlspecialchars($_SESSION["lname"]);?>" placeholder="Given By" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Funding Source:</small></label>
                </div>
                <div class="col">
                  <select class="form-select form-select-sm" name="funding_source">
                    <option disabled selected>Select one</option>
                    <option value="Private">Private</option>
                    <option value="VFC Eligible - Medical/Medicaid">VFC Eligible - Medical/Medicaid</option>
                    <option value="VFC Eligible - Uninsured">VFC Eligible - Uninsured</option>
                    <option value="VFC Eligible - Underinsured">VFC Eligible - Underinsured</option>
                    <option value="VFC Eligible - Native American">VFC Eligible - Native American</option>
                    <option value="VFC Eligible - Alaskan Native">VFC Eligible - Alaskan Native</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <textarea name="comment" class="form-control form-control-sm" placeholder="Comment......"></textarea>
                </div>
              </div>

            <button type="submit" name="patient_contactbtn" class="focus-ring btn btn-sm border mt-3">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
