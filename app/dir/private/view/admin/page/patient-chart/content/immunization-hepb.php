<style>
  #admin_card:hover{
    background-color: #e6effc;
    transition: all 1s ease;
  }
</style>

<div class="tab-pane fade" id="hepb" role="tabpanel" tabindex="0">
    <div class="container row">
        <div class="col-md-4 me-5">
            <table class="table table-borderless text-nowrap">
                <thead align="center">
                    <th><h6>1st Dose</h6></th>
                    <th><h6>2nd Dose</h6></th>
                    <th><h6>3rd Dose</h6></th>
                </thead>
                <tbody align="center" style="text-align: left">
                    <?php
                    $patientID = htmlspecialchars($patient['patientID']);
                    $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                    $vaccine = htmlspecialchars("Hepatitis B");
                    $query = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$vaccine' ";
                    $query_run = mysqli_query($con, $query);
                    $searchnum = mysqli_num_rows($query_run);
                    if($searchnum > 0)
                    {
                    foreach ($query_run as $vaccine)
                    {   
                        $admin_date = htmlspecialchars($vaccine['date']);
                        $date = date('Y') . '-' . date('m') . '-' . date('d'); 
                        $year = (date('Y') - date('Y', strtotime($admin_date)));  
                        $admin_hepB = (date('m', strtotime($admin_date)) . '/' . date('d', strtotime($admin_date)) . '/' . date('Y', strtotime($admin_date))); 

                        ?>
                        
                        <td hidden><a type="" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['id']);?></small></a></td>
                        <td hidden><a type="" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['patientID']);?></small></a></td>
                        <td hidden><a type="" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['groupID']);?></small></a></td>
                        <td >
                            <a type="button" class="text-decoration-none focus-ring" style="color: black; font-size: 14px" data-bs-toggle="modal" data-bs-target="#update_hepB">
                                <div class="card shadow" id="admin_card">
                                    <div class="card-body">
                                        <small><?=htmlspecialchars($admin_hepB);?></small>
                                    </div>
                                </div>
                            </a>
                        </td>
                        
                        <?php
                    }
                    }
                        else
                        {
                            ?>
                            <tr>
                                <td colspan="5" align="center"><small>No Data Found</small></td>
                            </tr>
                            <?php
                        }
                    ?>                
                </tbody>
            </table>
            <button type="button" class="focus-ring btn btn-sm border mt-3" data-bs-toggle="modal" data-bs-target="#administer_hepb">Administer Hep B</button> 
        </div>
        <div class="col-md-7 card">
            <div class="card-body">

            </div>
        </div>
    </div> 
    <?php include('modal/immunization/add-hepb.php'); ?>
</div>