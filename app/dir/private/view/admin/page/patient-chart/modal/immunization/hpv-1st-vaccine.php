<!-- Modal -->
<div class="modal fade" id="hpv_1st-Modal" tabindex="-1" aria-labelledby="hpv_1st-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="hpv_1st-ModalLabel">1st HPV</h1>
      </div>
      <div class="modal-body">
        <div class="tab-content" id="pills-tabContent">

          <!-- Main - Vaccine Information -->
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
            <?php
            $groupID = mysqli_real_escape_string($con, $_SESSION['group_id']);
            $patientID = htmlspecialchars($patient['patientID']);
            $vaccine = "SELECT * FROM immunization WHERE groupID='$groupID' AND patientID='$patientID' AND type='1st HPV' ";
            $vaccine_run = mysqli_query($con, $vaccine);
            if(mysqli_num_rows($vaccine_run) > 0 )
            {
              foreach ($vaccine_run as $hpv_1st){}
            }
            ?>
            <table class="focus-ring table table-sm text-nowrap table-borderless">
              <thead>
                <tr>
                  <th><small>Date</small></th>
                  <th><small>Time</small></th>
                  <th colspan="2"><small>Vaccine</small></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><small><?= htmlspecialchars($hpv_1st['date']); ?></small></td>
                  <td><small><?= htmlspecialchars($hpv_1st['time']); ?></small></td>
                  <td colspan="2"><?= htmlspecialchars(decryptthis($hpv_1st['vaccine'], $key)); ?></small></td>
                </tr>
              </tbody>
              <thead>
                <tr>
                  <th><small>Manufacturer</small></th>
                  <th><small>NDC</small></th>
                  <th><small>Lot Number</small></th>
                  <th><small>Expiration</small></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><small><?= htmlspecialchars(decryptthis($hpv_1st['manufacturer'], $key)); ?></small></td>
                  <td><small><?= htmlspecialchars(decryptthis($hpv_1st['ndc'], $key)); ?></small></td>
                  <td><small><?= htmlspecialchars(decryptthis($hpv_1st['lot'], $key)); ?></small></td>
                  <td><small><?= htmlspecialchars(decryptthis($hpv_1st['exp'], $key)); ?></small></td>
                </tr>
              </tbody>
              <thead>
                <tr>
                  <th><small>Site</small></th>
                  <th><small>Route</small></th>
                  <th><small>VIS Publication Date</small></th>
                  <th><small>VIS Given Date</small></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><small><?= htmlspecialchars(decryptthis($hpv_1st['site'], $key)); ?></small></td>
                  <td><small><?= htmlspecialchars(decryptthis($hpv_1st['route'], $key)); ?></small></td>
                  <td><small><?= htmlspecialchars(decryptthis($hpv_1st['vis'], $key)); ?></small></td>
                  <td><small><?= htmlspecialchars(decryptthis($hpv_1st['vis_given'], $key)); ?></small></td>
                </tr>
              </tbody>
              <thead>
                <tr>
                  <th><small>Administered By</small></th>
                  <th><small>Funding Source</small></th>
                  <th><small>Comment</small></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><small><?= htmlspecialchars(decryptthis($hpv_1st['administered_by'], $key)); ?></small></td>
                  <td><small><?= htmlspecialchars(decryptthis($hpv_1st['funding_source'], $key)); ?></small></td>
                  <td><small><?= htmlspecialchars(decryptthis($hpv_1st['comment'], $key)); ?></small></td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>

      <!-- Buttons -->
      <div class="modal-footer col d-flex justify-content-center">

        <ul class="nav nav-pills" id="pills-tab" role="tablist">
          <!-- Hidden Home button -->
          <li class="nav-item" role="presentation">
            <button class="nav-link focus-ring py-1 px-2 btn text-decoration-none border-none active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" hidden>Home</button>
          </li>
          <!-- Close Button -->
          <li class="nav-item" role="presentation">
            <button title="Close" type="button" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none mb-2" data-bs-dismiss="modal" aria-label="Close" style="color:black">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
              </svg>
            </button>
          </li>
          <!-- Edit Button -->
          <li class="nav-item" role="presentation">
            <button title="Edit" type="button" class="nav-link focus-ring py-1 px-2 btn text-decoration-none border-none" data-bs-toggle="modal" data-bs-target="#hpv_1st-edit-Modal" style="color:black">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
              </svg>
            </button>
          </li>
        </ul>
      </div>

    </div>
  </div>
</div>
