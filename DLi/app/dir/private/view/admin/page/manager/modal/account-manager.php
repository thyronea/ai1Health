<?php
include('../../components/print.php');
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
                        $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']); // this code will only show users from the same groupID
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
                              <td><a type="button" class="focus-ring text-decoration-none btn-md editbtn" style="color:black" data-bs-toggle="modal" data-bs-target="#editmodal"><small><?= htmlspecialchars(decryptthis($user['fname'], $key));?></small></a></td>
                              <td hidden><a type="button" class="focus-ring text-decoration-none btn-md" style="color:black" data-bs-toggle="modal" data-bs-target="#editmodal"><small><?= htmlspecialchars(decryptthis($user['lname'], $key));?></small></a></td>
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
      </div>

    </div>
  </div>
</div>
