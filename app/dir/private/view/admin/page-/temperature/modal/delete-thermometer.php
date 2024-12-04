<!-- Modal -->
<div class="modal fade" id="thermometerdeletemodal" tabindex="-1" aria-labelledby="storagedeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="thermometerdeletemodal-ModalLabel">Delete Thermometer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="process/delete-thermometer.php" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input class="form-control mb-2" type="hidden" name="id" id="delete_thermID">
            <input class="form-control mb-2" type="hidden" name="engineID" id="delete_therm_engineID">
            <input class="form-control mb-2" type="hidden" name="delete_thermometer_location" id="delete_therm_location">
            <input class="form-control mb-2" type="hidden" name="delete_thermometer_name" id="delete_therm_name">
            <!----------------------------------------------------->
            <p align="center">Thermometer will be permanently removed from database.</p>
            <p>Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-secondary btn-sm">No</button>
            <button type="submit" name="thermometerdeletebtn" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

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
