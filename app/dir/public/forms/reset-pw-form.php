<div class="py-5">
 <div class="container">
   <div class="row justify-content-center">
     <div class="col-md-4 mb-5">

        <?php include('../../../public/content/alert.php'); ?>

        
        <div class="card">
          <div class="card-body shadow">

            <form action="" method="post">
            <div class="mb-4" align="center">
              <h4>Reset Password</h4>
            </div>

            <div class="form-group mb-2">
              <input type="hidden" name="token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];}?>" class="form-control" required>
            </div>

            <div class="form-group mb-2">
              <input type="hidden" name="userID" value="<?php if(isset($_GET['userID'])){echo $_GET['userID'];}?>" class="form-control" required>
            </div>

            <div class="form-group mb-2" align="center">
              <small><label>Password Format</label></small>
                <a tabindex="0" role="button" style="color:red"
                data-bs-toggle="popover"
                data-bs-trigger="focus"
                data-bs-content="Must contain at least one number, one uppercase, lowercase letter, and at least 8 or more characters."
                ><b>!</b></a>
              <input type="password" name="new_password" placeholder="Password" onChange="onChange()" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control text-center"
              required>
            </div>
            <div class="form-group mb-3">
              <input type="password" name="confirm_password" placeholder="Confirm Password" onChange="onChange()" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control text-center"
              required>
            </div>

            <div class="form-group mb-2" align="center">
              <button type="submit" name="reset_user_PW_btn" class="btn btn-outline-secondary btn-sm">Reset</button>
            </div>
          </div>
        </div>
     </div>
   </div>
           </form>
 </div>
</div>
