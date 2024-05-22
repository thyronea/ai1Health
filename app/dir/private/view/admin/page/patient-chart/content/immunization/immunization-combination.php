<div class="tab-pane fade" id="combination" role="tabpanel" tabindex="0">
    <div class="d-flex align-items-start row">
        <div class="col-md-2">
            <button type='button' class='focus-ring btn btn-sm border col-md-12 mt-2 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_pediarix'>Administer Pediarix</button>
            <button type='button' class='focus-ring btn btn-sm border col-md-12 mt-3 mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepb'>Administer Pentacel</button>
            <button type='button' class='focus-ring btn btn-sm border col-md-12 mt-3 mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepb'>Administer Vaxelis</button>
            <button type='button' class='focus-ring btn btn-sm border col-md-12 mt-3 mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepb'>Administer Quadracel</button>
            <button type='button' class='focus-ring btn btn-sm border col-md-12 mt-3 mt-3 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepb'>Administer Kinrix</button>
            <button type='button' class='focus-ring btn btn-sm border col-md-12 mt-3 mt-3 mb-5 shadow' id='submit_btn' data-bs-toggle='modal' data-bs-target='#administer_hepb'>Administer Proquad</button>
        </div>
        <div class="row col-md-10 mt-2 mb-3">
            <div class="mb-3">
                <p>Hepatitis B - 3 Dose Series</p>
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$hepB_count;?>%"><?=$hepB_count;?>%</div>
                </div>
            </div>
            <div class="mb-3">
                <p>DTaP - 4 Dose Series</p>
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$dtap_count;?>%"><?=$dtap_count;?>%</div>
                </div>
            </div>
            <div class="mb-3">
                <p>IPV - 3 Dose Series</p>
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$ipv_count;?>%"><?=$ipv_count;?>%</div>
                </div>
            </div>
            <div class="mb-3">
                <p>Rotavirus - 2 Dose Series</p>
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$rota_count;?>%"><?=$rota_count;?>%</div>
                </div>
            </div>
        </div>
    </div> 
</div>
<?php include('modal/immunization/pediarix/add-pediarix.php'); ?>