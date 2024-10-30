<!--
Title: Google Pie Chart - Gender Data for ALL
Location: pages/admin/index.php
-->
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

<!--
Title: Patient View
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.patient-infobtn').on('click', function() {

      $('#patient-info').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#patient_id').val(data[0]);
      $('#patientID').val(data[1]);
      $('#fname').val(data[2]);
      $('#lname').val(data[3]);
      $('#suffix').val(data[4]);
      $('#dob').val(data[5]);
      $('#gender').val(data[6]);
      $('#image').val(data[7]);
    });
  });
</script>

<!--
Title: Popover
Location: components/footer.php
-->
<script type="text/javascript">
  const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
  const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>

<!--
Title: Edit Administered COVID-19
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    // passes the immunization ("covid") id and submits a request from the office table
    $('.covid-editbtn').on('click', function() {
      // passes covid information from immunization table to covid-vaccine modal
      $('#covid-vaccine-Modal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      // information passed from immunization table to office covid-vaccine modal
      $('#covid_id').val(data[0]);
      $('#date').val(data[1]);
      $('#time').val(data[2]);
      $('#vaccine').val(data[3]);
      $('#manufacturer').val(data[4]);
      $('#covid_ndc').val(data[5]);
      $('#covid_lot').val(data[6]);
      $('#covid_exp').val(data[7]);
      $('#site').val(data[8]);
      $('#route').val(data[9]);
      $('#vis').val(data[10]);
      $('#vis_given').val(data[11]);
      $('#administered_by').val(data[12]);
      $('#funding_source').val(data[13]);
      $('#comment').val(data[14]);
      $('#type').val(data[15]);
      $('#covid_engineID').val(data[16]);
      $('#covid_patientID').val(data[17]);
    });
  });
</script>

<!--
Title: Delete Administered COVID-19
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.delete_covid').on('click', function() {

      $('#delete_covid').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#delete_covid_id').val(data[0]),
      $('#delete_covid_name').val(data[4]),
      $('#delete_covid_type').val(data[15]);

    });
  });
</script>

<!--
Title: Edit Administered Influenza
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    // passes the immunization ("covid") id and submits a request from the office table
    $('.influenza-editbtn').on('click', function() {
      // passes covid information from immunization table to covid-vaccine modal
      $('#influenza-vaccine-Modal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      // information passed from immunization table to office covid-vaccine modal
      $('#influenza_id').val(data[0]);
      $('#influenza_date').val(data[1]);
      $('#influenza_time').val(data[2]);
      $('#influenza_vaccine').val(data[3]);
      $('#influenza_manufacturer').val(data[4]);
      $('#influenza_ndc').val(data[5]);
      $('#influenza_lot').val(data[6]);
      $('#influenza_exp').val(data[7]);
      $('#influenza_site').val(data[8]);
      $('#influenza_route').val(data[9]);
      $('#influenza_vis').val(data[10]);
      $('#influenza_vis_given').val(data[11]);
      $('#influenza_administered_by').val(data[12]);
      $('#influenza_funding_source').val(data[13]);
      $('#influenza_comment').val(data[14]);
      $('#influenza_type').val(data[15]);
      $('#influenza_engineID').val(data[16]);
      $('#influenza_patientID').val(data[17]);
    });
  });
</script>

<!--
Title: Delete Administered Influenza
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.delete_influenza').on('click', function() {

      $('#delete_influenza').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#delete_influenza_id').val(data[0]),
      $('#delete_influenza_name').val(data[4]),
      $('#delete_influenza_type').val(data[15]);

    });
  });
</script>
