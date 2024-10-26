<!-- Incomplete Profile Alert -->
<script type="text/javascript">
  $(window).on('load', function() {
      $('#admin_completeProfile').modal('show');
  });
</script>

<!-- Popover messages -->
<script type="text/javascript">
  const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
  const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>