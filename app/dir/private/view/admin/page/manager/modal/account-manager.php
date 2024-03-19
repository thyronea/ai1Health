<?php
include('../../components/print.php');
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
?>


<!-- Modal -->
<div class="modal fade" id="account-manager-Modal" tabindex="-1" aria-labelledby="account-manager-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="account-manager-ModalLabel">Account Manager</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body" align="center">
        <div class="col-md-8">

            <div class="row">

                     <!-- User's Table -->
                      <div class="col">
                        <div class="card m-2 shadow" style="width: auto; height: auto; overflow: auto;">
                          <div class="card-body">
                            <table class="table align-middle table-borderless table-sm table-hover text-nowrap">
                                <th>Users</th>
                                <tbody align="center" style="text-align: left">
                                  <?php
                                  $query = "SELECT * FROM profile WHERE groupID='$groupID' ";
                                  $query_run = mysqli_query($con, $query);

                                  if(mysqli_num_rows($query_run) > 0)
                                  {
                                    foreach($query_run as $user)
                                    {
                                      ?>
                                      <tr><td hidden><?= htmlspecialchars($user['userID']);?></td>
                                        <td hidden><?= htmlspecialchars($user['engineID']);?></td>
                                        <td hidden><?= htmlspecialchars($user['groupID']);?></td>
                                        <td><a type="button" class="focus-ring text-decoration-none btn-md editbtn" style="color:black" data-bs-toggle="modal" data-bs-target="#editmodal"><small><?= htmlspecialchars($user['fname']);?></small></a></td>
                                        <td hidden><a type="button" class="focus-ring text-decoration-none btn-md" style="color:black" data-bs-toggle="modal" data-bs-target="#editmodal"><small><?= htmlspecialchars($user['lname']);?></small></a></td>
                                        <td hidden><?= htmlspecialchars(decryptthis($user['email'], $key));?></td>
                                        <td hidden><?= htmlspecialchars(decryptthis($user['role'], $key));?></td>
                                        <td><a title="Update Account Information" type="button" class="focus-ring text-decoration-none btn-md editbtn" style="color:black" data-bs-toggle="modal" data-bs-target="#editmodal"><i class="bi bi-gear"></i></a></td>
                                        <td><a title="Delete" type="button" class="focus-ring border-none userdeletebtn" style="color:black;" data-bs-toggle="modal" data-bs-target="#userdeletemodal"><i class="bi bi-trash"></i></a></td>
                                      </tr>
                                      <?php
                                    }
                                  }
                                  else
                                  {
                                  ?>
                                      <tr>
                                        <td colspan="6"><small>No User Data Found</small></td>
                                      </tr>
                                  <?php
                                  }
                                  ?>
                                </tbody>
                              </table>
                          </div>
                        </div>
                      </div>

                      <!-- Office Table -->
                      <div class="col-md-6">
                        <div class="card m-2 shadow" style="width: auto; height: auto; overflow: auto;">
                          <div class="card-body">
                            <table class="table table-borderless table-sm table-hover text-nowrap">
                                <tbody align="center" style="text-align: left">
                                  <thead>
                                    <th>Location</th>
                                  </thead>
                                  <?php
                                  $query = "SELECT * FROM location WHERE groupID='$groupID' ";
                                  $query_run = mysqli_query($con, $query);

                                  if(mysqli_num_rows($query_run) > 0)
                                  {
                                    foreach($query_run as $office)
                                    {
                                      ?>
                                      <tr>
                                        <td hidden><?= htmlspecialchars($office['id']);?></td>
                                        <td hidden><?= htmlspecialchars($office['engineID']);?></td>
                                        <td hidden><?= htmlspecialchars($office['groupID']);?></td>
                                        <td><a type="button" class="focus-ring text-decoration-none btn-md location-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#office-edit"><small><?= htmlspecialchars($office['name']);?></small></a></td>
                                        <td hidden><?= htmlspecialchars($office['address1']);?></td>
                                        <td hidden><?= htmlspecialchars($office['address2']);?></td>
                                        <td hidden><?= htmlspecialchars($office['city']);?></td>
                                        <td hidden><?= htmlspecialchars($office['state']);?></td>
                                        <td hidden><?= htmlspecialchars($office['zip']);?></td>
                                        <td hidden><?= htmlspecialchars($office['phone']);?></td>
                                        <td hidden><?= htmlspecialchars($office['email']);?></td>
                                        <td hidden><?= htmlspecialchars($office['link']);?></td>
                                        <td hidden><?= htmlspecialchars($office['poc']);?></td>
                                        <td><a type="button" class="focus-ring border-none location-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#location-edit"><i class="bi bi-gear"></a></td>
                                        <td><a type="button" class="focus-ring border-none location-deletebtn" style="color:black;" data-bs-toggle="modal" data-bs-target="#locationdeletemodal"><i class="bi bi-trash"></i></a></td>

                                      </tr>
                                      <?php
                                    }
                                  }
                                  else
                                  {
                                  ?>
                                      <tr>
                                        <td colspan="6" align="center"><small>No Location Data Found</small></td>
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

      <!-- Buttons -->
      <div class="modal-footer col d-flex justify-content-center">
        <!-- Add User Button -->
        <button title="Add User" type="button" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none" data-bs-toggle="modal" data-bs-target="#add-user-Modal" style="text-align: left">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
          </svg>
        </button>

        <!-- Add Location Button -->
        <button title="Add Location" type="button" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none office-addbtn" data-bs-toggle="modal" data-bs-target="#add-location-Modal" style="text-align: left">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-building-add" viewBox="0 0 16 16">
            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Z"/>
            <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6.5a.5.5 0 0 1-1 0V1H3v14h3v-2.5a.5.5 0 0 1 .5-.5H8v4H3a1 1 0 0 1-1-1V1Z"/>
            <path d="M4.5 2a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z"/>
          </svg>
        </button>
      </div>

    </div>
  </div>
</div>
