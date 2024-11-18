<table class="table table-borderless table-sm table-hover text-nowrap">
    <tbody align="center" style="text-align: left">
        <thead><th>Location</th></thead>
        <?php
            $query = "SELECT * FROM location WHERE groupID='$groupID' ";
            $query_run = mysqli_query($con, $query);

            if(mysqli_num_rows($query_run) > 0){

                foreach($query_run as $office){
                    ?>
                        <tr>
                            <td hidden><?= htmlspecialchars($office['id']);?></td>
                            <td hidden><?= htmlspecialchars($office['engineID']);?></td>
                            <td hidden><?= htmlspecialchars($office['groupID']);?></td>
                            <td><a type="button" class="focus-ring text-decoration-none btn-md location-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#office-edit"><small><?= htmlspecialchars($office['name']);?></small></a></td>
                            <td hidden><?= htmlspecialchars($office['address1']);?></td>
                            <td hidden><?= htmlspecialchars($office['address2']);?></td>
                            <td hidden><?= htmlspecialchars($office['city']);?></td>
                            <td hidden><?= htmlspecialchars($office['state']);?></td>
                            <td hidden><?= htmlspecialchars($office['zip']);?></td>
                            <td hidden><?= htmlspecialchars($office['phone']);?></td>
                            <td hidden><?= htmlspecialchars($office['email']);?></td>
                            <td hidden><?= htmlspecialchars($office['link']);?></td>
                            <td hidden><?= htmlspecialchars($office['poc']);?></td>
                            <td><a type="button" class="focus-ring border-none location-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#location-edit"><i class="bi bi-gear"></a></td>
                            <td><a type="button" class="focus-ring border-none location-deletebtn" style="color:black;" data-bs-toggle="modal" data-bs-target="#locationdeletemodal"><i class="bi bi-trash"></i></a></td>
                        </tr>
                    <?php
                }
            }
            else{
                ?>
                    <tr>
                        <td colspan="6" align="center"><small>No Location Data Found</small></td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>