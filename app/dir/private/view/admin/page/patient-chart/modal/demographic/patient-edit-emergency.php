<div class="modal fade" id="patient-edit-emergency-Modal" tabindex="-1" aria-labelledby="patient-edit-emergency-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patient-edit-emergency-ModalLabel">Update Emergency Contact</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-8">
          <form class="" action="process/update-patient-emergency.php" method="post">
            <input type="hidden" class="form-control form-control-sm mt-2" name="fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="Last Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="id" id="emergency_ID" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" id="emergency_patientID" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" id="emergency_engineID" required>
            <input type="" class="form-control form-control-sm mt-2" name="emergency_fname" id="emergency_fname" required>
            <input type="" class="form-control form-control-sm mt-2" name="emergency_lname" id="emergency_lname" required>
            <input type="" class="form-control form-control-sm mt-2" name="emergency_phone" id="emergency_phone" required>
            <input type="" class="form-control form-control-sm mt-2" name="emergency_email" id="emergency_email" required>
            <button type="submit" name="update_patient_emergencybtn" class="focus-ring btn btn-sm border mt-3">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!--
Title: Edit Emergency Contact
Location: components/footer.php
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
      $('#emergency_patientID').val(data[1]);
      $('#emergency_engineID').val(data[2]);
      $('#emergency_groupID').val(data[3]);
      $('#emergency_fname').val(data[4]);
      $('#emergency_lname').val(data[5]);
      $('#emergency_phone').val(data[6]);
      $('#emergency_email').val(data[8]);
    });
  });
</script>
