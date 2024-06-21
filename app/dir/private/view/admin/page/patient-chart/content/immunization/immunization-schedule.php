<div class="tab-pane fade show active" id="schedule" role="tabpanel" tabindex="0">
    <div class="row col-md-12">
        <!--
        <div class="col-md-4 mt-5 mb-3">
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$rsv_count;?>%"><?=$rsv_count;?>%</div>
            </div>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$hepB_count;?>%"><?=$hepB_count;?>%</div>
            </div>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$rota_count;?>%"><?=$rota_count;?>%</div>
            </div>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$dtap_count;?>%"><?=$dtap_count;?>%</div>
            </div>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$hib_count;?>%"><?=$hib_count;?>%</div>
            </div>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$pcv_count;?>%"><?=$pcv_count;?>%</div>
            </div>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$ipv_count;?>%"><?=$ipv_count;?>%</div>
            </div>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$mmr_count;?>%"><?=$mmr_count;?>%</div>
            </div>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$var_count;?>%"><?=$var_count;?>%</div>
            </div>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$hepa_count;?>%"><?=$hepa_count;?>%</div>
            </div>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$tdap_count;?>%"><?=$tdap_count;?>%</div>
            </div>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$hpv_count;?>%"><?=$hpv_count;?>%</div>
            </div>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$mcv_count;?>%"><?=$mcv_count;?>%</div>
            </div>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$menb_count;?>%"><?=$menb_count;?>%</div>
            </div>
        </div>
        <div class="col-md-2 mt-5 mb-3" align="center">
            <small>
                <div style="margin-top: 14px">
                    <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small>RSV</small></button>
                </div>
                <div style="margin-top: 5px">
                    <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small>HEP B</small></button>
                </div>
                <div style="margin-top: 5.5px">
                    <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small>RV</small></button>
                </div>
                <div style="margin-top: 6px">
                    <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small>DTAP</small></button>
                </div>
                <div style="margin-top: 5px">
                    <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small>HIB</small></button>
                </div>
                <div style="margin-top: 5px">
                    <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small>PCV</small></button>
                </div>
                <div style="margin-top: 5px">
                    <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small>IPV</small></button>
                </div>
                <div style="margin-top: 5px">
                    <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small>MMR</small></button>
                </div>
                <div style="margin-top: 5px">
                    <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small>VAR</small></button>
                </div>
                <div style="margin-top: 6px">
                    <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small>HEP A</small></button>
                </div>
                <div style="margin-top: 6px">
                    <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small>TDAP</small></button>
                </div>
                <div style="margin-top: 6px">
                    <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small>HPV</small></button>
                </div>
                <div style="margin-top: 6px">
                    <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small>MCV</small></button>
                </div>
                <div style="margin-top: 6px">
                    <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small>MEN B</small></button>
                </div>
                
                <div class="mb-3">
                    <p>Men B - Trumenba</p>
                </div>
                
            </small>
        </div>
        -->
        <div class="col-md-7 me-3 mt-2 card border" style="background-image: linear-gradient(#ffffff, #edf3ff); width: 625px">
            <div class="row card-body">
                <div class="col mt-2 mb-3" align="left">
                    <small>
                        <!-- Schedule -->
                        <div style="margin-top: -5px;">
                            <button id="btn_schedule" class="py-1 px-2 btn btn-sm border-0 rounded-3" disabled></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>1st</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>2nd</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>3rd</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>4th</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>5th</b></small></button>
                        </div>
                        <!-- RSV -->
                        <?=$rsv_schedule?>
                        <!--  Hep B-->
                        <?=$hepb_schedule?>
                        <!-- RV -->
                        <?=$rota_schedule?>
                        <!-- DTaP -->
                        <?=$dtap_schedule?>
                        <!-- Hib -->
                        <?=$hib_schedule?>
                        <!-- PCV -->
                        <?=$pcv_schedule?>
                        <!-- IPV -->
                        <?=$ipv_schedule?>
                        <!-- MMR -->
                        <?=$mmr_schedule?>
                        <!-- VAR -->
                        <?=$var_schedule?>
                        <!-- Hep A -->
                        <?=$hepa_schedule?>
                        <!-- Tdap -->
                        <?=$tdap_schedule?>
                        <!-- HPV -->
                        <?=$hpv_schedule?>
                        <!-- MCV -->
                        <?=$mcv_schedule?>
                        <!-- Men B -->
                        <?=$menb_schedule?>
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-2 card border" style="background-image: linear-gradient(#ffffff, #edf3ff); width: 470px">
            <div class="row card-body">
                <div class="col mt-2 mb-3" align="left">
                    <small>
                        <div style="margin-top: 29px">
                            <button id="btn_progress" class="focus-ring py-1 px-2 btn btn-sm border-0 rounded-3" disabled><small>RSV</small></button>
                        </div>
                        <div style="margin-top: 5px">
                            <button id="btn_progress" class="focus-ring py-1 px-2 btn btn-sm border-0 rounded-3" disabled><small>HEP B</small></button>
                        </div>
                        <div style="margin-top: 5.5px">
                            <button id="btn_progress" class="focus-ring py-1 px-2 btn btn-sm border-0 rounded-3" disabled><small>RV</small></button>
                        </div>
                        <div style="margin-top: 6px">
                            <button id="btn_progress" class="focus-ring py-1 px-2 btn btn-sm border-0 rounded-3" disabled><small>DTAP</small></button>
                        </div>
                        <div style="margin-top: 5px">
                            <button id="btn_progress" class="focus-ring py-1 px-2 btn btn-sm border-0 rounded-3" disabled><small>HIB</small></button>
                        </div>
                        <div style="margin-top: 5px">
                            <button id="btn_progress" class="focus-ring py-1 px-2 btn btn-sm border-0 rounded-3" disabled><small>PCV</small></button>
                        </div>
                        <div style="margin-top: 5px">
                            <button id="btn_progress" class="focus-ring py-1 px-2 btn btn-sm border-0 rounded-3" disabled><small>IPV</small></button>
                        </div>
                        <div style="margin-top: 5px">
                            <button id="btn_progress" class="focus-ring py-1 px-2 btn btn-sm border-0 rounded-3" disabled><small>MMR</small></button>
                        </div>
                        <div style="margin-top: 5px">
                            <button id="btn_progress" class="focus-ring py-1 px-2 btn btn-sm border-0 rounded-3" disabled><small>VAR</small></button>
                        </div>
                        <div style="margin-top: 6px">
                            <button id="btn_progress" class="focus-ring py-1 px-2 btn btn-sm border-0 rounded-3" disabled><small>HEP A</small></button>
                        </div>
                        <div style="margin-top: 6px">
                            <button id="btn_progress" class="focus-ring py-1 px-2 btn btn-sm border-0 rounded-3" disabled><small>TDAP</small></button>
                        </div>
                        <div style="margin-top: 6px">
                            <button id="btn_progress" class="focus-ring py-1 px-2 btn btn-sm border-0 rounded-3" disabled><small>HPV</small></button>
                        </div>
                        <div style="margin-top: 6px">
                            <button id="btn_progress" class="focus-ring py-1 px-2 btn btn-sm border-0 rounded-3" disabled><small>MCV</small></button>
                        </div>
                        <div style="margin-top: 6px">
                            <button id="btn_progress" class="focus-ring py-1 px-2 btn btn-sm border-0 rounded-3" disabled><small>MEN B</small></button>
                        </div>
                    </small>
                </div>
                <div class="col-md-8 mt-2 mb-3">
                    <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 35px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$rsv_count;?>%"><?=$rsv_count;?>%</div>
                    </div>
                    <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$hepB_count;?>%"><?=$hepB_count;?>%</div>
                    </div>
                    <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$rota_count;?>%"><?=$rota_count;?>%</div>
                    </div>
                    <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$dtap_count;?>%"><?=$dtap_count;?>%</div>
                    </div>
                    <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$hib_count;?>%"><?=$hib_count;?>%</div>
                    </div>
                    <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$pcv_count;?>%"><?=$pcv_count;?>%</div>
                    </div>
                    <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$ipv_count;?>%"><?=$ipv_count;?>%</div>
                    </div>
                    <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 14px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$mmr_count;?>%"><?=$mmr_count;?>%</div>
                    </div>
                    <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 14px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$var_count;?>%"><?=$var_count;?>%</div>
                    </div>
                    <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$hepa_count;?>%"><?=$hepa_count;?>%</div>
                    </div>
                    <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$tdap_count;?>%"><?=$tdap_count;?>%</div>
                    </div>
                    <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$hpv_count;?>%"><?=$hpv_count;?>%</div>
                    </div>
                    <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$mcv_count;?>%"><?=$mcv_count;?>%</div>
                    </div>
                    <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 20px; margin-top: 17px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?=$menb_count;?>%"><?=$menb_count;?>%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>