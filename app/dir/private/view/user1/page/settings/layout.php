<?php
include('src.php');
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DLi - Settings</title>
    <?php include('../../../../components/links.php'); ?>
  </head>
  <body>
    <div class="container" align="center">
      <div class="col-md-12">
        <div class="py-5">
          <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#update-profile" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><small>Profile</small></button>
              <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><small>Password</small></button>
              <a class="nav-link" href="/private/view/user/index.php" type="button" ><small>Back</small></a>
            </div>
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="update-profile" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                <?php include('update-profile.php'); ?>
              </div>
              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                <?php include('update-password.php'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
