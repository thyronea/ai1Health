<!-- Modal -->
<div class="modal fade" id="influenza-history-Modal" tabindex="-1" aria-labelledby="influenza-history-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="influenza-history-ModalLabel">Influenza</h1>
      </div>
      <div class="modal-body">
        <table class="table table-borderless table-sm table-hover text-nowrap">
          <tbody align="center" style="text-align: left">
            <thead>
              <th><small>Date</small></th>
              <th><small>Vaccine</small></th>
              <th><small>Lot</small></th>
              <th><small>Expiration</small></th>
              <th><small>Administered By</small></th>
              <th><small>Funding Source</small></th>
            </thead>
            <?php
            $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
            $patientID = htmlspecialchars($patient['patientID']);
            $vaccine = htmlspecialchars('Influenza');
            $query = "SELECT * FROM immunization WHERE groupID='$groupID' AND patientID='$patientID' AND type='$vaccine' ";
            $query_run = mysqli_query($con, $query);
            if(mysqli_num_rows($query_run) > 0 )
            {
              foreach($query_run as $influenza)
              {
                ?>
                <form class="" action="index.html" method="post">
                  <tr>
                    <td hidden><small><?= htmlspecialchars($influenza['id']);?></small></td>
                    <td><small><?= htmlspecialchars($influenza['date']);?></small></td>
                    <td hidden><small><?= htmlspecialchars($influenza['time']);?></small></td>
                    <td><small><?= htmlspecialchars(decryptthis($influenza['vaccine'], $key));?></small></td>
                    <td hidden><small><?= htmlspecialchars(decryptthis($influenza['manufacturer'], $key));?></small></td>
                    <td hidden><small><?= htmlspecialchars(decryptthis($influenza['ndc'], $key));?></small></td>
                    <td><small><?= htmlspecialchars(decryptthis($influenza['lot'], $key));?></small></td>
                    <td><small><?= htmlspecialchars(decryptthis($influenza['exp'], $key));?></small></td>
                    <td hidden><small><?= htmlspecialchars(decryptthis($influenza['site'], $key));?></small></td>
                    <td hidden><small><?= htmlspecialchars(decryptthis($influenza['route'], $key));?></small></td>
                    <td hidden><small><?= htmlspecialchars(decryptthis($influenza['vis'], $key));?></small></td>
                    <td hidden><small><?= htmlspecialchars(decryptthis($influenza['vis_given'], $key));?></small></td>
                    <td><small><?= htmlspecialchars(decryptthis($influenza['administered_by'], $key));?></small></td>
                    <td hidden><small><?= htmlspecialchars(decryptthis($influenza['funding_source'], $key));?></small></td>
                    <td hidden><small><?= htmlspecialchars(decryptthis($influenza['comment'], $key));?></small></td>
                    <td hidden><small><?= htmlspecialchars(decryptthis($influenza['type'], $key));?></small></td>
                    <td><small><a type="button" class="focus-ring border-none delete_influenza" data-bs-toggle="modal" data-bs-target="#delete_influenza" style="color:red"><i class="bi bi-trash"></i></a></small></td>
                  </tr>
                </form>
                <?php
              }
            }
            else
            {
            ?>
                <tr>
                  <td colspan="6" align="center"><small>No COVID-19 Data Found</small></td>
                </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
