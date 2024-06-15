<?php
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);

$decrypted_dob = htmlspecialchars(decryptthis($diversity['dob'], $key));
$year = (date('Y') - date('Y', strtotime($decrypted_dob)));
$dob = (date('m', strtotime($decrypted_dob)) . '/' . date('d', strtotime($decrypted_dob)) . '/' . date('Y', strtotime($decrypted_dob)));

$date = date("Y/m/d");

// Date from Today
$month1 = strtotime("+1 months", strtotime($date));
$month1 = date('m/d/Y',$month1);
$month2 = strtotime("+2 months", strtotime($date));
$month2 = date('m/d/Y',$month2);
$month4 = strtotime("+4 months", strtotime($date));
$month4 = date('m/d/Y',$month4);
$month6 = strtotime("+6 months", strtotime($date));
$month6 = date('m/d/Y',$month6);
$month12 = strtotime("+12 months", strtotime($date));
$month12 = date('m/d/Y',$month12);
$month18 = strtotime("+18 months", strtotime($date));
$month18 = date('m/d/Y',$month18);

// Date from date of birth
$month1old = strtotime("+1 months", strtotime($dob));
$month1old = date('m/d/Y',$month1old);
$month2old = strtotime("+2 months", strtotime($dob));
$month2old = date('m/d/Y',$month2old);
$month4old = strtotime("+4 months", strtotime($dob));
$month4old = date('m/d/Y',$month4old);
$month6old = strtotime("+6 months", strtotime($dob));
$month6old = date('m/d/Y',$month6old);
$month15old = strtotime("+15 months", strtotime($dob));
$month15old = date('m/d/Y',$month15old);
$month18old = strtotime("+18 months", strtotime($dob));
$month18old = date('m/d/Y',$month18old);
$year1old = strtotime("+1 years", strtotime($dob));
$year1old = date('m/d/Y',$year1old);
$year4old = strtotime("+4 years", strtotime($dob));
$year4old = date('m/d/Y',$year4old);
$year6old = strtotime("+6 years", strtotime($dob));
$year6old = date('m/d/Y',$year6old);
$year11old = strtotime("+11 years", strtotime($dob));
$year11old = date('m/d/Y',$year11old);
$year11_6month_old = strtotime("+138 months", strtotime($dob));
$year11_6month_old = date('m/d/Y',$year11_6month_old);
$year16old = strtotime("+16 years", strtotime($dob));
$year16old = date('m/d/Y',$year16old);
$year16_1month_old = strtotime("+192 months", strtotime($dob));
$year16_1month_old = date('m/d/Y',$year16_1month_old);
$year16_6month_old = strtotime("+197 months", strtotime($dob));
$year16_6month_old = date('m/d/Y',$year16_6month_old);
$year18old = strtotime("+18 years", strtotime($dob));
$year18old = date('m/d/Y',$year18old);
?>

<style>
    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }
    #btn_schedule{
        width: 90px;
        height: 31px;
    }
    #btn_complete{
        width: 90px;
        height: 31px;
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        color: #fff;
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
    }
    #btn_progress{
        width: 90px;
        height: 31px;
    }
    .btn:hover{
    background-color: #8fafff;
    color: white;
    transition: all 1s ease;
  }
</style>
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
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>Vax</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>1st</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>2nd</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>3rd</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>4th</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>5th</b></small></button>
                        </div>

                        <!-- RSV -->
                        <?=$rsv_schedule?>

                        <!--  Hep B-->
                        <div style="margin-top: 5.5px">
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>Hep B</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$dob;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month2old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month6old;?></small></button>
                        </div>

                        <!-- RV -->
                        <div style="margin-top: 6px">
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>RV</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month2old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month4old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month6old;?></small></button>
                        </div>
                        <div style="margin-top: 5px"> <!-- DTaP -->
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>DTaP</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month2old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month4old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month6old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month15old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month18old;?></small></button>
                        </div>
                        <div style="margin-top: 5px"> <!-- Hib -->
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>Hib</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month2old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month4old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month6old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month15old;?></small></button>
                        </div>
                        <div style="margin-top: 5px"> <!-- PCV -->
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>PCV</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month2old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month4old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month6old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year1old;?></small></button>
                        </div>
                        <div style="margin-top: 5px"> <!-- IPV -->
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>IPV</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month2old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month4old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month6old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year4old;?></small></button>
                        </div>
                        <div style="margin-top: 5px"> <!-- MMR -->
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>MMR</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year1old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year4old;?></small></button>
                        </div>
                        <div style="margin-top: 6px"> <!-- VAR -->
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>VAR</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year1old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year4old;?></small></button>
                        </div>
                        <div style="margin-top: 5px"> <!-- Hep A -->
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>Hep A</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year1old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$month18old;?></small></button>
                        </div>
                        <div style="margin-top: 5px"> <!-- Tdap -->
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>Tdap</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year11old;?></small></button>
                        </div>
                        <div style="margin-top: 5px"> <!-- HPV -->
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>HPV</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year11old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year11_6month_old;?></small></button>
                        </div>
                        <div style="margin-top: 5px"> <!-- MCV -->
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>MCV</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year11old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year16old;?></small></button>
                        </div>
                        <div style="margin-top: 5px"> <!-- Men B Bexsero-->
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm btn-secondary rounded-3" disabled><small><b>Men B</b></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year16old;?></small></button>
                            <button id="btn_schedule" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year16_1month_old;?></small></button>
                        </div>
                        <!-- Trumenba
                        <div style="margin-top: 6px">
                            <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year16old;?></small></button>
                            <button id="btn" class="focus-ring py-1 px-2 btn btn-sm border rounded-3"><small><?=$year16_6month_old;?></small></button>
                        </div>
                        -->
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
    <!-- 
    <div class='card'>
        <div class='card-body'>
            <div class='row'>
                <div class='col'>
                    <?=$iz_recommendation?>
                </div>
                <div class='col'>
                    <?=$iz_recommendation?>
                </div>
                <div class='col'>
                    <?=$iz_recommendation?>
                </div>
                <div class='col'>
                    <?=$iz_recommendation?>
                </div>
                <div class='col'>
                    <?=$iz_recommendation?>
                </div>
            </div>
        </div>
    </div>
    -->
</div>