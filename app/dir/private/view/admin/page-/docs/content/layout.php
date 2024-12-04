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
                  <?php include('../../components/alert.php'); ?>
                  <!-- Content -->
                  <?php include('main.php') ?>
                  <!-- Modals -->
                  <?php include('modal/add-doc.php'); ?>
                  <?php include('modal/delete-doc.php'); ?>
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