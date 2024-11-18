<!-- Google Pie Chart - Document Data -->
<script>
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Category', 'Count'],
      ['pdf', <?=$pdf['count(*)']; ?>],
      ['word', <?=$word['count(*)']; ?>],
      ['csv', <?=$csv['count(*)']; ?>],
      ['txt', <?=$txt['count(*)']; ?>]
    ]);

    var options = {
      // title: 'Document',
      legend: 'none',
      pieHole: 0.4,
      slices: {
        0: { color: '#96B7FF' },
        1: { color: '#5D6D7E' },
        2: { color: '#D0C3DE' },
        3: { color: '#AEB6BF' },
        4: { color: '#AAB7B8' }
      }
    };

    var chart = new google.visualization.PieChart(document.getElementById('doc_chart'));
    chart.draw(data, options);
  }
</script>

<div id="doc_chart" style="width: 525px; height: 485px;"></div>