<?php
$date = date('Y') . '-' . date('m') . '-' . date('d');
$decrypted_dob = htmlspecialchars(decryptthis($diversity['dob'], $key));
$year = (date('Y') - date('Y', strtotime($decrypted_dob)));
$dob = (date('m', strtotime($decrypted_dob)) . '/' . date('d', strtotime($decrypted_dob)) . '/' . date('Y', strtotime($decrypted_dob)));
?>

<div class="tab-pane fade show active" id="snapshot-tab-pane" role="tabpanel" aria-labelledby="snapshot-tab" tabindex="0">
  <div class="container user-select-none">
    <?php include('../../components/alert.php'); ?>
    <div class="row g-2">
      <div class="col">
        <div class="row g-2 mt-2">

          <!-- Profile Container -->
          <div class="col-md-6">
            <div class="card mb-2 shadow" style="height:16rem; overflow: auto;">
              <div class="card-header text-center">
                <?php include('modal/demographic/patient-add-image.php');?>
                <h6><?=htmlspecialchars(decryptthis($patient['fname'], $key));?> <?=htmlspecialchars(decryptthis($patient['lname'], $key));?> <?=htmlspecialchars(decryptthis($patient['suffix'], $key));?></h6>
              </div>
              <div class="card-body">
                <div class="row g-2">
                  <div class="col-md-4">
                            <?php
                                $patientID = mysqli_real_escape_string($con, $_GET['patientID']);
                                $query = " SELECT * FROM profile_image WHERE userID='$patientID' ";
                                $result = mysqli_query($con, $query);
                                if(mysqli_num_rows($result) > 0 ) {
                                  foreach($result as $pic){
                                    ?>
                                      <a type="button" data-bs-toggle="modal" data-bs-target="#patient-add-image">
                                        <img src="../../../image/profile/<?php echo $pic['filename'];?>" style="height: 130px; width: 130px;border-radius: 50%; object-fit:cover;">
                                      </a>
                                    <?php
                                  }
                                }
                              ?>
                    </div>
                  <div class="col-md-8">
                    <table class="focus-ring table table-sm text-nowrap table-borderless">
                      <tr>
                        <td align="right"><small><b>DOB:</b></small></td>
                        <td><small><?=htmlspecialchars($dob);?> (<?=htmlspecialchars($year);?> years old)</small></td>
                      </tr>
                      <tr>
                        <td align="right"><small><b>Patient ID:</b></small></td>
                        <td><small><?=htmlspecialchars($patient['patientID']);?></small></td>
                      </tr>
                      <tr>
                        <td align="right"><small><b>Health Plan:</b></small></td>
                        <td><small><?=decryptthis($plan['health_plan'], $key);?> - <?=decryptthis($plan['status'], $key);?></small></td>
                      </tr>
                      <tr>
                        <td align="right"><small><b>Policy #:</b></small></td>
                        <td><small><?=decryptthis($plan['policy_number'], $key);?></small></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div style="padding-left: 23px; padding-top: 5px">
                  <a title="Call Home Phone" type="button" class="focus-ring btn btn-sm border-0" href="tel:<?=htmlspecialchars(decryptthis($contact['phone'], $key));?>" style="color:black">
                    <i class="bi bi-telephone"></i>
                  </a>
                  <a title="Call Mobile" type="button" class="focus-ring btn btn-sm border-0" href="tel:<?=htmlspecialchars(decryptthis($contact['mobile'], $key));?>" style="color:black">
                    <i class="bi bi-phone"></i>
                  </a>
                  <a type="button" class="focus-ring btn btn-sm border-0 patient_emailbtn" data-bs-toggle="modal" data-bs-target="#patient-message">
                    <i class="bi bi-envelope"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Health Summary Container -->
          <div class="col-md-6">
            <div class="card mb-2 shadow" style="height:16rem; overflow: auto">
              <div class="card-header text-center" style="item-align: middle">
                <h6>Vitals</h6>
              </div>
              <div class="card-body">
                <div class="row g-2">
                  <div class="col-md-3">
                    <table class="focus-ring table table-sm text-nowrap table-borderless">
                      <tr>
                        <td align="right"><small><b>Height:</b></small></td>
                        <td><small>...</small></td>
                      </tr>
                      <tr>
                        <td align="right"><small><b>Weight:</b></small></td>
                        <td><small>...</small></td>
                      </tr>
                      <tr>
                        <td align="right"><small><b>BMI:</b></small></td>
                        <td><small>...</small></td>
                      </tr>
                      <tr>
                        <td align="right"><small><b>BP:</b></small></td>
                        <td><small>...</small></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Health Summary Container
          <div class="col">
            <div class="card mb-3 shadow" style="height:15rem">
              <div class="card-body">
                <h6>Health Summary</h6>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <small>
                      <table>
                        <th>History:</th>
                        <td></td>
                      </table>
                      <table>
                        <th>Allergies:</th>
                        <td></td>
                      </table>
                      <table>
                      <table>
                        <th>Medication:</th>
                        <td></td>
                      </table>
                    </small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          -->

        </div>

        <!-- Health Chart -->
        <div class="row g-2">
          <div class="col">
            <div class="card shadow" style="height:296px">
              <div class="card-header text-center">
                <h6>Health Summary</h6>
              </div>
              <div class="card-body">
                <div class='row mt-3'>
                  <div class='col'>
                    <?=$iz_recommendation?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Patient Log Container -->
      <div class="col-md-3 mt-4 mb-2">
        <div class="card shadow" style="width: auto;height:35rem; overflow:auto">
          <div class="card-body">
            <div class="card-headers">
              <table class="table table-borderless table-sm table-hover text-nowrap">
                <tbody align="center" style="text-align: left">
                  <?php
                  $patientID =  htmlspecialchars($patient['patientID']);
                  $query = "SELECT * FROM patientlog WHERE patientID='$patientID' AND groupID='$groupID' ORDER BY id DESC ";
                  $query_run = mysqli_query($con, $query);

                  if(mysqli_num_rows($query_run) > 0)
                  {
                    foreach($query_run as $patientLog)
                    {
                      ?>
                      <tr>
                        <td hidden><?=htmlspecialchars($patientLog['engineID']);?></td>
                        <td hidden><?=htmlspecialchars($patientLog['groupID']);?></td>
                        <td ><small><?=htmlspecialchars($patientLog['date']);?></small></td>
                        <td ><small><?=htmlspecialchars(decryptthis($patientLog['activity'], $iz_key));?></small></td>
                      </tr>
                      <?php
                    }
                  }
                  else
                  {
                  ?>
                      <tr>
                        <td colspan="6" align="center"><small>No Patient Data Found</small></td>
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
</div>

<div align="center">
  <!-- Modal -->
  <?php 
      include('modal/snapshot/send-patient-email.php'); 
      include('modal/demographic/patient-add-image.php');
  ?>
</div>