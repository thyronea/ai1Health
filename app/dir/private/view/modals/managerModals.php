<!-- Account Manager -->
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
                            <?php include(PRIVATE_VIEW_PATH . '/tables/usersTable.php'); ?>
                          </div>
                        </div>
                      </div>

                      <!-- Office Table -->
                      <div class="col-md-6">
                        <div class="card m-2 shadow" style="width: auto; height: auto; overflow: auto;">
                          <div class="card-body">
                            <?php include(PRIVATE_VIEW_PATH . '/tables/officeTable.php'); ?>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
      </div>

      <!-- Controllers -->
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

<!-- Add User -->
<div class="modal fade" id="add-user-Modal" tabindex="-1" aria-labelledby="add-user-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="add-user-ModalLabel">Add User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <form class="" action="../../../controllers/auth/registrationController.php" method="POST">
            <div class="form-group mb-2 mt-2">
              <input type="hidden" name="engineID" id="user_engineID" class="form-control form-select-sm" required>
            </div>
            <div class="form-group mb-2 mt-2">
              <input type="hidden" name="newID" id="new_userID" class="form-control form-select-sm" required>
            </div>
            <div class="row g-2">
              <div class="col form-group mb-2 mt-2">
                <input type="text" name="fname" placeholder="First Name" class="form-control form-select-sm" required>
              </div>
              <div class="col form-group mb-2">
                <input type="text" name="lname" placeholder="Last Name" class="form-control form-select-sm" required>
              </div>
            </div>
            <div class="row g-2">
              <div class="col form-group mb-2">
                <input type="email" name="email" placeholder="Email Address" class="form-control form-select-sm" required>
              </div>
              <div class="col dropdown mb-4" required>
                <select class="form-select form-select-sm" name="role">
                  <option class="dropdown-item" disabled selected>Role</option>
                  <option class="dropdown-item" value="User">User</option>
                  <option class="dropdown-item" value="Admin">Admin</option>
                </select>
              </div>
            </div>
            <div class="row g-2">
              <div class="col form-group mb-2">
                <div class="col">
                  <select class="form-group form-select form-select-sm" name="location" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" data-bs-content="Location" required>
                    <option></option>
                    <option disabled>Select Location</option>
                    <?php
                      $sql = "SELECT * FROM location WHERE groupID='$groupID' ";
                      $sql_run = mysqli_query($con, $sql);
                      while ($location = mysqli_fetch_array($sql_run)){
                        echo "<option value='". $location['name'] ."'>" .$location['name'] ."</option>" ;
                      }
                    ?>
                  </select>
                </div>                   
              </div>
            </div>
      </div>
            <div class="modal-footer col d-flex justify-content-center form-group">
              <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#account-manager-Modal">Back</button>
              <button type="submit" name="register_new_user" class="btn btn-outline-secondary btn-sm">Add</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- Edit User -->
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="editmodal-ModalLabel">Edit User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body" align="center">
        <form class="" action="" method="POST" enctype="multipart/form-data">

          <div class="form-group mb-2">
            <input type="text" name="engineID" id="engineID" class="form-control form-select-sm" hidden required>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2">
              <input type="text" name="fname" id="fname" class="form-control form-select-sm" required>
            </div>
            <div class="col form-group mb-2">
              <input type="text" name="lname" id="lname" class="form-control form-select-sm" required>
            </div>
          </div>
          <div class="row g-2">
            <div class="col-md-9 form-group mb-2">
              <input type="email" name="email" id="email" class="form-control form-select-sm" required>
            </div>
            <div class="col-md-3 dropdown mb-2">
              <select class="form-select form-select-sm" name="role" id="role" required>
                <option class="dropdown-item" disabled selected>select one</option>
                <option class="dropdown-item" value="User">User</option>
                <option class="dropdown-item" value="Admin">Admin</option>
              </select>
            </div>
          </div>
          <div class="row g-2">
              <div class="col form-group mb-2">
                <div class="col">
                  <select name="location" id="location" class="form-group form-select form-select-sm" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" data-bs-content="Location" required>
                    <option></option>
                    <option disabled>Select Location</option>
                    <?php
                      $sql = "SELECT * FROM location WHERE groupID='$groupID' ";
                      $sql_run = mysqli_query($con, $sql);
                      while ($location = mysqli_fetch_array($sql_run)){
                        echo "<option value='". $location['name'] ."'>" .$location['name'] ."</option>" ;
                      }
                    ?>
                  </select>
                </div>                   
              </div>
            </div>

          <div class="form-group mt-4 mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#account-manager-Modal">Back</button>
            <button type="submit" name="update_btn" class="focus-ring btn btn-outline-secondary btn-sm">Update</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>

<!-- Delete User -->
<div class="modal fade" id="userdeletemodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userdeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="userdeletemodal-ModalLabel">Delete User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input class="form-control mb-2" type="hidden" name="delete_userID" id="delete_userID">
            <input class="form-control mb-2" type="hidden" name="delete_engineID" id="delete_engineID">
            <input class="form-control mb-2" type="hidden" name="delete_fname" id="delete_fname">
            <input class="form-control mb-2" type="hidden" name="delete_lname" id="delete_lname">
            <!----------------------------------------------------->
            <p align="center">Access and data will be permanently removed.</p>
            <p align="center">Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#account-manager-Modal">No</button>
            <button type="submit" name="userdeletebtn" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- Add Location -->
<div class="modal fade" id="add-location-Modal" tabindex="-1" aria-labelledby="add-location-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="add-office-ModalLabel">Add Location</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form class="" action="" method="POST">
          <div class="form-group mb-2 mt-2">
            <input type="text" name="engineID" id="office_engineID" class="form-control form-control-sm"  hidden required>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2 mt-2">
                <select class="form-select form-select-sm" name="poc" required>
                  <option disabled selected>Point of Contact</option>
                    <?php
                        $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                        $engineID = mysqli_real_escape_string($con, $_SESSION['engineID']);
                        $sql = "SELECT * FROM profile WHERE groupID='$groupID' ";
                        $sql_run = mysqli_query($con, $sql);
                        if(mysqli_num_rows($sql_run)){
                          foreach($sql_run as $row){
                            $fname = htmlspecialchars($row['fname']);
                            $lname = htmlspecialchars($row['lname']);
                            $fullname = "$fname $lname";
                            echo "<option value='". $fullname ."'>" .$fullname ."</option>" ;
                          }
                        }
                    ?>
                </select>
            </div>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2 mt-2">
              <input type="text" name="name" placeholder="Name of Location" class="form-control form-control-sm" required>
            </div>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2 mt-2">
              <input type="text" name="address1" placeholder="Address" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-4 form-group mb-2">
              <input type="text" name="address2" placeholder="Address 2" class="form-control form-control-sm">
            </div>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2">
              <input type="text" name="city" placeholder="City" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-2 dropdown mb-2">
              <select class="form-select form-select-sm" name="state" required>
                <option value="CA" selected>CA</option>
                <option value="AL">AL</option>
                	<option value="AK">AK</option>
                	<option value="AR">AR</option>
                	<option value="AZ">AZ</option>
                	<option value="CO">CO</option>
                	<option value="CT">CT</option>
                	<option value="DC">DC</option>
                	<option value="DE">DE</option>
                	<option value="FL">FL</option>
                	<option value="GA">GA</option>
                	<option value="HI">HI</option>
                	<option value="IA">IA</option>
                	<option value="ID">ID</option>
                	<option value="IL">IL</option>
                	<option value="IN">IN</option>
                	<option value="KS">KS</option>
                	<option value="KY">KY</option>
                	<option value="LA">LA</option>
                	<option value="MA">MA</option>
                	<option value="MD">MD</option>
                	<option value="ME">ME</option>
                	<option value="MI">MI</option>
                	<option value="MN">MN</option>
                	<option value="MO">MO</option>
                	<option value="MS">MS</option>
                	<option value="MT">MT</option>
                	<option value="NC">NC</option>
                	<option value="NE">NE</option>
                	<option value="NH">NH</option>
                	<option value="NJ">NJ</option>
                	<option value="NM">NM</option>
                	<option value="NV">NV</option>
                	<option value="NY">NY</option>
                	<option value="ND">ND</option>
                	<option value="OH">OH</option>
                	<option value="OK">OK</option>
                	<option value="OR">OR</option>
                	<option value="PA">PA</option>
                	<option value="RI">RI</option>
                	<option value="SC">SC</option>
                	<option value="SD">SD</option>
                	<option value="TN">TN</option>
                	<option value="TX">TX</option>
                	<option value="UT">UT</option>
                	<option value="VT">VT</option>
                	<option value="VA">VA</option>
                	<option value="WA">WA</option>
                	<option value="WI">WI</option>
                	<option value="WV">WV</option>
                	<option value="WY">WY</option>
              </select>
            </div>
            <div class="col-md-4 form-group mb-2">
              <input type="text" name="zip" placeholder="Zip" class="form-control form-control-sm" required>
            </div>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2">
              <input type="text" name="phone" placeholder="Phone Number" class="form-control form-control-sm" required>
            </div>
            <div class="col form-group mb-2">
              <input type="text" name="email" placeholder="Email Address" class="form-control form-control-sm" required>
            </div>
          </div>
          <div class="row g-2">
            <div class="mb-3">
              <input type="text" name="link" placeholder="Website Link" class="form-control form-control-sm">
            </div>
          </div>
      </div>
      <div class="modal-footer col d-flex justify-content-center form-group">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#account-manager-Modal">Back</button>
        <button type="submit" name="register_location" class="btn btn-outline-secondary btn-sm">Add</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Edit Location -->
<div class="modal fade" id="location-edit" tabindex="-1" aria-labelledby="location-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="office-edit-ModalLabel">Edit Location</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="" method="POST">
          <div class="form-group mb-2">
            <input type="text" name="id" id="location_id" class="form-control form-control-sm" hidden required>
          </div>
          <div class="form-group mb-2">
            <input type="text" name="engineID" id="location_engine_id" class="form-control form-control-sm" hidden required>
          </div>
          <div class="form-group mb-2">
          <select class="form-select form-select-sm" name="poc" id="location_poc" required>
                  <option disabled selected>Point of Contact</option>
                  <?php
                        $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                        $engineID = mysqli_real_escape_string($con, $_SESSION['engineID']);
                        $sql = "SELECT * FROM profile WHERE groupID='$groupID' ";
                        $sql_run = mysqli_query($con, $sql);
                        if(mysqli_num_rows($sql_run)){
                          foreach($sql_run as $row){
                            $fname = htmlspecialchars($row['fname']);
                            $lname = htmlspecialchars($row['lname']);
                            $fullname = "$fname $lname";
                            echo "<option value='". $fullname ."'>" .$fullname ."</option>" ;
                          }
                        }
                    ?>
                </select>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2">
              <input type="text" name="name" id="location_name" class="form-control form-control-sm" placeholder="Name of Location (office)" required>
            </div>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2">
              <input type="text" name="address1" id="location_address1" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-4 form-group mb-2">
              <input type="text" name="address2" id="location_address2" class="form-control form-control-sm" placeholder="Address 2">
            </div>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2">
              <input type="text" name="city" id="location_city" class="form-control form-control-sm" placeholder="City" required>
            </div>
            <div class="col-md-2 dropdown mb-2">
              <select class="form-select form-select-sm" name="state" id="location_state" required>
                <option disabled>select one</option>
                <option value="AL">AL</option>
              	<option value="AK">AK</option>
              	<option value="AR">AR</option>
              	<option value="AZ">AZ</option>
              	<option value="CA">CA</option>
              	<option value="CO">CO</option>
              	<option value="CT">CT</option>
              	<option value="DC">DC</option>
              	<option value="DE">DE</option>
              	<option value="FL">FL</option>
              	<option value="GA">GA</option>
              	<option value="HI">HI</option>
              	<option value="IA">IA</option>
              	<option value="ID">ID</option>
              	<option value="IL">IL</option>
              	<option value="IN">IN</option>
              	<option value="KS">KS</option>
              	<option value="KY">KY</option>
              	<option value="LA">LA</option>
              	<option value="MA">MA</option>
              	<option value="MD">MD</option>
              	<option value="ME">ME</option>
              	<option value="MI">MI</option>
              	<option value="MN">MN</option>
              	<option value="MO">MO</option>
              	<option value="MS">MS</option>
              	<option value="MT">MT</option>
              	<option value="NC">NC</option>
              	<option value="NE">NE</option>
              	<option value="NH">NH</option>
              	<option value="NJ">NJ</option>
              	<option value="NM">NM</option>
              	<option value="NV">NV</option>
              	<option value="NY">NY</option>
              	<option value="ND">ND</option>
              	<option value="OH">OH</option>
              	<option value="OK">OK</option>
              	<option value="OR">OR</option>
              	<option value="PA">PA</option>
              	<option value="RI">RI</option>
              	<option value="SC">SC</option>
              	<option value="SD">SD</option>
              	<option value="TN">TN</option>
              	<option value="TX">TX</option>
              	<option value="UT">UT</option>
              	<option value="VT">VT</option>
              	<option value="VA">VA</option>
              	<option value="WA">WA</option>
              	<option value="WI">WI</option>
              	<option value="WV">WV</option>
              	<option value="WY">WY</option>
              </select>
            </div>
            <div class="col-md-4 form-group mb-3">
              <input type="text" name="zip" id="location_zip" class="form-control form-control-sm" placeholder="Zip" required>
            </div>
          </div>
          <div class="row g-2">
            <div class="col form-group mb-2">
              <input type="text" name="phone" id="location_phone" class="form-control form-control-sm" placeholder="Phone" required>
            </div>
            <div class="col form-group mb-2">
              <input type="text" name="location_email" id="location_email" class="form-control form-control-sm" placeholder="Email" required>
            </div>
          </div>
          <div class="row g-2">
            <div class="col fom-group mb-4">
              <input type="text" name="location_link" id="location_link" class="form-control form-control-sm" placeholder="Website Link">
            </div>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#account-manager-Modal">Back</button>
            <button type="submit" name="location_update_btn" class="btn btn-outline-secondary btn-sm">Update</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>

<!-- Delete Location -->
<div class="modal fade" id="locationdeletemodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="locationdeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5"locationedeletemodal-ModalLabel">Delete Location</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input class="form-control mb-2" type="hidden" name="delete_locationid" id="delete_locationID">
            <input class="form-control mb-2" type="hidden" name="delete_location_engineid" id="delete_location_engineID">
            <input class="form-control mb-2" type="hidden" name="delete_location_name" id="delete_location_name">
            <!----------------------------------------------------->
            <p align="center">Access and data will be permanently removed (including STORAGE UNITS AND THEROMETERS assigned to this location).</p>
            <p align="center">Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#account-manager-Modal">No</button>
            <button type="submit" name="locationdeletebtn" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- Email Send -->
<div class="modal fade" id="message-Modal" tabindex="-1" aria-labelledby="message-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="message-ModalLabel">Send Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="post" action="">

          <label for="email">Email</label>

          <input class="form-control mb-2" type="email" name="email" id="email" required>

          <label for="subject">Subject</label>
          <input class="form-control mb-2" type="text" name="subject" id="subject" required>

          <label for="message">Message</label>
          <textarea class="form-control mb-4" name="message" id="message" style="height: 15rem" required></textarea>

          <div class="mb-2" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-outline-secondary btn-sm" type="submit" name="send_admin_email">Send</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<!-- Email Log -->
<div class="modal fade" id="email-log-Modal" tabindex="-1" aria-labelledby="email-log-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="email-log-ModalLabel">Email Log</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="emailLogprintThis" class="modal-body">


        <table class="table align-middle table-sm table-hover">
          <thead class="text-nowrap">
            <th>Date & Time</th>
            <th>From</th>
            <th>To</th>
            <th>Message</th>
          </thead>
          <tbody align="center" style="text-align: left">
            <?php
            $groupID = $_SESSION["groupID"]; // this code will only show users from the same groupID
            $query = "SELECT * FROM email WHERE groupID='$groupID' ORDER BY timestamp DESC ";
            $query_run = mysqli_query($con, $query);

            if(mysqli_num_rows($query_run) > 0)
            {
              foreach($query_run as $activity)
              {
                ?>
                <tr>

                  <td hidden><?=htmlspecialchars($activity['id']);?></td>
                  <td><small><?=htmlspecialchars($activity['timestamp']);?></small></td>
                  <td ><small><?=htmlspecialchars(decryptthis($activity['fromEmail'], $key));?></small></td>
                  <td ><small><?=htmlspecialchars(decryptthis($activity['toEmail'], $key));?></small></td>
                  <td style="word-break: break-word;"><small><?=htmlspecialchars(decryptthis($activity['message'], $key));?></small></td>

                </tr>
                <?php
              }
            }
            else
            {
            ?>
                <tr>
                  <td colspan="6" align="center"><small>No User Data Found</small></td>
                </tr>
            <?php
            }
            ?>
          </tbody>
        </table>

      </div>

      <div class="modal-footer col d-flex justify-content-center">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#emailclearmodal">Clear</button>
        <button id="emailLogPrint" type="submit" class="btn btn-outline-secondary btn-sm" onClick="window.print()">Print</button>
      </div>

    </div>
  </div>
</div>

<!-- Email Clear -->
<div class="modal fade" id="emailclearmodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="emailclear-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title fs-5" id="emailclear-ModalLabel">Clear Email Log</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="" method="POST">
          <div class="form-group mt-3 mb-5">
            <p align="center">Email log will be permanently cleared.</p>
            <p align="center">Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#email-log-Modal">No</button>
            <button type="submit" name="clear_email" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- Activity Log -->
<div class="modal fade" id="activity-log-Modal" tabindex="-1" aria-labelledby="user-log-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="activity-log-ModalLabel">Activity Log</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="activityLogprintThis">


        <table class="table align-middle table-sm table-hover text-nowrap">
          <thead>
            <th>Date & Time</th>
            <th>User</th>
            <th>Activity</th>
          </thead>
          <tbody align="center" style="text-align: left">
            <?php
            $groupID = htmlspecialchars($_SESSION["groupID"]); // this code will only show users from the same groupID
            $query = "SELECT * FROM admin_log WHERE groupID='$groupID' ORDER BY timestamp DESC ";
            $query_run = mysqli_query($con, $query);

            if(mysqli_num_rows($query_run) > 0)
            {
              foreach($query_run as $activity)
              {
                ?>
                <tr>
                  <td hidden><?= $activity['id'];?></td>
                  <td ><small><?= $activity['timestamp'];?></small></td>
                  <td ><small><?= htmlspecialchars(decryptthis($activity['user'], $key));?></small></td>
                  <td ><small><?= htmlspecialchars(decryptthis($activity['activity'], $key));?></small></td>
                </tr>
                <?php
              }
            }
            else
            {
            ?>
                <tr>
                  <td colspan="6" align="center">No User Data Found</td>
                </tr>
            <?php
            }
            ?>
          </tbody>
        </table>

      </div>

      <div class="modal-footer col d-flex justify-content-center">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#activityclearmodal">Clear</button>
        <button type="submit" class="btn btn-outline-secondary btn-sm" id="activityLogPrint" onClick="window.print()">Print</button>
      </div>

    </div>
  </div>
</div>

<!-- Activity Clear -->
<div class="modal fade" id="activityclearmodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="activityclear-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title fs-5" id="activityclear-ModalLabel">Clear Activity Log</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="" method="POST">
          <div class="form-group mt-3 mb-5">
            <p align="center">Activity log will be permanently cleared.</p>
            <p align="center">Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#activity-log-Modal">No</button>
            <button type="submit" name="clear_activity" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>



