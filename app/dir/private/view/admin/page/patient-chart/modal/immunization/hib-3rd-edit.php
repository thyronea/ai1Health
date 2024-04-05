<!-- Modal -->
<div class="modal fade" id="hib_3rd-edit-Modal" tabindex="-1" aria-labelledby="hib_3rd-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title w-100 fs-5" id="hib_3rd-edit-ModalLabel">Edit - 3rd Hib</h1>
      </div>
      <div class="modal-body">
        <form action="../process/sql.php" method="POST">
          <div class="row">
            <input type="hidden" class="form-control form-control-sm mt-2" name="id" value="<?=htmlspecialchars($hib_3rd['id']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" value="<?=htmlspecialchars($hib_3rd['engineID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" placeholder="First Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" placeholder="Last Name" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="dob" value="<?=htmlspecialchars(decryptthis($diversity['dob'], $key));?>" placeholder="Date of Birth" required>
            <input type="hidden" class="form-control form-control-sm mt-2" name="type" value="<?=htmlspecialchars($hib_3rd['type']);?>" required>
          </div>
          <div class="row mb-2">
            <div class="col-md-3">
              <label><small>Date</small></label>
              <input type="date" name="date" class="form-control form-control-sm" value="<?= htmlspecialchars($hib_3rd['date']); ?>" required>
            </div>
            <div class="col-md-3">
              <label><small>Time</small></label>
              <input type="text" name="time" class="form-control form-control-sm" value="<?= htmlspecialchars($hib_3rd['time']); ?>" required>
            </div>
            <div class="col-md-6">
              <label><small>Vaccine</small></label>
              <input type="text" name="vaccine" class="form-control form-control-sm" value="<?= htmlspecialchars(decryptthis($hib_3rd['vaccine'], $key)); ?>" required>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-3">
              <label><small>Manufacturer</small></label>
              <select class="form-select form-select-sm" name="manufacturer" required>
                <option selected><?= htmlspecialchars(decryptthis($hib_3rd['manufacturer'], $key)); ?></option>
                <option disabled>Manufacturer</option>
                <option value="GSK">GSK</option>
                <option value="Merck">Merck</option>
                <option value="Pfizer">Pfizer</option>
                <option value="Sanofi">Sanofi</option>
                <option value="Seqirus">Seqirus</option>
                <option value="AstraZeneca">AstraZeneca</option>
              </select>
            </div>
            <div class="col-md-3">
              <label><small>NDC</small></label>
              <input type="text" name="ndc" class="form-control form-control-sm" value="<?= htmlspecialchars(decryptthis($hib_3rd['ndc'], $key)); ?>" required>
            </div>
            <div class="col-md-3">
              <label><small>Lot Number</small></label>
              <input type="text" name="lot" class="form-control form-control-sm" value="<?= htmlspecialchars(decryptthis($hib_3rd['lot'], $key)); ?>" required>
            </div>
            <div class="col-md-3">
              <label><small>Expiration Date</small></label>
              <input type="date" name="exp" class="form-control form-control-sm" value="<?= htmlspecialchars(decryptthis($hib_3rd['exp'], $key)); ?>" required>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-3">
              <label><small>Site</small></label>
              <select class="form-select form-select-sm" name="site" required>
                <option selected><?= htmlspecialchars(decryptthis($hib_3rd['site'], $key)); ?></option>
                <option disabled>Site</option>
                <option value="L-Deltoid">L-Deltoid</option>
                <option value="R-Deltoid">R-Deltoid</option>
                <option value="L-Vastus Lateralis">L-Vastus Lateralis</option>
                <option value="R-Vastus Lateralis">R-Vastus Lateralis</option>
                <option value="L-Thigh">L-Thigh</option>
                <option value="R-Thigh">R-Thigh</option>
                <option value="Mouth">Mouth</option>
              </select>
            </div>
            <div class="col-md-3">
              <label><small>Route</small></label>
              <select class="form-select form-select-sm" name="route" required>
                <option selected><?= htmlspecialchars(decryptthis($hib_3rd['route'], $key)); ?></option>
                <option disabled>Route</option>
                <option value="Intramuscular">Intramuscular</option>
                <option value="Subcutaneous">Subcutaneous</option>
                <option value="Intranasal">Intranasal</option>
                <option value="Oral">Oral</option>
              </select>
            </div>
            <div class="col-md-3">
              <label><small>Vis Publication</small></label>
              <input type="date" name="vis" class="form-control form-control-sm" value="<?= htmlspecialchars(decryptthis($hib_3rd['vis'], $key)); ?>" required>
            </div>
            <div class="col-md-3">
              <label><small>VIS Given</small></label>
              <input type="date" name="vis_given" class="form-control form-control-sm" value="<?= htmlspecialchars(decryptthis($hib_3rd['vis_given'], $key)); ?>" required>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <label><small>Administered By</small></label>
              <input type="text" name="administered_by" class="form-control form-control-sm" value="<?= htmlspecialchars(decryptthis($hib_3rd['administered_by'], $key)); ?>" required>
            </div>
            <div class="col-md-6">
              <label><small>Funding Source</small></label>
              <select class="form-select form-select-sm" name="funding_source" required>
                <option selected><?= htmlspecialchars(decryptthis($hib_3rd['funding_source'], $key)); ?></option>
                <option disabled>Funding Source</option>
                <option value="Private">Private</option>
                <option value="VFC Eligible - Medical/Medicaid">VFC Eligible - Medical/Medicaid</option>
                <option value="VFC Eligible - Uninsured">VFC Eligible - Uninsured</option>
                <option value="VFC Eligible - Underinsured">VFC Eligible - Underinsured</option>
                <option value="VFC Eligible - Native American">VFC Eligible - Native American</option>
                <option value="VFC Eligible - Alaskan Native">VFC Eligible - Alaskan Native</option>
              </select>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col">
              <label><small>Comment:</small></label>
              <textarea name="comment" class="form-control form-control-sm"><?= htmlspecialchars(decryptthis($hib_3rd['comment'], $key)); ?></textarea>
            </div>
          </div>
      </div>

      <!-- Buttons -->
      <div class="modal-footer nav col d-flex justify-content-center mt-3">

        <ul class="nav nav-pills" id="pills-tab" role="tablist">
          </li>
          <!-- Back Button -->
          <li class="nav-item" role="presentation">
            <button title="Back" type="button" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none mb-2" data-bs-toggle="modal" data-bs-target="#hib_3rd-Modal" style="color:black">
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
            <button title="Delete" type="button" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none" data-bs-toggle="modal" data-bs-target="#delete_hib_3rd" style="color:red">
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
