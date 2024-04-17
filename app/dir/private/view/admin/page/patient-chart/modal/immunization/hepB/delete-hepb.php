<div class="modal fade" id="delete_hepb" tabindex="-1" aria-labelledby="delete_hepbLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="delete_hepbLabel">Hepatitis B</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mt-3">
        <div class="col-md-12">
          <form class="" action="process/immunization/delete-hepB.php" method="post">
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="Last Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="hepB_uniqueID" id="hepB_uniqueID" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="vaccine" id="delete_hepB_name" required>
            
            <p align="center">Administered Hepatits B will be permanently removed from the immunization chart.</p>
            <p>Do you still want to proceed?</p>

            <a type="button" class="focus-ring btn btn-sm border mt-3" id="submit_btn" data-bs-toggle="modal" data-bs-target="#edit_administered_hepb">No</a>  
            <button type="submit" name="delete_hepB" class="focus-ring btn btn-sm border mt-3" id="submit_btn">Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
