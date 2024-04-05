<?php
$date = date('Y') . '-' . date('m') . '-' . date('d');
$decrypted_dob = htmlspecialchars(decryptthis($diversity['dob'], $key));
$year = (date('Y') - date('Y', strtotime($decrypted_dob)));
$dob = (date('m', strtotime($decrypted_dob)) . '/' . date('d', strtotime($decrypted_dob)) . '/' . date('Y', strtotime($decrypted_dob)));
?>

<div class="tab-pane fade" id="demographic-tab-pane" role="tabpanel" aria-labelledby="demographic-tab" tabindex="1">
  <div class="container user-select-none" align="center">

  <!-- Modal -->
  <?php 
    include('modal/demographic/patient-add-diversity.php');
    include('modal/demographic/patient-edit-name.php');
    include('modal/demographic/patient-add-address.php'); 
    include('modal/demographic/patient-edit-address.php'); 
    include('modal/demographic/patient-add-contact.php'); 
    include('modal/demographic/patient-edit-contact.php'); 
    include('modal/demographic/patient-add-emergency.php'); 
    include('modal/demographic/patient-edit-emergency.php'); 
    include('modal/demographic/patient-add-plan.php'); 
    include('modal/demographic/patient-edit-plan.php');
    include('modal/demographic/send-emergency-email.php'); 
  ?>

    <div class="col-md-12">
      <div class="card border-0">
        <div class="card-body">
          <div class="row g-2">
            <div class="col-md-8">
              <div class="row g-2">
                <!-- Patient Name Container-->
                <div class="col-md-6 mb-2" align="left">
                  <div class="card shadow" style="height:15rem">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4 border" style="margin-left: 10px; height: 150px; width: 150px;border-radius: 50%"></div>
                        <div class="col">
                          <small>
                            <table>
                              <th>Patient ID:</th>
                              <td><?=htmlspecialchars($patient['patientID']);?></td>
                            </table>
                            <table>
                              <th>Name:</th>
                              <td><?=htmlspecialchars(decryptthis($patient['fname'], $key));?> <?=htmlspecialchars(decryptthis($patient['lname'], $key));?> <?=htmlspecialchars(decryptthis($patient['suffix'], $key));?></td>
                            </table>
                            <table>
                            <table>
                              <th>Gender:</th>
                              <td><?=htmlspecialchars(decryptthis($diversity['gender'], $key));?></td>
                            </table>
                            <table>
                              <th>DOB:</th>
                              <td><?=htmlspecialchars($dob);?> (<?=htmlspecialchars($year);?> years old)</td>
                            </table>
                            <table>
                              <th>Race:</th>
                              <td><?=htmlspecialchars(decryptthis($diversity['race'], $key));?></td>
                            </table>
                            <table>
                              <th>Ethnicity:</th>
                              <td><?=htmlspecialchars(decryptthis($diversity['ethnicity'], $key));?></td>
                            </table>
                          </small>
                        </div>
                      </div>
                      <div align="right">
                        <button type="button" class="focus-ring btn btn-sm border-0" data-bs-toggle="modal" data-bs-target="#patient-add-diversity-Modal">
                          <i class="bi bi-file-earmark-plus"></i>
                        </button>
                        <button type="button" class="focus-ring btn btn-sm border-0" data-bs-toggle="modal" data-bs-target="#patient-edit-name-Modal">
                          <i class="bi bi-gear"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Patient Address Container-->
                <div class="col-md-6 mb-2" align="left">
                  <div class="card shadow" style="height:15rem">
                    <div class="card-body">
                      <small>
                        <table>
                          <th>Address:</th>
                          <td><?=htmlspecialchars(decryptthis($address['address1'], $key));?></td>
                        </table>
                        <table>
                        <table>
                          <th>Address 2:</th>
                          <td><?=htmlspecialchars(decryptthis($address['address2'], $key));?></td>
                        </table>
                        <table>
                          <th>City:</th>
                          <td><?=htmlspecialchars(decryptthis($address['city'], $key));?></td>
                        </table>
                        <table>
                          <th>State:</th>
                          <td><?=htmlspecialchars(decryptthis($address['state'], $key));?></td>
                        </table>
                        <table>
                          <th>Zip Code:</th>
                          <td><?=htmlspecialchars(decryptthis($address['zip'], $key));?></td>
                        </table><br>
                      </small>
                      <div align="right">
                        <button type="button" class="focus-ring btn btn-sm border-0" data-bs-toggle="modal" data-bs-target="#patient-add-address-Modal">
                          <i class="bi bi-file-earmark-plus"></i>
                        </button>
                        <button type="button" class="focus-ring btn btn-sm border-0" data-bs-toggle="modal" data-bs-target="#patient-edit-address-Modal">
                          <i class="bi bi-gear"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row g-2">
                <!-- Patient Contact Container-->
                <div class="col-md-6" align="left">
                  <div class="card mb-3 shadow">
                    <div class="card-body">
                      <small>
                        <table>
                          <th>Home Phone:</th>
                          <td><?=htmlspecialchars(decryptthis($contact['phone'], $key));?></td>
                        </table>
                        <table>
                        <table>
                          <th>Mobile:</th>
                          <td><?=htmlspecialchars(decryptthis($contact['mobile'], $key));?></td>
                        </table>
                        <table>
                          <th>Email:</th>
                          <td><?=htmlspecialchars(decryptthis($contact['email'], $key));?></td>
                        </table>
                      </small>
                      <div class="mt-2" align="right">
                        <button type="button" class="focus-ring btn btn-sm border-0" data-bs-toggle="modal" data-bs-target="#patient-add-contact-Modal">
                          <i class="bi bi-file-earmark-plus"></i>
                        </button>
                        <button type="button" class="focus-ring btn btn-sm border-0" data-bs-toggle="modal" data-bs-target="#patient-edit-contact-Modal">
                          <i class="bi bi-gear"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Patient Health Plan Container-->
                <div class="col-md-6" align="left">
                  <div class="card mb-3 shadow">
                    <div class="card-body">
                      <small>
                        <table>
                          <th>Health Plan:</th>
                          <td><?=htmlspecialchars(decryptthis($plan['health_plan'], $key));?></td>
                        </table>
                        <table>
                          <th>Policy Number:</th>
                          <td><?=htmlspecialchars(decryptthis($plan['policy_number'], $key));?></td>
                        </table>
                        <table>
                          <th>Status:</th>
                          <td><?=htmlspecialchars(decryptthis($plan['status'], $key));?></td>
                        </table>
                      </small>
                      <div class="mt-2" align="right">
                        <a type="button" href="#" target="_blank" class="focus-ring btn btn-sm border-0">
                          <i class="bi bi-check2-square"></i>
                        </a>
                        <button type="button" class="focus-ring btn btn-sm border-0" data-bs-toggle="modal" data-bs-target="#patient-add-plan-Modal">
                          <i class="bi bi-file-earmark-plus"></i>
                        </button>
                        <button type="button" class="focus-ring btn btn-sm border-0" data-bs-toggle="modal" data-bs-target="#patient-edit-plan-Modal">
                          <i class="bi bi-gear"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Patient Emergency Contact Container-->
            <div class="col-md-4" align="left">
              <div class="card mb-3 shadow" style="height:387px; overflow:auto">
                <div class="card-body">
                  <small>
                    <table class="table table-borderless table-sm table-hover text-nowrap">
                      <th>Emergency Contact:</th>
                      <tbody align="center" style="text-align: left">
                        <?php
                        $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                        $patientID = mysqli_real_escape_string($con, $_GET['patientID']);
                        $query = "SELECT * FROM emergency_contact WHERE patientID='$patientID' AND groupID='$groupID' ";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) > 0)
                        {
                          $emergency = mysqli_fetch_array($query_run);
                          foreach($query_run as $emergency_contact)
                          {
                            ?>
                            <tr>
                              <td hidden><a type="text" class="focus-ring btn btn-sm border-0" ><?=htmlspecialchars($emergency_contact['id']);?></i></a></td>
                              <td hidden><a type="text" class="focus-ring btn btn-sm border-0" ><?=htmlspecialchars($emergency_contact['patientID']);?></i></a></td>
                              <td hidden><a type="text" class="focus-ring btn btn-sm border-0" ><?=htmlspecialchars($emergency_contact['engineID']);?></i></a></td>
                              <td hidden><a type="text" class="focus-ring btn btn-sm border-0" ><?=htmlspecialchars($emergency_contact['groupID']);?></i></a></td>
                              <td><?=htmlspecialchars(decryptthis($emergency_contact['fname'], $key));?></td>
                              <td hidden><a type="text" class="focus-ring btn btn-sm border-0" ><?=htmlspecialchars(decryptthis($emergency_contact['lname'], $key));?></i></a></td>
                              <td hidden><a type="text" class="focus-ring btn btn-sm border-0" ><?=htmlspecialchars(decryptthis($emergency_contact['phone'], $key));?></i></a></td>
                              <td><a type="button" class="focus-ring btn btn-sm border-0" href="tel:<?=htmlspecialchars(decryptthis($emergency_contact['phone'], $key));?>" style="color:black"><i class="bi bi-telephone"></i></a></td>
                              <td hidden><a type="text" class="focus-ring btn btn-sm border-0" ><?=htmlspecialchars(decryptthis($emergency_contact['email'], $key));?></i></a></td>
                              <td><a type="button" class="focus-ring btn btn-sm border-0 emergency_emailbtn" data-bs-toggle="modal" data-bs-target="#emergency-message-Modal"><i class="bi bi-envelope"></i></a></td>
                              <td><a type="button" class="focus-ring btn btn-sm border-0 emergency_editbtn" data-bs-toggle="modal" data-bs-target="#patient-edit-emergency-Modal"><i class="bi bi-gear"></i></a></td>
                            </tr>
                            <?php
                          }
                        }
                        else
                        {
                          ?>
                          <tr>
                            <td colspan="6" align="center"><small>No Data Found</small></td>
                          </tr>
                          <?php
                        }
                        ?>
                      </tbody>
                    </table>

                  </small>
                </div>
                <div class="mb-3" align="right">
                  <button title="Add Emergency Contact" type="button" class="focus-ring btn btn-sm border-0" data-bs-toggle="modal" data-bs-target="#patient-add-emergency-Modal">
                    <i class="bi bi-file-earmark-plus fa-lg"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
