<div class="tab-pane fade show active" id="history" role="tabpanel" tabindex="0">
    <div class="row">
        <div class="col mt-2 mb-3" align="right">
            <small>
                <div class="mb-4">
                    <p>RSV - 1 Dose Series</p>
                </div>
                <div class="mb-4">
                    <p>Hepatitis B - 3 Dose Series</p>
                </div>
                <div class="mb-4">
                    <p>Rotavirus - 2 Dose Series</p>
                </div>
                <div class="mb-4">
                    <p>DTaP - 4 Dose Series</p>
                </div>
                <div class="mb-4">
                    <p>Hib - 4 Dose Series</p>
                </div>
                <div class="mb-4">
                    <p>PCV - 4 Dose Series</p>
                </div>
                <div class="mb-4">
                    <p>IPV - 3 Dose Series</p>
                </div>
            </small>
        </div>
        <div class="row col-md-10 mt-2 mb-3">
            <div class="mb-3">
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$rsv_count;?>%"><?=$rsv_count;?>%</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$hepB_count;?>%"><?=$hepB_count;?>%</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$rota_count;?>%"><?=$rota_count;?>%</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$dtap_count;?>%"><?=$dtap_count;?>%</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$hib_count;?>%"><?=$hib_count;?>%</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$pcv_count;?>%"><?=$pcv_count;?>%</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$ipv_count;?>%"><?=$ipv_count;?>%</div>
                </div>
            </div>
        </div>
    </div> 
    <div class='card'>
        <div class='card-body'>
            <div class='row'>
                <div class='col'>
                    <?=$hepB_recommendation?>
                </div>
                <div class='col'>
                    <?=$hepB_recommendation?>
                </div>
                <div class='col'>
                    <?=$hepB_recommendation?>
                </div>
                <div class='col'>
                    <?=$hepB_recommendation?>
                </div>
                <div class='col'>
                    <?=$hepB_recommendation?>
                </div>
            </div>
        </div>
    </div>
</div>