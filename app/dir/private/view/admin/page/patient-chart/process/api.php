<?php
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
$iz_key = mysqli_real_escape_string($con, $_SESSION["iz_key"]);
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
if(isset($_GET['patientID'])){ 
  $query = "SELECT * FROM healthplan WHERE patientID='$patientID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $plans = mysqli_fetch_array($query_run);
    foreach($query_run as $plan){}
  }
}

// Display patient diversity from database to snapshot
if(isset($_GET['patientID'])){
  $query = "SELECT * FROM diversity WHERE userID='$patientID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $diverse = mysqli_fetch_array($query_run);
    foreach($query_run as $diversity){}
  }
}

// Display patient address from database to snapshot
if(isset($_GET['patientID'])){
  $query = "SELECT * FROM address WHERE userID='$patientID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $add = mysqli_fetch_array($query_run);
    foreach($query_run as $address){}
  }
}

// Display patient contact from database to snapshot
if(isset($_GET['patientID'])){
  $query = "SELECT * FROM contact WHERE userID='$patientID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $contact = mysqli_fetch_array($query_run);
    foreach($query_run as $contacts){}
  }
}

// Display patient's emergency contact from database to demographic
if(isset($_GET['patientID'])){
  $query = "SELECT * FROM emergency_contact WHERE patientID='$patientID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $emergency = mysqli_fetch_array($query_run);
    foreach($query_run as $emergency_contact){}
  }
}

// Display patient's profile image
if(isset($_GET['patientID'])){
  $query = "SELECT * FROM profile_image WHERE userID='$patientID' AND groupID='$groupID' ";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $emergency = mysqli_fetch_array($query_run);
    foreach($query_run as $image){}
  }
}

// Immunization Date Recommendation
if(isset($_GET['patientID'])){
  // Patient's Date of Birth
  $decrypted_dob = htmlspecialchars(decryptthis($diversity['dob'], $key));
  $year = (date('Y') - date('Y', strtotime($decrypted_dob)));
  $dob = (date('m', strtotime($decrypted_dob)) . '/' . date('d', strtotime($decrypted_dob)) . '/' . date('Y', strtotime($decrypted_dob)));
  $dob = date('m/d/Y',strtotime($dob));
  //$dob_ = "SELECT * FROM data_dob WHERE patientID='$patientID' ";
  //$dob_run = mysqli_query($con, $dob_);
  //$dob_row = mysqli_fetch_array($dob_run);
  //$dob = $dob_row['dob'];
  $dob = date('m/d/Y',strtotime($dob));
  $date = date('Y-m-d'); // Today's date (For some reason, this is the only format that works with $dob when identifying overdue IZ)

  // Date from Today
  $month1 = strtotime("+1 months", strtotime($date));
  $month1 = date('m/d/Y',$month1);
  $month2 = strtotime("+2 months", strtotime($date));
  $month2 = date('m/d/Y',$month2);
  $month4 = strtotime("+4 months", strtotime($date));
  $month4 = date('m/d/Y',$month4);
  $month6 = strtotime("+6 months", strtotime($date));
  $month6 = date('m/d/Y',$month6);
  $month9 = strtotime("+9 months", strtotime($date));
  $month9 = date('m/d/Y',$month9);
  $month12 = strtotime("+12 months", strtotime($date));
  $month12 = date('m/d/Y',$month12);
  $month15 = strtotime("+15 months", strtotime($date));
  $month15 = date('m/d/Y',$month15);
  $month18 = strtotime("+18 months", strtotime($date));
  $month18 = date('m/d/Y',$month18);
  $year4 = strtotime("+54 months", strtotime($date));
  $year4 = date('m/d/Y',$year4);

  // Date from date of birth
  $month1old = strtotime("+1 months", strtotime($dob));
  $month1old = date('m/d/Y',$month1old);
  $month1old_ = strtotime("+1 months", strtotime($dob));
  $month1old_ = date('Y-m-d',$month1old_);
  $month2old = strtotime("+2 months", strtotime($dob));
  $month2old = date('m/d/Y',$month2old);
  $month2old_ = strtotime("+2 months", strtotime($dob));
  $month2old_ = date('Y-m-d',$month2old_);
  $month4old = strtotime("+4 months", strtotime($dob));
  $month4old = date('m/d/Y',$month4old);
  $month6old = strtotime("+6 months", strtotime($dob));
  $month6old = date('m/d/Y',$month6old);
  $month11old = strtotime("+11 months", strtotime($dob));
  $month11old = date('m/d/Y',$month11old);
  $month12old = strtotime("+12 months", strtotime($dob));
  $month12old = date('m/d/Y',$month12old);
  $month12old_ = strtotime("+12 months", strtotime($dob));
  $month12old_ = date('Y-m-d',$month12old_);
  $month15old = strtotime("+15 months", strtotime($dob));
  $month15old = date('m/d/Y',$month15old);
  $month17old = strtotime("+18 months", strtotime($dob));
  $month17old = date('m/d/Y',$month17old);
  $month18old = strtotime("+18 months", strtotime($dob));
  $month18old = date('m/d/Y',$month18old);
  $year4old = strtotime("+4 years", strtotime($dob));
  $year4old = date('m/d/Y',$year4old);
  $year6old = strtotime("+6 years", strtotime($dob));
  $year6old = date('m/d/Y',$year6old);
  $year11old = strtotime("+11 years", strtotime($dob));
  $year11old = date('m/d/Y',$year11old);
  $year11old_ = strtotime("+11 years", strtotime($dob));
  $year11old_ = date('Y-m-d',$year11old_);
  $year11_6month_old = strtotime("+138 months", strtotime($dob));
  $year11_6month_old = date('m/d/Y',$year11_6month_old);
  $year14old_ = strtotime("+14 years", strtotime($dob));
  $year14old_ = date('Y-m-d',$year14old_);
  $year15old = strtotime("+15 years", strtotime($dob));
  $year15old = date('m/d/Y',$year15old);
  $year15old_ = strtotime("+15 years", strtotime($dob));
  $year15old_ = date('Y-m-d',$year15old_);
  $year15years_2months = strtotime("+182 months", strtotime($dob));
  $year15years_2months = date('m/d/Y',$year15years_2months);
  $year15years_2months_ = strtotime("+182 months", strtotime($dob));
  $year15years_2months_ = date('Y-m-d',$year15years_2months_);
  $year15years_6months = strtotime("+186 months", strtotime($dob));
  $year15years_6months = date('m/d/Y',$year15years_6months);
  $year15years_6months_ = strtotime("+186 months", strtotime($dob));
  $year15years_6months_ = date('Y-m-d',$year15years_6months_);
  $year16old = strtotime("+16 years", strtotime($dob));
  $year16old = date('m/d/Y',$year16old);
  $year16_1month_old = strtotime("+193 months", strtotime($dob));
  $year16_1month_old = date('m/d/Y',$year16_1month_old);
  $year18old = strtotime("+18 years", strtotime($dob));
  $year18old = date('m/d/Y',$year18old);
  $year18old_ = strtotime("+18 years", strtotime($dob));
  $year18old_ = date('Y-m-d',$year18old_);
}

// Immunization Schedule
if(isset($_GET['patientID'])){
  // Syringe Icon
  $syringe = '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 512 512"><path d="M441 7l32 32 32 32c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-15-15L417.9 128l55 55c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-72-72L295 73c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l55 55L422.1 56 407 41c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0zM210.3 155.7l61.1-61.1c.3 .3 .6 .7 1 1l16 16 56 56 56 56 16 16c.3 .3 .6 .6 1 1l-191 191c-10.5 10.5-24.7 16.4-39.6 16.4H97.9L41 505c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l57-57V325.3c0-14.9 5.9-29.1 16.4-39.6l43.3-43.3 57 57c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-57-57 41.4-41.4 57 57c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-57-57z"/></svg>';
  
  // Count Administered RSV
  $rsv = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='RSV' ";
  $rsv_run = mysqli_query($con, $rsv);
  $rsv_value = mysqli_fetch_assoc($rsv_run);
  $rsv_count = round($rsv_value['count(*)'] / 1 * 100);
  // RSV Recommendation
  $rsv_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='RSV' ORDER BY id DESC";
  $rsv_req_run = mysqli_query($con, $rsv_req);
  // Schedule
  foreach ($rsv_req_run as $row){
    if($row['seriesID'] == 1){
      $rsv1 = strtotime($row['date']);
      $rsv1 = date('m/d/Y',$rsv1);
    }
  }
  
  if(mysqli_num_rows($rsv_req_run) == 0 && $date <= $dob){
      $rsv_message = "
        <small>No Data Found</small><br>
        <button type='button' class='focus-ring btn btn-sm border mt-5 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_rsv'>Administer RSV</button> 
      ";
      $rsv_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>RSV</b></small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_rsv'><small>$dob</small></button>
        </div>
      ";
    }
  elseif(mysqli_num_rows($rsv_req_run) == 0 && $date > $dob){
      $rsv_message = "
        <small>No Data Found</small><br>
        <button type='button' class='focus-ring btn btn-sm border mt-5 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_rsv'>Administer RSV</button> 
      ";

      $rsv_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>RSV</b></small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_rsv'><small>OVERDUE</small></button>
      </div>
      ";
    }  
  if(mysqli_num_rows($rsv_req_run) == 1){
    $rsv_message = "
        <div align='center'>
          <small>
            <div class='mb-3'>
              RSV is complete!
            </div>
          </small>
        </div>
      ";
      $rsv_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>RSV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rsv1</small></button>
        </div>
      "; 
  }

  // Count Administered Hep B
  $hepB = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='Hepatitis B' ";
  $hepB_run = mysqli_query($con, $hepB);
  $hepB_value = mysqli_fetch_assoc($hepB_run);
  $hepB_count = round($hepB_value['count(*)'] / 3 * 100);
  // Hep B Recommendation
  $hepB_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='Hepatitis B'";
  $hepB_req_run = mysqli_query($con, $hepB_req);
  // Schedule
  foreach ($hepB_req_run as $row){
    if($row['seriesID'] == 1){
      $hepB1 = strtotime($row['date']);
      $hepB1 = date('m/d/Y',$hepB1);
      $v1_month2 = strtotime("+2 months", strtotime($hepB1));
      $v1_month2 = date('Y-m-d',$v1_month2); // For some reason, this is the only format that works when identifying overdue IZ
      $s1_month2 = strtotime("+2 months", strtotime($hepB1));
      $s1_month2 = date('m/d/Y',$s1_month2);
      $s1_month4 = strtotime("+4 months", strtotime($s1_month2));
      $s1_month4 = date('m/d/Y',$s1_month4);
    }
    if($row['seriesID'] == 2){
      $hepB2 = strtotime($row['date']);
      $hepB2 = date('m/d/Y',$hepB2);
      $v2_month4 = strtotime("+4 months", strtotime($hepB2));
      $v2_month4 = date('Y-m-d',$v2_month4); // For some reason, this is the only format that works when identifying overdue IZ
      $s2_month4 = strtotime("+4 months", strtotime($hepB2));
      $s2_month4 = date('m/d/Y',$s2_month4);
      $s2_month6 = strtotime("+2 months", strtotime($s2_month4));
      $s2_month6 = date('m/d/Y',$s2_month6);
      $s2_month18 = strtotime("+12 months", strtotime($s2_month6));
      $s2_month18 = date('m/d/Y',$s2_month18);
    }
    if($row['seriesID'] == 3){
      $hepB3 = strtotime($row['date']);
      $hepB3 = date('m/d/Y',$hepB3);
    }
  }
  if(mysqli_num_rows($hepB_req_run) == 0 && $date <= $dob){
    $hepB_message = "
      <small>No Data Found</small><br>
      <button type='button' class='focus-ring btn btn-sm border mt-5 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepb'>Administer Hep B</button> 
    ";

    $hepb_schedule = "
      <div style='margin-top: 5.5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hep B</b></small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hepb'><small>$dob</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month2old</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month6old</small></button> 
      </div>
    ";
  }
  elseif(mysqli_num_rows($hepB_req_run) == 0 && $date > $dob){
    $hepB_message = "
      <small>No Data Found</small><br>
      <button type='button' class='focus-ring btn btn-sm border mt-5 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepb'>Administer Hep B</button> 
    ";

    $hepb_schedule = "
      <div style='margin-top: 5.5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hep B</b></small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hepb'><small>OVERDUE</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month2old</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month6old</small></button> 
      </div>
    ";
    $iz_recommendation = "
      <div align='center'>
        <small>
          <div class='mb-3' align='left'>
          IZ Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          Combination Schedule <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          </div>
        </small>
      </div>
     ";
  }
  if(mysqli_num_rows($hepB_req_run) == 1 && $date <= $v1_month2){
    $hepB_message = "
      <div align='center'>
        <small>
          <div class='mb-3 row col-md-12'>
            <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
              <div class='card-body mt-3'>
              2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
              </div>
            </div>
            <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
               <div class='card-body'>
                  $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                  <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                  <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                  <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                  <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
               </div>
            </div>
          </div>
          <button type='button' class='focus-ring btn btn-sm border mt-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepb'>Administer Hep B</button> 
        </small>
      </div>
      ";
    $hepb_schedule = "
      <div style='margin-top: 5.5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hep B</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hepB1</small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hepb'><small>$s1_month2</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month4</small></button> 
      </div>
      ";
    $iz_recommendation = "
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
  elseif(mysqli_num_rows($hepB_req_run) == 1 && $date >= $v1_month2){
    $hepB_message = "
      <div align='center'>
        <small>
          <div class='mb-3 row col-md-12'>
            <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
              <div class='card-body mt-3'>
              2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
              </div>
            </div>
            <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
               <div class='card-body'>
                  $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                  <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                  <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                  <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                  <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
               </div>
            </div>
          </div>
          <button type='button' class='focus-ring btn btn-sm border mt-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepb'>Administer Hep B</button> 
        </small>
      </div>
      ";
    $hepb_schedule = "
      <div style='margin-top: 5.5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hep B</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hepB1</small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hepb'><small>OVERDUE</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month4</small></button> 
      </div>
      ";
    $iz_recommendation = "
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
  if(mysqli_num_rows($hepB_req_run) == 2 && $date <= $v2_month4){
      $hepB_message = "
          <div align='center'>
            <small>
              <div class='mb-3 row col-md-12'>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body mt-3'>
                    3rd dose is due on <b>$s2_month4</b> but no later than <b>$s2_month18</b>. If given at <b>$s2_month6</b>, please administer the following vaccines and other immunization agents:
                  </div>
                </div>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                      $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  </div>
                </div>
              </div>
              <button type='button' class='focus-ring btn btn-sm border mt-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepb'>Administer Hep B</button>
            </small>
          </div>
       ";

      $hepb_schedule = "
          <div style='margin-top: 5.5px'>
            <button id='btn_schedule' class='py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hep B</b></small></button>
            <button id='btn_complete' class='px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hepB1</small></button>
            <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hepB2</small></button>
            <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hepb'><small>$s2_month4</small></button> 
          </div>
        ";
  }
  elseif(mysqli_num_rows($hepB_req_run) == 2 && $date > $v2_month4){
    $hepB_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-3'>
                  3rd dose is due on <b>$s2_month4</b> but no later than <b>$s2_month18</b>. If given at <b>$s2_month6</b>, please administer the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                </div>
              </div>
            </div>
            <button type='button' class='focus-ring btn btn-sm border mt-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepb'>Administer Hep B</button>
          </small>
        </div>
     ";

    $hepb_schedule = "
        <div style='margin-top: 5.5px'>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hep B</b></small></button>
          <button id='btn_complete' class='px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hepB1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hepB2</small></button>
          <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hepb'><small>OVERDUE</small></button> 
        </div>
      ";
  }
  if(mysqli_num_rows($hepB_req_run) == 3){
      $hepB_message = "
        <div class='mb-3'>
          <div align='center'>
            <small>
              <div class='mb-3 row col-md-12'>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body mt-3'>
                    Hepatitis B series is complete! The following vaccines and other immunization agents should be administered today:
                  </div>
                </div>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV5</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                  </div>
                </div>
              </div>
            </small>
          </div>
        </div>
        ";
      
      $hepb_schedule = "
          <div style='margin-top: 5.5px'>
            <button id='btn_schedule' class='py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hep B</b></small></button>
            <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hepB1</small></button>
            <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hepB2</small></button>
            <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hepB3</small></button>
          </div>
          ";
  }

  // Count Administered Rotavirus
  $rota = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='Rotavirus' ";
  $rota_run = mysqli_query($con, $rota);
  $rota_value = mysqli_fetch_assoc($rota_run);
  $rota_count = round($rota_value['count(*)'] / 2 * 100);
  // Rota Recommendation
  $rota_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='Rotavirus' ORDER BY id DESC";
  $rota_req_run = mysqli_query($con, $rota_req);
  $rota_vaccine = mysqli_fetch_assoc($rota_req_run);
  // Schedule
  foreach ($rota_req_run as $row){
    if($row['seriesID'] == 1){
      $rota1 = strtotime($row['date']);
      $rota1 = date('m/d/Y',$rota1);
      $v1_month2 = strtotime("+2 months", strtotime($rota1));
      $v1_month2 = date('Y-m-d',$v1_month2);
      $s1_month2 = strtotime("+2 months", strtotime($rota1));
      $s1_month2 = date('m/d/Y',$s1_month2);
      $s1_month4 = strtotime("+2 months", strtotime($s1_month2));
      $s1_month4 = date('m/d/Y',$s1_month4);
      $s1_month6 = strtotime("+2 months", strtotime($s1_month4));
      $s1_month6 = date('m/d/Y',$s1_month6);
    }
    if($row['seriesID'] == 2){
      $rota2 = strtotime($row['date']);
      $rota2 = date('m/d/Y',$rota2);
      $v2_month2 = strtotime("+2 months", strtotime($rota2));
      $v2_month2 = date('Y-m-d',$v2_month2);
      $s2_month2 = strtotime("+2 months", strtotime($rota2));
      $s2_month2 = date('m/d/Y',$s2_month2);
    }
    if($row['seriesID'] == 3){
      $rota3 = strtotime($row['date']);
      $rota3 = date('m/d/Y',$rota3);
    }
  }
  if(mysqli_num_rows($rota_req_run) == 0 && $date <= $month2old_){
      $rota_message = "
        <small>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        </small> 
        <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_rota'>Administer Rotavirus</button> 
      ";

      $rota_schedule = "
        <div style='margin-top: 6px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>RV</b></small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_rota'><small>$month2old</small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month4old</small></button>
          <a href='https://www.cdc.gov/vaccines/schedules/hcp/imz/child-schedule-notes.html#note-rotavirus' target='_blank' id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small><i class='bi bi-book'></i></small></a> 
        </div>
      ";
  }
  elseif(mysqli_num_rows($rota_req_run) == 0 && $date > $month2old_){
    $rota_message = "
      <small>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small> 
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_rota'>Administer Rotavirus</button> 
    ";

    $rota_schedule = "
      <div style='margin-top: 6px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>RV</b></small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_rota'><small>OVERDUE</small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month4old</small></button>
        <a href='https://www.cdc.gov/vaccines/schedules/hcp/imz/child-schedule-notes.html#note-rotavirus' target='_blank' id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small><i class='bi bi-book'></i></small></a> 
      </div>
    ";
  }
  if(mysqli_num_rows($rota_req_run) == 1 && $date <= $v1_month2){
    $rota_brand = decryptthis($rota_vaccine['vaccine'], $iz_key);
    $rotateq = "RV - RotaTeq Single Dose Tubes";
    // Special condition (2 dose series if Rotarix and 3 dose series if Rotateq)
    if($rota_brand == $rotateq){
      $rota_message = "
          <div align='center'>
            <small>
              <div class='mb-3 row col-md-12'>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body mt-3'>
                    2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
                  </div>
                </div>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                    $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  </div>
                </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_rota'>Administer Rotavirus</button> 
            </small>
          </div>
        ";
      $rota_schedule = "
        <div style='margin-top: 6px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>RV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rota1</small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_rota'><small>$s1_month2</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month4</small></button>
        </div>
        ";  
    }
    else{
      $rota_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-3'>
                  2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                  $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_rota'>Administer Rotavirus</button> 
          </small>
        </div>
        ";
      $rota_schedule = "
        <div style='margin-top: 6px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>RV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rota1</small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_rota'><small>$s1_month2</small></button>
        </div>
        ";
    }   
  }
  elseif(mysqli_num_rows($rota_req_run) == 1 && $date > $v1_month2){
    $rota_brand = decryptthis($rota_vaccine['vaccine'], $iz_key);
    $rotateq = "RV - RotaTeq Single Dose Tubes";
    // Special condition (2 dose series if Rotarix and 3 dose series if Rotateq)
    if($rota_brand == $rotateq){
      $rota_message = "
          <div align='center'>
            <small>
              <div class='mb-3 row col-md-12'>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body mt-3'>
                    2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
                  </div>
                </div>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                    $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  </div>
                </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_rota'>Administer Rotavirus</button> 
            </small>
          </div>
        ";
      $rota_schedule = "
        <div style='margin-top: 6px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>RV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rota1</small></button>
          <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_rota'><small>$s1_month2</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month4</small></button>
        </div>
        ";  
    }
    else{
      $rota_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-3'>
                  2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                  $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_rota'>Administer Rotavirus</button> 
          </small>
        </div>
        ";
      $rota_schedule = "
        <div style='margin-top: 6px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>RV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rota1</small></button>
          <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_rota'><small>$s1_month2</small></button>
        </div>
        ";
    }  
  }
  if(mysqli_num_rows($rota_req_run) == 2 && $date <= $v2_month2){
    $rota_brand = decryptthis($rota_vaccine['vaccine'], $iz_key);
    $rotateq = "RV - RotaTeq Single Dose Tubes";
    // Special condition (2 dose series if Rotarix and 3 dose series if Rotateq)
    if($rota_brand == $rotateq){
      $rota_message = "
          <div align='center'>
            <small>
              <div class='mb-3 row col-md-12'>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body mt-3'>
                    3rd dose is due on <b>$s2_month2</b> along with the following vaccines and other immunization agents:
                  </div>
                </div>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                  </div>
                </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_rota'>Administer Rotavirus</button> 
            </small>
          </div>
        ";
      $rota_schedule = "
        <div style='margin-top: 6px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>RV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rota1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rota2</small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_rota'><small>$s2_month2</small></button>
        </div>
        ";  
    }
    else{
      $rota_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-3'>
                  Rotarix series is complete! The following vaccines and other immunization agents should be administered today:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                  $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_rota'>Administer Rotavirus</button> 
          </small>
        </div>
        ";
      $rota_schedule = "
        <div style='margin-top: 6px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>RV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rota1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rota2</small></button>
        </div>
        ";
    }
  }
  elseif(mysqli_num_rows($rota_req_run) == 2 && $date > $v2_month2){
    $rota_brand = decryptthis($rota_vaccine['vaccine'], $iz_key);
    $rotateq = "RV - RotaTeq Single Dose Tubes";
    // Special condition (2 dose series if Rotarix and 3 dose series if Rotateq)
    if($rota_brand == $rotateq){
      $rota_message = "
          <div align='center'>
            <small>
              <div class='mb-3 row col-md-12'>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body mt-3'>
                    3rd dose is due on <b>$s2_month2</b> along with the following vaccines and other immunization agents:
                  </div>
                </div>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                  </div>
                </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_rota'>Administer Rotavirus</button> 
            </small>
          </div>
        ";
      $rota_schedule = "
        <div style='margin-top: 6px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>RV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rota1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rota2</small></button>
          <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_rota'><small>OVERDUE</small></button>
        </div>
        ";  
    }
    else{
      $rota_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-3'>
                  Rotarix series is complete! The following vaccines and other immunization agents should be administered today:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                  $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_rota'>Administer Rotavirus</button> 
          </small>
        </div>
        ";
      $rota_schedule = "
        <div style='margin-top: 6px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>RV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rota1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rota2</small></button>
        </div>
        ";
    }
  }
  if(mysqli_num_rows($rota_req_run) == 3){
    $rota_message = "
      <div class='mb-3'>
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  RotaTeq series is complete! The following vaccines and other immunization agents should be administered today:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                  $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                  <br>$syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                  <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                  <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                  <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          </small>
        </div>
      </div>
     ";
    $rota_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>RV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rota1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rota2</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$rota3</small></button>
        </div>
     "; 
    $iz_recommendation = "
          <div align='center'>
            <small>
              <div class='mb-3' align='left'>
              <b>Due on $year4:</b><br>
                4th dose of IPV <br>
                2nd dose of MMR <br>
                2nd dose of Varicella <br>
                COVID-19 <br>
                Influenza
              </div>
             
            </small>
          </div>
       ";
  }

  // Count Administered DTaP
  $dtap = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='DTaP' ";
  $dtap_run = mysqli_query($con, $dtap);
  $dtap_value = mysqli_fetch_assoc($dtap_run);
  $dtap_count = round($dtap_value['count(*)'] / 5 * 100);
  // DTaP Recommendation
  $dtap_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='DTaP' ORDER BY id DESC";
  $dtap_req_run = mysqli_query($con, $dtap_req);
  $rows = mysqli_num_rows($dtap_req_run);
  // Schedule
  foreach ($dtap_req_run as $row){
    if($row['seriesID'] == 1){
      $dtap1 = strtotime($row['date']);
      $dtap1 = date('m/d/Y',$dtap1);
      $v1_month2 = strtotime("+2 months", strtotime($dtap1));
      $v1_month2 = date('Y-m-d',$v1_month2);
      $s1_month2 = strtotime("+2 months", strtotime($dtap1));
      $s1_month2 = date('m/d/Y',$s1_month2);
      $s1_month4 = strtotime("+2 months", strtotime($s1_month2));
      $s1_month4 = date('m/d/Y',$s1_month4);
      $s1_month15 = strtotime("+9 months", strtotime($s1_month4));
      $s1_month15 = date('m/d/Y',$s1_month15);
      $s1_year4 = strtotime("+33 months", strtotime($s1_month15));
      $s1_year4 = date('m/d/Y',$s1_year4);
    }
    if($row['seriesID'] == 2){
      $dtap2 = strtotime($row['date']);
      $dtap2 = date('m/d/Y',$dtap2);
      $v2_month2 = strtotime("+2 months", strtotime($dtap2));
      $v2_month2 = date('Y-m-d',$v2_month2);
      $s2_month2 = strtotime("+2 months", strtotime($dtap2));
      $s2_month2 = date('m/d/Y',$s2_month2);
      $s2_month9 = strtotime("+9 months", strtotime($s2_month2));
      $s2_month9 = date('m/d/Y',$s2_month9);
      $s2_year4 = strtotime("+33 months", strtotime($s2_month9));
      $s2_year4 = date('m/d/Y',$s2_year4);
    }
    if($row['seriesID'] == 3){
      $dtap3 = strtotime($row['date']);
      $dtap3 = date('m/d/Y',$dtap3);
      $v3_month9 = strtotime("+9 months", strtotime($dtap3));
      $v3_month9 = date('Y-m-d',$v3_month9);
      $s3_month9 = strtotime("+9 months", strtotime($dtap3));
      $s3_month9 = date('m/d/Y',$s3_month9);
      $s3_year4 = strtotime("+33 months", strtotime($s3_month9));
      $s3_year4 = date('m/d/Y',$s3_year4);
    }
    if($row['seriesID'] == 4){
      $dtap4 = strtotime($row['date']);
      $dtap4 = date('m/d/Y',$dtap4);
      $v4_year4 = strtotime("+33 months", strtotime($dtap4));
      $v4_year4 = date('Y-m-d',$v4_year4);
      $s4_year4 = strtotime("+33 months", strtotime($dtap4));
      $s4_year4 = date('m/d/Y',$s4_year4);
    }
    if($row['seriesID'] == 5){
      $dtap5 = strtotime($row['date']);
      $dtap5 = date('m/d/Y',$dtap5);
    } 
  }
  if(mysqli_num_rows($dtap_req_run) == 0 && $date <= $month2old_){
    $dtap_message = "
      <small>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer DTaP</button> 
    ";
    $dtap_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>DTaP</b></small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_dtap'><small>$month2old</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month4old</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month6old</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month15old</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year4old</small></button> 
      </div>
    ";
  }
  elseif(mysqli_num_rows($dtap_req_run) == 0 && $date > $month2old_){
    $dtap_message = "
      <small>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer DTaP</button> 
    ";
    $dtap_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>DTaP</b></small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_dtap'><small>OVERDUE</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month4old</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month6old</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month15old</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year4old</small></button> 
      </div>
    ";
  }
  if(mysqli_num_rows($dtap_req_run) == 1 && $date <= $v1_month2){
    $dtap_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                 <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                 </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer DTaP</button> 
            </div>
          </small>
        </div>
     ";
    $dtap_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>DTaP</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap1</small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_dtap'><small>$s1_month2</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month4</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month15</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_year4</small></button> 
      </div>
      ";
    $iz_recommendation = "
        <div align='center'>
          <small>
            <div class='mb-3' align='left'>
            <b>Due on $s1_month2:</b><br>
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
  elseif(mysqli_num_rows($dtap_req_run) == 1 && $date > $v1_month2){
    $dtap_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                 <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                 </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer DTaP</button> 
            </div>
          </small>
        </div>
     ";
    $dtap_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>DTaP</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap1</small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_dtap'><small>OVERDUE</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month4</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month15</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_year4</small></button> 
      </div>
      ";
    $iz_recommendation = "
        <div align='center'>
          <small>
            <div class='mb-3' align='left'>
            <b>Due on $s1_month2:</b><br>
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
  if(mysqli_num_rows($dtap_req_run) == 2 && $date <= $v2_month2){
    $dtap_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  3rd dose is due on <b>$s2_month2</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer DTaP</button> 
            </div>
          </small>
        </div>
     ";
    $dtap_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>DTaP</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap1</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap2</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_dtap'><small>$s2_month2</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3'><small>$s2_month9</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3'><small>$s2_year4</small></button> 
      </div>
      "; 
     $iz_recommendation = "
      <div align='center'>
        <small>
          <div class='mb-3' align='left'>
          <b>Due on $s2_month2:</b><br>
            3rd dose of Hep B <br>
            3rd dose of DTaP <br>
            3rd dose of PCV <br>
            3rd dose of IPV
          </div>     
        </small>
      </div>
       ";
  }
  elseif(mysqli_num_rows($dtap_req_run) == 2 && $date > $v2_month2){
    $dtap_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  3rd dose is due on <b>$s2_month2</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer DTaP</button> 
            </div>
          </small>
        </div>
     ";
    $dtap_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>DTaP</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap1</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap2</small></button>
        <button id='btn_overdue' class='py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_dtap'><small>OVERDUE</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3'><small>$s2_month9</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3'><small>$s2_year4</small></button> 
      </div>
      "; 
     $iz_recommendation = "
      <div align='center'>
        <small>
          <div class='mb-3' align='left'>
          <b>Due on $s2_month2:</b><br>
            3rd dose of Hep B <br>
            3rd dose of DTaP <br>
            3rd dose of PCV <br>
            3rd dose of IPV
          </div>     
        </small>
      </div>
       ";
  }
  if(mysqli_num_rows($dtap_req_run) == 3 && $date <= $v3_month9){
    $dtap_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-5'>
                  4th dose is due on <b>$s3_month9</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer DTaP</button> 
            </div>
          </small>
        </div>
     ";
    $dtap_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>DTaP</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap1</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap2</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap3</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_dtap'><small>$s3_month9</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s3_year4</small></button> 
      </div>
      "; 
    $iz_recommendation = "
          <div align='center'>
            <small>
              <div class='mb-3' align='left'>
              <b>Due on $s3_month9:</b><br>
                4th dose of PCV <br>
                3rd dose of IPV <br>
                3rd dose of Hib <br>
                COVID-19 <br>
                Influenza
              </div>
             
            </small>
          </div>
     ";
  }
  elseif(mysqli_num_rows($dtap_req_run) == 3 && $date > $v3_month9){
    $dtap_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-5'>
                  4th dose is due on <b>$s3_month9</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer DTaP</button> 
            </div>
          </small>
        </div>
     ";
    $dtap_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>DTaP</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap1</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap2</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap3</small></button>
        <button id='btn_overdue' class='py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_dtap'><small>OVERDUE</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s3_year4</small></button> 
      </div>
      "; 
    $iz_recommendation = "
          <div align='center'>
            <small>
              <div class='mb-3' align='left'>
              <b>Due on $s3_month9:</b><br>
                4th dose of PCV <br>
                3rd dose of IPV <br>
                3rd dose of Hib <br>
                COVID-19 <br>
                Influenza
              </div>
             
            </small>
          </div>
     ";
  }
  if(mysqli_num_rows($dtap_req_run) == 4 && $date <= $v4_year4){
    $dtap_message = "
      <div class='mb-3'>
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  5th dose is due on <b>$s4_year4</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                  $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                  <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                  <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer DTaP</button> 
            </div>
          </small>
        </div>
      </div>
      ";
    $dtap_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>DTaP</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap1</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap2</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap3</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap4</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_dtap'><small>$s4_year4</small></button>
      </div>
      "; 
    $iz_recommendation = "
          <div align='center'>
            <small>
              <div class='mb-3' align='left'>
              <b>Due on $s4_year4:</b><br>
                4th dose of IPV <br>
                2nd dose of MMR <br>
                2nd dose of Varicella <br>
                COVID-19 <br>
                Influenza
              </div>
             
            </small>
          </div>
       ";
  }
  if(mysqli_num_rows($dtap_req_run) == 4 && $date > $v4_year4){
    $dtap_message = "
      <div class='mb-3'>
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  5th dose is due on <b>$s4_year4</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                  $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                  <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                  <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_dtap'>Administer DTaP</button> 
            </div>
          </small>
        </div>
      </div>
      ";
    $dtap_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>DTaP</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap1</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap2</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap3</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap4</small></button>
        <button id='btn_overdue' class='py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_dtap'><small>OVERDUE</small></button>
      </div>
      "; 
    $iz_recommendation = "
          <div align='center'>
            <small>
              <div class='mb-3' align='left'>
              <b>Due on $s4_year4:</b><br>
                4th dose of IPV <br>
                2nd dose of MMR <br>
                2nd dose of Varicella <br>
                COVID-19 <br>
                Influenza
              </div>
             
            </small>
          </div>
       ";
  }
  if(mysqli_num_rows($dtap_req_run) == 5){
    $dtap_message = "
      <div class='mb-3'>
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  DTaP series is complete! The following vaccines and other immunization agents should be administered today:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                  $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                  <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                  <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                  <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          </small>
        </div>
      </div>
     ";
    $dtap_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>DTaP</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap2</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap3</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap4</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$dtap5</small></button>
        </div>
     "; 
    $iz_recommendation = "
          <div align='center'>
            <small>
              <div class='mb-3' align='left'>
              <b>Due on $year4:</b><br>
                4th dose of IPV <br>
                2nd dose of MMR <br>
                2nd dose of Varicella <br>
                COVID-19 <br>
                Influenza
              </div>
             
            </small>
          </div>
       ";
  }

  // Count Administered Hib
  $hib = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='Hib' ";
  $hib_run = mysqli_query($con, $hib);
  $hib_value = mysqli_fetch_assoc($hib_run);
  $hib_count = round($hib_value['count(*)'] / 4 * 100);
  // Hib Recommendation
  $hib_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='Hib' ORDER BY id DESC";
  $hib_req_run = mysqli_query($con, $hib_req);
  $hib_vaccine = mysqli_fetch_assoc($hib_req_run);
  // Schedule (appointment recommendation)
  foreach ($hib_req_run as $row){
    if($row['seriesID'] == 1){
      $hib1 = strtotime($row['date']);
      $hib1 = date('m/d/Y',$hib1);
      $v1_month2 = strtotime("+2 months", strtotime($hib1));
      $v1_month2 = date('Y-m-d',$v1_month2);
      $s1_month2 = strtotime("+2 months", strtotime($hib1));
      $s1_month2 = date('m/d/Y',$s1_month2);
      $s1_month4 = strtotime("+2 months", strtotime($s1_month2));
      $s1_month4 = date('m/d/Y',$s1_month4);
      $s1_month6 = strtotime("+2 months", strtotime($s1_month4));
      $s1_month6 = date('m/d/Y',$s1_month6);
      $s1_month10 = strtotime("+4 months", strtotime($s1_month6));
      $s1_month10 = date('m/d/Y',$s1_month10);
    }
    if($row['seriesID'] == 2){
      $hib2 = strtotime($row['date']);
      $hib2 = date('m/d/Y',$hib2);
      $v2_month2 = strtotime("+2 months", strtotime($hib2));
      $v2_month2 = date('Y-m-d',$v2_month2);
      $v2_month8 = strtotime("+8 months", strtotime($hib2));
      $v2_month8 = date('Y-m-d',$v2_month8);
      $s2_month2 = strtotime("+2 months", strtotime($hib2));
      $s2_month2 = date('m/d/Y',$s2_month2);
      $s2_month4 = strtotime("+2 months", strtotime($s2_month2));
      $s2_month4 = date('m/d/Y',$s2_month4);
      $s2_month6 = strtotime("+6 months", strtotime($s2_month2));
      $s2_month6 = date('m/d/Y',$s2_month6);
    }
    if($row['seriesID'] == 3){
      $hib3 = strtotime($row['date']);
      $hib3 = date('m/d/Y',$hib3);
      $v3_month6 = strtotime("+6 months", strtotime($hib3));
      $v3_month6 = date('Y-m-d',$v3_month6);
      $s3_month6 = strtotime("+6 months", strtotime($hib3));
      $s3_month6 = date('m/d/Y',$s3_month6);
      $s3_year4 = strtotime("+33 months", strtotime($s3_month6));
      $s3_year4 = date('m/d/Y',$s3_year4);
    }
    if($row['seriesID'] == 4){
      $hib4 = strtotime($row['date']);
      $hib4 = date('m/d/Y',$hib4);
    }
  }
  // 0 dose and on time
  if(mysqli_num_rows($hib_req_run) == 0 && $date <= $month2old_){
   $hib_message = "
      <small>
          Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button> 
     ";
   $hib_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hib</b></small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hib'><small>$month2old</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month4old</small></button>
        <a href='https://www.cdc.gov/vaccines/schedules/hcp/imz/child-schedule-notes.html#note-hib' target='_blank' id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small><i class='bi bi-book'></i></small></a> 
        <a href='https://www.cdc.gov/vaccines/schedules/hcp/imz/child-schedule-notes.html#note-hib' target='_blank' id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small><i class='bi bi-book'></i></small></a> 
      </div>
    ";
  }
  // 0 dose and overdue for the 1st dose
  elseif(mysqli_num_rows($hib_req_run) == 0 && $date > $month2old_){
    $hib_message = "
       <small>
           Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
           Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
       </small>
       <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button> 
      ";
    $hib_schedule = "
       <div style='margin-top: 5px'>
         <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hib</b></small></button>
         <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hib'><small>OVERDUE</small></button>
         <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month4old</small></button>
         <a href='https://www.cdc.gov/vaccines/schedules/hcp/imz/child-schedule-notes.html#note-hib' target='_blank' id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small><i class='bi bi-book'></i></small></a> 
         <a href='https://www.cdc.gov/vaccines/schedules/hcp/imz/child-schedule-notes.html#note-hib' target='_blank' id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small><i class='bi bi-book'></i></small></a> 
       </div>
     ";
  }
  // Received 1st dose and on time for the 2nd dose
  if(mysqli_num_rows($hib_req_run) == 1 && $date <= $v1_month2){
    $hib_brand = decryptthis($hib_vaccine['vaccine'], $iz_key);
    $pedvaxHib = "Hib - PedvaxHib Single Dose Vials";
    // Special condition (3 dose series if pedvaxHib else 4 dose series)
    if($hib_brand == $pedvaxHib){
      $hib_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button>
            </div>
          </small>
        </div>
        ";
      $hib_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hib</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib1</small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hib'><small>$s1_month2</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month10</small></button> 
        </div>
        ";  
    }
    else{
      $hib_message = "
        <div align='center'>
            <small>
              <div class='mb-3 row col-md-12'>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body mt-4'>
                    2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
                  </div>
                </div>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                      $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  </div>
                </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              <div class='row col-md-2'>
                <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button>
              </div>
            </small>
          </div>
        ";
      $hib_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hib</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib1</small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hib'><small>$s1_month2</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month4</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month10</small></button> 
        </div>
        ";
    }
  }
  // Received 1st dose but overdue for the 2nd dose
  elseif(mysqli_num_rows($hib_req_run) == 1 && $date > $v1_month2){
    $hib_brand = decryptthis($hib_vaccine['vaccine'], $iz_key);
    $pedvaxHib = "Hib - PedvaxHib Single Dose Vials";
    // Special condition (3 dose series if pedvaxHib else 4 dose series)
    if($hib_brand == $pedvaxHib){
      $hib_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button>
            </div>
          </small>
        </div>
        ";
      $hib_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hib</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib1</small></button>
          <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hib'><small>OVERDUE</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month10</small></button> 
        </div>
        ";  
    }
    else{
      $hib_message = "
        <div align='center'>
            <small>
              <div class='mb-3 row col-md-12'>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body mt-4'>
                    2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
                  </div>
                </div>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                      $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  </div>
                </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              <div class='row col-md-2'>
                <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button>
              </div>
            </small>
          </div>
        ";
      $hib_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hib</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib1</small></button>
          <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hib'><small>OVERDUE</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month4</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month10</small></button> 
        </div>
        ";
    }
  }
  // Received 2nd dose
  if(mysqli_num_rows($hib_req_run) == 2){
    $hib_brand = decryptthis($hib_vaccine['vaccine'], $iz_key);
    $pedvaxHib = "Hib - PedvaxHib Single Dose Vials";
    // Received 2nd dose and on time for the 3rd dose (pedvaxHib)
    if($hib_brand == $pedvaxHib && $date <= $v2_month8){
      $hib_message = "
        <div align='center'>
          <small>
            <div class='row col-md-12'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-5'>
                  3rd dose is due on <b>$s2_month2 or $s2_month4</b>. If given by <b>$s2_month2</b>, please administer the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-5'>
                  If given by <b>$s2_month4</b>, please administer the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button>
            </div>
          </small>
        </div>
        ";
      $hib_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hib</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib2</small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hib'><small>$s2_month6</small></button>
        </div>
      ";
    }
    // Received 2nd dose and overdue for the 3rd dose (pedvaxHib)
    elseif($hib_brand == $pedvaxHib && $date > $v2_month8){
      $hib_message = "
        <div align='center'>
          <small>
            <div class='row col-md-12'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-5'>
                  3rd dose is due on <b>$s2_month2 or $s2_month4</b>. If given by <b>$s2_month2</b>, please administer the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-5'>
                  If given by <b>$s2_month4</b>, please administer the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button>
            </div>
          </small>
        </div>
        ";
      $hib_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hib</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib2</small></button>
          <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hib'><small>OVERDUE</small></button>
        </div>
      ";
    }
    // Received 2nd dose and on time for the 3rd dose (ActHib, Hiberix, Pentacel, Vaxelis)
    elseif($hib_brand !== $pedvaxHib && $date <= $v2_month2){
      $hib_message = "
        <div align='center'>
          <small>
            <div class='row col-md-12'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-5'>
                  3rd dose is due on <b>$s2_month2 or $s2_month4</b>. If given by <b>$s2_month2</b>, please administer the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-5'>
                  If given by <b>$s2_month4</b>, please administer the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button>
            </div>
          </small>
        </div>
        ";
      $hib_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hib</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib2</small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hib'><small>$s2_month2</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s2_month6</small></button> 
        </div>
      ";
    }
    // Received 2nd dose and overdue for the 3rd dose (ActHib, Hiberix, Pentacel, Vaxelis)
    elseif($hib_brand !== $pedvaxHib && $date > $v2_month2){
      $hib_message = "
        <div align='center'>
          <small>
            <div class='row col-md-12'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-5'>
                  3rd dose is due on <b>$s2_month2 or $s2_month4</b>. If given by <b>$s2_month2</b>, please administer the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-5'>
                  If given by <b>$s2_month4</b>, please administer the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button>
            </div>
          </small>
        </div>
        ";
      $hib_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hib</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib2</small></button>
          <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hib'><small>OVERDUE</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s2_month6</small></button> 
        </div>
      ";
    }
  }
  // Received 3rd dose
  if(mysqli_num_rows($hib_req_run) == 3){
    $hib_brand = decryptthis($hib_vaccine['vaccine'], $iz_key);
    $pedvaxHib = "Hib - PedvaxHib Single Dose Vials";
    // Completed PedvaxHib series
    if($hib_brand == $pedvaxHib){
      $hib_message = "
          <div class='mb-3'>
            <div align='center'>
              <small>
                <div class='mb-3 row col-md-12'>
                    <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                      <div class='card-body mt-5'>
                        PedvaxHib series is complete! The following vaccines and other immunization agents should be administered today:
                      </div>
                    </div>
                    <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                      <div class='card-body'>
                        $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                        <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                        <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                        <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                        <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                        <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                        <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                        <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                      </div>
                    </div>
                </div>
                Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
                Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              </small>
            </div>
          </div>
        ";
      $hib_schedule = "
          <div style='margin-top: 5px'>
            <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hib</b></small></button>
            <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib1</small></button>
            <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib2</small></button>
            <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib3</small></button>
          </div>
      ";
    }
    // Received 3rd dose and on time for the 4th dose (Only applies for ActHib, Hiberix, Pentacel & Vaxelis)
    elseif(mysqli_num_rows($hib_req_run) == 3 && $date <= $v3_month6){
      $hib_message = "
          <div align='center'>
            <small>
              <div class='mb-3 row col-md-12'>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body mt-5'>
                    4th dose is due by <b>$s3_month6</b> along with the following vaccines and other immunization agents (if not administered when 3rd dose was given):
                  </div>
                </div>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                      $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                      <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                      <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                      <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                      <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                      <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                      <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                      <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                  </div>
                </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              <div class='row col-md-2'>
                <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button>
              </div>
            </small>
          </div>
        ";
      $hib_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hib</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib2</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib3</small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hib'><small>$s3_month6</small></button>
        </div>
      ";  
    }
    // Received 3rd dose but overdue for the 4th dose (Only applies for ActHib, Hiberix, Pentacel & Vaxelis)
    elseif(mysqli_num_rows($hib_req_run) == 3 && $date > $v3_month6){
      $hib_message = "
          <div align='center'>
            <small>
              <div class='mb-3 row col-md-12'>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body mt-5'>
                    4th dose is due by <b>$s3_month6</b> along with the following vaccines and other immunization agents (if not administered when 3rd dose was given):
                  </div>
                </div>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                      $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                      <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                      <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                      <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                      <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                      <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                      <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                      <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                  </div>
                </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              <div class='row col-md-2'>
                <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hib'>Administer Hib</button>
              </div>
            </small>
          </div>
        ";
      $hib_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hib</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib2</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib3</small></button>
          <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hib'><small>OVERDUE</small></button>
        </div>
      ";  
    }
  }
  // Completed Hib series
  if(mysqli_num_rows($hib_req_run) == 4){
    $hib_message = "
        <div class='mb-3'>
          <div align='center'>
            <small>
              <div class='mb-3 row col-md-12'>
                  <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                    <div class='card-body mt-5'>
                      Hib series is complete! The following vaccines and other immunization agents should be administered today:
                    </div>
                  </div>
                  <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                    <div class='card-body'>
                      $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                      <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                      <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                      <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                      <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                      <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                      <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                      <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                    </div>
                  </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            </small>
          </div>
        </div>
     ";
    $hib_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hib</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib2</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib3</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hib4</small></button>
        </div>
     ";
    
  }

  // Count Administered PCV
  $pcv = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='PCV' ";
  $pcv_run = mysqli_query($con, $pcv);
  $pcv_value = mysqli_fetch_assoc($pcv_run);
  $pcv_count = round($pcv_value['count(*)'] / 4 * 100);
  // PCV Recommendation
  $pcv_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='PCV' ORDER BY id DESC";
  $pcv_req_run = mysqli_query($con, $pcv_req);
  // Schedule
  foreach ($pcv_req_run as $row){
    if($row['seriesID'] == 1){
      $pcv1 = strtotime($row['date']);
      $pcv1 = date('m/d/Y',$pcv1);
      $v1_month2 = strtotime("+2 months", strtotime($pcv1));
      $v1_month2 = date('Y-m-d',$v1_month2);
      $s1_month2 = strtotime("+2 months", strtotime($pcv1));
      $s1_month2 = date('m/d/Y',$s1_month2);
      $s1_month4 = strtotime("+2 months", strtotime($s1_month2));
      $s1_month4 = date('m/d/Y',$s1_month4);
      $s1_month6 = strtotime("+6 months", strtotime($s1_month4));
      $s1_month6 = date('m/d/Y',$s1_month6);
    }
    if($row['seriesID'] == 2){
      $pcv2 = strtotime($row['date']);
      $pcv2 = date('m/d/Y',$pcv2);
      $v2_month2 = strtotime("+2 months", strtotime($pcv2));
      $v2_month2 = date('Y-m-d',$v2_month2);
      $s2_month2 = strtotime("+2 months", strtotime($pcv2));
      $s2_month2 = date('m/d/Y',$s2_month2);
      $s2_month6 = strtotime("+6 months", strtotime($s2_month2));
      $s2_month6 = date('m/d/Y',$s2_month6);
    }
    if($row['seriesID'] == 3){
      $pcv3 = strtotime($row['date']);
      $pcv3 = date('m/d/Y',$pcv3);
      $v3_month6 = strtotime("+6 months", strtotime($pcv3));
      $v3_month6 = date('Y-m-d',$v3_month6);
      $s3_month6 = strtotime("+6 months", strtotime($pcv3));
      $s3_month6 = date('m/d/Y',$s3_month6);
    }
    if($row['seriesID'] == 4){
      $pcv4 = strtotime($row['date']);
      $pcv4 = date('m/d/Y',$pcv4);
    }
  }
  if(mysqli_num_rows($pcv_req_run) == 0 && $date <= $month2old_){
   $pcv_message = "
      <small>
          Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_pcv'>Administer PCV</button> 
    ";
   $pcv_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>PCV</b></small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_pcv'><small>$month2old</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month4old</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month6old</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month12old</small></button> 
      </div>
    ";
  }
  elseif(mysqli_num_rows($pcv_req_run) == 0 && $date > $month2old_){
    $pcv_message = "
       <small>
           Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
           Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
       </small>
       <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_pcv'>Administer PCV</button> 
     ";
    $pcv_schedule = "
       <div style='margin-top: 5px'>
         <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>PCV</b></small></button>
         <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_pcv'><small>OVERDUE</small></button>
         <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month4old</small></button>
         <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month6old</small></button> 
         <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month12old</small></button> 
       </div>
     ";
  }
  if(mysqli_num_rows($pcv_req_run) == 1 && $date <= $v1_month2){
    $pcv_message = "
       <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                 </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_pcv'>Administer PCV</button> 
            </div>
          </small>
        </div>
    ";
    $pcv_schedule = "
        <div style='margin-top: 6px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>PCV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv1</small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_pcv'><small>$s1_month2</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month4</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month6</small></button>
        </div>
      ";
    
  }
  elseif(mysqli_num_rows($pcv_req_run) == 1 && $date > $v1_month2){
    $pcv_message = "
       <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                 </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_pcv'>Administer PCV</button> 
            </div>
          </small>
        </div>
    ";
    $pcv_schedule = "
        <div style='margin-top: 6px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>PCV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv1</small></button>
          <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_pcv'><small>OVERDUE</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month4</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month6</small></button>
        </div>
      ";
    
  }
  if(mysqli_num_rows($pcv_req_run) == 2 && $date <= $v2_month2){
    $pcv_message = "
      <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  3rd dose is due on <b>$s2_month2</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
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
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_pcv'>Administer PCV</button> 
            </div>
          </small>
      </div>
    ";
    $pcv_schedule = "
      <div style='margin-top: 6px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>PCV</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv1</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv2</small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_pcv'><small>$s2_month2</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s2_month6</small></button>
      </div>
    ";
  }
  elseif(mysqli_num_rows($pcv_req_run) == 2 && $date > $v2_month2){
    $pcv_message = "
      <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  3rd dose is due on <b>$s2_month2</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
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
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_pcv'>Administer PCV</button> 
            </div>
          </small>
      </div>
    ";
    $pcv_schedule = "
      <div style='margin-top: 6px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>PCV</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv1</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv2</small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_pcv'><small>OVERDUE</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s2_month6</small></button>
      </div>
    ";
  }
  if(mysqli_num_rows($pcv_req_run) == 3 && $date <= $v3_month6){
     $pcv_message = "
        <div align='center'>
           <small>
              <div class='mb-3 row col-md-12'>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body mt-5'>
                    4th dose is due on <b>$s3_month6</b> along with the following vaccines and other immunization agents:
                  </div>
                </div>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                    $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd or 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                    <br> $syringe 2 dose series - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-a.pdf' class='text-decoration-none' target='_blank'>Hep A</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                  </div>
                </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              <div class='row col-md-2'>
                  <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_pcv'>Administer PCV</button> 
              </div>
           </small>
        </div>
      ";
      $pcv_schedule = "
        <div style='margin-top: 6px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>PCV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv2</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv3</small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_pcv'><small>$s3_month6</small></button>
        </div>
      ";
  }
  elseif(mysqli_num_rows($pcv_req_run) == 3 && $date > $v3_month6){
    $pcv_message = "
       <div align='center'>
          <small>
             <div class='mb-3 row col-md-12'>
               <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                 <div class='card-body mt-5'>
                   4th dose is due on <b>$s3_month6</b> along with the following vaccines and other immunization agents:
                 </div>
               </div>
               <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                 <div class='card-body'>
                   $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                   <br> $syringe 3rd or 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                   <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                   <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                   <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                   <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                   <br> $syringe 2 dose series - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-a.pdf' class='text-decoration-none' target='_blank'>Hep A</a>
                   <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                   <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                 </div>
               </div>
             </div>
             Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
             Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
             <div class='row col-md-2'>
                 <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_pcv'>Administer PCV</button> 
             </div>
          </small>
       </div>
     ";
    $pcv_schedule = "
       <div style='margin-top: 6px'>
         <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>PCV</b></small></button>
         <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv1</small></button>
         <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv2</small></button>
         <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv3</small></button>
         <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_pcv'><small>OVERDUE</small></button>
       </div>
     ";
  }
  if(mysqli_num_rows($pcv_req_run) == 4){
    $pcv_message = "
        <div class='mb-3'>
          <div align='center'>
            <small>
              <div class='mb-3 row col-md-12'>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body mt-5'>
                    PCV series is complete! The following vaccines and other immunization agents should be administered today:
                  </div>
                </div>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                    $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd or 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                    <br> $syringe 2 dose series - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-a.pdf' class='text-decoration-none' target='_blank'>Hep A</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                  </div>
                </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            </small>
          </div>
        </div>
      ";
    $pcv_schedule = "
        <div style='margin-top: 6px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>PCV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv2</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv3</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$pcv4</small></button>
        </div>
      ";
  }

  // Count Administered IPV
  $ipv = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='IPV' ";
  $ipv_run = mysqli_query($con, $ipv);
  $ipv_value = mysqli_fetch_assoc($ipv_run);
  $ipv_count = round($ipv_value['count(*)'] / 4 * 100);
  // Recommended dates to administer 2nd, 3rd & 4th dose of IPV
  $ipv_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='IPV' ORDER BY id DESC";
  $ipv_req_run = mysqli_query($con, $ipv_req);
  // Schedule
  foreach ($ipv_req_run as $row){
    if($row['seriesID'] == 1){
      $ipv1 = strtotime($row['date']);
      $ipv1 = date('m/d/Y',$ipv1);
      $v1_month2 = strtotime("+2 months", strtotime($ipv1));
      $v1_month2 = date('Y-m-d',$v1_month2);
      $s1_month2 = strtotime("+2 months", strtotime($ipv1));
      $s1_month2 = date('m/d/Y',$s1_month2);
      $s1_month4 = strtotime("+2 months", strtotime($s1_month2));
      $s1_month4 = date('m/d/Y',$s1_month4);
      $s1_year4 = strtotime("+42 months", strtotime($s1_month4));
      $s1_year4 = date('m/d/Y',$s1_year4);
    }
    if($row['seriesID'] == 2){
      $ipv2 = strtotime($row['date']);
      $ipv2 = date('m/d/Y',$ipv2);
      $v2_month2 = strtotime("+2 months", strtotime($ipv2));
      $v2_month2 = date('Y-m-d',$v2_month2);
      $s2_month2 = strtotime("+2 months", strtotime($ipv2));
      $s2_month2 = date('m/d/Y',$s2_month2);
      $s2_month16 = strtotime("+16 months", strtotime($s2_month2));
      $s2_month16 = date('m/d/Y',$s2_month16);
      $s2_year4 = strtotime("+42 months", strtotime($s1_month4));
      $s2_year4 = date('m/d/Y',$s2_year4);
    }
    if($row['seriesID'] == 3){
      $ipv3 = strtotime($row['date']);
      $ipv3 = date('m/d/Y',$ipv3);
      $v3_year4 = strtotime("+42 months", strtotime($ipv3));
      $v3_year4 = date('Y-m-d',$v3_year4);
      $s3_year4 = strtotime("+42 months", strtotime($ipv3));
      $s3_year4 = date('m/d/Y',$s3_year4);
    }
    if($row['seriesID'] == 4){
      $ipv4 = strtotime($row['date']);
      $ipv4 = date('m/d/Y',$ipv4);
    }
  }
  if(mysqli_num_rows($ipv_req_run) == 0 && $date <= $month2old_){
   $ipv_message = "
      <small>
          Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_ipv'>Administer IPV</button> 
    ";
   $ipv_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>IPV</b></small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_ipv'><small>$month2old</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month4old</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month6old</small></button> 
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year4old</small></button> 
      </div>
    ";
  }
  elseif(mysqli_num_rows($ipv_req_run) == 0 && $date > $month2old_){
    $ipv_message = "
       <small>
           Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
           Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
       </small>
       <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_ipv'>Administer IPV</button> 
     ";
    $ipv_schedule = "
       <div style='margin-top: 5px'>
         <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>IPV</b></small></button>
         <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_ipv'><small>OVERDUE</small></button>
         <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month4old</small></button>
         <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month6old</small></button> 
         <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year4old</small></button> 
       </div>
     ";
  }
  if(mysqli_num_rows($ipv_req_run) == 1 && $date <= $v1_month2){
    $ipv_message = "
       <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                 </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_ipv'>Administer IPV</button> 
            </div>
          </small>
        </div>
      ";
    $ipv_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>IPV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv1</small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_ipv'><small>$s1_month2</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month4</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_year4</small></button> 
        </div>
      ";
  }
  elseif(mysqli_num_rows($ipv_req_run) == 1 && $date > $v1_month2){
    $ipv_message = "
       <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  2nd dose is due on <b>$s1_month2</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                 </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_ipv'>Administer IPV</button> 
            </div>
          </small>
        </div>
      ";
    $ipv_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>IPV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv1</small></button>
          <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_ipv'><small>OVERDUE</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_month4</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s1_year4</small></button> 
        </div>
      ";
  }
  if(mysqli_num_rows($ipv_req_run) == 2 && $date <= $v2_month2){
    $ipv_message = "
        <div align='center'>
          <small>
            <div class='row col-md-12'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  3rd dose is due on <b>$s2_month2</b> but no later than <b>$s2_month16</b>. If given by <b>$s2_month16</b>, please administer the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV5</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            <div class='mb-1 row col-md-12'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-5'>
                  If given by <b>$s2_month16</b>, please administer the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                    <br> $syringe 2 dose series - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-a.pdf' class='text-decoration-none' target='_blank'>Hep A</a>
                    <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_ipv'>Administer IPV</button> 
            </div>
           </small>
         </div>
      ";
    $ipv_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>IPV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv2</small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_ipv'><small>$s2_month2</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s2_year4</small></button>
        </div>
      ";
  }
  elseif(mysqli_num_rows($ipv_req_run) == 2 && $date > $v2_month2){
    $ipv_message = "
        <div align='center'>
          <small>
            <div class='row col-md-12'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  3rd dose is due on <b>$s2_month2</b> but no later than <b>$s2_month16</b>. If given by <b>$s2_month16</b>, please administer the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/rotavirus.pdf' class='text-decoration-none' target='_blank'>RV5</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            <div class='mb-1 row col-md-12'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-5'>
                  If given by <b>$s2_month16</b>, please administer the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hib.pdf' class='text-decoration-none' target='_blank'>Hib</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/pcv.pdf' class='text-decoration-none' target='_blank'>PCV15, PCV20</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                    <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                    <br> $syringe 2 dose series - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-a.pdf' class='text-decoration-none' target='_blank'>Hep A</a>
                    <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <div class='row col-md-2'>
              <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_ipv'>Administer IPV</button> 
            </div>
           </small>
         </div>
      ";
    $ipv_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>IPV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv2</small></button>
          <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_ipv'><small>OVERDUE</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$s2_year4</small></button>
        </div>
      ";
  }
  if(mysqli_num_rows($ipv_req_run) == 3 && $date <= $v3_year4){
    $ipv_message = "
        <div class='mb-3'>
          <div align='center'>
            <small>
              <div class='row col-md-12'>
                  <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                    <div class='card-body mt-4'>
                      4th dose is due on <b>$s3_year4</b> along with the following vaccines and other immunization agents:
                    </div>
                  </div>
                  <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                    <div class='card-body'>
                      $syringe 5th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                      <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                      <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                    </div>
                  </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              <div class='row col-md-2'>
                <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_ipv'>Administer IPV</button> 
              </div>
            </small>
          </div>
        </div>
      ";
    $ipv_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>IPV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv2</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv3</small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_ipv'><small>$s3_year4</small></button>
        </div>
      ";
  }
  elseif(mysqli_num_rows($ipv_req_run) == 3 && $date > $v3_year4){
    $ipv_message = "
        <div class='mb-3'>
          <div align='center'>
            <small>
              <div class='row col-md-12'>
                  <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                    <div class='card-body mt-4'>
                      4th dose is due on <b>$s3_year4</b> along with the following vaccines and other immunization agents:
                    </div>
                  </div>
                  <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                    <div class='card-body'>
                      $syringe 5th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                      <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                      <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                    </div>
                  </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              <div class='row col-md-2'>
                <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_ipv'>Administer IPV</button> 
              </div>
            </small>
          </div>
        </div>
      ";
    $ipv_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>IPV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv2</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv3</small></button>
          <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_ipv'><small>OVERDUE</small></button>
        </div>
      ";
  }
  if(mysqli_num_rows($ipv_req_run) == 4){
    $ipv_message = "
        <div class='mb-3'>
          <div align='center'>
            <small>
              <div class='row col-md-12'>
                  <div class='col card border-0 m-1 mt-1 mb-3' align='left' style='background-color: #e8e8e8'>
                    <div class='card-body mt-4'>
                      IPV series is complete! The following vaccines and other immunization agents should be administered today:
                    </div>
                  </div>
                  <div class='col card border-0 m-1 mt-1 mb-3' align='left' style='background-color: #e8e8e8'>
                    <div class='card-body'>
                      $syringe 5th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                      <br> $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                      <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                      <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                    </div>
                  </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            </small>
          </div>
        </div>
      ";
    $ipv_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>IPV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv2</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv3</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$ipv4</small></button>
        </div>
      ";
  }
  
  // Count Administered MMR
  $mmr = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='MMR' ";
  $mmr_run = mysqli_query($con, $mmr);
  $mmr_value = mysqli_fetch_assoc($mmr_run);
  $mmr_count = round($mmr_value['count(*)'] / 2 * 100);
  // Recommended dates to administer MMR Vaccine
  $mmr_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='MMR' ORDER BY id DESC";
  $mmr_req_run = mysqli_query($con, $mmr_req);
  // Schedule
  foreach ($mmr_req_run as $row){
    if($row['seriesID'] == 1){
      $mmr1 = strtotime($row['date']);
      $mmr1 = date('m/d/Y',$mmr1);
      $v1_year4 = strtotime("+36 months", strtotime($mmr1));
      $v1_year4 = date('Y-m-d',$v1_year4);
      $s1_year4 = strtotime("+36 months", strtotime($mmr1));
      $s1_year4 = date('m/d/Y',$s1_year4);
    }
    if($row['seriesID'] == 2){
      $mmr2 = strtotime($row['date']);
      $mmr2 = date('m/d/Y',$mmr2);
    }
  }
  if(mysqli_num_rows($mmr_req_run) == 0 && $date <= $month12old_){
    $mmr_message = "
      <small>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_mmr'>Administer MMR</button> 
      ";
    $mmr_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>MMR</b></small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_mmr'><small>$month12old</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' data-bs-container='body' data-bs-toggle='popover' data-bs-placement='top' data-bs-content='Slow down! 1st dose first' style='cursor:default'><small>$year4old</small></button>
      </div>
      ";
  }
  elseif(mysqli_num_rows($mmr_req_run) == 0 && $date > $month12old_){
    $mmr_message = "
       <small>
         Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
         Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
       </small>
       <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_mmr'>Administer MMR</button> 
     ";
    $mmr_schedule = "
       <div style='margin-top: 5px'>
         <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>MMR</b></small></button>
         <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_mmr'><small>OVERDUE</small></button>
         <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year4old</small></button>
       </div>
     ";
  }
  if(mysqli_num_rows($mmr_req_run) == 1 && $date <= $v1_year4){
    $mmr_message = "
       <div align='center'>
          <small>
            <div class='row col-md-12 mb-3'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  2nd dose is due by <b>$s1_year4</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                    <br> $syringe 5th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                 </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_mmr'>Administer MMR</button> 
          </small>
        </div>
      ";
    $mmr_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>MMR</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$mmr1</small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_mmr'><small>$s1_year4</small></button>
      </div>
    ";
  }
  elseif(mysqli_num_rows($mmr_req_run) == 1 && $date > $v1_year4){
    $mmr_message = "
       <div align='center'>
          <small>
            <div class='row col-md-12 mb-3'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  2nd dose is due by <b>$s1_year4</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                    <br> $syringe 5th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                    <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                    <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                 </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_mmr'>Administer MMR</button> 
          </small>
        </div>
      ";
    $mmr_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>MMR</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$mmr1</small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_mmr'><small>OVERDUE</small></button>
      </div>
    ";
  }
  if(mysqli_num_rows($mmr_req_run) == 2){
    $mmr_message = "
       <div align='center'>
          <small>
            <div class='row col-md-12 mb-3'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  MMR series is complete! The following vaccines and other immunization agents should be administered today:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                  $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/varicella.pdf' class='text-decoration-none' target='_blank'>Varicella</a>
                  <br> $syringe 5th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                  <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                  <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          </small>
        </div>
     ";
    $mmr_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>MMR</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$mmr1</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$mmr2</small></button>
      </div>
    ";
  }

  // Count Administered Varicella
  $var = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='Varicella' ";
  $var_run = mysqli_query($con, $var);
  $var_value = mysqli_fetch_assoc($var_run);
  $var_count = round($var_value['count(*)'] / 2 * 100);
  // Recommended dates to administer Varicella Vaccine
  $var_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='Varicella' ORDER BY id DESC";
  $var_req_run = mysqli_query($con, $var_req);
  // Schedule
  foreach ($var_req_run as $row){
    if($row['seriesID'] == 1){
      $var1 = strtotime($row['date']);
      $var1 = date('m/d/Y',$var1);
      $v1_year4 = strtotime("+36 months", strtotime($var1));
      $v1_year4 = date('Y-m-d',$v1_year4);
      $s1_year4 = strtotime("+36 months", strtotime($var1));
      $s1_year4 = date('m/d/Y',$s1_year4);
    }
    if($row['seriesID'] == 2){
      $var2 = strtotime($row['date']);
      $var2 = date('m/d/Y',$var2);
    }
  }
  if(mysqli_num_rows($var_req_run) == 0 && $date <= $month12old_){
   $var_message = "
      <small>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_var'>Administer Varicella</button> 
    ";
    $var_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>VAR</b></small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_var'><small>$month12old</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year4old</small></button>
      </div>
    ";
  }
  elseif(mysqli_num_rows($var_req_run) == 0 && $date > $month12old_){
    $var_message = "
       <small>
         Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
         Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
       </small>
       <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_var'>Administer Varicella</button> 
     ";
    $var_schedule = "
       <div style='margin-top: 5px'>
         <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>VAR</b></small></button>
         <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_var'><small>OVERDUE</small></button>
         <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year4old</small></button>
       </div>
     ";
  }
  if(mysqli_num_rows($var_req_run) == 1 && $date <= $v1_year4){
    $var_message = "
       <div align='center'>
          <small>
            <div class='row col-md-12 mb-3'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  2nd dose is due by <b>$s1_year4</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                  $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                  <br> $syringe 5th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                  <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                  <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_var'>Administer Varicella</button> 
          </small>
        </div>
    ";
    $var_schedule = "
      <div style='margin-top: 6px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>VAR</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$var1</small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_var'><small>$s1_year4</small></button>
      </div>
    ";
  }
  elseif(mysqli_num_rows($var_req_run) == 1 && $date > $v1_year4){
    $var_message = "
       <div align='center'>
          <small>
            <div class='row col-md-12 mb-3'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  2nd dose is due by <b>$s1_year4</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                  $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                  <br> $syringe 5th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                  <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                  <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_var'>Administer Varicella</button> 
          </small>
        </div>
      ";
    $var_schedule = "
      <div style='margin-top: 6px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>VAR</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$var1</small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_var'><small>OVERDUE</small></button>
      </div>
      ";
  }
  if(mysqli_num_rows($var_req_run) == 2){
    $var_message = "
       <div align='center'>
          <small>
            <div class='row col-md-12 mb-3'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  Varicella series is complete! The following vaccines and other immunization agents should be administered today:
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                  $syringe 2nd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mmr.pdf' class='text-decoration-none' target='_blank'>MMR</a>
                  <br> $syringe 5th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                  <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  <br> $syringe 1 or more doses of updated vaccine - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                  <br> $syringe 1 or 2 doses of annual vaccination - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          </small>
        </div>
      ";
    $var_schedule = "
        <div style='margin-top: 6px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>VAR</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$var1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$var2</small></button>
        </div>
      ";
  }

  // Count Administered Hepatitis A
  $hepa = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='Hepatitis A' ";
  $hepa_run = mysqli_query($con, $hepa);
  $hepa_value = mysqli_fetch_assoc($hepa_run);
  $hepa_count = round($hepa_value['count(*)'] / 2 * 100);
  // Recommended dates to administer Varicella Vaccine
  $hepa_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='Hepatitis A' ORDER BY id DESC";
  $hepa_req_run = mysqli_query($con, $hepa_req);
  // Schedule
  foreach ($hepa_req_run as $row){
    if($row['seriesID'] == 1){
      $hepa1 = strtotime($row['date']);
      $hepa1 = date('m/d/Y',$hepa1);
      $v1_month6 = strtotime("+6 months", strtotime($hepa1));
      $v1_month6 = date('Y-m-d',$v1_month6);
      $s1_month6 = strtotime("+6 months", strtotime($hepa1));
      $s1_month6 = date('m/d/Y',$s1_month6);
    }
    if($row['seriesID'] == 2){
      $hepa2 = strtotime($row['date']);
      $hepa2 = date('m/d/Y',$hepa2);
    }
  }
  if(mysqli_num_rows($hepa_req_run) == 0 && $date <= $month12old_){
   $hepa_message = "
      <small>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>  
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepa'>Administer Hepatitis A</button> 
    ";
    $hepa_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hep A</b></small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hepa'><small>$month12old</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month18old</small></button>
      </div>
    ";
  }
  elseif(mysqli_num_rows($hepa_req_run) == 0 && $date > $month12old_){
    $hepa_message = "
       <small>
         Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
         Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
       </small>  
       <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepa'>Administer Hepatitis A</button> 
     ";
    $hepa_schedule = "
       <div style='margin-top: 5px'>
         <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hep A</b></small></button>
         <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hepa'><small>OVERDUE</small></button>
         <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$month18old</small></button>
       </div>
     ";
  }
  if(mysqli_num_rows($hepa_req_run) == 1 && $date <= $v1_month6){
    $hepa_message = "
       <div align='center'>
          <small>
            <div class='row col-md-12 mb-3'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  2nd dose is due by <b>$s1_month6</b> along with the following vaccines and other immunization agents (routine or catch-up):
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                  $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                  <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                  <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                  <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepa'>Administer Hep A</button> 
          </small>
        </div>
      ";
    $hepa_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hep A</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hepa1</small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hepa'><small>$s1_month6</small></button>
      </div>
    ";
  }
  elseif(mysqli_num_rows($hepa_req_run) == 1 && $date <= $v1_month6){
    $hepa_message = "
       <div align='center'>
          <small>
            <div class='row col-md-12 mb-3'>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-4'>
                  2nd dose is due by <b>$s1_month6</b> along with the following vaccines and other immunization agents (routine or catch-up):
                </div>
              </div>
              <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                  $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                  <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                  <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                  <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                  <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <button type='button' class='focus-ring btn btn-sm border mt-4' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepa'>Administer Hep A</button> 
          </small>
        </div>
      ";
    $hepa_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hep A</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hepa1</small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hepa'><small>OVERDUE</small></button>
      </div>
    ";
  }
  if(mysqli_num_rows($hepa_req_run) == 2){
    $hepa_message = "
      <div align='center'>
        <small>
          <div class='row col-md-12 mb-3'>
            <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
              <div class='card-body mt-4'>
                Hepatitis A series is complete! The following vaccines and other immunization agents should be administered today as a routine or catch-up:
              </div>
            </div>
            <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
              <div class='card-body'>
                $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hep-b.pdf' class='text-decoration-none' target='_blank'>Hep B</a>
                <br> $syringe 4th dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/dtap.pdf' class='text-decoration-none' target='_blank'>DTaP</a>
                <br> $syringe 3rd dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/ipv.pdf' class='text-decoration-none' target='_blank'>IPV</a>
                <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
              </div>
            </div>
          </div>
          Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
        </small>
      </div>
      ";
    $hepa_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Hep A</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hepa1</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hepa2</small></button>
      </div>
      ";
  }

  // Count Administered Tdap
  $tdap = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='Tdap' ";
  $tdap_run = mysqli_query($con, $tdap);
  $tdap_value = mysqli_fetch_assoc($tdap_run);
  $tdap_count = round($tdap_value['count(*)'] / 1 * 100);
  // Tdap Complete
  $tdap_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='Tdap' ORDER BY id DESC";
  $tdap_req_run = mysqli_query($con, $tdap_req);
  // Schedule
  foreach ($tdap_req_run as $row){
    if($row['seriesID'] == 1){
      $tdap1 = strtotime($row['date']);
      $tdap1 = date('m/d/Y',$tdap1);
    }
  }
  if(mysqli_num_rows($tdap_req_run) == 0 && $date <= $year11old_){
      $tdap_message = "
        <small>
          Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        </small>
        <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_tdap'>Administer Tdap</button> 
      ";
      $tdap_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Tdap</b></small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_tdap'><small>$year11old</small></button>
      </div>
    ";
  }
  elseif(mysqli_num_rows($tdap_req_run) == 0 && $date > $year11old_){
    $tdap_message = "
      <small>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_tdap'>Administer Tdap</button> 
      ";
    $tdap_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Tdap</b></small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_tdap'><small>OVERDUE</small></button>
      </div>
      ";
  }
  if(mysqli_num_rows($tdap_req_run) == 1){
    $tdap_message = "
      <div align='center'>
        <small>
          <div class='row col-md-12 mb-3'>
            <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
              <div class='card-body mt-4'>
                Tdap series is complete! The following vaccines and other immunization agents should be administered today as a routine or catch-up:
              </div>
            </div>
            <div class='col card border-0 m-1 mt-1' align='left' style='background-color: #e8e8e8'>
              <div class='card-body'>
                $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/hpv.pdf' class='text-decoration-none' target='_blank'>HPV</a>
                <br> $syringe 1st dose - <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/mcv.pdf' class='text-decoration-none' target='_blank'>MCV</a>
                <br> $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
              </div>
            </div>
          </div>
          Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a>
        </small>
      </div>
      ";
    $tdap_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Tdap</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$tdap1</small></button>
      </div>
      ";
  }

  // Count Administered HPV
  $hpv = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='HPV' ";
  $hpv_run = mysqli_query($con, $hpv);
  $hpv_value = mysqli_fetch_assoc($hpv_run);
  $hpv_count = round($hpv_value['count(*)'] / 2 * 100);
  // Recommended dates to administer 2nd & 3rd dose of Hep B
  $hpv_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='HPV' ORDER BY id DESC";
  $hpv_req_run = mysqli_query($con, $hpv_req);
  // Schedule
  foreach ($hpv_req_run as $row){
    if($row['seriesID'] == 1){
      $hpv1 = strtotime($row['date']);
      $hpv1 = date('m/d/Y',$hpv1);
      $v1_month6 = strtotime("+6 months", strtotime($hpv1));
      $v1_month6 = date('Y-m-d',$v1_month6);
      $s1_month6 = strtotime("+6 months", strtotime($hpv1));
      $s1_month6 = date('m/d/Y',$s1_month6);
    }
    if($row['seriesID'] == 2){
      $hpv2 = strtotime($row['date']);
      $hpv2 = date('m/d/Y',$hpv2);
    }
    if($row['seriesID'] == 3){
      $hpv3 = strtotime($row['date']);
      $hpv3 = date('m/d/Y',$hpv3);
    }
  }
  if(mysqli_num_rows($hpv_req_run) == 0 && $date <= $year11old_){
      $hpv_message = "
        <small>
          Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        </small>
        <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hpv'>Administer HPV</button> 
      ";
      $hpv_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>HPV</b></small></button>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hpv'><small>$year11old</small></button>
          <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year11_6month_old</small></button>
        </div>
      ";
  }
  elseif(mysqli_num_rows($hpv_req_run) == 0 && $date > $year11old_){
    $hpv_message = "
      <small>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hpv'>Administer HPV</button> 
    ";
    $hpv_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>HPV</b></small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hpv'><small>OVERDUE</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year11_6month_old</small></button>
      </div>
    ";
  }
  if(mysqli_num_rows($hpv_req_run) == 1 && $date <= $year11old_){
    $hpv_message = "
          <div align='center'>
            <small>
              <div class='mb-3 row col-md-12'>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body mt-2'>
                    2nd dose is due by <b>$s1_month6</b> along with the following vaccines and other immunization agents:
                  </div>
                </div>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                   <div class='card-body'>
                      $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                      <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                   </div>
                </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              <button type='button' class='focus-ring btn btn-sm border mt-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hpv'>Administer HPV</button> 
            </small>
          </div>
        ";
      $hpv_schedule = "
          <div style='margin-top: 5px'>
            <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>HPV</b></small></button>
            <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hpv1</small></button>
            <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hpv'><small>$s1_month6</small></button>
          </div>
        ";
      $hpv_recommendation = "
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
  elseif(mysqli_num_rows($hpv_req_run) == 1 && $date > $year11old_){
    $hpv_message = "
          <div align='center'>
            <small>
              <div class='mb-3 row col-md-12'>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body mt-2'>
                    2nd dose is due by <b>$s1_month6</b> along with the following vaccines and other immunization agents:
                  </div>
                </div>
                <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                   <div class='card-body'>
                      $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                      <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                   </div>
                </div>
              </div>
              Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
              <button type='button' class='focus-ring btn btn-sm border mt-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hpv'>Administer HPV</button> 
            </small>
          </div>
        ";
    $hpv_schedule = "
          <div style='margin-top: 5px'>
            <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>HPV</b></small></button>
            <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hpv1</small></button>
            <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hpv'><small>OVERDUE</small></button>
          </div>
        ";
    $hpv_recommendation = "
          <div align='center'>
            <small>
              <div class='mb-3' align='left'>
              <b>Due on $s1_month6:</b><br>
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
  if(mysqli_num_rows($hpv_req_run) == 2 && $date <= $year14old_){ 
    $hpv_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-2'>
                  HPV series is complete! The following vaccines and other immunization agents should be administered today:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          </small>
        </div>
      ";
    $hpv_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>HPV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hpv1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hpv2</small></button>
        </div>
      ";
  }
  elseif(mysqli_num_rows($hpv_req_run) == 2 && $date > $year14old_){ 
    $hpv_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-2'>
                  HPV series is complete! The following vaccines and other immunization agents should be administered today:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          </small>
        </div>
      ";
    $hpv_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>HPV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hpv1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hpv2</small></button>
        </div>
      ";
  }
  if(mysqli_num_rows($hpv_req_run) == 0 && $date >= $year15old_){
    $hpv_message = "
      <small>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hpv'>Administer HPV</button> 
    ";
    $hpv_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>HPV</b></small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hpv'><small>OVERDUE</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year15years_2months</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year15years_6months</small></button>
      </div>
    ";
  }
  if(mysqli_num_rows($hpv_req_run) == 1 && $date == $year15years_2months_){
    $hpv_message = "
      <small>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hpv'>Administer HPV</button> 
    ";
    $hpv_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>HPV</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hpv1</small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hpv'><small>$year15years_2months</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year15years_6months</small></button>
      </div>
    ";
  }
  elseif(mysqli_num_rows($hpv_req_run) == 1 && $date > $year15years_2months_){
    $hpv_message = "
      <small>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hpv'>Administer HPV</button> 
    ";
    $hpv_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>HPV</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hpv1</small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hpv'><small>OVERDUE</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year15years_6months</small></button>
      </div>
    ";
  }
  if(mysqli_num_rows($hpv_req_run) == 2 && $date == $year15years_6months_){
    $hpv_message = "
      <small>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hpv'>Administer HPV</button> 
    ";
    $hpv_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>HPV</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hpv1</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hpv2</small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hpv'><small>$year15years_6months</small></button>
      </div>
    ";
  }
  elseif(mysqli_num_rows($hpv_req_run) == 2 && $date > $year15years_6months_){
    $hpv_message = "
      <small>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hpv'>Administer HPV</button> 
    ";
    $hpv_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>HPV</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hpv1</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hpv2</small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_hpv'><small>OVERDUE</small></button>
      </div>
    ";
  }
  if(mysqli_num_rows($hpv_req_run) == 3){ 
    $hpv_message = "
        <div align='center'>
          <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-2'>
                  HPV series is complete! The following vaccines and other immunization agents should be administered today:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body'>
                    $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          </small>
        </div>
      ";
    $hpv_schedule = "
        <div style='margin-top: 5px'>
          <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>HPV</b></small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hpv1</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hpv2</small></button>
          <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$hpv3</small></button>
        </div>
      ";
  }

  // Count Administered MCV
  $mcv = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='MCV' ";
  $mcv_run = mysqli_query($con, $mcv);
  $mcv_value = mysqli_fetch_assoc($mcv_run);
  $mcv_count = round($mcv_value['count(*)'] / 2 * 100);
  // Recommended dates to administer MCV
  $mcv_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='MCV' ORDER BY id DESC";
  $mcv_req_run = mysqli_query($con, $mcv_req);
  // Schedule
  foreach ($mcv_req_run as $row){
    if($row['seriesID'] == 1){
      $mcv1 = strtotime($row['date']);
      $mcv1 = date('m/d/Y',$mcv1);
      $v1_year15 = strtotime("+15 years", strtotime($mcv1));
      $v1_year15 = date('Y-m-d',$v1_year15);
      $s1_year15 = strtotime("+15 years", strtotime($mcv1));
      $s1_year15 = date('m/d/Y',$s1_year15);
    }
    if($row['seriesID'] == 2){
      $mcv2 = strtotime($row['date']);
      $mcv2 = date('m/d/Y',$mcv2);
    }
  }
  if(mysqli_num_rows($mcv_req_run) == 0 && $date <= $year11old_){
   $mcv_message = "
      <small>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
      </small>
      <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_mcv'>Administer MCV</button> 
    ";
    $mcv_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>MCV</b></small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_mcv'><small>$year11old</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year16old</small></button>
      </div>
    ";
  }
  elseif(mysqli_num_rows($mcv_req_run) == 0 && $date > $year11old_){
    $mcv_message = "
       <small>
         Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
         Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
       </small>
       <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_mcv'>Administer MCV</button> 
     ";
     $mcv_schedule = "
       <div style='margin-top: 5px'>
         <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>MCV</b></small></button>
         <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_mcv'><small>OVERDUE</small></button>
         <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year16old</small></button>
       </div>
     ";
  }
  if(mysqli_num_rows($mcv_req_run) == 1 && $date <= $v1_year15){
    $mcv_message = "
      <div align='center'>
         <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-2'>
                  2nd dose is due on <b>$s1_year15</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                    $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                  </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_mcv'>Administer MCV</button> 
         </small>
      </div>
    ";
    $mcv_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>MCV</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$mcv1</small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_mcv'><small>$s1_year15</small></button>
      </div>
    ";
  }
  elseif(mysqli_num_rows($mcv_req_run) == 1 && $date > $v1_year15){
    $mcv_message = "
      <div align='center'>
         <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-2'>
                  2nd dose is due on <b>$s1_year15</b> along with the following vaccines and other immunization agents:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                    $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                  </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_mcv'>Administer MCV</button> 
         </small>
      </div>
      ";
    $mcv_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>MCV</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$mcv1</small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_mcv'><small>OVERDUE</small></button>
      </div>
    ";
  }
  if(mysqli_num_rows($mcv_req_run) == 2){
    $mcv_message = "
       <div align='center'>
        <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-2'>
                  MCV series is complete! The following vaccines and other immunization agents should be administered today:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                    $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                  </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          </small>
        </div>
      ";
    $mcv_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>MCV</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$mcv1</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$mcv2</small></button>
      </div>
    ";
  }

  // Count Administered Men B
  $menb = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='Men B' ";
  $menb_run = mysqli_query($con, $menb);
  $menb_value = mysqli_fetch_assoc($menb_run);
  $menb_count = round($menb_value['count(*)'] / 2 * 100);
  // Recommended dates to administer MCV
  $menb_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='Men B' ORDER BY id DESC";
  $menb_req_run = mysqli_query($con, $menb_req);
  // Schedule
  foreach ($menb_req_run as $row){
    if($row['seriesID'] == 1){
      $menb1 = strtotime($row['date']);
      $menb1 = date('m/d/Y',$menb1);
      $v1_month1 = strtotime("+1 months", strtotime($menb1));
      $v1_month1 = date('Y-m-d',$v1_month1);
      $s1_month1 = strtotime("+1 months", strtotime($menb1));
      $s1_month1 = date('m/d/Y',$s1_month1);
    }
    if($row['seriesID'] == 2){
      $menb2 = strtotime($row['date']);
      $menb2 = date('m/d/Y',$menb2);
    }
  }
  if(mysqli_num_rows($menb_req_run) == 0 && $date <= $year15old_){
   $menb_message = "
      <small>
        <div class='mb-3 row col-md-12'>
          <div class='col card border-0 m-2' align='left' style='background-color: #e8e8e8'>
            <div class='card-body mt-2'>
              <b>Adolescents not at increased risk</b> age 16–23 years (preferred age 16–18 years) based on shared clinical decision-making:<br>
              1st dose is recommended by <b>$year16old - $year18old</b>
            </div>
          </div>
          <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
              <div class='card-body'>
                $syringe <b>Bexsero</b>: 2-dose series at least 1 month apart
                <br> $syringe <b>Trumenba</b>: 2-dose series at least 6 months apart (if dose 2 is administered earlier than 6 months, administer a 3rd dose at least 4 months after dose 2)
              </div>
          </div>
        </div>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_menb'>Administer Men B</button> 
      </small>
    ";
    $menb_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Men B</b></small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_menb'><small>$year16old</small></button>
        <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year16_1month_old</small></button>
      </div>
    ";
  }
  elseif(mysqli_num_rows($menb_req_run) == 0 && $date > $year15old_){
    $menb_message = "
       <small>
         <div class='mb-3 row col-md-12'>
           <div class='col card border-0 m-2' align='left' style='background-color: #e8e8e8'>
             <div class='card-body mt-2'>
               <b>Adolescents not at increased risk</b> age 16–23 years (preferred age 16–18 years) based on shared clinical decision-making:<br>
               1st dose is recommended by <b>$year16old - $year18old</b>
             </div>
           </div>
           <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
               <div class='card-body'>
                 $syringe <b>Bexsero</b>: 2-dose series at least 1 month apart
                 <br> $syringe <b>Trumenba</b>: 2-dose series at least 6 months apart (if dose 2 is administered earlier than 6 months, administer a 3rd dose at least 4 months after dose 2)
               </div>
           </div>
         </div>
         Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
         Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
         <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_menb'>Administer Men B</button> 
       </small>
     ";
    $menb_schedule = "
       <div style='margin-top: 5px'>
         <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Men B</b></small></button>
         <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_menb'><small>OVERDUE</small></button>
         <button id='btn_schedule' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$year16_1month_old</small></button>
       </div>
     ";
  }
  if(mysqli_num_rows($menb_req_run) == 1 && $date <= $v1_month1){
    $menb_message = "
      <small>
        <div class='mb-3 row col-md-12'>
          <div class='col card border-0 m-2' align='left' style='background-color: #e8e8e8'>
            <div class='card-body mt-2'>
              2nd dose is due by:<br>
              <b>Bexsero: $s1_month1</b><br>
              <b>Trumenba: $s1_month1</b><br>
            </div>
          </div>
          <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
              <div class='card-body'>
                $syringe <b>Bexsero</b>: 2-dose series at least 1 month apart
                <br> $syringe <b>Trumenba</b>: 2-dose series at least 6 months apart (if dose 2 is administered earlier than 6 months, administer a 3rd dose at least 4 months after dose 2)
              </div>
          </div>
        </div>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_menb'>Administer Men B</button> 
      </small>
    ";
    $menb_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Men B</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$menb1</small></button>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_menb'><small>$s1_month1</small></button>
      </div>
    ";
    
  }
  elseif(mysqli_num_rows($menb_req_run) == 1 && $date > $v1_month1){
    $menb_message = "
      <small>
        <div class='mb-3 row col-md-12'>
          <div class='col card border-0 m-2' align='left' style='background-color: #e8e8e8'>
            <div class='card-body mt-2'>
              2nd dose is due by:<br>
              <b>Bexsero: $s1_month1</b><br>
              <b>Trumenba: $s1_month1</b><br>
            </div>
          </div>
          <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
              <div class='card-body'>
                $syringe <b>Bexsero</b>: 2-dose series at least 1 month apart
                <br> $syringe <b>Trumenba</b>: 2-dose series at least 6 months apart (if dose 2 is administered earlier than 6 months, administer a 3rd dose at least 4 months after dose 2)
              </div>
          </div>
        </div>
        Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
        <button type='button' class='focus-ring btn btn-sm border mt-4 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_menb'>Administer Men B</button> 
      </small>
      ";
    $menb_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Men B</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$menb1</small></button>
        <button id='btn_overdue' class='focus-ring py-1 px-2 btn btn-sm border rounded-3' data-bs-toggle='modal' data-bs-target='#administer_menb'><small>OVERDUE</small></button>
      </div>
      ";
    
  }
  if(mysqli_num_rows($menb_req_run) == 2){
    $menb_message = "
       <div align='center'>
        <small>
            <div class='mb-3 row col-md-12'>
              <div class='col card border-0 m-2' align='left' style='background-color: #e8e8e8'>
                <div class='card-body mt-2'>
                  Men B series is complete! The following vaccines and other immunization agents should be administered today:
                </div>
              </div>
              <div class='col card border-0 m-2 mt-2' align='left' style='background-color: #e8e8e8'>
                  <div class='card-body'>
                    $syringe 1 or more doses of updated <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/COVID-19.pdf' class='text-decoration-none' target='_blank'>COVID-19</a>
                    <br> $syringe 1 or 2 doses of annual <a href='https://www.cdc.gov/vaccines/hcp/vis/vis-statements/flu.pdf' class='text-decoration-none' target='_blank'>Influenza</a>
                  </div>
              </div>
            </div>
            Immunization Schedule <a href='https://www.cdc.gov/vaccines/schedules/hcp/index.html' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
            Combination Vaccines with Other Immunization Agents <a href='https://eziz.org/assets/docs/IMM-922.pdf' target='_blank'><i class='bi bi-info-circle' style='color:blue'></i></a><br>
          </small>
        </div>
    ";
    $menb_schedule = "
      <div style='margin-top: 5px'>
        <button id='btn_schedule' class='focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3' disabled><small><b>Men B</b></small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$menb1</small></button>
        <button id='btn_complete' class='py-1 px-2 btn btn-sm border rounded-3' style='cursor:default'><small>$menb2</small></button>
      </div>
    ";
  }

  // Count Administered COVID-19
  $covid = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='COVID' ";
  $covid_run = mysqli_query($con, $covid);
  $covid_value = mysqli_fetch_assoc($covid_run);
  $covid_count = round($covid_value['count(*)'] / 20 * 100);
  // Recommended dates to administer COVID-19
  $covid_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='COVID' ORDER BY id DESC";
  $covid_req_run = mysqli_query($con, $covid_req);
  if(mysqli_num_rows($covid_req_run) == 0){
   $covid_message = "
   <small><a href='https://www.cdc.gov/vaccines/schedules/hcp/imz/child-adolescent.html' target='_blank'>Immunization Schedule</a></small><br>
   <button type='button' class='focus-ring btn btn-sm border mt-5 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_covid'>Administer COVID-19</button> 
    ";
  }
  if(mysqli_num_rows($covid_req_run) > 0){
    $row = mysqli_fetch_assoc($covid_req_run);
    $date = $row['date'];
    $month4 = strtotime("+2 months", strtotime($date));
    $month4 = date('m/d/Y',$month4);
 
    $covid_message = "
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
            <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_covid'>Administer COVID-19</button> 
          </small>
        </div>
    ";
  }

  // Count Administered Influenza
  $flu = "SELECT count(*) FROM immunization WHERE patientID='$patientID' AND type='Influenza' ";
  $flu_run = mysqli_query($con, $flu);
  $flu_value = mysqli_fetch_assoc($flu_run);
  $flu_count = round($flu_value['count(*)'] / 20 * 100);
  // Recommended dates to administer Influenza Vaccine
  $flu_req = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='COVID' ORDER BY id DESC";
  $flu_req_run = mysqli_query($con, $flu_req);
  if(mysqli_num_rows($flu_req_run) == 0){
   $flu_message = "
   <small><a href='https://www.cdc.gov/vaccines/schedules/hcp/imz/child-adolescent.html' target='_blank'>Immunization Schedule</a></small><br>
   <button type='button' class='focus-ring btn btn-sm border mt-5 mb-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_flu'>Administer Influenza Vaccine</button> 
    ";
  }
  if(mysqli_num_rows($flu_req_run) > 0){
    $flu_message = "
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
            <button type='button' class='focus-ring btn btn-sm border mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_covid'>Administer COVID-19</button> 
          </small>
        </div>
    ";
  }
}
?>