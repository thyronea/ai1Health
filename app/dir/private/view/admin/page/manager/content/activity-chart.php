<div class="card border-0 m-2" style="width: auto; height: auto; overflow: auto;">
  <div class="card-body">

    <!-- SQL query for data visualization -->
    <?php include('process/math.php'); ?>
    <?php include('process/scripts.php'); ?>

    <!-- Google Pie Chart -->
    <div class="col-md-12">
      <div class="row g-2">
        <div class="col">
          <div id="groupchart" style="width: 525px; height: 485px;"></div>
        </div>
        <div class="col">
          <div id="activitychart" style="width: 525px; height: 485px;"></div>
        </div>
      </div>
    </div>

  </div>
</div>
