<!-- Modal -->
<div class="modal fade" id="storagedeletemodal" tabindex="-1" aria-labelledby="storagedeletemodal-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title fs-5" id="storagedeletemodal-ModalLabel">Delete Storage Unit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="process/delete-unit.php" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input class="form-control mb-2" type="hidden" name="id" id="delete_storage_storageID">
            <input class="form-control mb-2" type="hidden" name="engineID" id="delete_storage_engineID">
            <input class="form-control mb-2" type="hidden" name="delete_storage_location" id="delete_storage_location">
            <input class="form-control mb-2" type="hidden" name="delete_storage_name" id="delete_storage_name">
            <!----------------------------------------------------->
            <p align="center">Storage unit will be permanently removed from database.</p>
            <p>Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-secondary btn-sm">No</button>
            <button type="submit" name="storagedeletebtn" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

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

