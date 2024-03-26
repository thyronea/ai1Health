<?php
session_start();
date_default_timezone_set('America/Los_Angeles');
$today = date('Y') . '-' . date('m') . '-' . date('d');
$rv_vis = date('2021') . '-' . date('10') . '-' . date('15');
?>


<!-- Modal -->
<div class="modal fade" id="rv-1st-Modal" tabindex="-1" aria-labelledby="rv-1st-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="rv-1st-ModalLabel">1st Rotavirus</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../process/sql.php" method="POST" align="left">
            <div class="row mt-3">
              <div class="col-md-6">
                <label><small>Product:</small></label>
                <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
                <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
                <input type="hidden" class="form-control form-control-sm mt-2" name="fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
                <input type="hidden" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="Last Name" required>
                <input type="hidden" class="form-control form-control-sm mt-2" name="dob" value="<?=htmlspecialchars(decryptthis($diversity['dob'], $key));?>" placeholder="Date of Birth" required>
                <input type="hidden" class="form-control form-control-sm mt-2" name="type" value="1st Rotavirus" required>
                <select id="vaccines" name="vaccine" class="form-select form-select-sm" required>
                  <option selected disabled>Select from inventory</option>
                  <?php
                  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
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
                  <option value="L-Deltoid">L-Deltoid</option>
                  <option value="R-Deltoid">R-Deltoid</option>
                  <option value="L-Vastus Lateralis">L-Vastus Lateralis</option>
                  <option value="R-Vastus Lateralis">R-Vastus Lateralis</option>
                  <option value="L-Thigh">L-Thigh</option>
                  <option value="R-Thigh">R-Thigh</option>
                  <option selected value="Mouth">Mouth</option>
                </select>
              </div>
              <div class="col">
                <label><small>Route:</small></label>
                <select class="form-select form-select-sm" name="route" required>
                  <option value="Intramuscular">Intramuscular</option>
                  <option value="Subcutaneous">Subcutaneous</option>
                  <option value="Intranasal">Intranasal</option>
                  <option selected value="Oral">Oral</option>
                </select>
              </div>
              <div class="col">
                <label><small>VIS Given Date:</small></label>
                <input type="date" name="vis_given" class="form-control form-control-sm" value="<?php echo $today; ?>" required>
              </div>
              <div class="col">
                <label><small><a href="https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf" target="_blank" class="text-decoration-none">VIS Publication Date:</a></small></label>
                <input type="date" name="vis" class="form-control form-control-sm" value="<?php echo $rv_vis; ?>" required>
              </div>
            </div>
            <hr class="mt-4">
            <div class="row mt-3">
              <div class="col">
                <label><small>Administered By:</small></label>
                <input type="text" name="administered_by" class="form-control form-control-sm" value="<?=htmlspecialchars($_SESSION["fname"]);?> <?=htmlspecialchars($_SESSION["lname"]);?>" placeholder="Given By" required>
              </div>
              <div class="col">
                <label><small>Funding Source:</small></label>
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
            <div class="row mt-3">
              <div class="col">
                <label><small>Comment:</small></label>
                <textarea name="comment" class="form-control form-control-sm"></textarea>
              </div>
            </div>


          <div class="mt-4" align="center">
            <button type="submit" name="rv_1st" class="focus-ring py-1 px-2 btn-outline border btn btn-sm">Submit</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
