<!-- Modal -->
<div class="modal fade" id="message-Modal" tabindex="-1" aria-labelledby="message-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="message-ModalLabel">Send Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="post" action="process/send-email.php">

          <label for="email">Email</label>

          <input class="form-control mb-2" type="email" name="email" id="email" required>

          <label for="subject">Subject</label>
          <input class="form-control mb-2" type="text" name="subject" id="subject" required>

          <label for="message">Message</label>
          <textarea class="form-control mb-4" name="message" id="message" style="height: 15rem" required></textarea>

          <div class="mb-2" align="center">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-outline-secondary btn-sm" type="submit" name="send_admin_email">Send</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>
