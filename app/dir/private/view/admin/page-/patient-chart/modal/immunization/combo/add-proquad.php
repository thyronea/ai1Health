<?php 
$mmr_vis = date('2021') . '-' . date('08') . '-' . date('06'); 
$var_vis = date('2021') . '-' . date('08') . '-' . date('06'); 
?>

<div class="modal fade" id="administer_proquad" tabindex="-1" aria-labelledby="administer_proquadLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="administer_proquadLabel">Administer Proquad</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <form class="" action="process/immunization/administer-vax.php" method="post">
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="Last Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_dob" value="<?=htmlspecialchars(decryptthis($diversity['dob'], $key));?>" placeholder="Date of Birth" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="uniqueID" id="proquad_uniqueID" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="combo_type" value="PROQUAD" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="mmr_type" value="MMR" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="var_type" value="Varicella" required>
            
            <div class="row col-md-8 mb-2">
              <div class="col">
                <input type="hidden" name="date" class="form-control form-control-sm text-center" value="<?php echo $today; ?>" required>
              </div>
              <div class="col">
                <input type="hidden" name="time" class="form-control form-control-sm text-center" value="<?php echo date("h:i A"); ?>" required>
              </div>
            </div>
            
            <label><small>Vaccine</small></label>
            <select id="proquad_ID" name="id" class="form-select form-select-sm mb-2" onchange="add_proquad()" required>
                  <option></option>
                  <option disabled>Select from inventory</option>
                  <?php
                    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='MMRV - Proquad Single Dose Vials' ";
                    $sql_run = mysqli_query($con, $sql);
                    $proquad = mysqli_num_rows($sql_run);
                    while ($proquad = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($proquad['id']) ."'>" .htmlspecialchars($proquad['name']) .' ' .'('.htmlspecialchars($proquad['funding_source']).')' ."</option>" ;
                    }
                  ?>
              </option>
            </select>
            <div class="row mb-2">
                <div class="col">
                  <input type="" id="add_proquad_vaccines" name="vaccine" class="form-control form-control-sm" value="" hidden required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                  <input type="" id="add_proquad_manu" name="manufacturer" class="form-control form-control-sm" value="" placeholder="Manufacturer" required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                  <input type="text" id="add_proquad_lot" name="lot" class="form-control form-control-sm" value="" placeholder="Lot Number" required>
                </div>
                <div class="col">
                  <input type="text" id="add_proquad_ndc" name="ndc" class="form-control form-control-sm" value="" placeholder="NDC" required>
                </div>
            </div>
            <?php
              
            ?>
            
            <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Expiration Date:</small></label>
                </div>
                <div class="col">
                  <input type="date" id="add_proquad_exp" name="exp" class="form-control form-control-sm" value="" required>
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
                  <label><small><a href="https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf" target="_blank" class="text-decoration-none">(MMR) VIS Publication Date:</a></small></label>
                </div>
                <div class="col">
                  <input type="date" name="mmr_vis" class="form-control form-control-sm" value="<?php echo $mmr_vis; ?>" required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small><a href="https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf" target="_blank" class="text-decoration-none">(Varicella) VIS Publication Date:</a></small></label>
                </div>
                <div class="col">
                  <input type="date" name="var_vis" class="form-control form-control-sm" value="<?php echo $var_vis; ?>" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label style="color:red"><small>Eligibility:</small></label>
                </div>
                <div class="col">
                  <input id="add_proquad_funding" name="add_proquad_funding" class="form-control form-control-sm" onChange="add_validate_proquad()" hidden required>
                  <select id="add_proquad_eligibility" name="add_proquad_eligibility" class="form-select form-select-sm" onChange="add_validate_proquad()" required>
                    <option></option>
                    <option disabled>Select one</option>
                    <option value="Private">Private</option>
                    <optgroup label="Public">
                      <option value="Public">Select Eligibility Type</option>
                      <option value="VFC Eligible - Medical/Medicaid">VFC Eligible - Medical/Medicaid</option>
                      <option value="VFC Eligible - Uninsured">VFC Eligible - Uninsured</option>
                      <option value="VFC Eligible - Underinsured">VFC Eligible - Underinsured</option>
                      <option value="VFC Eligible - Native American">VFC Eligible - Native American</option>
                      <option value="VFC Eligible - Alaskan Native">VFC Eligible - Alaskan Native</option>
                    </optgroup>
                  </select>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Administered By:</small></label>
                </div>
                <div class="col">
                  <select name="administered_by" class="form-select form-select-sm mb-2" required>
                      <option value="<?=htmlspecialchars($_SESSION["fname"]);?> <?=htmlspecialchars($_SESSION["lname"]);?>" selected><?=htmlspecialchars($_SESSION["fname"]);?> <?=htmlspecialchars($_SESSION["lname"]);?></option>
                      <option disabled>Or select from active users</option>
                      <?php
                      $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                      $sql = "SELECT * FROM profile WHERE groupID='$groupID' ";
                      $sql_run = mysqli_query($con, $sql);
                      $admin = mysqli_num_rows($sql_run);
                      while ($admin = mysqli_fetch_array($sql_run))
                      {
                        echo "<option value='".htmlspecialchars($admin['fname'])." ".htmlspecialchars($admin['lname'])."'>".htmlspecialchars($admin['fname']).' '.htmlspecialchars($admin['lname'])."</option>" ;
                      }
                      ?>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <textarea name="comment" class="form-control form-control-sm" placeholder="Comment......"></textarea>
                </div>
              </div>

            <button type="submit" name="administer_proquad" class="focus-ring btn btn-sm border mt-3">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script for generating random uniqueID -->
<script>
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 9) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("proquad_uniqueID").value = randomNumber(8);
</script>

