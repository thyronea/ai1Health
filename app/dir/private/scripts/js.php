<!-- Incomplete Profile Alert -->
<script type="text/javascript">
  $(window).on('load', function() {
      $('#admin_completeProfile').modal('show');
  });
</script>

<!-- Popover messages -->
<script type="text/javascript">
  const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
  const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>

<!-- Password Verification -->
<script>
 function onChange() {
    const password = document.querySelector('input[name=password]');
    const confirm = document.querySelector('input[name=confirm]');
    if (confirm.value === password.value) {
      confirm.setCustomValidity('');
    } else {
      confirm.setCustomValidity('Passwords do not match');
    }
  }
</script>

<!-- Script for generating random User ID -->
<script>
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 9) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("new_userID").value = randomNumber(7);
</script>

<!-- Script for generating random user Engine ID -->
<script>
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 9) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("user_engineID").value = randomNumber(7);
</script>

<!-- Script for generating random Engine ID -->
<script>
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 9) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("office_engineID").value = randomNumber(7);
</script>

<!-- Script for generating random thermometer ID -->
<script>
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 9) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("thermometer_engineID").value = randomNumber(7);
</script>

<!-- Script for generating random unit ID -->
<script>
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 9) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("unit_engineID").value = randomNumber(7);
</script>

<!-- Script for generating random inventory ID -->
<script>
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 9) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("inventory_engineID").value = randomNumber(7);
</script>

<!-- Script for generating random scanned inventory ID -->
<script>
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 9) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("scan_inventory_engineID").value = randomNumber(7);
</script>

<!-- Script for generating random patient ID -->
<script>
 function randomNumber(len) {
  var randomNumber;
  var n = '';

    for (var count = 0; count < len; count++) {
      randomNumber = Math.floor((Math.random() * 5) + 1);
      n += randomNumber.toString();
    }
    return n;
  }
  document.getElementById("patientID").value = randomNumber(7);
</script>

<!-- Script for generating random unique ID -->
<script>
function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 5) + 1);
    n += randomNumber.toString();
  }
  return n;
}
document.getElementById("uniqueID").value = randomNumber(8);
</script>

<!-- Script for generating random engineID-->
<script>
  function randomNumber(len) {
  var randomNumber;
  var n = '';

    for (var count = 0; count < len; count++) {
      randomNumber = Math.floor((Math.random() * 5) + 1);
      n += randomNumber.toString();
    }
    return n;
  }
  document.getElementById("engineID").value = randomNumber(7);
</script>

<!-- Script to print email log -->
<script>
  document.getElementById("emailLogPrint").onclick = function () {
    printElement(document.getElementById("emailLogprintThis"));
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

<!-- Script to print activity log -->
<script>
  document.getElementById("activityLogPrint").onclick = function () {
    printElement(document.getElementById("activityLogprintThis"));
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
Title: Edit User
Table location: /private/view/charts/usersTable.php
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
      $('#location').val(data[7]);
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

<!--
Title: Edit Location
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.location-editbtn').on('click', function() {

      $('#location-edit').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#location_id').val(data[0]);
      $('#location_engine_id').val(data[1]);
      $('#location_groupID').val(data[2]);
      $('#location_name').val(data[3]);
      $('#location_address1').val(data[4]);
      $('#location_address2').val(data[5]);
      $('#location_city').val(data[6]);
      $('#location_state').val(data[7]);
      $('#location_zip').val(data[8]);
      $('#location_phone').val(data[9]);
      $('#location_email').val(data[10]);
      $('#location_link').val(data[11]);
      $('#location_poc').val(data[12]);
    });
  });
</script>

<!--
Title: Delete Location
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.location-deletebtn').on('click', function() {

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#delete_locationID').val(data[0]);
      $('#delete_location_engineID').val(data[1]);
      $('#delete_location_name').val(data[3]);

    });
  });
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

<!--
Title: Edit Unit
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
      $('#unitEngineID').val(data[1]);
      $('#unit_groupID').val(data[2]);
      $('#unit_location').val(data[3]);
      $('#unit_position').val(data[4]);
      $('#unit_name').val(data[5]);
      $('#unit_type').val(data[6]);
      $('#unit_grade').val(data[7]);
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
      $('#delete_storage_location').val(data[3]);
      $('#delete_storage_name').val(data[4]);
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
      $('#therm_location').val(data[3]);
      $('#therm_position').val(data[4]);
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
      $('#delete_therm_location').val(data[3]);
      $('#delete_therm_name').val(data[5]);
    });
  });
</script>

<!--
Title: Edit Vaccine
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.inventory-editbtn').on('click', function() {

      $('#inventory-edit').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#inventory_id').val(data[0]);
      $('#inventory_engineid').val(data[1]);
      $('#groupid').val(data[2]);
      $('#doses').val(data[3]);
      $('#name').val(data[4]);
      $('#name_delete').val(data[4]);
      $('#inventory_manufacturer').val(data[5]);
      $('#ndc').val(data[6]);
      $('#lot').val(data[7]);
      $('#lot_delete').val(data[7]);
      $('#exp').val(data[8]);
      $('#source').val(data[9]);
      $('#storage').val(data[10]);
      $('#timestamp').val(data[11]);
    });
  });
</script>

<!--
Title: Assign Patient
Location: /private/view/modals/patientsModals.php
-->
<script>
  $(document).ready(function () {
    $('.assignPatient').on('click', function() {

      $('#assignPatient').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#engine_ID').val(data[0]);
      $('#patient_ID').val(data[1]);
      $('#patient_name').val(data[2]);
      $('#patient_email').val(data[3]);
    });
  });
</script>

<!--
Title: Remove Patient
Location: /private/view/modals/patientsModals.php
-->
<script>
  $(document).ready(function () {
    $('.patientdeletebtn').on('click', function() {

      $('#patientdeletemodal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#engine_id').val(data[0]);
      $('#patient_id').val(data[1]);
      $('#patient_name').val(data[2]);
      $('#patients_email').val(data[3]);
    });
  });
</script>

<!--
Title: Patient Chart: Edit Emergency Contact
Location: /private/view/admin/patient-chart/modals/patient-edit-emergency.php
-->
<script>
  $(document).ready(function () {
    // passes the immunization ("covid") id and submits a request from the office table
    $('.emergency_editbtn').on('click', function() {
      // passes covid information from immunization table to covid-vaccine modal
      $('#patient-edit-emergency-Modal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      // information passed from immunization table to office covid-vaccine modal
      $('#emergency_ID').val(data[0]);
      $('#emergency_ID_').val(data[0]);
      $('#emergency_patientID').val(data[1]);
      $('#emergency_patientID_').val(data[1]);
      $('#emergency_engineID').val(data[2]);
      $('#emergency_groupID').val(data[3]);
      $('#emergency_fname').val(data[5]);
      $('#emergency_fname_').val(data[5]);
      $('#emergency_fname__').val(data[5]);
      $('#emergency_lname').val(data[6]);
      $('#emergency_lname_').val(data[6]);
      $('#emergency_phone').val(data[7]);
      $('#emergency_email').val(data[9]);
    });
  });
</script>

<!--
Title: Send Message
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    // passes the immunization ("covid") id and submits a request from the office table
    $('.emergency_emailbtn').on('click', function() {
      // passes covid information from immunization table to covid-vaccine modal
      $('#emergency-message-Modal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#emergency_Email').val(data[9]);
    });
  });
</script>


<!-- Script for generating random uniqueID -->
<script>
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 9) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("rsv_uniqueID").value = randomNumber(8);
</script>


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

<!-- Script to print Inventory List -->
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

<!-- Script to print Vaccine Administered List -->
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
                  <input type="hidden" name="groupID[]" value="<?=$_SESSION['groupID']; ?>" class="form-control">\
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
            <input type="hidden" name="groupID[]" value="<?=$_SESSION['groupID']; ?>" class="form-control">\
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



