<!--
Title: Google Pie Chart - Group Data
Location: page/admin/index.php
-->
<script>
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Category', 'Count'],
      ['Admin', <?=$admin['count(*)']; ?>],
      ['User', <?=$user['count(*)']; ?>]
    ]);

    var options = {
      title: 'Group Data',
      legend: 'none',
      pieHole: 0.4,
      slices: {
        0: { color: '#96B7FF' },
        1: { color: '#AEB6BF' }
      }
    };

    var chart = new google.visualization.PieChart(document.getElementById('groupchart'));
    chart.draw(data, options);
  }
</script>

<!--
Title: Google Pie Chart - Activity Data
Location: pages/admin/index.php
-->
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

<!--
Title: Edit User
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.editbtn').on('click', function() {

      $('#editmodal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#userID').val(data[0]);
      $('#engineID').val(data[1]);
      $('#groupID').val(data[2]);
      $('#fname').val(data[3]);
      $('#lname').val(data[4]);
      $('#email').val(data[5]);
      $('#role').val(data[6]);
    });
  });
</script>

<!--
Title: Delete User
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.userdeletebtn').on('click', function() {

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#delete_userID').val(data[0]);
      $('#delete_engineID').val(data[1]);
      $('#delete_fname').val(data[3]);
      $('#delete_lname').val(data[4]);

    });
  });
</script>

