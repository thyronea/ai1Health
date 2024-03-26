<!-- Modal -->
<div class="modal fade" id="patient-message" data-bs-backdrop="static" tabindex="-1" aria-labelledby="patient-message-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="patient-message-ModalLabel">Send Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="post" action="../../admin/process/sql.php">

          <div class="" align="left">
            <input class="form-control form-control-sm mb-2" type="hidden" name="engineID" value="<?=$emergency_contact['engineID'];?>" required>
            <input class="form-control form-control-sm mb-2" type="text" name="email" value="<?=htmlspecialchars(decryptthis($contact['email'], $key));?>" required>
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
