<table class="table align-middle table-borderless table-sm table-hover text-nowrap">
    <th>Users</th>
    <tbody align="center" style="text-align: left">
        <?php

            $query = "SELECT * FROM profile WHERE groupID='$groupID' ";
            $query_run = mysqli_query($con, $query);

            if(mysqli_num_rows($query_run) > 0){
                foreach($query_run as $user){
                    ?>
                        <tr><td hidden><?= htmlspecialchars($user['userID']);?></td>
                            <td hidden><?= htmlspecialchars($user['engineID']);?></td>
                            <td hidden><?= htmlspecialchars($user['groupID']);?></td>
                            <td><a type="button" class="focus-ring text-decoration-none btn-md editbtn" style="color:black" data-bs-toggle="modal" data-bs-target="#editmodal"><small><?= htmlspecialchars($user['fname']);?></small></a></td>
                            <td hidden><a type="button" class="focus-ring text-decoration-none btn-md" style="color:black" data-bs-toggle="modal" data-bs-target="#editmodal"><small><?= htmlspecialchars($user['lname']);?></small></a></td>
                            <td hidden><?= htmlspecialchars(decryptthis($user['email'], $key));?></td>
                            <td hidden><?= htmlspecialchars(decryptthis($user['role'], $key));?></td>
                            <td hidden><?= htmlspecialchars(decryptthis($user['location'], $key));?></td>
                            <td><a title="Update Account Information" type="button" class="focus-ring text-decoration-none btn-md editbtn" style="color:black" data-bs-toggle="modal" data-bs-target="#editmodal"><i class="bi bi-gear"></i></a></td>
                            <td><a title="Delete" type="button" class="focus-ring border-none userdeletebtn" style="color:black;" data-bs-toggle="modal" data-bs-target="#userdeletemodal"><i class="bi bi-trash"></i></a></td>
                        </tr>
                    <?php
                }
            }
            else{
                ?>
                    <tr>
                        <td colspan="6"><small>No User Data Found</small></td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>