<!--
Title: Google Pie Chart - Document Data
Location: pages/admin/index.php
-->
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


<!--
Title: Delete File
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.filedelete').on('click', function() {

      $('#filedeletemodal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#file_ID').val(data[0]);
      $('#file_userID').val(data[1]);
      $('#file_groupID').val(data[2]);
      $('#file_docname').val(data[3]);
      $('#file_type').val(data[4]);

    });
  });
</script>
