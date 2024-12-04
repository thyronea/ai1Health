<div class="mt-5">
 <div class="container">
   <div class="row justify-content-center">
     <div class="col-md-4 mb-5">

       <!-- Header Alert -->
       <?php include('../../private/messages/alert.php'); ?>

       <!-- Reset Password form -->
       <div class="card">
        <div class="card-body shadow">

           <form method="post" action="../../private/process/create-patient-pw-process.php">
           <div class="mb-4" align="center">
             <h4>Create Password</h4>
           </div>

           <div class="form-group mb-2">
             <input type="hidden" name="token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];}?>" class="form-control" required>
           </div>

           <div class="form-group mb-2" align="center">
             <small><label>Password Format</label></small>
               <a tabindex="0" role="button" style="color:red"
               data-bs-toggle="popover"
               data-bs-trigger="focus"
               data-bs-content="Must contain at least one number, one uppercase, lowercase letter, and at least 8 or more characters."
               ><b>!</b></a>
             <input type="password" name="new_password" placeholder="Password" onChange="onChange()" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control"
             required>
           </div>
           <div class="form-group mb-3">
             <input type="password" name="confirm_password" placeholder="Confirm Password" onChange="onChange()" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control"
             required>
           </div>

           <div class="form-group mb-2" align="center">
             <button type="submit" name="create_patient_PW_btn" class="btn btn-outline-secondary btn-sm">Create</button>

        </div>
       </div>
     </div>
   </div>
           </form>
  </div>
 </div>
</div>
