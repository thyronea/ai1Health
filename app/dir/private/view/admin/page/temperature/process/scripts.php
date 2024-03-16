<!--
Title: Print Temperature Logs
Location: components/footer.php
-->
<script>
  document.getElementById("tempLogPrint").onclick = function () {
    printElement(document.getElementById("tempLogPrintThis"));
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
Title: Add More Storage Unit
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $(document).on('click', '.remove-btn', function () {
        $(this).closest('.sh-form').remove();
    });

    $(document).on('click', '.add-more-sh', function () {
        $('.paste-new-sh').append('<div class="sh-form mb-2">\
          <div class="col-md-2">\
              <div class="form-group">\
                  <input type="hidden" name="groupID[]" value="<?=$_SESSION['group_id']; ?>" class="form-control">\
              </div>\
          </div>\
            <div class="row g-2">\
              <div class="col-md-3">\
                  <div class="form-group">\
                      <input type="text" name="unitLocation[]" class="form-control form-control-sm" required>\
                  </div>\
              </div>\
                <div class="col-md-3">\
                    <div class="form-group">\
                      <select class="form-select form-select-sm" name="unitType[]" required>\
                        <option disabled selected>Select one</option>\
                        <option value="Refrigerator">Refrigerator</option>\
                        <option value="Freezer">Freezer</option>\
                      </select>\
                    </div>\
                </div>\
                <div class="col-md-2">\
                    <div class="form-group">\
                      <select class="form-select form-select-sm" name="unitGrade[]" required>\
                        <option disabled selected>Select one</option>\
                        <option value="Pharm-Grade">Pharm-Grade</option>\
                        <option value="Household">Household</option>\
                      </select>\
                    </div>\
                </div>\
                <div class="col-md-3">\
                    <div class="form-group">\
                        <input type="text" name="unitName[]" class="form-control form-control-sm" required>\
                    </div>\
                </div>\
                <div class="col-md-1">\
                  <div class="form-group">\
                      <button type="button" class="remove-btn focus-ring text-decoration-none btn"><i class="bi bi-trash"></i></button>\
                  </div>\
                </div>\
            </div>\
        </div>');
    });
  });
</script>

<!--
Title: Edit Storage Unit
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.storage-editbtn').on('click', function() {

      $('#storage-edit').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#unit_storageID').val(data[0]);
      $('#unit_engineID').val(data[1]);
      $('#unit_groupID').val(data[2]);
      $('#unit_office').val(data[3]);
      $('#unit_name').val(data[4]);
      $('#unit_location').val(data[5]);
      $('#unit_type').val(data[6]);
      $('#unit_grade').val(data[7]);
    });
  });
</script>

<!--
Title: Add More Thermometer
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $(document).on('click', '.remove-btn', function () {
        $(this).closest('.thermometer-form').remove();
    });
    $(document).on('click', '.add-more-thermometer', function () {
      $('.paste-new-thermometer').append('<div class="thermometer-form mb-2">\
        <div class="col-md-2">\
          <div class="form-group">\
            <input type="hidden" name="groupID[]" value="<?=$_SESSION['group_id']; ?>" class="form-control">\
          </div>\
        </div>\
        <div class="row g-2">\
          <div class="col-md-3">\
            <div class="form-group">\
              <select class="form-select form-select-sm" name="thermLocation[]" required>\
                <option disabled selected></option>\
                <option value="Refrigerator">Refrigerator</option>\
                <option value="Freezer">Freezer</option>\
                <option value="Back-up">Back-up</option>\
              </select>\
            </div>\
          </div>\
          <div class="col-md-3">\
            <div class="form-group">\
                <input type="text" name="thermName[]" class="form-control form-control-sm" required>\
            </div>\
          </div>\
          <div class="col-md-3">\
            <div class="form-group">\
                <input type="text" name="thermSerial[]" class="form-control form-control-sm" required>\
            </div>\
          </div>\
          <div class="col-md-2">\
            <div class="form-group">\
                <input type="date" name="thermExpiration[]" class="form-control form-control-sm" required>\
            </div>\
          </div>\
          <div class="col-md-1">\
            <div class="form-group form-group-sm">\
                <button type="button" class="remove-btn btn focus-ring py-1 px-2 text-decoration-none border-none"><i class="bi bi-trash"></i></button>\
            </div>\
          </div>\
        </div>\
       </div>');
    });
  });
</script>

<!--
Title: Edit Thermometer
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.thermometer-editbtn').on('click', function() {

      $('#thermometer-edit').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#thermID').val(data[0]);
      $('#therm_engineID').val(data[1]);
      $('#therm_groupID').val(data[2]);
      $('#therm_office').val(data[3]);
      $('#therm_location').val(data[4]);
      $('#therm_name').val(data[5]);
      $('#therm_serial').val(data[6]);
      $('#therm_expiration').val(data[7]);
    });
  });
</script>

<!--
Title: Delete Thermometer
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.thermometerdeletebtn').on('click', function() {

      $('#thermometerdeletemodal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#delete_thermID').val(data[0]);
      $('#delete_therm_engineID').val(data[1]);
      $('#delete_therm_name').val(data[5]);
    });
  });
</script>

<!--
Title: Delete Storage Unit
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.storagedeletebtn').on('click', function() {

      $('#storagedeletemodal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#delete_storage_storageID').val(data[0]);
      $('#delete_storage_engineID').val(data[1]);
      $('#delete_storage_name').val(data[4]);
    });
  });
</script>
