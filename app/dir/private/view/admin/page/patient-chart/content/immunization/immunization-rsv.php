<div class="tab-pane fade" id="rsv" role="tabpanel" tabindex="0">
    <div class="d-flex align-items-start row">
        <div class="col-md-2">
            <table class="table table-borderless text-nowrap">
                <tbody align="center" style="text-align: left">
                            
                </tbody>
            </table>
        </div>
        <div class="row col-md-10 mt-2 mb-3">
            <div class="">
                <p>RSV (Respiratory Synctial Virus)</p>
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$rsv_count;?>%"><?=$rsv_count;?>%</div>
                </div>
                <div class="mt-3">
                    <?=$rsv_message?> 
                </div>
            </div>
        </div>
    </div> 
</div>
<?php include('modal/immunization/rsv/add-rsv.php'); ?>
<?php include('modal/immunization/rsv/edit-rsv.php'); ?>
<?php include('modal/immunization/rsv/delete-rsv.php'); ?>