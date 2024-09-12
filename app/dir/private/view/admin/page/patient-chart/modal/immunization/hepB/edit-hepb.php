<?php $hepB_vis = date('2023') . '-' . date('05') . '-' . date('12'); ?>

<div class="modal fade" id="edit_administered_hepb" tabindex="-1" aria-labelledby="edit_administered_hepbLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="edit_administered_hepbLabel">Hepatitis B</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <form class="" action="process/immunization/update-iz.php" method="post">
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="Last Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="shotID" id="hepB_edit_ID" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="uniqueID" id="hepB_edit_uniqueID" required>
            
            <div class="row col-md-8 mb-2">
              <div class="col">
                <input type="hidden" name="date" class="form-control form-control-sm text-center" value="<?php echo $today; ?>" required>
              </div>
              <div class="col">
                <input type="hidden" name="time" class="form-control form-control-sm text-center" value="<?php echo date("h:i A"); ?>" required>
              </div>
            </div>

            <select id="edit_hepB_vaccines" name="vaccineID" class="form-select form-select-sm mb-4" onchange="edit_hepB()">
              <option>Select from inventory</option>
                  <?php
                    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                    $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Hepatitis B - Engerix B Single Dose Vials' ";
                    $sql_run = mysqli_query($con, $sql);
                    $hepB_SDV = mysqli_num_rows($sql_run);
                    while ($hepB_SDV = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($hepB_SDV['id']) ."'>" .htmlspecialchars($hepB_SDV['name']) .' ' .'('.htmlspecialchars($hepB_SDV['funding_source']).')' ."</option>" ;
                    }

                    $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Hepatitis B - Engerix B Single Dose Syringes' ";
                    $sql_run = mysqli_query($con, $sql);
                    $hepB_SDS = mysqli_num_rows($sql_run);
                    while ($hepB_SDS = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($hepB_SDS['id']) ."'>" .$hepB_SDS['name'] .' ' .'('.htmlspecialchars($hepB_SDS['funding_source']).')' ."</option>" ;
                    }

                    $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Hepatitis B - Recombivax Single Dose Vials' ";
                    $sql_run = mysqli_query($con, $sql);
                    $hepB_RSDV = mysqli_num_rows($sql_run);
                    while ($hepB_RSDV = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($hepB_RSDV['id']) ."'>" .$hepB_RSDV['name'] .' ' .'('.htmlspecialchars($hepB_RSDV['funding_source']).')' ."</option>" ;
                    }

                    $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Hepatitis B - Recombivax Single Dose Syringes' ";
                    $sql_run = mysqli_query($con, $sql);
                    $hepB_RSDS = mysqli_num_rows($sql_run);
                    while ($hepB_RSDS = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($hepB_RSDS['id']) ."'>" .$hepB_RSDS['name'] .' ' .'('.htmlspecialchars($hepB_RSDS['funding_source']).')' ."</option>" ;
                    }

                    $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='DTaP/Hep-B/IPV - Pediarix Single Dose Syringes' ";
                    $sql_run = mysqli_query($con, $sql);
                    $hepB_pediarix = mysqli_num_rows($sql_run);
                    while ($hepB_pediarix = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($hepB_pediarix['id']) ."'>" .htmlspecialchars($hepB_pediarix['name']) .' ' .'('.htmlspecialchars($hepB_pediarix['funding_source']).')' ."</option>" ;
                    }

                    $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='DTaP/IPV/Hib/Hep-B - Vaxelis Single Dose Vials' ";
                    $sql_run = mysqli_query($con, $sql);
                    $vaxelis_SDV = mysqli_num_rows($sql_run);
                    while ($vaxelis_SDV = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($vaxelis_SDV['id']) ."'>" .htmlspecialchars($vaxelis_SDV['name']) .' ' .'('.htmlspecialchars($vaxelis_SDV['funding_source']).')' ."</option>" ;
                    }

                    $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='DTaP/IPV/Hib/Hep-B - Vaxelis Single Dose Syringes' ";
                    $sql_run = mysqli_query($con, $sql);
                    $vaxelis_SDS = mysqli_num_rows($sql_run);
                    while ($vaxelis_SDS = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($vaxelis_SDS['id']) ."'>" .htmlspecialchars($vaxelis_SDS['name']) .' ' .'('.htmlspecialchars($vaxelis_SDS['funding_source']).')' ."</option>" ;
                    }
                  ?>
            </select>

            <div class="row mb-2">
                <div class="col">
                  <input type="" id="edit_hepB_name" name="vaccine" class="form-control form-control-sm" value="" required>
                </div>
            </div>
            
             <div class="row mb-2">
                <div class="col">
                  <input type="text" id="edit_hepB_lot" name="lot" class="form-control form-control-sm" value="" placeholder="Lot Number" required>
                </div>
                <div class="col">
                  <input type="text" id="edit_hepB_ndc" name="ndc" class="form-control form-control-sm" value="" placeholder="NDC" required>
                </div>
             </div>
             <?php
              
             ?>
            
             <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Expiration Date:</small></label>
                </div>
                <div class="col">
                  <input type="date" id="edit_hepB_exp" name="exp" class="form-control form-control-sm" value="" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Site:</small></label>
                </div>
                <div class="col">
                  <select class="form-select form-select-sm" name="site" id="hepB_edit_site" required>
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
                  <select class="form-select form-select-sm" name="route" id="hepB_edit_route" required>
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
                  <input type="date" name="vis_given" id="hepB_edit_vis_given" class="form-control form-control-sm" value="<?php echo $today; ?>" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small><a href="https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf" target="_blank" class="text-decoration-none">VIS Publication Date:</a></small></label>
                </div>
                <div class="col">
                  <input type="date" name="vis" id="hepB_vis" class="form-control form-control-sm" value="<?php echo $hepB_vis; ?>" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Eligibility:</small></label>
                </div>
                <div class="col">
                  <input id="edit_hepB_funding" name="edit_hepB_funding" class="form-control form-control-sm" onChange="edit_validate_hepB()" hidden required>
                  <select id="edit_hepB_eligibility" name="edit_hepB_eligibility" class="form-select form-select-sm" onChange="edit_validate_hepB()">
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
                  <select class="form-select form-select-sm mb-2" id="hepBadministered_by" name="administered_by" required>
                  <option value="<?=htmlspecialchars(decryptthis_iz($vaccine['administered_by'], $iz_key));?>"><?=htmlspecialchars(decryptthis_iz($vaccine['administered_by'], $iz_key));?></option>
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
                  <textarea name="comment" class="form-control form-control-sm" id="hepB_edit_comment" placeholder="Comment......"></textarea>
                </div>
              </div>

            <a type="button" class="focus-ring btn btn-sm border mt-3" id="submit_btn" data-bs-toggle="modal" data-bs-target="#delete_hepb">Delete</a>  
            <button type="submit" name="update_hepB" class="focus-ring btn btn-sm border mt-3" id="submit_btn" >Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


