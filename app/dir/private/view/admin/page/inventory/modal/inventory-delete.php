<!-- Modal -->
<div class="modal fade" id="inventorydeletemodal" tabindex="-1" aria-labelledby="inventorydeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title w-100 fs-5" id="vaccinedeletemodal-ModalLabel">Delete Inventory</h1>
      </div>

      <div class="modal-body">
        <form class="" action="process/delete-inventory.php" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input class="form-control mb-2" type="hidden" name="engineID" id="delete_vaccine_engineID">
            <input class="form-control mb-2" type="hidden" name="delete_vaccine_name" id="delete_vaccine_name">
            <!----------------------------------------------------->
            <p align="center">Vaccine will be permanently removed from inventory.</p>
            <p>Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-secondary btn-sm">No</button>
            <button type="submit" name="inventorydeletebtn" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>


<!--
Title: Delete Vaccine
Location: components/footer.php
-->
<script>
  $(document).ready(function () {
    $('.inventorydeletebtn').on('click', function() {

      $('#inventorydeletemodal').modal('show');

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