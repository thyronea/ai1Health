<div class="container">
  <div class="container-fluid" align="center">
   <div class="row flex-nowrap" style="animation: appear 2s ease">

     <!-- Sidebar Menu Button -->
     <?php include('components/sidebar.php'); ?>

     <!-- Inventory Chart and List-->
     <?php include('content/inventory.php'); ?>

     <!-- Modals -->
     <?php include('modal/add-vaccine.php'); ?>
     <?php include('modal/vaccine-edit.php'); ?>
     <?php include('modal/vaccine-delete.php'); ?>
     <?php include('modal/vaccine-inventory-list.php'); ?>
     <?php include('modal/vaccine-administered-list.php'); ?>
     <?php include('modal/clear-inventory.php'); ?>

   </div>
  </div>
</div>
