<?php
date_default_timezone_set('America/Los_Angeles');
$today = date('Y') . '-' . date('m') . '-' . date('d');
$hepB_vis = date('2023') . '-' . date('05') . '-' . date('12');
?>

<div class="tab-pane fade show active" id="nav-history" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="active focus-ring py-1 px-2 btn btn-sm border rounded-0" data-bs-toggle="pill" data-bs-target="#history" type="button" role="tab">History</button>
                    <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 id=" data-bs-toggle="pill" data-bs-target="#rsv" type="button" role="tab">RSV</button>
                    <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 id=" data-bs-toggle="pill" data-bs-target="#hepb" type="button" role="tab">Hepatitis B</button>
                    <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 id=" data-bs-toggle="pill" data-bs-target="#rota" type="button" role="tab">Rotavirus</button>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <?php include('immunization-history.php');?>
                    <?php include('immunization-rsv.php');?>
                    <?php include('immunization-hepb.php');?>
                    <?php include('immunization-rota.php');?>
                </div>
            </div>
        </div>
    </div>
</div>