<div class="modal fade" id="delete_tdap" tabindex="-1" aria-labelledby="delete_tdapLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="delete_tdapLabel">Tdap</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mt-3">
        <div class="col-md-12">
          <form class="" action="" method="post">
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($patient['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patient_lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="Last Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="uniqueID" id="delete_tdap_uniqueID" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="vaccine" id="delete_tdap_name" required>
            
            <p align="center">Administered Tdap vaccine will be permanently removed from the immunization chart.</p>
            <p>Do you still want to proceed?</p>

            <a type="button" class="focus-ring btn btn-sm border mt-3" id="submit_btn" data-bs-toggle="modal" data-bs-target="#edit_administered_tdap">No</a>  
            <button type="submit" name="delete_administered_vax" class="focus-ring btn btn-sm border mt-3" id="submit_btn">Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
