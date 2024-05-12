<?php $rsv_vis = date('2023') . '-' . date('10') . '-' . date('19'); ?>

<div class="modal fade" id="edit_administered_rsv" tabindex="-1" aria-labelledby="edit_administered_rsvLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="edit_administered_rsvLabel">RSV</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <form class="" action="process/immunization/update-iz.php" method="post">
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_fname" value="<?=htmlspecialchars(decryptthis_iz($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_lname" value="<?=htmlspecialchars(decryptthis_iz($patient['lname'], $key));?>" placeholder="Last Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="shotID" id="rsv_edit_ID" required>
            
            <div class="row col-md-8 mb-2">
              <div class="col">
                <input type="hidden" name="date" class="form-control form-control-sm text-center" value="<?php echo $today; ?>" required>
              </div>
              <div class="col">
                <input type="hidden" name="time" class="form-control form-control-sm text-center" value="<?php echo date("h:i A"); ?>" required>
              </div>
            </div>
            
            <select id="edit_rsv_vaccines" name="vaccineID" class="form-select form-select-sm mb-4" onchange="edit_rsv()">
              <option>Select from inventory</option>
                  <?php
                  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                  $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='RSV - Beyfortus 0.5 mL Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $rsv_half = mysqli_num_rows($sql_run);
                  while ($rsv_half = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". htmlspecialchars($rsv_half['id']) ."'>" .htmlspecialchars($rsv_half['name']) .' ' .'('.htmlspecialchars($rsv_half['funding_source']).')' ."</option>" ;
                  }

                  $sql = "SELECT * FROM inventory WHERE groupID='$groupID' AND name='RSV - Beyfortus 1.0 mL Single Dose Syringes' ";
                  $sql_run = mysqli_query($con, $sql);
                  $rsv_full = mysqli_num_rows($sql_run);
                  while ($rsv_full = mysqli_fetch_array($sql_run))
                  {
                    echo "<option value='". htmlspecialchars($rsv_full['id']) ."'>" .htmlspecialchars($rsv_full['name']) .' ' .'('.htmlspecialchars($rsv_full['funding_source']).')' ."</option>" ;
                  }
                  ?>
            </select>

            <div class="row mb-2">
                <div class="col">
                  <input type="text" id="edit_rsv_name" name="vaccine" class="form-control form-control-sm" value="" required>
                </div>
            </div>

             <div class="row mb-2">
                <div class="col">
                  <input type="text" id="edit_rsv_lot" name="lot" class="form-control form-control-sm" value="" placeholder="Lot Number" required>
                </div>
                <div class="col">
                  <input type="text" id="edit_rsv_ndc" name="ndc" class="form-control form-control-sm" value="" placeholder="NDC" required>
                </div>
             </div>
             <?php
              
             ?>
            
             <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Expiration Date:</small></label>
                </div>
                <div class="col">
                  <input type="date" id="edit_rsv_exp" name="exp" class="form-control form-control-sm" value="" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Site:</small></label>
                </div>
                <div class="col">
                  <select class="form-select form-select-sm" name="site" id="rsv_edit_site" required>
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
                  <select class="form-select form-select-sm" name="route" id="rsv_edit_route" required>
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
                  <input type="date" name="vis_given" id="rsv_edit_vis_given" class="form-control form-control-sm" value="<?php echo $today; ?>" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small><a href="https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rsv.pdf" target="_blank" class="text-decoration-none">VIS Publication Date:</a></small></label>
                </div>
                <div class="col">
                  <input type="date" name="vis" id="rsv_edit_vis" class="form-control form-control-sm" value="<?php echo $rsv_vis; ?>" required>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col" align="right">
                  <label><small>Funding Source:</small></label>
                </div>
                <div class="col">
                  <input id="edit_rsv_funding" name="edit_rsv_funding" class="form-control form-control-sm" onChange="edit_validate_rsv()" hidden required>
                  <select id="edit_rsv_eligibility" name="edit_rsv_eligibility" class="form-select form-select-sm" onChange="edit_validate_rsv()">
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
                    <select class="form-select form-select-sm mb-2" id="rsvadministered_by" name="administered_by" required>
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
                  <textarea name="comment" class="form-control form-control-sm" id="rsv_edit_comment" placeholder="Comment......"></textarea>
                </div>
              </div>

            <a type="button" class="focus-ring btn btn-sm border mt-3" id="submit_btn" data-bs-toggle="modal" data-bs-target="#delete_rsv">Delete</a>  
            <button type="submit" name="update_rsv" class="focus-ring btn btn-sm border mt-3" id="submit_btn" >Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('.edit_rsv_btn').on('click', function() {
      $('#edit_administered_rsv').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#rsv_edit_ID').val(data[0]);
      $('#rsv_edit_uniqueID').val(data[1]);
      $('#delete_rsv_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_rsv_name').val(data[4]);
      $('#delete_rsv_name').val(data[4]);
      $('#edit_rsv_lot').val(data[5]);
      $('#edit_rsv_ndc').val(data[6]);
      $('#edit_rsv_exp').val(data[7]);
      $('#rsv_edit_site').val(data[8]);
      $('#rsv_edit_route').val(data[9]);
      $('#rsv_edit_vis_given').val(data[10]);
      $('#rsv_edit_vis').val(data[11]);
      $('#edit_rsv_funding').val(data[12]);
      $('#edit_rsv_eligibility').val(data[12]);
      $('#rsvadministered_by').val(data[13]);
      $('#rsv_edit_comment').val(data[14]);
    });
  });
</script>
