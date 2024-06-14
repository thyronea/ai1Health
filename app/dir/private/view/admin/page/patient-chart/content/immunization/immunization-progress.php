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
    #btn{
        width: 100px;
        height: 31px;
    }
    .btn:hover{
    background-color: #e6effc;
    transition: all 1s ease;
  }
</style>
<div class="tab-pane fade show" id="progress" role="tabpanel" tabindex="0">
    <div class="row col-md-12">
        <div class="col-md-2 mt-5 mb-3" align="right">
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
                
            </small>
        </div>
        <div class="col-md-6 mt-5 mb-3">
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