<table>
    <tbody>
        <?php
            $patientID = htmlspecialchars($patient['patientID']);
            $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
            $vaccine = htmlspecialchars("RSV");
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
                    $admin_rsv = (date('m', strtotime($admin_date)) . '/' . date('d', strtotime($admin_date)) . '/' . date('Y', strtotime($admin_date))); 

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
                                <?=$rsv_schedule?>
                            </td>
                        </tr>
                    <?php
                }
            }
            else{
                ?>
                    <td >
                        <?=$rsv_schedule?>
                    </td>
                <?php
            }
        ?>                
    </tbody>
</table>