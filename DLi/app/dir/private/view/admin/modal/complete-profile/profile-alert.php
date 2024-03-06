<div class="modal fade" id="admin_completeProfile" data-bs-backdrop="static" tabindex="-1" aria-labelledby="admin_completeProfile-Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body">
        <div class="container">
          <div class="col-md-12 mt-3">
            <small>Hi <?=htmlspecialchars($_SESSION['fname']); ?>!</small><br><br>
            <small>Wecome and thank you for signing up!</small>
            <small>To better serve you, please complete your profile</small>
            <small>as accurate as possible.</small><br>
            <div align="center">
              <button type="button" class="focus-ring btn btn-outline-secondary btn-sm mt-5 mb-3" data-bs-toggle="modal" data-bs-target="#admin_addProfile">
                Complete Profile
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script for Auto Modal Alert-->
<script type="text/javascript">
  $(window).on('load', function() {
      $('#admin_completeProfile').modal('show');
  });
</script>
