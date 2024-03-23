<div class="col-md-8">
  <div class="card border-0" style="height: auto; overflow: auto;">
    <div class="card-body" align="center">

      <?php
      // Total Daptacel
      $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
      $query = "SELECT SUM(doses) FROM vaccines WHERE groupID='$groupID' AND vaccine='Daptacel Single Dose Vials' ";
      $query_run = mysqli_query($con, $query);
      $daptacel = mysqli_fetch_array($query_run);
      // Total Infanrix SDV
      $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
      $query = "SELECT SUM(doses) FROM vaccines WHERE groupID='$groupID' AND vaccine='Infanrix Single Dose Vials' ";
      $query_run = mysqli_query($con, $query);
      $infanrixSDV = mysqli_fetch_array($query_run);
      // Total Infanrix SDS
      $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
      $query = "SELECT SUM(doses) FROM vaccines WHERE groupID='$groupID' AND vaccine='Infanrix Single Dose Syringes' ";
      $query_run = mysqli_query($con, $query);
      $infanrixSDS = mysqli_fetch_array($query_run);
      // Total Kinrix SDV
      $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
      $query = "SELECT SUM(doses) FROM vaccines WHERE groupID='$groupID' AND vaccine='Kinrix Single Dose Vials' ";
      $query_run = mysqli_query($con, $query);
      $kinrixSDV = mysqli_fetch_array($query_run);
      // Total Kinrix SDS
      $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
      $query = "SELECT SUM(doses) FROM vaccines WHERE groupID='$groupID' AND vaccine='Kinrix Single Dose Syringes' ";
      $query_run = mysqli_query($con, $query);
      $kinrixSDS = mysqli_fetch_array($query_run);
      // Total Quadracel SDV
      $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
      $query = "SELECT SUM(doses) FROM vaccines WHERE groupID='$groupID' AND vaccine='Quadracel Single Dose Vials' ";
      $query_run = mysqli_query($con, $query);
      $quadracelSDV = mysqli_fetch_array($query_run);
      // Total Quadracel SDS
      $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
      $query = "SELECT SUM(doses) FROM vaccines WHERE groupID='$groupID' AND vaccine='Quadracel Single Dose Syringes' ";
      $query_run = mysqli_query($con, $query);
      $quadracelSDS = mysqli_fetch_array($query_run);
      // Total Pediarix SDV
      $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
      $query = "SELECT SUM(doses) FROM vaccines WHERE groupID='$groupID' AND vaccine='Pediarix Single Dose Syringes' ";
      $query_run = mysqli_query($con, $query);
      $pediarixSDV = mysqli_fetch_array($query_run);
      // Total Pentacel SDS
      $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
      $query = "SELECT SUM(doses) FROM vaccines WHERE groupID='$groupID' AND vaccine='Pentacel Single Dose Vials' ";
      $query_run = mysqli_query($con, $query);
      $pentacelSDS = mysqli_fetch_array($query_run);
      ?>

      <!-- Google Column Chart -->
      <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
          var data = google.visualization.arrayToDataTable([
            ['Vaccine', 'Doses'],
            ['Daptacel Single Dose Vials', <?=$daptacel['SUM(doses)'];?>],
            ['Infanrix Single Dose Vials', <?=$infanrixSDV['SUM(doses)'];?>],
            ['Infanrix Single Dose Syringes', <?=$infanrixSDS['SUM(doses)'];?>],
            ['Kinrix Single Dose Vials', <?=$kinrixSDV['SUM(doses)'];?>],
            ['Kinrix Single Dose Syringes', <?=$kinrixSDS['SUM(doses)'];?>],
            ['Quadracel Single Dose Vials', <?=$quadracelSDV['SUM(doses)'];?>],
            ['Quadracel Single Dose Syringes', <?=$quadracelSDS['SUM(doses)'];?>],
            ['Pediarix Single Dose Vials', <?=$pediarixSDV['SUM(doses)'];?>],
            ['Pentacel Single Dose Syringes', <?=$pentacelSDS['SUM(doses)'];?>],
          ]);

          var options = {
            width: 450,
            legend: 'none',
            vAxis: {title: 'Vaccine Inventory'},
            hAxis: {title: '', direction:1, slantedText:true, slantedTextAngle:45 },
            seriesType: 'bars',
            bar: { groupWidth: "75%" }
          };

          var chart = new google.visualization.ComboChart(document.getElementById('inventorychart'));
          chart.draw(data, options);
        }
      </script>

      <div id="inventorychart" style="width: 450px; height: auto;"></div>

    </div>
  </div>
</div>
