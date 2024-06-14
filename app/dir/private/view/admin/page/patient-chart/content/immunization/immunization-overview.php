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
    <div class="container col-md-12 mt-3 mb-3">
        <div class="d-flex align-items-start"> 
            <div class="nav col-md-1 flex-column nav-pills me-3 mt-2" id="v-pills-tab" role="tablist">
                <button class="active focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#schedule" type="button">Schedule</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#progress" type="button">Progress</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#combination" type="button">Combo</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#rsv" type="button">RSV</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#hepb" type="button">Hep B</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#rota" type="button">Rotavirus</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#dtap" type="button">DTaP</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#hib" type="button">Hib</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#pcv" type="button">PCV</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#ipv" type="button">IPV</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#mmr" type="button">MMR</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#var" type="button">Varicella</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#hepa" type="button">Hep A</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#tdap" type="button">Tdap</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#hpv" type="button">HPV</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#mcv" type="button">MCV</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#menb" type="button">MenB</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#covid" type="button">COVID-19</button>
                <button class="focus-ring py-1 px-2 btn btn-sm border rounded-0 text-start" id="iz_sidebar" data-bs-toggle="pill" data-bs-target="#flu" type="button">Influenza</button>
                
            </div>
            <div class="col tab-content">
                <?php include('immunization-schedule.php');?>
                <?php include('immunization-progress.php');?>
                <?php include('immunization-combination.php');?>
                <?php include('immunization-rsv.php');?>
                <?php include('immunization-hepb.php');?>
                <?php include('immunization-rota.php');?>
                <?php include('immunization-dtap.php');?>
                <?php include('immunization-hib.php');?>
                <?php include('immunization-pcv.php');?>
                <?php include('immunization-ipv.php');?>
                <?php include('immunization-mmr.php');?>
                <?php include('immunization-var.php');?>
                <?php include('immunization-hepa.php');?>
                <?php include('immunization-tdap.php');?>
                <?php include('immunization-hpv.php');?>
                <?php include('immunization-mcv.php');?>
                <?php include('immunization-menb.php');?>
                <?php include('immunization-covid.php');?>
                <?php include('immunization-flu.php');?>
            </div>
        </div>
    </div>
</div>
