<?php $hepA_vis = date('2021') . '-' . date('10') . '-' . date('15');  ?>

<div class="modal fade" id="edit_administered_hepa" tabindex="-1" aria-labelledby="edit_administered_hepaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="edit_administered_hepaLabel">Hep A</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <form class="" action="process/immunization/update-iz.php" method="post">
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="Last Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="shotID" id="hepa_edit_ID" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="uniqueID" id="hepa_edit_uniqueID" required>
            
            <div class="row col-md-8 mb-2">
              <div class="col">
                <input type="hidden" name="date" class="form-control form-control-sm text-center" value="<?php echo $today; ?>" required>
              </div>
              <div class="col">
                <input type="hidden" name="time" class="form-control form-control-sm text-center" value="<?php echo date("h:i A"); ?>" required>
              </div>
            </div>

            <select id="edit_hepa_vaccines" name="vaccineID" class="form-select form-select-sm mb-4" onchange="edit_hepa()">
              <option>Select from inventory</option>
                  <?php
                    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                    $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Hepatitis A - Vaqta Single Dose Vials' ";
                    $sql_run = mysqli_query($con, $sql);
                    $vaqta_SDV = mysqli_num_rows($sql_run);
                    while ($vaqta_SDV = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($vaqta_SDV['id']) ."'>" .htmlspecialchars($vaqta_SDV['name']) .' ' .'('.htmlspecialchars($vaqta_SDV['funding_source']).')' ."</option>" ;
                    }

                    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                    $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Hepatitis A - Vaqta Single Dose Syringes' ";
                    $sql_run = mysqli_query($con, $sql);
                    $vaqta_SDS = mysqli_num_rows($sql_run);
                    while ($vaqta_SDS = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($vaqta_SDS['id']) ."'>" .htmlspecialchars($vaqta_SDS['name']) .' ' .'('.htmlspecialchars($vaqta_SDS['funding_source']).')' ."</option>" ;
                    }

                    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                    $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Hepatitis A - Havrix Single Dose Vials' ";
                    $sql_run = mysqli_query($con, $sql);
                    $havrix_SDV = mysqli_num_rows($sql_run);
                    while ($havrix_SDV = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($havrix_SDV['id']) ."'>" .htmlspecialchars($havrix_SDV['name']) .' ' .'('.htmlspecialchars($havrix_SDV['funding_source']).')' ."</option>" ;
                    }

                    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                    $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Hepatitis A - Havrix Single Dose Syringes' ";
                    $sql_run = mysqli_query($con, $sql);
                    $havrix_SDS = mysqli_num_rows($sql_run);
                    while ($havrix_SDS = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($havrix_SDS['id']) ."'>" .htmlspecialchars($havrix_SDS['name']) .' ' .'('.htmlspecialchars($havrix_SDS['funding_source']).')' ."</option>" ;
                    }
                  ?>
            </select>

            <div class="row mb-2">
                <div class="col">
                  <input type="text" id="edit_hepa_name" name="vaccine" class="form-control form-control-sm" value="" required>
                </div>
            </div>
            
             <div class="row mb-2">
                <div class="col">
                  <input type="text" id="edit_hepa_lot" name="lot" class="form-control form-control-sm" value="" placeholder="Lot Number" required>
                </div>
                <div class="col">
                  <input type="text" id="edit_hepa_ndc" name="ndc" class="form-control form-control-sm" value="" placeholder="NDC" required>
                </div>
             </div>
             <?php
              
             ?>
            
             <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Expiration Date:</small></label>
                </div>
                <div class="col">
                  <input type="date" id="edit_hepa_exp" name="exp" class="form-control form-control-sm" value="" required>
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
                    <option selected value="Subcutaneous">Subcutaneous</option>
                    <option value="Intramuscular">Intramuscular</option>
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
                  <input type="date" name="vis_given" id="hepa_edit_vis_given" class="form-control form-control-sm" value="<?php echo $today; ?>" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small><a href="https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-a.pdf" target="_blank" class="text-decoration-none">VIS Publication Date:</a></small></label>
                </div>
                <div class="col">
                  <input type="date" name="vis" id="hepa_vis" class="form-control form-control-sm" value="<?php echo $hepA_vis; ?>" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Eligibility:</small></label>
                </div>
                <div class="col">
                  <input id="edit_hepa_funding" name="edit_hepa_funding" class="form-control form-control-sm" onChange="edit_validate_hepa()" hidden required>
                  <select id="edit_hepa_eligibility" name="edit_hepa_eligibility" class="form-select form-select-sm" onChange="edit_validate_hepa()">
                    <option></option>
                    <option disabled>Select one</option>
                    <option value="Private">Private</option>
                    <optgroup label="Public">
                      <option value="Public">Select Elegibility Status</option>
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
                  <select class="form-select form-select-sm mb-2" id="hepaadministered_by" name="administered_by" required>
                      <option disabled selected>Or select from active users</option>
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
                  <textarea name="comment" class="form-control form-control-sm" id="hepa_edit_comment" placeholder="Comment......"></textarea>
                </div>
              </div>

            <a type="button" class="focus-ring btn btn-sm border mt-3" id="submit_btn" data-bs-toggle="modal" data-bs-target="#delete_hepa">Delete</a>  
            <button type="submit" name="update_hepa" class="focus-ring btn btn-sm border mt-3" id="submit_btn" >Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
