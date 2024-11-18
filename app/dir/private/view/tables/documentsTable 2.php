<table class="table align-middle table-borderless table-sm text-nowrap">
    <thead></thead>
    <tbody align="center" style="text-align: left">
        <?php
            $groupID = htmlspecialchars($_SESSION["groupID"]); // this code will only show users from the same groupID
            $query = "SELECT * FROM docs WHERE groupID='$groupID' ";
            $query_run = mysqli_query($con, $query);

            if(mysqli_num_rows($query_run) > 0){
                foreach($query_run as $file){
                ?>
                    <tr>
                        <td hidden><?=$file['id'];?></td>
                        <td hidden><?=$file['userID'];?></td>
                        <td hidden><?=$file['groupID'];?></td>
                        <td>
                            <div class="card shadow" id="box">
                                <div class="card-body">
                                    <small class="col"><a href="../../../uploads/<?=$file['docname'];?>" target="_blank" style="text-decoration:none;"><?= $file['docname'];?></a></small>
                                </div>
                            </div>
                        </td>
                        <td hidden><?=$file['type'];?></td>
                        <td><small class="col"><a title="Delete File" type="button" href="#" class="filedelete" data-bs-toggle="modal" data-bs-target="#filedeletemodal" style="color:black"><i class="bi bi-trash"></i></a></small></td>
                    </tr>
                <?php
                }
            }
            else{
            ?>
            <!--
                <tr>
                    <td colspan="6" align="center">No Data Found</td>
                </tr>
            -->
            <?php
            }
        ?>
    </tbody>
</table>