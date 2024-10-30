<style media="screen">
  @keyframes appear {
      0%{opacity: 0;transform: translate(50px);}
      100%{opacity: 1;transform: translate(0px);}
  }
</style>

<div class="card shadow" style="width:35rem; animation: appear 1.5s ease">
  <div class="card-body">
    <form class="" action="../../../models/admin/profileUpdate.php" method="post">
      <div class="row mt-2 g-2">
        <div class="col" align="center">
            <div id="display-image" class="border" style="width:170px;height:170px;border-radius:50%;overflow:auto">
              <?php include(PRIVATE_MODELS_PATH . '/admin/profileIMG.php'); ?>
            </div>
            <a title="Add Profile Image" type="button" class="mt-2 mb-3" data-bs-toggle="modal" data-bs-target="#add_profile_image" style="color:black;"><i class="bi bi-camera"></i></a>
            <a title="Add Background Image" type="button" class="mt-2 mb-3" data-bs-toggle="modal" data-bs-target="#add_background_image" style="color:black;"><i class="bi bi-image"></i></a>
        </div>

        <div class="col">

          <div class="col mb-2">
            <input type="text" name="fname" class="form-control form-select-sm" value="<?=$fname;?>" placeholder="First Name" required>
          </div>
          <div class="col mb-2">
            <input type="text" name="lname" class="form-control form-select-sm" value="<?=$lname;?>" placeholder="Last Name" required>
          </div>

          <div class="row g-2 mb-2">
            <div class="col-md-6">
              <input type="date" name="dob" class="form-control form-select-sm" value="<?=$dob;?>" required>
            </div>
            <div class="col-md-6">
              <select class="form-select form-select-sm" name="gender">
                <option value="<?=$gender;?>"><?=$gender;?></option>
                <option disabled>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
          </div>

          <div class="col mb-2">
            <select class="form-select form-select-sm" name="race">
              <option value="<?=$race;?>"><?=$race;?></option>
              <option disabled>Select Race</option>
              <option value="Hispanic or Latino">Hispanic or Latino</option>
              <option value="Not Hispanic or Latino">Not Hispanic or Latino</option>
            </select>
          </div>

          <div class="col mb-2">
            <select class="form-select form-select-sm" name="ethnicity">
              <option value="<?=$ethnicity;?>"><?=$ethnicity;?></option>
              <option disabled>Select Ethnicity</option>
              <option value="American Indian or Alaska Native">American Indian or Alaska Native</option>
              <option value="Asian">Asian</option>
              <option value="Black or African American">Black or African American</option>
              <option value="Native Hawaiian or Other Pacific Islander">Native Hawaiian or Other Pacific Islander</option>
              <option value="White">White</option>
            </select>
          </div>
        </div>
      </div>

      <div class="form-group row g-2 mb-2">
        <div class="col">
          <input type="text" name="address1" class="form-control form-select-sm" value="<?=$address1;?>" placeholder="Address" required>
        </div>

        <div class="col">
          <input type="text" name="address2" class="form-control form-select-sm" value="<?=$address2;?>" placeholder="Address 2">
        </div>
      </div>

      <div class="form-group row g-2 mb-2">
        <div class="col-md-6">
          <input type="text" name="city" class="form-control form-select-sm" value="<?=$city;?>" placeholder="City" required>
        </div>

        <div class="col-md-2 dropdown">
          <select class="form-select form-select-sm" name="state" required>
            <option class="dropdown-item" value="<?=$state;?>" selected><?=$state;?></option>
            <option class="dropdown-item" disabled>select one</option>
            <option class="dropdown-item" value="AL">AL</option>
            <option class="dropdown-item" value="AK">AK</option>
            <option class="dropdown-item" value="AR">AR</option>
            <option class="dropdown-item" value="AZ">AZ</option>
            <option class="dropdown-item" value="CA">CA</option>
            <option class="dropdown-item" value="CO">CO</option>
            <option class="dropdown-item" value="CT">CT</option>
            <option class="dropdown-item" value="DC">DC</option>
            <option class="dropdown-item" value="DE">DE</option>
            <option class="dropdown-item" value="FL">FL</option>
            <option class="dropdown-item" value="GA">GA</option>
            <option class="dropdown-item" value="HI">HI</option>
            <option class="dropdown-item" value="IA">IA</option>
            <option class="dropdown-item" value="ID">ID</option>
            <option class="dropdown-item" value="IL">IL</option>
            <option class="dropdown-item" value="IN">IN</option>
            <option class="dropdown-item" value="KS">KS</option>
            <option class="dropdown-item" value="KY">KY</option>
            <option class="dropdown-item" value="LA">LA</option>
            <option class="dropdown-item" value="MA">MA</option>
            <option class="dropdown-item" value="MD">MD</option>
            <option class="dropdown-item" value="ME">ME</option>
            <option class="dropdown-item" value="MI">MI</option>
            <option class="dropdown-item" value="MN">MN</option>
            <option class="dropdown-item" value="MO">MO</option>
            <option class="dropdown-item" value="MS">MS</option>
            <option class="dropdown-item" value="MT">MT</option>
            <option class="dropdown-item" value="NC">NC</option>
            <option class="dropdown-item" value="NE">NE</option>
            <option class="dropdown-item" value="NH">NH</option>
            <option class="dropdown-item" value="NJ">NJ</option>
            <option class="dropdown-item" value="NM">NM</option>
            <option class="dropdown-item" value="NV">NV</option>
            <option class="dropdown-item" value="NY">NY</option>
            <option class="dropdown-item" value="ND">ND</option>
            <option class="dropdown-item" value="OH">OH</option>
            <option class="dropdown-item" value="OK">OK</option>
            <option class="dropdown-item" value="OR">OR</option>
            <option class="dropdown-item" value="PA">PA</option>
            <option class="dropdown-item" value="RI">RI</option>
            <option class="dropdown-item" value="SC">SC</option>
            <option class="dropdown-item" value="SD">SD</option>
            <option class="dropdown-item" value="TN">TN</option>
            <option class="dropdown-item" value="TX">TX</option>
            <option class="dropdown-item" value="UT">UT</option>
            <option class="dropdown-item" value="VT">VT</option>
            <option class="dropdown-item" value="VA">VA</option>
            <option class="dropdown-item" value="WA">WA</option>
            <option class="dropdown-item" value="WI">WI</option>
            <option class="dropdown-item" value="WV">WV</option>
            <option class="dropdown-item" value="WY">WY</option>
          </select>
        </div>

        <div class="col-md-4">
          <input type="text" name="zip" class="form-control form-select-sm" value="<?=$zip;?>" placeholder="Zip" required>
        </div>
      </div>

      <div class="form-group mb-4">
        <div class="row g-2 mb-2">
          <div class="col">
            <input type="text" name="phone" class="form-control form-select-sm" value="<?=$phone;?>" placeholder="Home Phone" required>
          </div>
          <div class="col">
            <input type="text" name="mobile" class="form-control form-select-sm" value="<?=$mobile;?>" placeholder="Mobile Phone" required>
          </div>
        </div>
        <div class="row g-2">
          <div class="col">
            <input type="text" name="email" class="form-control form-select-sm" value="<?=$email;?>" placeholder="Email Address" required>
          </div>
        </div>
      </div>

      <div class="justify-content-center">
        <button type="submit" name="admin_update_profile" class="focus-ring btn btn-outline-secondary btn-sm">Update</button>
        <a class="focus-ring btn btn-outline-secondary btn-sm" href="../../../view/admin/profile/?userID=<?=$_SESSION['userID'];?>" target="_blank">View</a>
      </div>
    </form>
  </div>
</div>
