<!-- Autotab input on login verification code -->
<script type="text/javascript">
  $(".inputs").keyup(function () {
      if (this.value.length == this.maxLength) {
        $(this).next('.inputs').focus();
      }
  });
</script>