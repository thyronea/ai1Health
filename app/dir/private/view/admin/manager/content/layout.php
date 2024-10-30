<div class="container" style="animation: appear 2s ease">
  <div class="row col-md-12">
    <div class="tab-content" id="v-pills-tabContent">


    <div class="col-md-12">
      <div class="d-flex align-items-st">
        <div class="container-fluid">
          <div class="row flex-nowrap">

          <!-- Sidebar -->
          <?php include('components/sidebar.php'); ?>

          <!-- Content and Modals -->
          <main>
            <div class="row m-2">
              <div class="col-md-12">
                <div class="row col d-flex justify-content-center">
                  <!-- Header Alert -->
                  <?php include(PRIVATE_CONTENT_PATH . '/admin/headerAlert.php'); ?>  
                  <!-- Content -->
                  <?php include('activity-chart.php') ?>
                  <!-- Modals -->
                  <?php include('modal/add-image.php'); ?>
                  <?php include('modal/add-user.php'); ?>
                  <?php include('modal/edit-user.php'); ?>
                  <?php include('modal/delete-user.php'); ?>
                  <?php include('modal/add-location.php'); ?>
                  <?php include('modal/edit-location.php'); ?>
                  <?php include('modal/delete-location.php'); ?>
                  <?php include('modal/send-email.php'); ?>
                  <?php include('modal/email-log.php'); ?>
                  <?php include('modal/email-clear.php'); ?>
                  <?php include('modal/activity-log.php'); ?>
                  <?php include('modal/activity-clear.php'); ?>
                  <?php include('modal/account-manager.php'); ?>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
    </div>

    </div>
  </div>
 </div>
</div>

<style>
  @keyframes appear {
    0%{opacity: 0;transform: translate(50px);}
    100%{opacity: 1;transform: translate(0px);}
}
</style>