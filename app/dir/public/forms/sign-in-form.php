<!-- Login Form -->
<div class="mt-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <!-- Header Alert -->
        <?php include('../../../private/messages/alert.php'); ?>

        <!-- Invalid login alert -->
        <div align="center">
          <?php if ($is_invalid): ?>
          <em style="color:red">Invalid login</em>
        <?php endif; ?>
        </div>

        <!-- Login form -->
        <div class="card">
         <div class="card-body shadow" align="center">

           <form method="post">
             <div class="mb-4">
               <h4>Sign in</h4>
             </div>

             <div class="form-group mb-4">
               <input type="email" name="email" placeholder="Email" class="form-control form-control-sm" style="text-align:center;" required>
             </div>

             <!-- Activity input -->
             <div class="form-group mb-2">
               <input type="text" name="login" value="Logged in" class="form-control" hidden required>
             </div>

             <div class="form-group mb-2">
               <button type="submit" name="send_code" class="btn btn-outline-secondary btn-sm">Send Verification Code</button>
             </div>
             <hr style="border-top: 2px solid;">

             <div class="mt-2">
               <small>Don't have an account? <a class="text-decoration-none" href="admin-registration.php">Register</a></small><br>
             </div>
           </form>

         </div>
        </div>
      </div>
    </div>
  </div>
</div>
