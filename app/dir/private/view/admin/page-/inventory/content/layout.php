<div class="container">
  <div class="container-fluid" align="center">
   <div class="row flex-nowrap" style="animation: appear 1s ease">

     <!-- Sidebar Menu Button -->
     <?php include('components/sidebar.php'); ?>

     <!-- Inventory Chart and List-->
     <?php include('content/inventory.php'); ?>

     <!-- Modals -->
     <?php include('modal/inventory-add.php'); ?>
     <?php include('modal/inventory-scan.php'); ?>
     <?php include('modal/inventory-edit.php'); ?>
     <?php include('modal/inventory-delete.php'); ?>
     <?php include('modal/inventory-list.php'); ?>
     <?php include('modal/vaccine-administered-list.php'); ?>
     <?php include('modal/clear-inventory.php'); ?>

   </div>
  </div>
</div>
