<!-- Google Pie Chart - Group Data -->
<script>
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Category', 'Count'],
      ['Admin', <?=$admin['count(*)']; ?>],
      ['User', <?=$user['count(*)']; ?>],
      ['Location', <?=$location['count(*)']; ?>]
    ]);

    var options = {
      title: 'Group Data',
      legend: 'none',
      pieHole: 0.4,
      slices: {
        0: { color: '#96B7FF' },
        1: { color: '#AEB6BF' },
        2: { color: '#AAB7B8' }
      }
    };

    var chart = new google.visualization.PieChart(document.getElementById('groupchart'));
    chart.draw(data, options);
  }
</script>

<!-- Google Pie Chart - Activity Data -->
<script>
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Category', 'Count'],
      ['Emails Sent', <?=$email['count(*)']; ?>],
      ['Account Updates', <?=$updates['count(*)']; ?>],
      ['User Sign-in', <?=$signin['count(*)']; ?>],
      ['Logs cleared', <?=$clear['count(*)']; ?>]
    ]);

    var options = {
      title: 'Activity Data',
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

    var chart = new google.visualization.PieChart(document.getElementById('activitychart'));
    chart.draw(data, options);
  }
</script>

<div class="col-md-12">
      <div class="row g-2">
          <div class="col">

              <div id="groupchart" style="width: 425px; height: 385px;"></div>

            </div>
            <div class="col">

              <div id="activitychart" style="width: 425px; height: 385px;"></div>
                            
          </div>
    </div>
</div>