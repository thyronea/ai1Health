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
