<?php
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$patientID = mysqli_real_escape_string($con, $_GET['patientID']);

// Update vcode - move this code inside "sql.php" and include the file directory on top.
if(isset($_SESSION["userID"])){
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $new_vcode = rand(1000,9999); // Generates random verification token
  $update_vcode = "UPDATE token SET v_code='$new_vcode' WHERE userID='$userID' ";
  $update_vcode_run = mysqli_query($con, $update_vcode);
}

// Display patient name from database to snapshot
if(isset($_GET['patientID'])){
  $query = "SELECT * FROM patients WHERE patientID='$patientID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $patients = mysqli_fetch_array($query_run);
    foreach($query_run as $patient){}
  }
}

// Display patient's health plan from database to snapshot
if(isset($_GET['patientID']))
{ 
  $query = "SELECT * FROM healthplan WHERE patientID='$patientID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $plans = mysqli_fetch_array($query_run);
    foreach($query_run as $plan){}
  }
}

// Display patient diversity from database to snapshot
if(isset($_GET['patientID']))
{
  $query = "SELECT * FROM diversity WHERE userID='$patientID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $diverse = mysqli_fetch_array($query_run);
    foreach($query_run as $diversity){}
  }
}

// Display patient address from database to snapshot
if(isset($_GET['patientID']))
{
  $query = "SELECT * FROM address WHERE userID='$patientID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $add = mysqli_fetch_array($query_run);
    foreach($query_run as $address){}
  }
}

// Display patient contact from database to snapshot
if(isset($_GET['patientID']))
{
  $query = "SELECT * FROM contact WHERE userID='$patientID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $contact = mysqli_fetch_array($query_run);
    foreach($query_run as $contacts){}
  }
}

// Display patient's emergency contact from database to demographic
if(isset($_GET['patientID']))
{
  $query = "SELECT * FROM emergency_contact WHERE patientID='$patientID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $emergency = mysqli_fetch_array($query_run);
    foreach($query_run as $emergency_contact){}
  }
}

// Display patient's profile image
if(isset($_GET['patientID']))
{
  $query = "SELECT * FROM profile_image WHERE userID='$patientID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $emergency = mysqli_fetch_array($query_run);
    foreach($query_run as $image){}
  }
}

if(isset($_GET['patientID'])){

  // Syringe icon
  $syringe = '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 512 512"><path d="M441 7l32 32 32 32c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-15-15L417.9 128l55 55c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-72-72L295 73c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l55 55L422.1 56 407 41c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0zM210.3 155.7l61.1-61.1c.3 .3 .6 .7 1 1l16 16 56 56 56 56 16 16c.3 .3 .6 .6 1 1l-191 191c-10.5 10.5-24.7 16.4-39.6 16.4H97.9L41 505c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l57-57V325.3c0-14.9 5.9-29.1 16.4-39.6l43.3-43.3 57 57c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-57-57 41.4-41.4 57 57c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-57-57z"/></svg>';

  // Count Administered RSV
  $rsv = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='RSV' ";
  $rsv_run = mysqli_query($con, $rsv);
  $rsv_value = mysqli_fetch_assoc($rsv_run);
  $rsv_count = round($rsv_value['count(*)'] / 1 * 100);
  // RSV Complete
  $rsv_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='RSV' ORDER BY id DESC";
  $rsv_req_run = mysqli_query($con, $rsv_req);
  if(mysqli_num_rows($rsv_req_run) == 0){
      $rsv_message = "
      <small>No Data Found</small><br>
      <button type='button' class='focus-ring btn btn-sm border mt-5 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_rsv'>Administer RSV</button> 
      ";
    }
    else{
    $rsv_message = "
          <div align='center'>
            <small>
              <div class='mb-3'>
                RSV is complete!
              </div>
            </small>
          </div>
      ";
  }

  // Count Administered Hep B
  $hepB = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='Hepatitis B' ";
  $hepB_run = mysqli_query($con, $hepB);
  $hepB_value = mysqli_fetch_assoc($hepB_run);
  $hepB_count = round($hepB_value['count(*)'] / 3 * 100);
  // Recommended dates to administer 2nd & 3rd dose of Hep B
  $hepB_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='Hepatitis B' ORDER BY id DESC";
  $hepB_req_run = mysqli_query($con, $hepB_req);
  if(mysqli_num_rows($hepB_req_run) == 0){
      $hepB_message = "
      <small>No Data Found</small><br>
      <button type='button' class='focus-ring btn btn-sm border mt-5 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepb'>Administer Hep B</button> 
      ";
      $hepB_recommendation = " <a href='https://www.cdc.gov/vaccines/schedules/hcp/imz/child-adolescent.html' target='_blank'>Immunization Schedule</a>";
  }
  if(mysqli_num_rows($hepB_req_run) > 0){
      $row = mysqli_fetch_assoc($hepB_req_run);
      $date = $row['date'];
      $month2 = strtotime("+2 months", strtotime($date));
      $month2 = date('m/d/Y',$month2);

      $hepB_message = "
          <div align='center'>
            <small>
              <div class='mb-3'>
                2nd dose is due on <b>$month2</b> along with the following vaccines and other immunization agents:
                <div class='col-md-3 card mt-2' align='left' style='background-color: #e8e8e8'>
                   <div class='card-body'>
                      $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                      <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                      <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                      <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                      <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                   </div>
                </div>
              </div>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
              <div class='row col-md-10 mt-2'>
                <div class='col me-2'>
                  <div class='row'>
                    <div class='card mb-2' style='background-color: #cae3d1'>
                      <div class='card-body'>
                        PEDIARIX
                        <br>(DTaP, IPV, Hep B)
                      </div>
                    </div>
                  </div>
                  +
                  <div class='row'>
                    <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                      <div class='py-2'>
                        PCV
                        <br> Rotavirus
                        <br> Hib
                      </div>
                    </div>
                  </div>
                </div>
                <div class='col me-2'>
                  <div class='row'>
                    <div class='card mb-2' style='background-color: #fadefa'>
                      <div class='card-body'>
                        PENTACEL
                        <br>(DTaP, IPV, Hib)
                      </div>
                    </div>
                  </div>
                  +
                  <div class='row'>
                    <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                      <div class='py-2'>
                        PCV
                        <br> Rotavirus
                        <br> Hep B
                      </div>
                    </div>
                  </div>
                </div>
                <div class='col me-2'>
                  <div class='row'>
                    <div class='card mb-2' style='background-color: #ccd4fc'>
                      <div class='card-body'>
                        VAXELIS
                        <br>(DTaP, IPV, Hib, Hep B)
                      </div>
                    </div>
                  </div>
                  +
                  <div class='row'>
                    <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                      <div class='py-2'>
                        PCV
                        <br> Rotavirus
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepb'>Administer Hep B</button> 
            </small>
          </div>
      ";
      $hepB_recommendation = "
          <div align='center'>
            <small>
              <div class='mb-3' align='left'>
              <b>Due on $month2:</b><br>
                2nd dose of Hep B <br>
                1st dose of Rotavirus <br>
                1st dose of DTaP <br>
                1st dose of Hib <br>
                1st dose of PCV <br>
                1st dose of IPV
              </div>
             
            </small>
          </div>
      ";
  }
  if(mysqli_num_rows($hepB_req_run) == 2){
      $date = $row['date'];
      $month2 = strtotime("+2 months", strtotime($date));
      $month2 = date('m/d/Y',$month2);
      $month6 = strtotime("+2 months", strtotime($month2));
      $month6 = date('m/d/Y',$month6);
      
      $hepB_message = "
          <div align='center'>
            <small>
              <div class='mb-3'>
                3rd dose is due on <b>$month6</b> along with the following vaccines and other immunization agents:
                <div class='col-md-5 card mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                      $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  </div>
                </div>
              </div>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
              <div class='row col-md-10 mt-2'>
                <div class='col me-2'>
                  <div class='row'>
                    <div class='card mb-2' style='background-color: #cae3d1'>
                      <div class='card-body'>
                        PEDIARIX
                        <br>(DTaP, IPV, Hep B)
                      </div>
                    </div>
                  </div>
                  +
                  <div class='row'>
                    <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                      <div class='py-2'>
                        PCV
                        <br> Rotavirus
                        <br> Hib
                      </div>
                    </div>
                  </div>
                </div>
                <div class='col me-2'>
                  <div class='row'>
                    <div class='card mb-2' style='background-color: #fadefa'>
                      <div class='card-body'>
                        PENTACEL
                        <br>(DTaP, IPV, Hib)
                      </div>
                    </div>
                  </div>
                  +
                  <div class='row'>
                    <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                      <div class='py-2'>
                        PCV
                        <br> Rotavirus
                        <br> Hep B
                      </div>
                    </div>
                  </div>
                </div>
                <div class='col me-2'>
                  <div class='row'>
                    <div class='card mb-2' style='background-color: #ccd4fc'>
                      <div class='card-body'>
                        VAXELIS
                        <br>(DTaP, IPV, Hib, Hep B)
                      </div>
                    </div>
                  </div>
                  +
                  <div class='row'>
                    <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                      <div class='py-2'>
                        PCV
                        <br> Rotavirus
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepb'>Administer Hep B</button>
            </small>
          </div>
       ";

       $hepB_recommendation = "
          <div align='center'>
            <small>
              <div class='mb-3' align='left'>
              <b>Due on $month6:</b><br>
                3rd dose of Hep B <br>
                2nd dose of Rotavirus <br>
                2nd dose of DTaP <br>
                2nd dose of Hib <br>
                2nd dose of PCV <br>
                2nd dose of IPV
              </div>
             
            </small>
          </div>
      ";
  }
  if(mysqli_num_rows($hepB_req_run) == 3){
      $hepB_message = "
      <div class='mb-3'>
        <div align='center'>
          <small>
            <div class='mb-3'>
                Hepatitis B series is complete! The following vaccines and other immunization agents should be administered today:
                <div class='col-md-5 card mt-2' align='left' style='background-color: #e8e8e8'>
                   <div class='card-body'>
                      $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                      <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                      <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                      <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                   </div>
                </div>
            </div>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
            <div class='row col-md-10 mt-2'>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #cae3d1'>
                    <div class='card-body'>
                      PEDIARIX
                      <br>(DTaP, IPV, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hib
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #fadefa'>
                    <div class='card-body'>
                      PENTACEL
                      <br>(DTaP, IPV, Hib)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hep B
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #ccd4fc'>
                    <div class='card-body'>
                      VAXELIS
                      <br>(DTaP, IPV, Hib, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </small>
        </div>
      </div>
      ";
      
      $hepB_recommendation = null;
  }

  // Count Administered Rotavirus
  $rota = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='Rotavirus' ";
  $rota_run = mysqli_query($con, $rota);
  $rota_value = mysqli_fetch_assoc($rota_run);
  $rota_count = round($rota_value['count(*)'] / 2 * 100);
  // Recommended dates to administer 2nd & 3rd dose of Hep B
  $rota_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='Rotavirus' ORDER BY id DESC";
  $rota_req_run = mysqli_query($con, $rota_req);
  if(mysqli_num_rows($rota_req_run) == 0){
       $rota_message = "
       <small>No Data Found</small><br>
       <button type='button' class='focus-ring btn btn-sm border mt-5 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_rota'>Administer Rotavirus</button> 
       ";
  }
  if(mysqli_num_rows($rota_req_run) > 0){
       $row = mysqli_fetch_assoc($rota_req_run);
       $date = $row['date'];
       $month2 = strtotime("+2 months", strtotime($date));
       $month2 = date('m/d/Y',$month2);
 
       $rota_message = "
           <div align='center'>
             <small>
               <div class='mb-3'>
                 2nd dose is due on <b>$month2</b> along with the following vaccines and other immunization agents:
                 <div class='col-md-3 card mt-2' align='left' style='background-color: #e8e8e8'>
                    <div class='card-body'>
                       $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                       <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                       <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                       <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    </div>
                 </div>
               </div>
               Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
               <div class='row col-md-10 mt-2'>
                 <div class='col me-2'>
                   <div class='row'>
                     <div class='card mb-2' style='background-color: #cae3d1'>
                       <div class='card-body'>
                         PEDIARIX
                         <br>(DTaP, IPV, Hep B)
                       </div>
                     </div>
                   </div>
                   +
                   <div class='row'>
                     <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                       <div class='py-2'>
                         PCV
                         <br> Rotavirus
                         <br> Hib
                       </div>
                     </div>
                   </div>
                 </div>
                 <div class='col me-2'>
                   <div class='row'>
                     <div class='card mb-2' style='background-color: #fadefa'>
                       <div class='card-body'>
                         PENTACEL
                         <br>(DTaP, IPV, Hib)
                       </div>
                     </div>
                   </div>
                   +
                   <div class='row'>
                     <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                       <div class='py-2'>
                         PCV
                         <br> Rotavirus
                         <br> Hep B
                       </div>
                     </div>
                   </div>
                 </div>
                 <div class='col me-2'>
                   <div class='row'>
                     <div class='card mb-2' style='background-color: #ccd4fc'>
                       <div class='card-body'>
                         VAXELIS
                         <br>(DTaP, IPV, Hib, Hep B)
                       </div>
                     </div>
                   </div>
                   +
                   <div class='row'>
                     <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                       <div class='py-2'>
                         PCV
                         <br> Rotavirus
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
               <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_rota'>Administer Rotavirus</button> 
             </small>
           </div>
       ";
  }
  if(mysqli_num_rows($rota_req_run) == 2){
       $rota_message = "
       <div class='mb-3'>
         <div align='center'>
           <small>
             <div class='mb-3'>
                 Rotavirus series is complete! The following vaccines and other immunization agents should be administered today:
                 <div class='col-md-5 card mt-2' align='left' style='background-color: #e8e8e8'>
                    <div class='card-body'>
                       $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                       <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                       <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                       <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    </div>
                 </div>
             </div>
             Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
             <div class='row col-md-10 mt-2'>
               <div class='col me-2'>
                 <div class='row'>
                   <div class='card mb-2' style='background-color: #cae3d1'>
                     <div class='card-body'>
                       PEDIARIX
                       <br>(DTaP, IPV, Hep B)
                     </div>
                   </div>
                 </div>
                 +
                 <div class='row'>
                   <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                     <div class='py-2'>
                       PCV
                       <br> Rotavirus
                       <br> Hib
                     </div>
                   </div>
                 </div>
               </div>
               <div class='col me-2'>
                 <div class='row'>
                   <div class='card mb-2' style='background-color: #fadefa'>
                     <div class='card-body'>
                       PENTACEL
                       <br>(DTaP, IPV, Hib)
                     </div>
                   </div>
                 </div>
                 +
                 <div class='row'>
                   <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                     <div class='py-2'>
                       PCV
                       <br> Rotavirus
                       <br> Hep B
                     </div>
                   </div>
                 </div>
               </div>
               <div class='col me-2'>
                 <div class='row'>
                   <div class='card mb-2' style='background-color: #ccd4fc'>
                     <div class='card-body'>
                       VAXELIS
                       <br>(DTaP, IPV, Hib, Hep B)
                     </div>
                   </div>
                 </div>
                 +
                 <div class='row'>
                   <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                     <div class='py-2'>
                       PCV
                       <br> Rotavirus
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </small>
         </div>
       </div>
       ";
  }

  // Count Administered DTaP
  $dtap = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='DTaP' ";
  $dtap_run = mysqli_query($con, $dtap);
  $dtap_value = mysqli_fetch_assoc($dtap_run);
  $dtap_count = round($dtap_value['count(*)'] / 4 * 100);
  // Recommended dates to administer 2nd & 3rd dose of DTaP
  $dtap_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='DTaP' ORDER BY id DESC";
  $dtap_req_run = mysqli_query($con, $dtap_req);
  if(mysqli_num_rows($dtap_req_run) == 0){
    $dtap_message = "
    <small>No Data Found</small><br>
    <button type='button' class='focus-ring btn btn-sm border mt-5 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer DTaP</button> 
    ";
  }
  if(mysqli_num_rows($dtap_req_run) > 0){
    $row = mysqli_fetch_assoc($dtap_req_run);
    $date = $row['date'];
    $month4 = strtotime("+2 months", strtotime($date));
    $month4 = date('m/d/Y',$month4);

    $dtap_message = "
        <div align='center'>
          <small>
            <div class='mb-3'>
              2nd dose is due on <b>$month4</b> along with the following vaccines and other immunization agents:
              <div class='col-md-3 card mt-2' align='left' style='background-color: #e8e8e8'>
                 <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                 </div>
              </div>
            </div>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
            <div class='row col-md-10 mt-2'>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #cae3d1'>
                    <div class='card-body'>
                      PEDIARIX
                      <br>(DTaP, IPV, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hib
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #fadefa'>
                    <div class='card-body'>
                      PENTACEL
                      <br>(DTaP, IPV, Hib)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hep B
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #ccd4fc'>
                    <div class='card-body'>
                      VAXELIS
                      <br>(DTaP, IPV, Hib, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer DTaP</button> 
          </small>
        </div>
    ";
  }
  if(mysqli_num_rows($dtap_req_run) == 2){
    $date = $row['date'];
    $month4 = strtotime("+2 months", strtotime($date));
    $month4 = date('m/d/Y',$month4);
    $month6 = strtotime("+2 months", strtotime($month4));
    $month6 = date('m/d/Y',$month6);
    
    $dtap_message = "
        <div align='center'>
          <small>
            <div class='mb-3'>
              3rd dose is due on <b>$month6</b> along with the following vaccines and other immunization agents:
              <div class='col-md-5 card mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
            <div class='row col-md-10 mt-2'>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #cae3d1'>
                    <div class='card-body'>
                      PEDIARIX
                      <br>(DTaP, IPV, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hib
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #fadefa'>
                    <div class='card-body'>
                      PENTACEL
                      <br>(DTaP, IPV, Hib)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hep B
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #ccd4fc'>
                    <div class='card-body'>
                      VAXELIS
                      <br>(DTaP, IPV, Hib, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer DTaP</button>
          </small>
        </div>
     ";
  }
  if(mysqli_num_rows($dtap_req_run) == 3  ){
    $date = $row['date'];
    $month6 = strtotime("+2 months", strtotime($date));
    $month6 = date('m/d/Y',$month6);
    $month15 = strtotime("+9 months", strtotime($month6));
    $month15 = date('m/d/Y',$month15);
    
    $dtap_message = "
        <div align='center'>
          <small>
            <div class='mb-3'>
              4th dose is due on <b>$month15</b> along with the following vaccines and other immunization agents:
              <div class='col-md-5 card mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
            <div class='row col-md-10 mt-2'>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #cae3d1'>
                    <div class='card-body'>
                      PEDIARIX
                      <br>(DTaP, IPV, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hib
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #fadefa'>
                    <div class='card-body'>
                      PENTACEL
                      <br>(DTaP, IPV, Hib)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hep B
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #ccd4fc'>
                    <div class='card-body'>
                      VAXELIS
                      <br>(DTaP, IPV, Hib, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer DTaP</button>
          </small>
        </div>
     ";
  }
  if(mysqli_num_rows($dtap_req_run) == 4){
    $dtap_message = "
    <div class='mb-3'>
      <div align='center'>
        <small>
          <div class='mb-3'>
              DTaP series is complete! The following vaccines and other immunization agents should be administered today:
              <div class='col-md-5 card mt-2' align='left' style='background-color: #e8e8e8'>
                 <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                 </div>
              </div>
          </div>
          Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
          <div class='row col-md-10 mt-2'>
            <div class='col me-2'>
              <div class='row'>
                <div class='card mb-2' style='background-color: #cae3d1'>
                  <div class='card-body'>
                    PEDIARIX
                    <br>(DTaP, IPV, Hep B)
                  </div>
                </div>
              </div>
              +
              <div class='row'>
                <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                  <div class='py-2'>
                    PCV
                    <br> Rotavirus
                    <br> Hib
                  </div>
                </div>
              </div>
            </div>
            <div class='col me-2'>
              <div class='row'>
                <div class='card mb-2' style='background-color: #fadefa'>
                  <div class='card-body'>
                    PENTACEL
                    <br>(DTaP, IPV, Hib)
                  </div>
                </div>
              </div>
              +
              <div class='row'>
                <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                  <div class='py-2'>
                    PCV
                    <br> Rotavirus
                    <br> Hep B
                  </div>
                </div>
              </div>
            </div>
            <div class='col me-2'>
              <div class='row'>
                <div class='card mb-2' style='background-color: #ccd4fc'>
                  <div class='card-body'>
                    VAXELIS
                    <br>(DTaP, IPV, Hib, Hep B)
                  </div>
                </div>
              </div>
              +
              <div class='row'>
                <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                  <div class='py-2'>
                    PCV
                    <br> Rotavirus
                  </div>
                </div>
              </div>
            </div>
          </div>
        </small>
      </div>
    </div>
    ";
  }

  // Count Administered Hib
  $hib = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='Hib' ";
  $hib_run = mysqli_query($con, $hib);
  $hib_value = mysqli_fetch_assoc($hib_run);
  $hib_count = round($hib_value['count(*)'] / 4 * 100);
  // Recommended dates to administer 2nd, 3rd & 4th dose of Hib
  $hib_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='Hib' ORDER BY id DESC";
  $hib_req_run = mysqli_query($con, $hib_req);
  if(mysqli_num_rows($hib_req_run) == 0){
   $hib_message = "
   <small>No Data Found</small><br>
   <button type='button' class='focus-ring btn btn-sm border mt-5 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button> 
    ";
  }
  if(mysqli_num_rows($hib_req_run) > 0){
    $row = mysqli_fetch_assoc($hib_req_run);
    $date = $row['date'];
    $month4 = strtotime("+2 months", strtotime($date));
    $month4 = date('m/d/Y',$month4);
 
    $hib_message = "
       <div align='center'>
          <small>
           <div class='mb-3'>
             2nd dose is due on <b>$month4</b> along with the following vaccines and other immunization agents:
              <div class='col-md-3 card mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                 </div>
              </div>
            </div>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
            <div class='row col-md-10 mt-2'>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #cae3d1'>
                    <div class='card-body'>
                      PEDIARIX
                      <br>(DTaP, IPV, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hib
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #fadefa'>
                    <div class='card-body'>
                      PENTACEL
                      <br>(DTaP, IPV, Hib)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                 <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hep B
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #ccd4fc'>
                    <div class='card-body'>
                      VAXELIS
                      <br>(DTaP, IPV, Hib, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button> 
          </small>
        </div>
    ";
  }
  if(mysqli_num_rows($hib_req_run) == 2){
    $date = $row['date'];
    $month4 = strtotime("+2 months", strtotime($date));
    $month4 = date('m/d/Y',$month4);
    $month12 = strtotime("+8 months", strtotime($month4));
    $month12 = date('m/d/Y',$month12);
     
    $hib_message = "
        <div align='center'>
          <small>
            <div class='mb-3'>
              3rd dose is due on <b>$month12</b> along with the following vaccines and other immunization agents:
              <div class='col-md-5 card mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
            <div class='row col-md-10 mt-2'>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #cae3d1'>
                    <div class='card-body'>
                      PEDIARIX
                      <br>(DTaP, IPV, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hib
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
               <div class='row'>
                  <div class='card mb-2' style='background-color: #fadefa'>
                    <div class='card-body'>
                      PENTACEL
                      <br>(DTaP, IPV, Hib)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hep B
                    </div>
                  </div>
                </div>
               </div>
               <div class='col me-2'>
                  <div class='row'>
                    <div class='card mb-2' style='background-color: #ccd4fc'>
                      <div class='card-body'>
                        VAXELIS
                      <br>(DTaP, IPV, Hib, Hep B)
                    </div>
                  </div>
               </div>
                 +
                 <div class='row'>
                   <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                     <div class='py-2'>
                       PCV
                       <br> Rotavirus
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button>
           </small>
         </div>
      ";
  }
  if(mysqli_num_rows($hib_req_run) == 3){
     $date = $row['date'];
     $month12 = strtotime("+2 months", strtotime($date));
     $month12 = date('m/d/Y',$month12);
     $month15 = strtotime("+3 months", strtotime($month12));
     $month15 = date('m/d/Y',$month15);
     
     $hib_message = "
         <div align='center'>
           <small>
             <div class='mb-3'>
               4th dose is due on <b>$month15</b> along with the following vaccines and other immunization agents:
               <div class='col-md-5 card mt-2' align='left' style='background-color: #e8e8e8'>
                 <div class='card-body'>
                     $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                     <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                     <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                     <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                 </div>
               </div>
             </div>
             Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
             <div class='row col-md-10 mt-2'>
               <div class='col me-2'>
                 <div class='row'>
                   <div class='card mb-2' style='background-color: #cae3d1'>
                     <div class='card-body'>
                       PEDIARIX
                       <br>(DTaP, IPV, Hep B)
                     </div>
                   </div>
                 </div>
                 +
                 <div class='row'>
                   <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                     <div class='py-2'>
                       PCV
                       <br> Rotavirus
                       <br> Hib
                     </div>
                   </div>
                 </div>
               </div>
               <div class='col me-2'>
                 <div class='row'>
                   <div class='card mb-2' style='background-color: #fadefa'>
                     <div class='card-body'>
                       PENTACEL
                       <br>(DTaP, IPV, Hib)
                     </div>
                   </div>
                 </div>
                 +
                 <div class='row'>
                   <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                     <div class='py-2'>
                       PCV
                       <br> Rotavirus
                       <br> Hep B
                     </div>
                   </div>
                 </div>
               </div>
               <div class='col me-2'>
                 <div class='row'>
                   <div class='card mb-2' style='background-color: #ccd4fc'>
                     <div class='card-body'>
                       VAXELIS
                       <br>(DTaP, IPV, Hib, Hep B)
                     </div>
                   </div>
                 </div>
                 +
                 <div class='row'>
                   <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                     <div class='py-2'>
                       PCV
                       <br> Rotavirus
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button>
           </small>
         </div>
      ";
  }
  if(mysqli_num_rows($hib_req_run) == 4){
    $hib_message = "
    <div class='mb-3'>
      <div align='center'>
        <small>
          <div class='mb-3'>
              Hib series is complete! The following vaccines and other immunization agents should be administered today:
              <div class='col-md-5 card mt-2' align='left' style='background-color: #e8e8e8'>
                 <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                 </div>
              </div>
          </div>
          Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
          <div class='row col-md-10 mt-2'>
            <div class='col me-2'>
              <div class='row'>
                <div class='card mb-2' style='background-color: #cae3d1'>
                  <div class='card-body'>
                    PEDIARIX
                    <br>(DTaP, IPV, Hep B)
                  </div>
                </div>
              </div>
              +
              <div class='row'>
                <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                  <div class='py-2'>
                    PCV
                    <br> Rotavirus
                    <br> Hib
                  </div>
                </div>
              </div>
            </div>
            <div class='col me-2'>
              <div class='row'>
                <div class='card mb-2' style='background-color: #fadefa'>
                  <div class='card-body'>
                    PENTACEL
                    <br>(DTaP, IPV, Hib)
                  </div>
                </div>
              </div>
              +
              <div class='row'>
                <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                  <div class='py-2'>
                    PCV
                    <br> Rotavirus
                    <br> Hep B
                  </div>
                </div>
              </div>
            </div>
            <div class='col me-2'>
              <div class='row'>
                <div class='card mb-2' style='background-color: #ccd4fc'>
                  <div class='card-body'>
                    VAXELIS
                    <br>(DTaP, IPV, Hib, Hep B)
                  </div>
                </div>
              </div>
              +
              <div class='row'>
                <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                  <div class='py-2'>
                    PCV
                    <br> Rotavirus
                  </div>
                </div>
              </div>
            </div>
          </div>
        </small>
      </div>
    </div>
    ";
  }

  // Count Administered PCV
  $pcv = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='PCV' ";
  $pcv_run = mysqli_query($con, $pcv);
  $pcv_value = mysqli_fetch_assoc($pcv_run);
  $pcv_count = round($pcv_value['count(*)'] / 4 * 100);
  // Recommended dates to administer 2nd, 3rd & 4th dose of Hib
  $pcv_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='PCV' ORDER BY id DESC";
  $pcv_req_run = mysqli_query($con, $pcv_req);
  if(mysqli_num_rows($pcv_req_run) == 0){
   $pcv_message = "
   <small>No Data Found</small><br>
   <button type='button' class='focus-ring btn btn-sm border mt-5 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_pcv'>Administer PCV</button> 
    ";
  }
  if(mysqli_num_rows($pcv_req_run) > 0){
    $row = mysqli_fetch_assoc($pcv_req_run);
    $date = $row['date'];
    $month4 = strtotime("+2 months", strtotime($date));
    $month4 = date('m/d/Y',$month4);
 
    $pcv_message = "
       <div align='center'>
          <small>
           <div class='mb-3'>
             2nd dose is due on <b>$month4</b> along with the following vaccines and other immunization agents:
              <div class='col-md-3 card mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                 </div>
              </div>
            </div>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
            <div class='row col-md-10 mt-2'>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #cae3d1'>
                    <div class='card-body'>
                      PEDIARIX
                      <br>(DTaP, IPV, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hib
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #fadefa'>
                    <div class='card-body'>
                      PENTACEL
                      <br>(DTaP, IPV, Hib)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                 <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hep B
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #ccd4fc'>
                    <div class='card-body'>
                      VAXELIS
                      <br>(DTaP, IPV, Hib, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_pcv'>Administer PCV</button> 
          </small>
        </div>
    ";
  }
  if(mysqli_num_rows($pcv_req_run) == 2){
    $date = $row['date'];
    $month4 = strtotime("+2 months", strtotime($date));
    $month4 = date('m/d/Y',$month4);
    $month12 = strtotime("+8 months", strtotime($month4));
    $month12 = date('m/d/Y',$month12);
     
    $pcv_message = "
        <div align='center'>
          <small>
            <div class='mb-3'>
              3rd dose is due on <b>$month12</b> along with the following vaccines and other immunization agents:
              <div class='col-md-5 card mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
            <div class='row col-md-10 mt-2'>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #cae3d1'>
                    <div class='card-body'>
                      PEDIARIX
                      <br>(DTaP, IPV, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hib
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
               <div class='row'>
                  <div class='card mb-2' style='background-color: #fadefa'>
                    <div class='card-body'>
                      PENTACEL
                      <br>(DTaP, IPV, Hib)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hep B
                    </div>
                  </div>
                </div>
               </div>
               <div class='col me-2'>
                  <div class='row'>
                    <div class='card mb-2' style='background-color: #ccd4fc'>
                      <div class='card-body'>
                        VAXELIS
                      <br>(DTaP, IPV, Hib, Hep B)
                    </div>
                  </div>
               </div>
                 +
                 <div class='row'>
                   <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                     <div class='py-2'>
                       PCV
                       <br> Rotavirus
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer PCV</button>
           </small>
         </div>
      ";
  }
  if(mysqli_num_rows($pcv_req_run) == 3){
     $date = $row['date'];
     $month12 = strtotime("+2 months", strtotime($date));
     $month12 = date('m/d/Y',$month12);
     $month15 = strtotime("+3 months", strtotime($month12));
     $month15 = date('m/d/Y',$month15);
     
     $pcv_message = "
         <div align='center'>
           <small>
             <div class='mb-3'>
               4th dose is due on <b>$month15</b> along with the following vaccines and other immunization agents:
               <div class='col-md-5 card mt-2' align='left' style='background-color: #e8e8e8'>
                 <div class='card-body'>
                     $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                     <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                     <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                     <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                 </div>
               </div>
             </div>
             Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
             <div class='row col-md-10 mt-2'>
               <div class='col me-2'>
                 <div class='row'>
                   <div class='card mb-2' style='background-color: #cae3d1'>
                     <div class='card-body'>
                       PEDIARIX
                       <br>(DTaP, IPV, Hep B)
                     </div>
                   </div>
                 </div>
                 +
                 <div class='row'>
                   <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                     <div class='py-2'>
                       PCV
                       <br> Rotavirus
                       <br> Hib
                     </div>
                   </div>
                 </div>
               </div>
               <div class='col me-2'>
                 <div class='row'>
                   <div class='card mb-2' style='background-color: #fadefa'>
                     <div class='card-body'>
                       PENTACEL
                       <br>(DTaP, IPV, Hib)
                     </div>
                   </div>
                 </div>
                 +
                 <div class='row'>
                   <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                     <div class='py-2'>
                       PCV
                       <br> Rotavirus
                       <br> Hep B
                     </div>
                   </div>
                 </div>
               </div>
               <div class='col me-2'>
                 <div class='row'>
                   <div class='card mb-2' style='background-color: #ccd4fc'>
                     <div class='card-body'>
                       VAXELIS
                       <br>(DTaP, IPV, Hib, Hep B)
                     </div>
                   </div>
                 </div>
                 +
                 <div class='row'>
                   <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                     <div class='py-2'>
                       PCV
                       <br> Rotavirus
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_pcv'>Administer PCV</button>
           </small>
         </div>
      ";
  }
  if(mysqli_num_rows($pcv_req_run) == 4){
    $pcv_message = "
    <div class='mb-3'>
      <div align='center'>
        <small>
          <div class='mb-3'>
              PCV series is complete! The following vaccines and other immunization agents should be administered today:
              <div class='col-md-5 card mt-2' align='left' style='background-color: #e8e8e8'>
                 <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                 </div>
              </div>
          </div>
          Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
          <div class='row col-md-10 mt-2'>
            <div class='col me-2'>
              <div class='row'>
                <div class='card mb-2' style='background-color: #cae3d1'>
                  <div class='card-body'>
                    PEDIARIX
                    <br>(DTaP, IPV, Hep B)
                  </div>
                </div>
              </div>
              +
              <div class='row'>
                <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                  <div class='py-2'>
                    PCV
                    <br> Rotavirus
                    <br> Hib
                  </div>
                </div>
              </div>
            </div>
            <div class='col me-2'>
              <div class='row'>
                <div class='card mb-2' style='background-color: #fadefa'>
                  <div class='card-body'>
                    PENTACEL
                    <br>(DTaP, IPV, Hib)
                  </div>
                </div>
              </div>
              +
              <div class='row'>
                <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                  <div class='py-2'>
                    PCV
                    <br> Rotavirus
                    <br> Hep B
                  </div>
                </div>
              </div>
            </div>
            <div class='col me-2'>
              <div class='row'>
                <div class='card mb-2' style='background-color: #ccd4fc'>
                  <div class='card-body'>
                    VAXELIS
                    <br>(DTaP, IPV, Hib, Hep B)
                  </div>
                </div>
              </div>
              +
              <div class='row'>
                <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                  <div class='py-2'>
                    PCV
                    <br> Rotavirus
                  </div>
                </div>
              </div>
            </div>
          </div>
        </small>
      </div>
    </div>
    ";
  }

  // Count Administered IPV
  $ipv = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='IPV' ";
  $ipv_run = mysqli_query($con, $ipv);
  $ipv_value = mysqli_fetch_assoc($ipv_run);
  $ipv_count = round($ipv_value['count(*)'] / 3 * 100);
  // Recommended dates to administer 2nd, 3rd & 4th dose of Hib
  $ipv_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='IPV' ORDER BY id DESC";
  $ipv_req_run = mysqli_query($con, $hib_req);
  if(mysqli_num_rows($ipv_req_run) == 0){
   $ipv_message = "
   <small>No Data Found</small><br>
   <button type='button' class='focus-ring btn btn-sm border mt-5 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_ipv'>Administer IPV</button> 
    ";
  }
  if(mysqli_num_rows($ipv_req_run) > 0){
    $row = mysqli_fetch_assoc($ipv_req_run);
    $date = $row['date'];
    $month4 = strtotime("+2 months", strtotime($date));
    $month4 = date('m/d/Y',$month4);
 
    $ipv_message = "
       <div align='center'>
          <small>
           <div class='mb-3'>
             2nd dose is due on <b>$month4</b> along with the following vaccines and other immunization agents:
              <div class='col-md-3 card mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                 </div>
              </div>
            </div>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
            <div class='row col-md-10 mt-2'>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #cae3d1'>
                    <div class='card-body'>
                      PEDIARIX
                      <br>(DTaP, IPV, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hib
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #fadefa'>
                    <div class='card-body'>
                      PENTACEL
                      <br>(DTaP, IPV, Hib)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                 <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hep B
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #ccd4fc'>
                    <div class='card-body'>
                      VAXELIS
                      <br>(DTaP, IPV, Hib, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_ipv'>Administer IPV</button> 
          </small>
        </div>
    ";
  }
  if(mysqli_num_rows($ipv_req_run) == 2){
    $date = $row['date'];
    $month4 = strtotime("+2 months", strtotime($date));
    $month4 = date('m/d/Y',$month4);
    $month12 = strtotime("+8 months", strtotime($month4));
    $month12 = date('m/d/Y',$month12);
     
    $ipv_message = "
        <div align='center'>
          <small>
            <div class='mb-3'>
              3rd dose is due on <b>$month12</b> along with the following vaccines and other immunization agents:
              <div class='col-md-5 card mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
            <div class='row col-md-10 mt-2'>
              <div class='col me-2'>
                <div class='row'>
                  <div class='card mb-2' style='background-color: #cae3d1'>
                    <div class='card-body'>
                      PEDIARIX
                      <br>(DTaP, IPV, Hep B)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hib
                    </div>
                  </div>
                </div>
              </div>
              <div class='col me-2'>
               <div class='row'>
                  <div class='card mb-2' style='background-color: #fadefa'>
                    <div class='card-body'>
                      PENTACEL
                      <br>(DTaP, IPV, Hib)
                    </div>
                  </div>
                </div>
                +
                <div class='row'>
                  <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                    <div class='py-2'>
                      PCV
                      <br> Rotavirus
                      <br> Hep B
                    </div>
                  </div>
                </div>
               </div>
               <div class='col me-2'>
                  <div class='row'>
                    <div class='card mb-2' style='background-color: #ccd4fc'>
                      <div class='card-body'>
                        VAXELIS
                      <br>(DTaP, IPV, Hib, Hep B)
                    </div>
                  </div>
               </div>
                 +
                 <div class='row'>
                   <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                     <div class='py-2'>
                       PCV
                       <br> Rotavirus
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer DTaP</button>
           </small>
         </div>
      ";
  }
  if(mysqli_num_rows($ipv_req_run) == 3){
    $ipv_message = "
    <div class='mb-3'>
      <div align='center'>
        <small>
          <div class='mb-3'>
              IPV series is complete! The following vaccines and other immunization agents should be administered today:
              <div class='col-md-5 card mt-2' align='left' style='background-color: #e8e8e8'>
                 <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                 </div>
              </div>
          </div>
          Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
          <div class='row col-md-10 mt-2'>
            <div class='col me-2'>
              <div class='row'>
                <div class='card mb-2' style='background-color: #cae3d1'>
                  <div class='card-body'>
                    PEDIARIX
                    <br>(DTaP, IPV, Hep B)
                  </div>
                </div>
              </div>
              +
              <div class='row'>
                <div class='card mt-2 mb-2' style='background-color: #e6f2e9;'>
                  <div class='py-2'>
                    PCV
                    <br> Rotavirus
                    <br> Hib
                  </div>
                </div>
              </div>
            </div>
            <div class='col me-2'>
              <div class='row'>
                <div class='card mb-2' style='background-color: #fadefa'>
                  <div class='card-body'>
                    PENTACEL
                    <br>(DTaP, IPV, Hib)
                  </div>
                </div>
              </div>
              +
              <div class='row'>
                <div class='card mt-2 mb-2' style='background-color: #fcf2fc;'>
                  <div class='py-2'>
                    PCV
                    <br> Rotavirus
                    <br> Hep B
                  </div>
                </div>
              </div>
            </div>
            <div class='col me-2'>
              <div class='row'>
                <div class='card mb-2' style='background-color: #ccd4fc'>
                  <div class='card-body'>
                    VAXELIS
                    <br>(DTaP, IPV, Hib, Hep B)
                  </div>
                </div>
              </div>
              +
              <div class='row'>
                <div class='card mt-2' style='background-color: #ebeeff; height:81px'>
                  <div class='py-2'>
                    PCV
                    <br> Rotavirus
                  </div>
                </div>
              </div>
            </div>
          </div>
        </small>
      </div>
    </div>
    ";
  } 

}


?>