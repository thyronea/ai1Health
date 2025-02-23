<div class="tab-pane fade" id="v-pills-storage-handling" role="tabpanel" aria-labelledby="v-pills-storage-handling-tab" tabindex="0">
  <div class="col-md-12 m-2 px-0">
    <div class="">
      <div class="align-items-start">
        <div class="row px-3" align="center">

          <!-- Configuration -->
          <div class="col-md-2 mb-3">
            <div class="card shadow" style="height: auto; overflow: auto;">
              <div class="card-body">
                <div class="">
                  <table class="table align-middle table-borderless table-sm text-nowrap">
                    <tbody align="center" style="text-align: left">
                      <thead>
                        <th>Configuration</th>
                      </thead>
                      <tr>
                        <td>
                          <a style="text-align: left" title="Add Storage & Handling Unit" type="button" class="nav-link focus-ring py-1 px-2 btn btn-sm border-0 rounded-0" data-bs-toggle="modal" data-bs-target="#add-sh-Modal">
                            <small>Add</small> <i class="bi bi-plugin fa-lg"></i>
                          </a>
                          <a style="text-align: left" title="Add Thermometer" type="button" class="nav-link focus-ring py-1 px-2 btn btn-sm border-0 rounded-0" data-bs-toggle="modal" data-bs-target="#addThermometer">
                            <small>Add</small> <i class="bi bi-thermometer-snow fa-lg"></i>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- Storage Units -->
          <div class="col mb-3">
            <div class="card shadow" style="height: auto; overflow: auto;">
              <div class="card-body">
               <div class="">
                 <table class="table align-middle table-borderless table-sm table-hover text-nowrap">
                   <tbody align="center" style="text-align: left">
                     <thead>
                       <th>Storage Units</th>
                     </thead>
                     <?php
                     $groupID = $_SESSION["groupID"]; // this code will only show users from the same groupID
                     $query = "SELECT * FROM storage WHERE groupID='$groupID' ";
                     $query_run = mysqli_query($con, $query);

                     if(mysqli_num_rows($query_run) > 0)
                     {
                       foreach($query_run as $storage)
                       {
                         ?>
                         <tr>
                            <td hidden><small><?= htmlspecialchars($storage['id']);?></small></td>
                            <td hidden><small><?= htmlspecialchars($storage['engineID']);?></small></td>
                            <td hidden><small><?= htmlspecialchars($storage['groupID']);?></small></td>
                            <td hidden><small><?= htmlspecialchars($storage['location']);?></small></td>
                            <td hidden><small><?= htmlspecialchars(decryptthis($storage['position'], $key));?></small></td>
                            <td hidden><small><?= htmlspecialchars(decryptthis($storage['name'], $key));?></small></td>
                            <td hidden><small><?= htmlspecialchars($storage['type']);?></small></td>
                            <td hidden><small><?= htmlspecialchars(decryptthis($storage['grade'], $key));?></small></td>
                            <td><a type="button" class="focus-ring border-none text-decoration-none storage-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#storage-edit"><small><?= htmlspecialchars(decryptthis($storage['name'], $key));?></small></a></td>
                            <td><a type="button" class="focus-ring border-none storage-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#storage-edit"><i class="bi bi-gear"></a></td>
                            <td><a type="button" class="focus-ring border-none storagedeletebtn" style="color:black;" data-bs-toggle="modal" data-bs-target="#storagedeletemodal"><i class="bi bi-trash"></i></a></td>

                         </tr>
                         <?php
                       }
                     }
                     else
                     {
                     ?>
                         <tr>
                           <td colspan="6" align="center"><small>No Storage Unit Found</small></td>
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
          <!-- Thermometers -->
          <div class="col mb-3">
            <div class="card shadow" style="height: auto; overflow: auto;">
              <div class="card-body">
                <div class="">
                  <table class="table align-middle table-borderless table-sm table-hover text-nowrap">
                    <tbody align="center" style="text-align: left">
                      <thead>
                        <th>Thermometers</th>
                      </thead>
                      <?php
                      $groupID = $_SESSION["groupID"]; // this code will only show users from the same groupID
                      $query = "SELECT * FROM thermometers WHERE groupID='$groupID' ";
                      $query_run = mysqli_query($con, $query);

                      if(mysqli_num_rows($query_run) > 0)
                      {
                        foreach($query_run as $thermometer)
                        {
                          ?>
                          <tr>
                            <td hidden><small><?= htmlspecialchars($thermometer['id']);?></small></td>
                            <td hidden><small><?= htmlspecialchars($thermometer['engineID']);?></small></td>
                            <td hidden><small><?= htmlspecialchars($thermometer['groupID']);?></small></td>
                            <td hidden><small><?= htmlspecialchars($thermometer['location']);?></small></td>
                            <td hidden><small><?= htmlspecialchars(decryptthis($thermometer['position'], $key));?></small></td>
                            <td><a type="button" class="focus-ring border-none text-decoration-none thermometer-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#thermometer-edit"><small><?= htmlspecialchars(decryptthis($thermometer['name'], $key));?></small></a></td>
                            <td hidden><small><?= htmlspecialchars($thermometer['serial']);?></small></td>
                            <td hidden><small><?= htmlspecialchars($thermometer['expiration']);?></small></td>
                            <td hidden><small><?= htmlspecialchars($thermometer['scale']);?></small></td>
                            <td hidden><small><?= htmlspecialchars($thermometer['lowAlarm']);?></small></td>
                            <td hidden><small><?= htmlspecialchars($thermometer['highAlarm']);?></small></td>
                            <td><a type="button" class="focus-ring border-none thermometer-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#thermometer-edit"><i class="bi bi-gear"></a></td>
                            <td><a type="button" class="focus-ring border-none thermometerdeletebtn" style="color:black;" data-bs-toggle="modal" data-bs-target="#thermometerdeletemodal"><i class="bi bi-trash"></i></a></td>

                          </tr>
                          <?php
                        }
                      }
                      else
                      {
                      ?>
                          <tr>
                            <td colspan="6" align="center"><small>No Thermometer Found</small></td>
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

        </div>
      </div>
   </div>
  </div>
</div>
