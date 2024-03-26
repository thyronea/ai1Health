<!--
Title: Google Pie Chart - Inventory Data for ALL
Location: pages/admin/index.php
-->
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

<!--
Title: Print Vaccine Inventory List
Location: components/footer.php
-->
<script>
  document.getElementById("vaccineReportPrint").onclick = function () {
    printElement(document.getElementById("vaccineReportprintThis"));
  };

  function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
 }
</script>

<!--
Title: Print Vaccine Administered List
Location: components/footer.php
-->
<script>
  document.getElementById("administeredReportPrint").onclick = function () {
    printElement(document.getElementById("administeredReportprintThis"));
  };

  function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
 }
</script>

<!--
Title: Add Vaccines
Location: components/footer.php
-->
<script>
    $(document).ready(function () {

        $(document).on('click', '.remove-btn', function () {
            $(this).closest('.main-form').remove();
        });

        $(document).on('click', '.add-more-form', function () {
            $('.paste-new-forms').append('<div class="main-form mt-3">\
              <div class="col-md-3">\
                <div class="form-group mb-3 mt-2">\
                  <input type="hidden" name="engineID[]" value="<?php echo(rand(1000000,10000000)); ?>" class="form-control form-control-sm" required>\
                </div>\
                  <div class="form-group mb-1">\
                      <input type="hidden" name="groupID" value="<?=htmlspecialchars($_SESSION['group_id']); ?>" class="form-control form-control-sm">\
                  </div>\
              </div>\
              <div class="row g-2">\
              <div class="col">\
                <select class="form-group form-select form-select-sm" name="storage[]">\
                  <option disabled selected>Storage Unit</option>\
                  <?php
                  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
                  $sql = "SELECT * FROM storage WHERE groupID='$groupID' ";
                  $sql_run = mysqli_query($con, $sql);
                  $office = mysqli_num_rows($sql_run);
                  while ($storage = mysqli_fetch_array($sql_run))
                  {
                  ?>
                  <option value="<?=htmlspecialchars(decryptthis($storage['name'], $key));?>"><?=htmlspecialchars(decryptthis($storage['name'], $key));?></option>"\
                  <?php
                  }
                  ?>
                </select>\
              </div>\
                  <div class="col">\
                      <div class="form-group mb-1">\
                        <select class="form-select form-select-sm" name="manufacturer[]" required>\
                          <option disabled selected>Manufacturer</option>\
                          <option value="GSK">GSK</option>\
                          <option value="Merck">Merck</option>\
                          <option value="Pfizer">Pfizer</option>\
                          <option value="Sanofi">Sanofi</option>\
                          <option value="Seqirus">Seqirus</option>\
                          <option value="AstraZeneca">AstraZeneca</option>\
                        </select>\
                      </div>\
                  </div>\
                  <div class="col">\
                    <div class="form-group mb-2">\
                          <select class="form-select form-select-sm" name="vaccine[]" required>\
                            <option disabled selected>Product</option>\
                            <option disabled>DTaP</option>\
                            <option value="DTaP - Daptacel Single Dose Vials">Daptacel (Single Dose Vials)</option>\
                            <option value="DTaP - Infanrix Single Dose Vials">Infanrix (Single Dose Vials)</option>\
                            <option value="DTaP - Infanrix Single Dose Syringes">Infanrix (Single Dose Syringes)</option>\
                            <option disabled>DTaP/IPV</option>\
                            <option value="DTaP/IPV - Kinrix Single Dose Vials">Kinrix (Single Dose Vials)</option>\
                            <option value="DTaP/IPV - Kinrix Single Dose Syringes">Kinrix (Single Dose Syringes)</option>\
                            <option value="DTaP/IPV - Quadracel Single Dose Vials">Quadracel (Single Dose Vials)</option>\
                            <option value="DTaP/IPV - Quadracel Single Dose Syringes">Quadracel (Single Dose Syringes)</option>\
                            <option disabled>DTaP/Hep-B/IPV</option>\
                            <option value="DTaP/Hep-B/IPV - Pediarix Single Dose Syringes">Pediarix (Single Dose Syringes)</option>\
                            <option disabled>DTaP/IPV/Hib</option>\
                            <option value="DTaP/IPV/Hib - Pentacel Single Dose Vials">Pentacel (Single Dose Vials)</option>\
                            <option disabled>DTaP/IPV/Hib/Hep-B</option>\
                            <option value="DTaP/IPV/Hib/Hep-B - Vaxelis Single Dose Vials">Vaxelis (Single Dose Vials)</option>\
                            <option value="DTaP/IPV/Hib/Hep-B - Vaxelis Single Dose Syringes">Vaxelis (Single Dose Syringes)</option>\
                            <option disabled>Hepatitis A</option>\
                            <option value="Hepatitis A - Vaqta Single Dose Vials">Vaqta (Single Dose Vials)</option>\
                            <option value="Hepatitis A - Vaqta Single Dose Syringes">Vaqta (Single Dose Syringes)</option>\
                            <option value="Hepatitis A - Havrix Single Dose Vials">Havrix (Single Dose Vials)</option>\
                            <option value="Hepatitis A - Havrix Single Dose Syringes">Havrix (Single Dose Syringes)</option>\
                            <option disabled>Hepatitis B</option>\
                            <option value="Hepatitis B - Engerix B Single Dose Vials">Engerix B (Single Dose Vials)</option>\
                            <option value="Hepatitis B - Engerix B Single Dose Syringes">Engerix B (Single Dose Syringes)</option>\
                            <option value="Hepatitis B - Recombivax Single Dose Vials">Recombivax (Single Dose Vials)</option>\
                            <option value="Hepatitis B - Recombivax Single Dose Syringes">Recombivax (Single Dose Syringes)</option>\
                            <option disabled>Hib</option>\
                            <option value="Hib - PedvaxHib Single Dose Vials">PedvaxHib B (Single Dose Vials)</option>\
                            <option value="Hib - ActHIB Single Dose Vials">ActHIB (Single Dose Vials)</option>\
                            <option value="Hib - Hiberix Single Dose Vials">Hiberix (Single Dose Vials)</option>\
                            <option disabled>HPV</option>\
                            <option value="HPV - Gardasil 9 Single Dose Syringes">Gardasil 9 (Single Dose Syringes)</option>\
                            <option disabled>IPV</option>\
                            <option value="IPV - IPOL 10 Dose Vials">IPOL (Single 10 Dose Vials)</option>\
                            <option disabled>Meningococcal Conjugate</option>\
                            <option value="MCV - Menactra Single Dose Vials">Menactra (Single Dose Vials)</option>\
                            <option value="MCV - Menveo Single Dose Vials">Menveo (Single Dose Vials)</option>\
                            <option value="MCV - MenQuadfi Single Dose Vials">MenQuadfi (Single Dose Vials)</option>\
                            <option disabled>Meningococcal B</option>\
                            <option value="MenB - Trumenba Single Dose Syringes">Trumenba (Single Dose Syringes)</option>\
                            <option value="MenB - Bexsero Single Dose Syringes">Bexsero (Single Dose Syringes)</option>\
                            <option disabled>MMR</option>\
                            <option value="MMR - MMR-II Single Dose Vials">MMR-II (Single Dose Vials)</option>\
                            <option value="MMR - Priorix Single Dose Vials">Priorix (Single Dose Vials)</option>\
                            <option disabled>Pneumococcal Conjugate</option>\
                            <option value="PCV - Prevnar Single Dose Syringes">Prevnar (Single Dose Syringes)</option>\
                            <option value="PCV - Vaxneuvance Single Dose Syringes">Vaxneuvance (Single Dose Syringes)</option>\
                            <option disabled>Rotavirus</option>\
                            <option value="RV - RotaTeq Single Dose Tubes">RotaTeq (Single Dose Tubes)</option>\
                            <option value="RV - Rotarix Single Dose Vials">Rotarix (Single Dose Vials)</option>\
                            <option value="RV - Rotarix Single Oral Doses">Rotarix (Single Oral Doses)</option>\
                            <option disabled>Tdap</option>\
                            <option value="Tdap - Boostrix Single Dose Vials">Boostrix (Single Dose Vials)</option>\
                            <option value="Tdap - Boostrix Single Dose Syringes">Boostrix (Single Dose Syringes)</option>\
                            <option value="Tdap - Adacel Single Dose Vials">Adacel (Single Dose Vials)</option>\
                            <option value="Tdap - Adacel Single Dose Syringes">Adacel (Single Dose Syringes)</option>\
                            <option disabled>Varicella</option>\
                            <option value="Varicella - Varivax Single Dose Vials">Varivax (Single Dose Vials)</option>\
                            <option disabled>MMRV</option>\
                            <option value="MMRV - Proquad Single Dose Vials">Proquad (Single Dose Vials)</option>\
                            <option disabled>Pneumococcal Polysaccharide</option>\
                            <option value="PPSV23 - Pneumovax Single Dose Vials">Pneumovax (Single Dose Vials)</option>\
                            <option value="PPSV23 - Pneumovax Single Dose Syringes">Pneumovax (Single Dose Syringes)</option>\
                            <option disabled>TD</option>\
                            <option value="TD - Tenivac Single Dose Vials">Tenivac (Single Dose Vials)</option>\
                            <option value="TD - Tenivac Single Dose Syringes">Tenivac (Single Dose Syringes)</option>\
                            <option disabled>COVID-19</option>\
                            <option value="COVID-19 - Pfizer-BioNTech">Pfizer-BioNTech</option>\
                            <option value="COVID-19 - Moderna">Moderna</option>\
                            <option value="COVID-19 - Novavax">Novavax</option>\
                            <option disabled>Influenza</option>\
                            <option value="Influenza - Fluarix Single Dose Syringes">Fluarix (Single Dose Syringes)</option>\
                            <option value="Influenza - Flucelvax Single Dose Syringes">Flucelvax (Single Dose Syringes)</option>\
                            <option value="Influenza - FluLaval Single Dose Syringes">FluLaval (Single Dose Syringes)</option>\
                            <option value="Influenza - Fluzone Single Dose Syringes">Fluzone (Single Dose Syringes)</option>\
                            <option value="Influenza - Flumist Intranasal Sprayer">Flumist (Intranasal Sprayer)</option>\
                            <option value="other" name="other">Other</option>\
                          </select>\
                          <div id="div1"></div>\
                        </div>\
                  </div>\
                  <div class="col">\
                    <div class="form-group mb-1">\
                      <input type="text" name="ndc[]" class="form-control form-control-sm" placeholder="NDC" required>\
                    </div>\
                  </div>\
              </div>\
              <div class="row g-2">\
                <div class="col-md-3">\
                    <div class="form-group mb-1">\
                        <input type="text" name="lot[]" class="form-control form-control-sm" placeholder="Lot" required>\
                    </div>\
                </div>\
                <div class="col">\
                    <div class="form-group mb-1">\
                        <input type="date" name="exp[]" class="form-control form-control-sm" required>\
                    </div>\
                </div>\
                <div class="col-md-3">\
                    <div class="form-group mb-1">\
                        <input type="text" name="doses[]" class="form-control form-control-sm" placeholder="Doses" required>\
                    </div>\
                </div>\
                <div class="col-md-2">\
                  <div class="form-group mb-3">\
                      <select class="form-select form-select-sm" name="funding[]" required>\
                        <option disabled selected>Source</option>\
                        <option value="Private">Private</option>\
                        <option value="Public">Public</option>\
                      </select>\
                    </div>\
                </div>\
                      <div class="col-md-1">\
                        <div class="form-group mb-3">\
                            <button type="button" class="remove-btn focus-ring text-decoration-none btn"><i class="bi bi-trash"></i></button>\
                        </div>\
                      </div>\
                    </div>\
                  </div>\
                </div>\
            </div>');
        });
    });
</script>
<!--
Title: Add "Other" Vaccines
Location: components/footer.php
-->
<script>
  function showfield(name){
    if(name=='other')document.getElementById('div1').innerHTML='<input type="text" class="form-control form-control-sm mt-2" placeholder="Other" name="other" />';
    else document.getElementById('div1').innerHTML='';
  }
</script>



<!--
Title: Delete Vaccine
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.vaccinedeletebtn').on('click', function() {

      $('#vaccinedeletemodal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#delete_vaccine_engineID').val(data[0]);
      $('#delete_vaccine_name').val(data[3]);
    });
  });
</script>

<!--
Title: Clear Vaccine inventory
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.clearinventory').on('click', function() {

      $('#clearinventory').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#clear_engineid').val(data[0]);
      $('#clear_name').val(data[3]);
    });
  });
</script>
