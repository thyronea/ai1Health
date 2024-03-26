<!-- Modal -->
<div class="modal fade" id="influenza-vaccine-Modal" tabindex="-1" aria-labelledby="influenza-vaccine-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <form action="../process/sql.php" method="post">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h1 class="modal-title w-100 fs-5" id="influenza-vaccine-ModalLabel">Influenza</h1>
        </div>
        <div class="modal-body">
          <div class="tab-content" id="pills-tabContent">
            <!-- Main - Vaccine Information -->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
              <table class="focus-ring table table-sm text-nowrap table-borderless">
                <div class="row">
                  <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" value="<?=htmlspecialchars($patient['patientID']);?>" required>
                  <input type="hidden" class="form-control form-control-sm mt-2" name="fname" value="<?=htmlspecialchars(decryptthis($patient['fname'], $key));?>" required>
                  <input type="hidden" class="form-control form-control-sm mt-2" name="lname" value="<?=htmlspecialchars(decryptthis($patient['lname'], $key));?>" required>
                  <input type="hidden" class="form-control form-control-sm mt-2" name="dob" value="<?=htmlspecialchars(decryptthis($patient['dob'], $key));?>" required>
                  <input type="hidden" class="form-control form-control-sm mt-2" name="engineID" id="influenza_engineID" class="form-control form-control-sm" required>
                  <input type="hidden" class="form-control form-control-sm mt-2" name="patientID" id="influenza_patientID" class="form-control form-control-sm" required>
                  <input type="hidden" class="form-control form-control-sm mt-2" name="id" id="influenza_id" class="form-control form-control-sm" required>
                  <input type="hidden" class="form-control form-control-sm mt-2" name="type" id="influenza_type" class="form-control form-control-sm" required>
                </div>
                <thead>
                  <tr>
                    <th><small>Date</small></th>
                    <th><small>Time</small></th>
                    <th colspan="2"><small>Vaccine</small></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><small><input type="date" name="date" id="influenza_date" class="form-control form-control-sm" required></small></td>
                    <td><small><input type="text" name="time" id="influenza_time" class="form-control form-control-sm" required></small></td>
                    <td colspan="2"><small><input type="text" name="vaccine" id="influenza_vaccine" class="form-control form-control-sm" required></small></td>
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
                    <td>
                      <small><select class="form-select form-select-sm" name="manufacturer" id="influenza_manufacturer" required>
                        <option disabled selected>Select one</option>
                        <option value="GSK">GSK</option>
                        <option value="Merck">Merck</option>
                        <option value="Pfizer">Pfizer</option>
                        <option value="Sanofi">Sanofi</option>
                        <option value="Seqirus">Seqirus</option>
                        <option value="AstraZeneca">AstraZeneca</option>
                      </select></small>
                    </td>
                    <td><small><input type="text" name="ndc" id="influenza_ndc" class="form-control form-control-sm" required></small></td>
                    <td><small><input type="text" name="lot" id="influenza_lot" class="form-control form-control-sm" required></small></td>
                    <td><small><input type="date" name="exp" id="influenza_exp" class="form-control form-control-sm" required></small></td>
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
                    <td>
                      <small><select class="form-select form-select-sm" name="site" id="influenza_site" required>
                        <option selected value="L-Deltoid">L-Deltoid</option>
                        <option value="R-Deltoid">R-Deltoid</option>
                        <option value="L-Vastus Lateralis">L-Vastus Lateralis</option>
                        <option value="R-Vastus Lateralis">R-Vastus Lateralis</option>
                        <option value="L-Thigh">L-Thigh</option>
                        <option value="R-Thigh">R-Thigh</option>
                        <option value="Mouth">Mouth</option>
                      </select></small>
                    </td>
                    <td>
                      <small><select class="form-select form-select-sm" name="route"  id="influenza_route" required>
                      <option selected value="Intramuscular">Intramuscular</option>
                      <option value="Subcutaneous">Subcutaneous</option>
                      <option value="Intranasal">Intranasal</option>
                      <option value="Oral">Oral</option>
                    </select></small>
                  </td>
                    <td><small><input type="date" name="vis" id="influenza_vis" class="form-control form-control-sm" required></small></td>
                    <td><small><input type="date" name="vis_given" id="influenza_vis_given" class="form-control form-control-sm" required></small></td>
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
                    <td><small><input type="text" name="administered_by" id="influenza_administered_by" class="form-control form-control-sm" required></small></td>
                    <td>
                      <small><select class="form-select form-select-sm" name="funding_source" id="influenza_funding_source" required>
                      <option disabled selected>Select one</option>
                      <option value="Private">Private</option>
                      <option value="State Program">State Program</option>
                      <option value="VFC Eligible - Medical/Medicaid">VFC Eligible - Medical/Medicaid</option>
                      <option value="VFC Eligible - Uninsured">VFC Eligible - Uninsured</option>
                      <option value="VFC Eligible - Underinsured">VFC Eligible - Underinsured</option>
                      <option value="VFC Eligible - Native American">VFC Eligible - Native American</option>
                      <option value="VFC Eligible - Alaskan Native">VFC Eligible - Alaskan Native</option>
                    </select></small>
                  </td>
                    <td colspan="2"><small><input type="text" name="comment" id="influenza_comment" class="form-control form-control-sm"></small></td>
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
              <button title="Delete" type="button" class="nav-link focus-ring py-1 px-2 text-decoration-none border-none" data-bs-toggle="modal" data-bs-target="#influenza-history-Modal" style="color:red">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                </svg>
              </button>
            </li>
          </ul>
        </div>

      </div>
    </form>
  </div>
</div>
