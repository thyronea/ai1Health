<!-- Google Pie Chart - Gender Data for ALL -->
<script>
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Category', 'Count'],
      ['Male', <?=$male['count(*)']; ?>],
      ['Female', <?=$female['count(*)']; ?>]
    ]);

    var options = {
      title: 'Patient Data',
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

    var chart = new google.visualization.PieChart(document.getElementById('patientchart'));
    chart.draw(data, options);
  }
</script>

<div class="col">
    <div id="patientchart" style="width: 425px; height: 385px;"></div>
</div>