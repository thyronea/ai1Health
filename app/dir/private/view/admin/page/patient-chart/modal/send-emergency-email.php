<!-- Modal -->
<div class="modal fade" id="emergency-message-Modal" tabindex="-1" aria-labelledby="emergency-message-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="emergency-message-ModalLabel">Send Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="post" action="../../admin/process/sql.php">

          <div class="" align="left">
            <input class="form-control form-control-sm mb-2" type="" name="engineID" value="<?=htmlspecialchars($emergency_contact['engineID']);?>" hidden required>
            <input class="form-control form-control-sm mb-2" type="text" name="email" id="emergency_Email" placeholder="Email" required>
            <input class="form-control form-control-sm mb-2" type="text" name="subject" id="subject" value="<?=htmlspecialchars(decryptthis($organization['name'], $key));?>: Important Message from <?=htmlspecialchars($_SESSION['office']);?>" placeholder="Subject" required>
            <textarea class="form-control form-control-sm mb-4" name="message" id="message" style="height: 15rem" required></textarea>
          </div>

          <div class="mb-2" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-outline-secondary btn-sm" type="submit" name="send_email">Send</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>


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
      $('#emergency_Email').val(data[8]);
    });
  });
</script>
