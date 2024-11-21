<table class="focus-ring table-borderless table table-sm text-nowrap">
    <tbody align="center">
        <?php
            if(isset($_GET['search'])){
                $filtervalues = htmlspecialchars($_GET['search']);
                $query = "SELECT * FROM engine WHERE groupID='$groupID' AND CONCAT(keyword1,keyword2,keyword3) LIKE '%$filtervalues%' ";
                $query_run = mysqli_query($con, $query);
                $searchnum = mysqli_num_rows($query_run);
                    
                if($searchnum == 0){
                      echo "We were unable to find your search term of '<b>$filtervalues</b>'";
                    }
                    else{
                    ?><h5 class="mb-3"><?= $searchnum ?> Results Found For "<?= $filtervalues?>"</h5><?php
                    foreach ($query_run as $result){
                    ?>
                        <tr>
                            <td>
                                <div class="card col-md-8 shadow" style="text-align:left;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <a type="button" class="text-decoration-none" style="color: black" href="<?= htmlspecialchars($result['link']); ?>" target="_blank">
                                                <b><?= htmlspecialchars($result['keyword1']); ?></b><br>
                                                <small><?= htmlspecialchars($result['keyword2']); ?></small>
                                                </a><br>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#message-Modal">
                                                <small>
                                                    <?= htmlspecialchars($result['keyword3']); ?>
                                                </small>
                                                </a>
                                                <?php include(VIEW_MODALS . '/managerModals.php'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                }
            }
        ?>
    </tbody>
</table>