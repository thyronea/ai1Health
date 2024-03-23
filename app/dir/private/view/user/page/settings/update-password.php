<div class="card shadow" style="width:35rem">
  <div class="card-body">
    <div class="container mt-2" align="center">
      <div class="mb-4">
        <small style="color: red;">Password confirmation is required</small>
      </div>
      <div class="col-md-8">
          <form class="" action="update-password-process.php" method="post">
            <div class="mb-2">
              <small>User ID: <?=htmlspecialchars($_SESSION['userID'])?></small>
            </div>
            <div class="row g-2 mb-2">
              <div class="col">
                <input type="password" name="password" onChange="onChange()" placeholder="Enter Password" class="inputs form-control form-control-sm" style="text-align:center;" required>
              </div>
            </div>
            <div class="row g-2 mb-4">
              <div class="col">
                <input type="password" name="confirm" onChange="onChange()" placeholder="Confirm Password" class="inputs form-control form-control-sm" style="text-align:center;" required>
              </div>
            </div>
            <div class="row g-2 mb-2">
              <div class="col">
                <button type="submit" name="reset_password_btn" class="focus-ring btn btn-outline-secondary btn-sm">Send Reset Password Link</button>
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>

<script>
 function onChange() {
    const password = document.querySelector('input[name=password]');
    const confirm = document.querySelector('input[name=confirm]');
    if (confirm.value === password.value) {
      confirm.setCustomValidity('');
    } else {
      confirm.setCustomValidity('Passwords do not match');
    }
  }
</script>
