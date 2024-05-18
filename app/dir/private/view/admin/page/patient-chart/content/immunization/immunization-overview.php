<?php
date_default_timezone_set('America/Los_Angeles');
$today = date('Y') . '-' . date('m') . '-' . date('d');
$hepB_vis = date('2023') . '-' . date('05') . '-' . date('12');
?>

<style>
  #admin_card:hover{
    background-color: #e6effc;
    transition: all 1s ease;
  }
  #iz_sidebar:hover{
    background-color: #e6effc;
    transition: all 1s ease;
  }
  #submit_btn:hover{
    background-color: #e6effc;
    transition: all 1s ease;
  }
</style>



<div class="tab-pane fade show active" id="nav-history" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
    <div class="mt-4">
        <div class="container col-md-12">
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3 mt-2" id="v-pills-tab" role="tablist">
                    <button class="active focus-ring py-1 px-2 btn btn-sm border rounded-0" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#history" type="button">History</button>
                    <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#combination" type="button">Combination</button>
                    <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#rsv" type="button">RSV</button>
                    <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#hepb" type="button">Hepatitis B</button>
                    <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#rota" type="button">Rotavirus</button>
                    <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#dtap" type="button">DTaP</button>
                    <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#hib" type="button">Hib</button>
                    <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#pcv" type="button">PCV</button>
                    <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#ipv" type="button">IPV</button>
                </div>
                <div class="col tab-content me-3">
                    <?php include('immunization-history.php');?>
                    <?php include('immunization-combination.php');?>
                    <?php include('immunization-rsv.php');?>
                    <?php include('immunization-hepb.php');?>
                    <?php include('immunization-rota.php');?>
                    <?php include('immunization-dtap.php');?>
                    <?php include('immunization-hib.php');?>
                    <?php include('immunization-pcv.php');?>
                    <?php include('immunization-ipv.php');?>
                </div>
            </div>
        </div>
    </div>
</div>
