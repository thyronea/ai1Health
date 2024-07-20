<?php 
$dtap_vis = date('2021') . '-' . date('08') . '-' . date('06'); 
$ipv_vis = date('2021') . '-' . date('08') . '-' . date('06'); 
$hepB_vis = date('2023') . '-' . date('05') . '-' . date('12'); 
?>

<div class="modal fade" id="administer_pediarix" tabindex="-1" aria-labelledby="administer_pediarixLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="administer_pediarixLabel">Administer Pediarix</h1>
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
            <input type="hidden" class="form-control form-control-sm mt-2" name="uniqueID" id="pediarix_uniqueID" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="combo_type" value="PEDIARIX" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="dtap_type" value="DTaP" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="hepB_type" value="Hepatitis B" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="ipv_type" value="IPV" required>
            
            <div class="row col-md-8 mb-2">
              <div class="col">
                <input type="hidden" name="date" class="form-control form-control-sm text-center" value="<?php echo $today; ?>" required>
              </div>
              <div class="col">
                <input type="hidden" name="time" class="form-control form-control-sm text-center" value="<?php echo date("h:i A"); ?>" required>
              </div>
            </div>
            
            <label><small>Vaccine</small></label>
            <select id="pediarix_ID" name="id" class="form-select form-select-sm mb-2" onchange="add_pediarix()" required>
                  <option></option>
                  <option disabled>Select from inventory</option>
                  <?php
                    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='DTaP/Hep-B/IPV - Pediarix Single Dose Syringes' ";
                    $sql_run = mysqli_query($con, $sql);
                    $pediarix = mysqli_num_rows($sql_run);
                    while ($pediarix = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($pediarix['id']) ."'>" .htmlspecialchars($pediarix['name']) .' ' .'('.htmlspecialchars($pediarix['funding_source']).')' ."</option>" ;
                    }
                  ?>
              </option>
            </select>
            <div class="row mb-2">
                <div class="col">
                  <input type="" id="add_pediarix_vaccines" name="vaccine" class="form-control form-control-sm" value="" hidden required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                  <input type="" id="add_pediarix_manu" name="manufacturer" class="form-control form-control-sm" value="" placeholder="Manufacturer" required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                  <input type="text" id="add_pediarix_lot" name="lot" class="form-control form-control-sm" value="" placeholder="Lot Number" required>
                </div>
                <div class="col">
                  <input type="text" id="add_pediarix_ndc" name="ndc" class="form-control form-control-sm" value="" placeholder="NDC" required>
                </div>
            </div>
            <?php
              
            ?>
            
            <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Expiration Date:</small></label>
                </div>
                <div class="col">
                  <input type="date" id="add_pediarix_exp" name="exp" class="form-control form-control-sm" value="" required>
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
                  <label><small><a href="https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf" target="_blank" class="text-decoration-none">(DTaP) VIS Publication Date:</a></small></label>
                </div>
                <div class="col">
                  <input type="date" name="dtap_vis" class="form-control form-control-sm" value="<?php echo $dtap_vis; ?>" required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small><a href="https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf" target="_blank" class="text-decoration-none">(Hep B) VIS Publication Date:</a></small></label>
                </div>
                <div class="col">
                  <input type="date" name="hepB_vis" class="form-control form-control-sm" value="<?php echo $hepB_vis; ?>" required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small><a href="https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf" target="_blank" class="text-decoration-none">(IPV) VIS Publication Date:</a></small></label>
                </div>
                <div class="col">
                  <input type="date" name="ipv_vis" class="form-control form-control-sm" value="<?php echo $ipv_vis; ?>" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label style="color:red"><small>Eligibility:</small></label>
                </div>
                <div class="col">
                  <input id="add_pediarix_funding" name="add_pediarix_funding" class="form-control form-control-sm" onChange="add_validate_pediarix()" hidden required>
                  <select id="add_pediarix_eligibility" name="add_pediarix_eligibility" class="form-select form-select-sm" onChange="add_validate_pediarix()" required>
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

            <button type="submit" name="administer_pediarix" class="focus-ring btn btn-sm border mt-3">Submit</button>
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
  document.getElementById("pediarix_uniqueID").value = randomNumber(8);
</script>

