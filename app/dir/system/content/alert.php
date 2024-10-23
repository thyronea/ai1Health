<!-- verification status message -->
<?php
if(isset($_SESSION['success']))
{
  ?>
  <div class="alert alert-success alert-dismissible fade show shadow" role="alert" align="center">
    <?=$_SESSION['success'];?>
    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
   unset($_SESSION['success']);
}
?>
<!-- non-verified alert -->
<?php
if(isset($_SESSION['warning']))
{
  ?>
  <div class="alert alert-danger alert-dismissible fade show shadow" role="alert" align="center">
    <?=$_SESSION['warning'];?>
    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
   unset($_SESSION['warning']);
}
?>
