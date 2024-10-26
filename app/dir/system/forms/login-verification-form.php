<!-- Login Form -->
<div class="mt-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <!-- Header Alert -->
        <?php include('../../../system/content/alert.php'); ?>

        <!-- Login form -->
        <div class="card">
         <div class="card-body shadow" align="center">
           <form method="post">
             <div class="mb-4">
               <h4>Enter Verification Code</h4>
             </div>

             <div class="col-md-8 mb-4">
               <div class="row col g-1">
                 <input class="col m-1 inputs form-control form-control-sm" name="vcode1" type="text" maxlength="1" style="text-align:center;" />
                 <input class="col m-1 inputs form-control form-control-sm" name="vcode2" type="text" maxlength="1" style="text-align:center;" />
                 <input class="col m-1 inputs form-control form-control-sm" name="vcode3" type="text" maxlength="1" style="text-align:center;" />
                 <input class="col m-1 inputs form-control form-control-sm" name="vcode4" type="text" maxlength="1" style="text-align:center;" />
                 <input type="password" name="password" placeholder="Password" class="inputs form-control form-control-sm" style="text-align:center;" required>
               </div>
             </div>

             <div class="form-group mb-2">
               <button type="submit" name="login_btn" class="btn btn-outline-secondary btn-sm">Login</button>
             </div>
             <hr style="border-top: 2px solid;">

             <div class="mt-2">
               <small><a class="text-decoration-none" href="/system/view/access/">Resend Verification Code</a></small><br>
               <small><a class="text-decoration-none" href="/system/view//forgot-pw/">Reset Password</a></small>
             </div>
           </form>
         </div>
        </div>
      </div>
    </div>
  </div>
</div>
