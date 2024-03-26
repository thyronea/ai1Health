<div class="col-md-12" style="animation: appear 2s ease">
  <!-- Header Alert -->
  <?php include('../../components/alert.php'); ?>

  <div class="card border-0 mb-3" style="overflow:auto">
    <div class="card-body table-responsive">

      <!-- Vaccine Search Box -->
      <div class="col-md-3" hidden>
       <form class="" action="" method="get">
         <div class="input-group input-group-sm">
           <input type="text" name="vaccine_search" value="<?php if(isset($_GET['vaccine_search'])){echo $_GET['']; }?>" class="form-control" placeholder="Search for vaccine" required>
          <button type="submit" class="focus-ring btn btn-secondary border" name="button">Search</button>
        </div>
       </form>
      </div>
      
        <!-- SQL Math for Google Charts -->
        <?php include('process/math.php'); ?>
        <?php include('process/scripts.php'); ?>

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


