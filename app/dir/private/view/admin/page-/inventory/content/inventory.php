<div class="col-md-12" style="animation: appear 2s ease">
  <!-- Header Alert -->
  <?php include('../../components/alert.php'); ?>

  <div class="card border-0 mb-3" style="overflow:auto">
    <div class="card-body table-responsive">
      
        <!-- SQL Math for Google Charts -->
        <?php include('process/math.php'); ?>

        <!-- Inventory Chart & List -->
        <div class="row">
          <!-- Inventory Google Chart-->
          <div id="inventorychart" class="col" style="width: 525px; height: 485px;"></div>
          <!-- Inventory List -->
          <?php include('inventory-list.php'); ?>
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


