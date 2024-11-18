<!-- Modal -->
<div class="modal fade" id="emergency-message-modal" tabindex="-1" aria-labelledby="emergency-message-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="emergency-message-ModalLabel">Send Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="post" action="">

          <div class="" align="left">
            <input class="form-control form-control-sm mb-2" type="hidden" name="userID" value="<?=htmlspecialchars($contact['userID']);?>" hidden required>
            <input class="form-control form-control-sm mb-2" type="hidden" name="engineID" value="<?=htmlspecialchars($emergency_contact['engineID']);?>" hidden required>
            <input class="form-control form-control-sm mb-2" type="text" name="email" id="emergency_Email" placeholder="Email" required>
            <input class="form-control form-control-sm mb-2" type="text" name="subject" value="Important Message from <?=htmlspecialchars($_SESSION['location']);?>" placeholder="Subject" required>
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
