<!-- Modal -->
<div class="modal fade" id="clearinventory" tabindex="-1" aria-labelledby="clearinventoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title fs-5" id="clearinventoryLabel">Clear Inventory</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="" action="process/sql.php" method="POST">
          <div class="form-group mt-3 mb-5">
            <!-- Hidden inputs to be insterted to activity table -->
            <input class="form-control mb-2" type="" name="engineID" id="clear_engineid">
            <input class="form-control mb-2" type="" name="delete_vaccine_name" id="clear_name">
            <!----------------------------------------------------->
            <p align="center">Vaccine will be permanently removed from inventory.</p>
            <p>Do you still want to proceed?</p>
          </div>

          <div class="form-group mb-3" align="center">
            <button type="button" data-bs-dismiss="modal" class="btn btn-outline-secondary btn-sm">No</button>
            <button type="submit" name="vaccinedeletebtn" class="btn btn-outline-danger btn-sm">Yes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<?php

// Display patient name from database to snapshot
if(isset($_GET['id']))
{
  $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
  $patientID = mysqli_real_escape_string($con, $_GET['id']);
  $query = "SELECT * FROM vaccines WHERE groupID='$groupID' AND engineID='$engineID'";
  $query_run = mysqli_query($con, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
    $patients = mysqli_fetch_array($query_run);
    foreach($query_run as $patient){}
  }
}

?>
