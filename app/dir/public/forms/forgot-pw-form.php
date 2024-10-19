<div class="mt-5">
 <div class="container">
   <div class="row justify-content-center">
     <div class="col-md-4 mb-5">

       <!-- Header Alert -->
       <?php include('../../../private/messages/alert.php'); ?>

       <div class="card">
        <div class="card-body shadow">

           <form action="../../../private/security/forgot-pw-process.php" method="post">
           <div class="mb-4" align="center">
             <h4>Forgot Password?</h4>
             <p><small>Provide registered email to reset password</small></p>
           </div>

           <div class="form-group mb-4">
             <input type="email" name="email" placeholder="email" class="form-control form-control-sm text-center" required>
           </div>

           <!-- Activity input -->
           <div class="form-group mb-2">
             <input type="text" name="forgotPW" value="Password Reset" class="form-control form-control-sm" hidden required>
           </div>

           <div class="form-group mb-2" align="center">
             <button type="submit" name="forgot_pw" class="btn btn-outline-secondary btn-sm">Send</button>
           </div>

        </div>
       </div>
     </div>
   </div>
           </form>
 </div>
</div>
