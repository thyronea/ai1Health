<?php $tdap_vis = date('2021') . '-' . date('08') . '-' . date('06'); ?>

<div class="modal fade" id="edit_administered_tdap" tabindex="-1" aria-labelledby="edit_administered_tdapLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="edit_administered_tdapLabel">Tdap</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <form class="" action="process/immunization/update-iz.php" method="post">
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_fname" value="<?=htmlspecialchars(decryptthis_iz($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_lname" value="<?=htmlspecialchars(decryptthis_iz($patient['lname'], $key));?>" placeholder="Last Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="shotID" id="tdap_edit_ID" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="uniqueID" id="tdap_edit_uniqueID" required>
            
            <div class="row col-md-8 mb-2">
              <div class="col">
                <input type="hidden" name="date" class="form-control form-control-sm text-center" value="<?php echo $today; ?>" required>
              </div>
              <div class="col">
                <input type="hidden" name="time" class="form-control form-control-sm text-center" value="<?php echo date("h:i A"); ?>" required>
              </div>
            </div>
            
            <select id="edit_tdap_vaccines" name="vaccineID" class="form-select form-select-sm mb-4" onchange="edit_tdap()">
              <option>Select from inventory</option>
                  <?php
                    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                    $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Tdap - Boostrix Single Dose Vials' ";
                    $sql_run = mysqli_query($con, $sql);
                    $boostrix_SDV = mysqli_num_rows($sql_run);
                    while ($boostrix_SDV = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($boostrix_SDV['id']) ."'>" .htmlspecialchars($boostrix_SDV['name']) .' ' .'('.htmlspecialchars($boostrix_SDV['funding_source']).')' ."</option>" ;
                    }

                    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                    $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Tdap - Boostrix Single Dose Syringes' ";
                    $sql_run = mysqli_query($con, $sql);
                    $boostrix_SDS = mysqli_num_rows($sql_run);
                    while ($boostrix_SDS = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($boostrix_SDS['id']) ."'>" .htmlspecialchars($boostrix_SDS['name']) .' ' .'('.htmlspecialchars($boostrix_SDS['funding_source']).')' ."</option>" ;
                    }

                    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                    $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Tdap - Adacel Single Dose Vials' ";
                    $sql_run = mysqli_query($con, $sql);
                    $adacel_SDV = mysqli_num_rows($sql_run);
                    while ($adacel_SDV = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($adacel_SDV['id']) ."'>" .htmlspecialchars($adacel_SDV['name']) .' ' .'('.htmlspecialchars($adacel_SDV['funding_source']).')' ."</option>" ;
                    }

                    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                    $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='Tdap - Adacel Single Dose Syringes' ";
                    $sql_run = mysqli_query($con, $sql);
                    $adacel_SDS = mysqli_num_rows($sql_run);
                    while ($adacel_SDS = mysqli_fetch_array($sql_run))
                    {
                      echo "<option value='". htmlspecialchars($adacel_SDS['id']) ."'>" .htmlspecialchars($adacel_SDS['name']) .' ' .'('.htmlspecialchars($adacel_SDS['funding_source']).')' ."</option>" ;
                    }
                  ?>
            </select>

            <div class="row mb-2">
                <div class="col">
                  <input type="text" id="edit_tdap_name" name="vaccine" class="form-control form-control-sm" value="" required>
                </div>
            </div>

             <div class="row mb-2">
                <div class="col">
                  <input type="text" id="edit_tdap_lot" name="lot" class="form-control form-control-sm" value="" placeholder="Lot Number" required>
                </div>
                <div class="col">
                  <input type="text" id="edit_tdap_ndc" name="ndc" class="form-control form-control-sm" value="" placeholder="NDC" required>
                </div>
             </div>
             <?php
              
             ?>
            
             <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Expiration Date:</small></label>
                </div>
                <div class="col">
                  <input type="date" id="edit_tdap_exp" name="exp" class="form-control form-control-sm" value="" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Site:</small></label>
                </div>
                <div class="col">
                  <select class="form-select form-select-sm" name="site" id="tdap_edit_site" required>
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
                  <select class="form-select form-select-sm" name="route" id="tdap_edit_route" required>
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
                  <input type="date" name="vis_given" id="tdap_edit_vis_given" class="form-control form-control-sm" value="<?php echo $today; ?>" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small><a href="https://www.cdc.gov/vaccines/hcp/vis/vis-statements/tdap.pdf" target="_blank" class="text-decoration-none">VIS Publication Date:</a></small></label>
                </div>
                <div class="col">
                  <input type="date" name="vis" id="tdap_edit_vis" class="form-control form-control-sm" value="<?php echo $tdap_vis; ?>" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Funding Source:</small></label>
                </div>
                <div class="col">
                  <input id="edit_tdap_funding" name="edit_tdap_funding" class="form-control form-control-sm" onChange="edit_validate_tdap()" hidden required>
                  <select id="edit_tdap_eligibility" name="edit_tdap_eligibility" class="form-select form-select-sm" onChange="edit_validate_tdap()">
                    <option disabled selected>Select one</option>
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
                    <select class="form-select form-select-sm mb-2" id="tdapadministered_by" name="administered_by" required>
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
                  <textarea name="comment" class="form-control form-control-sm" id="tdap_edit_comment" placeholder="Comment......"></textarea>
                </div>
              </div>

            <a type="button" class="focus-ring btn btn-sm border mt-3" id="submit_btn" data-bs-toggle="modal" data-bs-target="#delete_tdap">Delete</a>  
            <button type="submit" name="update_tdap" class="focus-ring btn btn-sm border mt-3" id="submit_btn" >Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('.edit_tdap_btn').on('click', function() {
      $('#edit_administered_tdap').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#tdap_edit_ID').val(data[0]);
      $('#tdap_edit_uniqueID').val(data[1]);
      $('#delete_tdap_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_tdap_name').val(data[4]);
      $('#delete_tdap_name').val(data[4]);
      $('#edit_tdap_lot').val(data[5]);
      $('#edit_tdap_ndc').val(data[6]);
      $('#edit_tdap_exp').val(data[7]);
      $('#tdap_edit_site').val(data[8]);
      $('#tdap_edit_route').val(data[9]);
      $('#tdap_edit_vis_given').val(data[10]);
      $('#tdap_edit_vis').val(data[11]);
      $('#edit_tdap_funding').val(data[12]);
      $('#edit_tdap_eligibility').val(data[12]);
      $('#tdapadministered_by').val(data[13]);
      $('#tdap_edit_comment').val(data[14]);
    });
  });
</script>
