<!-- Modal -->
<div class="modal fade" id="add-user-Modal" tabindex="-1" aria-labelledby="add-user-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="add-user-ModalLabel">Add User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form class="" action="process/user-add.php" method="POST">
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
      </div>
      <div class="modal-footer col d-flex justify-content-center form-group">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#account-manager-Modal">Back</button>
        <button type="submit" name="register_btn" class="btn btn-outline-secondary btn-sm">Add</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Script for generating random User ID -->
<script>
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 9) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("new_userID").value = randomNumber(7);
</script>

<!-- Script for generating random Engine ID -->
<script>
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 9) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("user_engineID").value = randomNumber(7);
</script>
