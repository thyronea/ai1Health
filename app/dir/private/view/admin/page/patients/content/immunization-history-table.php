<div class="tab-pane fade show active" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab" tabindex="2">
  <div class="row m-4">
    <div class="col">
      <!-- Routine Vaccine History -->
      <div class="card mb-3">
        <div class="card-body">
          <table class="focus-ring table table-sm text-nowrap table-borderless">
            <tbody>
              <!-- Hep B-->
              <tr>
                <?php
                $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                $engineID = htmlspecialchars($patient['engineID']);
                $hepb1st = htmlspecialchars('1st Hep B');
                $iz_hepB_1st = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='$hepb1st' ";
                $iz_hepB_1st_run = mysqli_query($con, $iz_hepB_1st);
                if(mysqli_num_rows($iz_hepB_1st_run) > 0 )
                {
                  foreach ($iz_hepB_1st_run as $hepB_1st){}
                }
                $hepb2nd = htmlspecialchars('2nd Hep B');
                $iz_hepB_2nd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='$hepb2nd' ";
                $iz_hepB_2nd_run = mysqli_query($con, $iz_hepB_2nd);
                if(mysqli_num_rows($iz_hepB_2nd_run) > 0 )
                {
                  foreach ($iz_hepB_2nd_run as $hepB_2nd){}
                }
                $hepb3rd = htmlspecialchars('3rd Hep B');
                $iz_hepB_3rd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='$hepb3rd' ";
                $iz_hepB_3rd_run = mysqli_query($con, $iz_hepB_3rd);
                if(mysqli_num_rows($iz_hepB_3rd_run) > 0 )
                {
                  foreach ($iz_hepB_3rd_run as $hepB_3rd){}
                }
                ?>
                <th><small>Hepatitis B:</small></th>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#hepB_1st-Modal" style="color:#FF8B00"><?= $hepB_1st['1st']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#hepB_2nd-Modal" style="color:#E08406"><?= $hepB_2nd['2nd']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#hepB_3rd-Modal" style="color:#C0A900"><?= $hepB_3rd['3rd']; ?></a></small></td>
              </tr>

              <!-- Rotavirus -->
              <tr>
                <?php
                $engineID = htmlspecialchars($patient['engineID']);
                $iz_rv_1st = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='1st Rotavirus' ";
                $iz_rv_1st_run = mysqli_query($con, $iz_rv_1st);
                if(mysqli_num_rows($iz_rv_1st_run) > 0 )
                {
                  foreach ($iz_rv_1st_run as $rv_1st){}
                }
                $iz_rv_2nd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='2nd Rotavirus' ";
                $iz_rv_2nd_run = mysqli_query($con, $iz_rv_2nd);
                if(mysqli_num_rows($iz_rv_2nd_run) > 0 )
                {
                  foreach ($iz_rv_2nd_run as $rv_2nd){}
                }
                $iz_rv_3rd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='3rd Rotavirus' ";
                $iz_rv_3rd_run = mysqli_query($con, $iz_rv_3rd);
                if(mysqli_num_rows($iz_rv_3rd_run) > 0 )
                {
                  foreach ($iz_rv_3rd_run as $rv_3rd){}
                }
                ?>
                <th><small>Rotavirus:</small></th>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#rv_1st-Modal" style="color:#FF8B00"><?= $rv_1st['1st']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#rv_2nd-Modal" style="color:#E08406"><?= $rv_2nd['2nd']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#rv_3rd-Modal" style="color:#C0A900"><?= $rv_3rd['3rd']; ?></a></small></td>
              </tr>

              <!-- DTaP -->
              <tr>
                <?php
                $engineID = htmlspecialchars($patient['engineID']);
                $iz_dtap_1st = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='1st DTaP' ";
                $iz_dtap_1st_run = mysqli_query($con, $iz_dtap_1st);
                if(mysqli_num_rows($iz_dtap_1st_run) > 0 )
                {
                  foreach ($iz_dtap_1st_run as $dtap_1st){}
                }
                $iz_dtap_2nd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='2nd DTaP' ";
                $iz_dtap_2nd_run = mysqli_query($con, $iz_dtap_2nd);
                if(mysqli_num_rows($iz_dtap_2nd_run) > 0 )
                {
                  foreach ($iz_dtap_2nd_run as $dtap_2nd){}
                }
                $iz_dtap_3rd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='3rd DTaP' ";
                $iz_dtap_3rd_run = mysqli_query($con, $iz_dtap_3rd);
                if(mysqli_num_rows($iz_dtap_3rd_run) > 0 )
                {
                  foreach ($iz_dtap_3rd_run as $dtap_3rd){}
                }
                $iz_dtap_4th = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='4th DTaP' ";
                $iz_dtap_4th_run = mysqli_query($con, $iz_dtap_4th);
                if(mysqli_num_rows($iz_dtap_4th_run) > 0 )
                {
                  foreach ($iz_dtap_4th_run as $dtap_4th){}
                }
                $iz_dtap_5th = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='5th DTaP' ";
                $iz_dtap_5th_run = mysqli_query($con, $iz_dtap_5th);
                if(mysqli_num_rows($iz_dtap_5th_run) > 0 )
                {
                  foreach ($iz_dtap_5th_run as $dtap_5th){}
                }
                ?>
                <th><small>DTaP:</small></th>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#dtap_1st-Modal" style="color:#FF8B00"><?= $dtap_1st['1st']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#dtap_2nd-Modal" style="color:#E08406"><?= $dtap_2nd['2nd']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#dtap_3rd-Modal" style="color:#C0A900"><?= $dtap_3rd['3rd']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#dtap_4th-Modal" style="color:#059D00"><?= $dtap_4th['4th']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#dtap_5th-Modal" style="color:#007C13"><?= $dtap_5th['5th']; ?></a></small></td>
              </tr>

              <!-- Hib -->
              <tr>
                <?php
                $engineID = htmlspecialchars($patient['engineID']);

                $iz_hib_1st = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='1st Hib' ";
                $iz_hib_1st_run = mysqli_query($con, $iz_hib_1st);
                if(mysqli_num_rows($iz_hib_1st_run) > 0 )
                {
                  foreach ($iz_hib_1st_run as $hib_1st){}
                }

                $iz_hib_2nd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='2nd Hib' ";
                $iz_hib_2nd_run = mysqli_query($con, $iz_hib_2nd);
                if(mysqli_num_rows($iz_hib_2nd_run) > 0 )
                {
                  foreach ($iz_hib_2nd_run as $hib_2nd){}
                }

                $iz_hib_3rd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='3rd Hib' ";
                $iz_hib_3rd_run = mysqli_query($con, $iz_hib_3rd);
                if(mysqli_num_rows($iz_hib_3rd_run) > 0 )
                {
                  foreach ($iz_hib_3rd_run as $hib_3rd){}
                }

                $iz_hib_4th = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='4th Hib' ";
                $iz_hib_4th_run = mysqli_query($con, $iz_hib_4th);
                if(mysqli_num_rows($iz_hib_4th_run) > 0 )
                {
                  foreach ($iz_hib_4th_run as $hib_4th){}
                }
                ?>
                <th><small>Hib:</small></th>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#hib_1st-Modal" style="color:#FF8B00"><?= $hib_1st['1st']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#hib_2nd-Modal" style="color:#E08406"><?= $hib_2nd['2nd']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#hib_3rd-Modal" style="color:#C0A900"><?= $hib_3rd['3rd']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#hib_4th-Modal" style="color:#059D00"><?= $hib_4th['4th']; ?></a></small></td>
              </tr>

              <!-- Pneumococcal -->
              <tr>
                <?php
                $engineID = htmlspecialchars($patient['engineID']);

                $iz_pcv_1st = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='1st PCV' ";
                $iz_pcv_1st_run = mysqli_query($con, $iz_pcv_1st);
                if(mysqli_num_rows($iz_pcv_1st_run) > 0 )
                {
                  foreach ($iz_pcv_1st_run as $pcv_1st){}
                }

                $iz_pcv_2nd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='2nd PCV' ";
                $iz_pcv_2nd_run = mysqli_query($con, $iz_pcv_2nd);
                if(mysqli_num_rows($iz_pcv_2nd_run) > 0 )
                {
                  foreach ($iz_pcv_2nd_run as $pcv_2nd){}
                }

                $iz_pcv_3rd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='3rd PCV' ";
                $iz_pcv_3rd_run = mysqli_query($con, $iz_pcv_3rd);
                if(mysqli_num_rows($iz_pcv_3rd_run) > 0 )
                {
                  foreach ($iz_pcv_3rd_run as $pcv_3rd){}
                }

                $iz_pcv_4th = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='4th PCV' ";
                $iz_pcv_4th_run = mysqli_query($con, $iz_pcv_4th);
                if(mysqli_num_rows($iz_pcv_4th_run) > 0 )
                {
                  foreach ($iz_pcv_4th_run as $pcv_4th){}
                }
                ?>
                <th><small>Pneumococcal:</small></th>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#pcv_1st-Modal" style="color:#FF8B00"><?= $pcv_1st['1st']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#pcv_2nd-Modal" style="color:#E08406"><?= $pcv_2nd['2nd']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#pcv_3rd-Modal" style="color:#C0A900"><?= $pcv_3rd['3rd']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#pcv_4th-Modal" style="color:#059D00"><?= $pcv_4th['4th']; ?></a></small></td>
              </tr>

              <!-- IPV -->
              <tr>
                <?php
                $engineID = htmlspecialchars($patient['engineID']);

                $iz_ipv_1st = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='1st IPV' ";
                $iz_ipv_1st_run = mysqli_query($con, $iz_ipv_1st);
                if(mysqli_num_rows($iz_ipv_1st_run) > 0 )
                {
                  foreach ($iz_ipv_1st_run as $ipv_1st){}
                }

                $iz_ipv_2nd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='2nd IPV' ";
                $iz_ipv_2nd_run = mysqli_query($con, $iz_ipv_2nd);
                if(mysqli_num_rows($iz_ipv_2nd_run) > 0 )
                {
                  foreach ($iz_ipv_2nd_run as $ipv_2nd){}
                }

                $iz_ipv_3rd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='3rd IPV' ";
                $iz_ipv_3rd_run = mysqli_query($con, $iz_ipv_3rd);
                if(mysqli_num_rows($iz_ipv_3rd_run) > 0 )
                {
                  foreach ($iz_ipv_3rd_run as $ipv_3rd){}
                }

                $iz_ipv_4th = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='4th IPV' ";
                $iz_ipv_4th_run = mysqli_query($con, $iz_ipv_4th);
                if(mysqli_num_rows($iz_ipv_4th_run) > 0 )
                {
                  foreach ($iz_ipv_4th_run as $ipv_4th){}
                }
                ?>
                <th><small>IPV:</small></th>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#ipv_1st-Modal" style="color:#FF8B00"><?= $ipv_1st['1st']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#ipv_2nd-Modal" style="color:#E08406"><?= $ipv_2nd['2nd']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#ipv_3rd-Modal" style="color:#C0A900"><?= $ipv_3rd['3rd']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#ipv_4th-Modal" style="color:#059D00"><?= $ipv_4th['4th']; ?></a></small></td>
              </tr>

              <!-- MMR -->
              <tr>
                <?php
                $engineID = htmlspecialchars($patient['engineID']);

                $iz_mmr_1st = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='1st MMR' ";
                $iz_mmr_1st_run = mysqli_query($con, $iz_mmr_1st);
                if(mysqli_num_rows($iz_mmr_1st_run) > 0 )
                {
                  foreach ($iz_mmr_1st_run as $mmr_1st){}
                }

                $iz_mmr_2nd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='2nd MMR' ";
                $iz_mmr_2nd_run = mysqli_query($con, $iz_mmr_2nd);
                if(mysqli_num_rows($iz_mmr_2nd_run) > 0 )
                {
                  foreach ($iz_mmr_2nd_run as $mmr_2nd){}
                }
                ?>
                <th><small>MMR:</small></th>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#mmr_1st-Modal" style="color:#FF8B00"><?= $mmr_1st['1st']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#mmr_2nd-Modal" style="color:#E08406"><?= $mmr_2nd['2nd']; ?></a></small></td>
              </tr>

              <!-- Varicella -->
              <tr>
                <?php
                $engineID = htmlspecialchars($patient['engineID']);

                $iz_var_1st = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='1st Varicella' ";
                $iz_var_1st_run = mysqli_query($con, $iz_var_1st);
                if(mysqli_num_rows($iz_var_1st_run) > 0 )
                {
                  foreach ($iz_var_1st_run as $var_1st){}
                }

                $iz_var_2nd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='2nd Varicella' ";
                $iz_var_2nd_run = mysqli_query($con, $iz_var_2nd);
                if(mysqli_num_rows($iz_var_2nd_run) > 0 )
                {
                  foreach ($iz_var_2nd_run as $var_2nd){}
                }
                ?>
                <th><small>Varicella:</small></th>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#var_1st-Modal" style="color:#FF8B00"><?= $var_1st['1st']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#var_2nd-Modal" style="color:#E08406"><?= $var_2nd['2nd']; ?></a></small></td>
              </tr>

              <!-- Hepatitis A -->
              <tr>
                <?php
                $engineID = htmlspecialchars($patient['engineID']);

                $iz_hepA_1st = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='1st Hep A' ";
                $iz_hepA_1st_run = mysqli_query($con, $iz_hepA_1st);
                if(mysqli_num_rows($iz_hepA_1st_run) > 0 )
                {
                  foreach ($iz_hepA_1st_run as $hepA_1st){}
                }

                $iz_hepA_2nd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='2nd Hep A' ";
                $iz_hepA_2nd_run = mysqli_query($con, $iz_hepA_2nd);
                if(mysqli_num_rows($iz_hepA_2nd_run) > 0 )
                {
                  foreach ($iz_hepA_2nd_run as $hepA_2nd){}
                }
                ?>
                <th><small>Hepatitis A:</small></th>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#hepA_1st-Modal" style="color:#FF8B00"><?= $hepA_1st['1st']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#hepA_2nd-Modal" style="color:#E08406"><?= $hepA_2nd['2nd']; ?></a></small></td>
              </tr>

              <!-- Tdap -->
              <tr>
                <?php
                $engineID = htmlspecialchars($patient['engineID']);
                $iz_tdap = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='Tdap' ";
                $iz_tdap_run = mysqli_query($con, $iz_tdap);
                if(mysqli_num_rows($iz_tdap_run) > 0 )
                {
                  foreach ($iz_tdap_run as $tdap_1st){}
                }
                ?>
                <th><small>Tdap:</small></th>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#tdap_1st-Modal" style="color:#FF8B00"><?= $tdap_1st['1st']; ?></a></small></td>
              </tr>

              <!-- Meningococcal -->
              <tr>
                <?php
                $engineID = htmlspecialchars($patient['engineID']);

                $iz_mcv_1st = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='1st MCV' ";
                $iz_mcv_1st_run = mysqli_query($con, $iz_mcv_1st);
                if(mysqli_num_rows($iz_mcv_1st_run) > 0 )
                {
                  foreach ($iz_mcv_1st_run as $mcv_1st){}
                }

                $iz_mcv_2nd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='2nd MCV' ";
                $iz_mcv_2nd_run = mysqli_query($con, $iz_mcv_2nd);
                if(mysqli_num_rows($iz_mcv_2nd_run) > 0 )
                {
                  foreach ($iz_mcv_2nd_run as $mcv_2nd){}
                }
                ?>
                <th><small>Meningococcal:</small></th>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#mcv_1st-Modal" style="color:#FF8B00"><?= $mcv_1st['1st']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#mcv_2nd-Modal" style="color:#E08406"><?= $mcv_2nd['2nd']; ?></a></small></td>
              </tr>

              <!-- HPV -->
              <tr>
                <?php
                $engineID = htmlspecialchars($patient['engineID']);
                $iz_hpv_1st = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='1st HPV' ";
                $iz_hpv_1st_run = mysqli_query($con, $iz_hpv_1st);
                if(mysqli_num_rows($iz_hpv_1st_run) > 0 )
                {
                  foreach ($iz_hpv_1st_run as $hpv_1st){}
                }
                $iz_hpv_2nd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='2nd HPV' ";
                $iz_hpv_2nd_run = mysqli_query($con, $iz_hpv_2nd);
                if(mysqli_num_rows($iz_hpv_2nd_run) > 0 )
                {
                  foreach ($iz_hpv_2nd_run as $hpv_2nd){}
                }
                $iz_hpv_3rd = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='3rd HPV' ";
                $iz_hpv_3rd_run = mysqli_query($con, $iz_hpv_3rd);
                if(mysqli_num_rows($iz_hpv_3rd_run) > 0 )
                {
                  foreach ($iz_hpv_3rd_run as $hpv_3rd){}
                }
                ?>
                <th><small>HPV:</small></th>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#hpv_1st-Modal" style="color:#FF8B00"><?= $hpv_1st['1st']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#hpv_2nd-Modal" style="color:#E08406"><?= $hpv_2nd['2nd']; ?></a></small></td>
                <td><small><a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#hpv_3rd-Modal" style="color:#C0A900"><?= $hpv_3rd['3rd']; ?></a></small></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="row">
        <!-- COVID-19 History -->
        <div class="card mb-3" style="height:209px;overflow:auto">
          <div class="card-body">
            <h6>COVID-19</h6>
            <table class="table table-borderless table-sm table-hover text-nowrap">
              <tbody align="center" style="text-align: left">
                <thead>
                  <th><small>Date</small></th>
                  <th><small>Vaccine</small></th>
                  <th><small>Lot</small></th>
                  <th><small>Expiration</small></th>
                </thead>
                <?php
                $engineID = htmlspecialchars($patient['engineID']);
                $vaccine = htmlspecialchars('COVID-19');
                $query = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='$vaccine' ";
                $query_run = mysqli_query($con, $query);
                if(mysqli_num_rows($query_run) > 0 )
                {
                  foreach($query_run as $covid)
                  {
                    ?>
                    <form class="" method="post">
                      <tr>
                        <td hidden><small><?= htmlspecialchars($covid['id']);?></small></td>
                        <td><small><a type="button" class="focus-ring border-none text-decoration-none covid-editbtn" data-bs-toggle="modal" data-bs-target="#covid-vaccine-Modal" style="color:black"><?= htmlspecialchars($covid['date']);?></a></small></td>
                        <td hidden><small><?= htmlspecialchars($covid['time']);?></small></td>
                        <td><small><a type="button" class="focus-ring border-none text-decoration-none covid-editbtn" data-bs-toggle="modal" data-bs-target="#covid-vaccine-Modal" style="color:black"><?= htmlspecialchars(decryptthis($covid['vaccine'], $key));?></a></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($covid['manufacturer'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($covid['ndc'], $key));?></small></td>
                        <td><small><a type="button" class="focus-ring border-none text-decoration-none covid-editbtn" data-bs-toggle="modal" data-bs-target="#covid-vaccine-Modal" style="color:black"><?= htmlspecialchars(decryptthis($covid['lot'], $key));?></a></small></td>
                        <td><small><a type="button" class="focus-ring border-none text-decoration-none covid-editbtn" data-bs-toggle="modal" data-bs-target="#covid-vaccine-Modal" style="color:black"><?= htmlspecialchars(decryptthis($covid['exp'], $key));?></a></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($covid['site'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($covid['route'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($covid['vis'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($covid['vis_given'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($covid['administered_by'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($covid['funding_source'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($covid['comment'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($covid['type'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars($covid['engineID']);?></small></td>
                        <td hidden><small><?= htmlspecialchars($covid['patientID']);?></small></td>
                        </tr>
                    </form>
                    <?php
                  }
                }
                else
                {
                ?>
                    <tr>
                      <td colspan="6" align="center"><small>No COVID-19 Data Found</small></td>
                    </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- Influenza History -->
        <div class="card" style="height:209px;overflow:auto">
          <div class="card-body">
            <h6>Influenza</h6>
            <table class="table table-borderless table-sm table-hover text-nowrap">
              <tbody align="center" style="text-align: left">
                <thead>
                  <th><small>Date</small></th>
                  <th><small>Vaccine</small></th>
                  <th><small>Lot</small></th>
                  <th><small>Expiration</small></th>
                </thead>
                <?php
                $engineID = htmlspecialchars($patient['engineID']);
                $vaccine = htmlspecialchars('Influenza');
                $query = "SELECT * FROM immunization WHERE groupID='$groupID' AND engineID='$engineID' AND type='$vaccine' ";
                $query_run = mysqli_query($con, $query);
                if(mysqli_num_rows($query_run) > 0 )
                {
                  foreach($query_run as $influenza)
                  {
                    ?>
                    <form class="" action="index.html" method="post">
                      <tr>
                        <td hidden><small><?= htmlspecialchars($influenza['id']);?></small></td>
                        <td><small><a type="button" class="focus-ring border-none text-decoration-none influenza-editbtn" data-bs-toggle="modal" data-bs-target="#influenza-vaccine-Modal" style="color:black"><?= htmlspecialchars($influenza['date']);?></a></small></td>
                        <td hidden><small><?= htmlspecialchars($influenza['time']);?></small></td>
                        <td><small><a type="button" class="focus-ring border-none text-decoration-none influenza-editbtn" data-bs-toggle="modal" data-bs-target="#influenza-vaccine-Modal" style="color:black"><?= htmlspecialchars(decryptthis($influenza['vaccine'], $key));?></a></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($influenza['manufacturer'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($influenza['ndc'], $key));?></small></td>
                        <td><small><a type="button" class="focus-ring border-none text-decoration-none influenza-editbtn" data-bs-toggle="modal" data-bs-target="#influenza-vaccine-Modal" style="color:black"><?= htmlspecialchars(decryptthis($influenza['lot'], $key));?></a></small></td>
                        <td><small><a type="button" class="focus-ring border-none text-decoration-none influenza-editbtn" data-bs-toggle="modal" data-bs-target="#influenza-vaccine-Modal" style="color:black"><?= htmlspecialchars(decryptthis($influenza['exp'], $key));?></a></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($influenza['site'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($influenza['route'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($influenza['vis'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($influenza['vis_given'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($influenza['administered_by'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($influenza['funding_source'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($influenza['comment'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars(decryptthis($influenza['type'], $key));?></small></td>
                        <td hidden><small><?= htmlspecialchars($influenza['engineID']);?></small></td>
                        <td hidden><small><?= htmlspecialchars($influenza['patientID']);?></small></td>
                      </tr>
                    </form>
                    <?php
                  }
                }
                else
                {
                ?>
                    <tr>
                      <td colspan="6" align="center"><small>No influenza Data Found</small></td>
                    </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
