<!-- Google Pie Chart - Inventory Data -->
<script>
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Category', 'Count'],
      ['Private Inventory', <?=$private['count(*)']; ?>],
      ['Public Inventory', <?=$public['count(*)']; ?>]
    ]);

    var options = {
      title: 'Inventory Data',
      legend: 'none',
      pieHole: 0.4,
      slices: {
        0: { color: '#AAB7B8' },
        1: { color: '#96B7FF' },
        2: { color: '#CACFD2' },
        3: { color: '#AEB6BF' },
        4: { color: '#5D6D7E' },
        5: { color: '#7B7D7D' },
        6: { color: '#D0C3DE' }
      }
    };

    var chart = new google.visualization.PieChart(document.getElementById('inventorychart'));
    chart.draw(data, options);
  }
</script>

<div id="inventorychart" class="col" style="width: 525px; height: 485px;"></div>