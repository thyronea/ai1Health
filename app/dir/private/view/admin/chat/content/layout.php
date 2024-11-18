<div class="container">
  <div class="d-flex align-items-st">
    <div class="container-fluid">
      <div class="row flex-nowrap">

      <!-- Sidebar -->
      <?php include('components/sidebar.php'); ?>

      <!-- Content and Modals -->
      <main>
        <!-- Header Alert -->
        <?php include(PRIVATE_VIEW_PATH . '/alerts/headerAlert.php'); ?> 
        <!-- Content -->
        <?php include('content/main.php') ?>
      </main>

      </div>
    </div>
  </div>
</div>
