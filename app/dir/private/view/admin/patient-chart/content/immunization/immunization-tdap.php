<div class="tab-pane fade" id="tdap" role="tabpanel" tabindex="0">
    <div class="d-flex align-items-start row">
        <div class="col-md-2">
            <table class="table table-borderless text-nowrap">
                <tbody align="center" style="text-align: left">
                    <?php
                        $patientID = htmlspecialchars($patient['patientID']);
                        $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                        $vaccine = htmlspecialchars("tdap");
                        $query = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$vaccine' ORDER BY id DESC";
                        $query_run = mysqli_query($con, $query);
                        $searchnum = mysqli_num_rows($query_run);

                        if($searchnum > 0)
                        {
                            foreach ($query_run as $vaccine)
                            {   
                                $admin_date = htmlspecialchars($vaccine['date']);
                                $date = date('Y') . '-' . date('m') . '-' . date('d'); 
                                $year = (date('Y') - date('Y', strtotime($admin_date)));  
                                $admin_tdap = (date('m', strtotime($admin_date)) . '/' . date('d', strtotime($admin_date)) . '/' . date('Y', strtotime($admin_date))); 

                                ?>
                                <tr align="center">
                                    <td hidden><a class="text-decoration-none inventory-editbtn" style="color: black"><small><?=htmlspecialchars($vaccine['id']);?></small></a></td>
                                    <td hidden><a class="text-decoration-none inventory-editbtn" style="color: black"><small><?=htmlspecialchars($vaccine['uniqueID']);?></small></a></td>
                                    <td hidden><a class="text-decoration-none inventory-editbtn" style="color: black"><small><?=htmlspecialchars($vaccine['patientID']);?></small></a></td>
                                    <td hidden><a class="text-decoration-none inventory-editbtn" style="color: black"><small><?=htmlspecialchars($vaccine['groupID']);?></small></a></td>
                                    <td hidden><a class="text-decoration-none inventory-editbtn" style="color: black"><small><?=htmlspecialchars(decryptthis_iz($vaccine['vaccine'], $iz_key));?></small></a></td>
                                    <td hidden><a class="text-decoration-none inventory-editbtn" style="color: black"><small><?=htmlspecialchars(decryptthis_iz($vaccine['lot'], $iz_key));?></small></a></td>
                                    <td hidden><a class="text-decoration-none inventory-editbtn" style="color: black"><small><?=htmlspecialchars(decryptthis_iz($vaccine['ndc'], $iz_key));?></small></a></td>
                                    <td hidden><a class="text-decoration-none inventory-editbtn" style="color: black"><small><?=htmlspecialchars($vaccine['exp']);?></small></a></td>
                                    <td hidden><a class="text-decoration-none inventory-editbtn" style="color: black"><small><?=htmlspecialchars(decryptthis_iz($vaccine['site'], $iz_key));?></small></a></td>
                                    <td hidden><a class="text-decoration-none inventory-editbtn" style="color: black"><small><?=htmlspecialchars(decryptthis_iz($vaccine['route'], $iz_key));?></small></a></td>
                                    <td hidden><a class="text-decoration-none inventory-editbtn" style="color: black"><small><?=htmlspecialchars(decryptthis_iz($vaccine['vis_given'], $iz_key));?></small></a></td>
                                    <td hidden><a class="text-decoration-none inventory-editbtn" style="color: black"><small><?=htmlspecialchars(decryptthis_iz($vaccine['vis'], $iz_key));?></small></a></td>
                                    <td hidden><a class="text-decoration-none inventory-editbtn" style="color: black"><small><?=htmlspecialchars(decryptthis_iz($vaccine['funding_source'], $iz_key));?></small></a></td>
                                    <td hidden><a class="text-decoration-none inventory-editbtn" style="color: black"><small><?=htmlspecialchars(decryptthis_iz($vaccine['administered_by'], $iz_key));?></small></a></td>
                                    <td hidden><a class="text-decoration-none inventory-editbtn" style="color: black"><small><?=htmlspecialchars(decryptthis_iz($vaccine['comment'], $iz_key));?></small></a></td>
                                    <td >
                                        <a class="text-decoration-none focus-ring edit_tdap_btn" style="color: black; font-size: 14px" data-bs-toggle="modal" data-bs-target="#edit_administered_tdap">
                                            <div class="card shadow" id="admin_card">
                                                <div class="card-body">
                                                    <small><?=htmlspecialchars($admin_tdap);?></small>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>                
                </tbody>
            </table>
        </div>
        <div class="row col-md-10 mt-2 mb-3">
            <div class="">
                <p>Tdap <a href="https://www.cdc.gov/vaccines/hcp/vis/vis-statements/tdap.pdf" target="_blank" class="text-decoration-none text-secondary"><small>(Tetanus, Diptheria, Pertussis)</small></a> - 1 Dose Series</p>
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$tdap_count;?>%"><?=$tdap_count;?>%</div>
                </div>
                <div class="mt-3">
                    <?=$tdap_message?> 
                </div>
            </div>
        </div>
    </div> 
</div>