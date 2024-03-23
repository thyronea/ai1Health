<?php
session_start();
require_once('../../../../initialize.php');
include(PRIVATE_SECURITY_PATH . '/dbcon.php');
include(PRIVATE_SECURITY_PATH . '/encrypt_decrypt.php');
include('../../../../components/src.php');
if(isset($_SESSION["userID"])) {
include('src.php');
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="1200;url=/private/access/logout-process.php" /> <!--Auto log out after 20 minutes-->
    <title>Settings</title>
  </head>
  <body>
    <div class="container" align="center">
      <div class="col-md-6">
        <div class="py-5">
          <?php include('alert.php'); ?>
          <div class="d-flex align-items-start">

            <!-- Controller -->
            <div class="nav flex-column me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <button class="nav-link active focus-ring py-1 px-2 btn border rounded-0" data-bs-toggle="pill" data-bs-target="#profile" type="button" role="tab">
                <small>Profile</small>
              </button>
              <button class="nav-link focus-ring py-1 px-2 btn border rounded-0" data-bs-toggle="pill" data-bs-target="#password" type="button" role="tab">
                <small>Password</small>
              </button>
              <a class="nav-link focus-ring py-1 px-2 btn border rounded-0" href="/private/view/admin/index.php?$_GET" type="button" ><small>Back</small></a>
            </div>

            <!-- Content -->
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="profile" role="tabpanel" tabindex="0">
                <?php include('update-profile.php'); ?>
                <?php include('add-profile-image.php'); ?>
                <?php include('add-background-image.php'); ?>
              </div>
              <div class="tab-pane fade" id="password" role="tabpanel" tabindex="0">
                <?php include('update-password.php'); ?>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </body>
</html>

<?php
}
else
{
  include(ADMIN_CONTENT . '/logged_out.php'); // Exit session
}
include(ADMIN_COMPONENTS . '/footer.php');

?>
