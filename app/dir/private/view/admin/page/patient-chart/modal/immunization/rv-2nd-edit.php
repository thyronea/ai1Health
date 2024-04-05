<!-- Modal -->
<div class="modal fade" id="rv_2nd-edit-Modal" tabindex="-1" aria-labelledby="rv_2nd-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="rv_2nd-edit-ModalLabel">Edit - 2nd Rotavirus</h1>
      </div>
      <div class="modal-body">
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
              <td><small><?= htmlspecialchars($rv_2nd['date']); ?></small></td>
              <td><small><?= htmlspecialchars($rv_2nd['time']); ?></small></td>
              <td colspan="2"><?= htmlspecialchars(decryptthis($rv_2nd['vaccine'], $key)); ?></small></td>
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
              <td><small><?= htmlspecialchars(decryptthis($rv_2nd['manufacturer'], $key)); ?></small></td>
              <td><small><?= htmlspecialchars(decryptthis($rv_2nd['ndc'], $key)); ?></small></td>
              <td><small><?= htmlspecialchars(decryptthis($rv_2nd['lot'], $key)); ?></small></td>
              <td><small><?= htmlspecialchars(decryptthis($rv_2nd['exp'], $key)); ?></small></td>
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
              <td><small><?= htmlspecialchars(decryptthis($rv_2nd['site'], $key)); ?></small></td>
              <td><small><?= htmlspecialchars(decryptthis($rv_2nd['route'], $key)); ?></small></td>
              <td><small><?= htmlspecialchars(decryptthis($rv_2nd['vis'], $key)); ?></small></td>
              <td><small><?= htmlspecialchars(decryptthis($rv_2nd['vis_given'], $key)); ?></small></td>
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
              <td><small><?= htmlspecialchars(decryptthis($rv_2nd['administered_by'], $key)); ?></small></td>
              <td><small><?= htmlspecialchars(decryptthis($rv_2nd['funding_source'], $key)); ?></small></td>
              <td><small><?= htmlspecialchars(decryptthis($rv_2nd['comment'], $key)); ?></small></td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Buttons -->
      <div class="modal-footer nav col d-flex justify-content-center mt-3">

        <ul class="nav nav-pills" id="pills-tab" role="tablist">
          </li>
          <!-- Back Button -->
          <li class="nav-item" role="presentation">
            <button title="Back" type="button" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none mb-2" data-bs-toggle="modal" data-bs-target="#rv_2nd-Modal" style="color:black">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
              </svg>
            </button>
          </li>
          <!-- Save Button -->
          <li class="nav-item" role="presentation">
            <button title="Save" type="submit" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none mb-2" style="color:black" name="edit_administered_vaccine">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
              </svg>
            </button>
          </li>
          <!-- Delete Button -->
          <li class="nav-item" role="presentation">
            <button title="Delete" type="button" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none" data-bs-toggle="modal" data-bs-target="#delete_rv_2nd" style="color:red">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
              </svg>
            </button>
          </li>
        </ul>
      </div>
        </form>
    </div>
  </div>
</div>
