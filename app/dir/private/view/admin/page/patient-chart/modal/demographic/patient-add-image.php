<div class="modal fade" id="patient-add-image" tabindex="-1" aria-labelledby="patient-add-imageLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patient-add-imageLabel">Add Profile Image</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="col-md-8">
            
          <form class="" action="process/demographic/add-patient-image.php" method="post" enctype="multipart/form-data">
            <div class="col-auto">
              <input type="hidden" class="form-control form-control-sm" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
              <input type="file" name="patient_image" class="form-control form-control-sm mt-2" required>
            </div>
            <button type="submit" name="add_patient_image" class="focus-ring btn btn-sm border mt-3">Upload</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
