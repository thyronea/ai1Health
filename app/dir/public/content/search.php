<!-- Search Container -->
<div class="container" align="center">
  <div class="col-md-11">
    <h6 class="mt-3 mb-4 text-center">Search for DLi in your area</h6>
   <form action="" method="get">
    <div class="input-group input-group-sm">
     <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['']; }?>" class="form-control text-center" style="border-radius:16px" placeholder="Enter name, email, phone, city, state or zip"><a href="#" class="mt-1" style="color: black"><i class="p-3 bi bi-mic"></i></a>
    </div>
   </form>
  </div>
</div>

<!-- Search Result -->
<div class="card col-md-12 p-4 border-0" style="overflow:auto">
 <div class="card-body">
  <table class="focus-ring table table-borderless table-sm table-hover text-nowrap">
    <tbody>

      <?php
        if(isset($_GET['search']))
        {
          $filtervalues = trim(mysqli_real_escape_string($con, $_GET['search']));
          $query = "SELECT * FROM offices WHERE CONCAT(name, city, state, zip, phone, email) LIKE '%$filtervalues%' ";
          $query_run = $con->query($query);

          if($query_run->num_rows > 0)
          {
            foreach ($query_run as $kaverson)
            {
              ?>
              <tr>
                <td hidden><small><?= htmlspecialchars($kaverson['id']); ?></small></td>
                <td><small><?= htmlspecialchars($kaverson['name']); ?></small></td>
                <td><small><?= htmlspecialchars($kaverson['phone']); ?></small></td>
                <td hidden><a title="Schedule Appointment" type="button" class="focus-ring text-decoration-none" data-bs-toggle="modal" data-bs-target="#patient-register-Modal" style="color: black"><i class="bi bi-calendar3"></i></a></td>
                <td><a title="Link to Website" href="<?= htmlspecialchars($kaverson['link']); ?>" target="_blank" style="color: black"><i class="bi bi-globe2"></i></a></td>
              </tr>
              <?php
            }
          }
            else
            {
              ?>
                <tr>
                  <td colspan="4" align="center"><small>No Data</small></td>
                </tr>
              <?php
            }
          }
      ?>
    </tbody>
  </table>
 </div>
</div>
