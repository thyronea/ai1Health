<script>
// Fetch PEDIARIX information based on option selected to ADD
function add_pediarix(){
    var id = document.getElementById("pediarix_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_pediarix_vaccines").value = data.vaccines;
            document.getElementById("add_pediarix_lot").value = data.lot;
            document.getElementById("add_pediarix_ndc").value = data.ndc;
            document.getElementById("add_pediarix_exp").value = data.exp;
            document.getElementById("add_pediarix_funding").value = data.funding_source;
            document.getElementById("add_pediarix_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding PEDIARIX
function add_validate_pediarix() {
    const funding = document.querySelector('input[name=add_pediarix_funding]');
    const eligibility = document.querySelector('select[name=add_pediarix_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}

// Fetch RSV information based on option selected to ADD
function add_rsv(){
    var id = document.getElementById("rsv_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_rsv_vaccines").value = data.vaccines;
            document.getElementById("add_rsv_lot").value = data.lot;
            document.getElementById("add_rsv_ndc").value = data.ndc;
            document.getElementById("add_rsv_exp").value = data.exp;
            document.getElementById("add_rsv_funding").value = data.funding_source;
            document.getElementById("add_rsv_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding RSV
function add_validate_rsv() {
    const funding = document.querySelector('input[name=add_rsv_funding]');
    const eligibility = document.querySelector('select[name=add_rsv_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}
// Fetch RSV information based on option selected to EDIT
function edit_rsv(){
    var id = document.getElementById("edit_rsv_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_rsv_name").value = data.vaccines;
            document.getElementById("edit_rsv_lot").value = data.lot;
            document.getElementById("edit_rsv_ndc").value = data.ndc;
            document.getElementById("edit_rsv_exp").value = data.exp;
            document.getElementById("edit_rsv_funding").value = data.funding_source;
            document.getElementById("edit_rsv_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing RSV
function edit_validate_rsv() {
    const funding = document.querySelector('input[name=edit_rsv_funding]');
    const eligibility = document.querySelector('select[name=edit_rsv_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}

// Fetch Hep B information based on option selected to ADD
function add_hepB(){
    var id = document.getElementById("hepB_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_hepB_vaccines").value = data.vaccines;
            document.getElementById("add_hepB_lot").value = data.lot;
            document.getElementById("add_hepB_ndc").value = data.ndc;
            document.getElementById("add_hepB_exp").value = data.exp;
            document.getElementById("add_hepB_funding").value = data.funding_source;
            document.getElementById("add_hepB_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding Hep B
function add_validate_hepB() {
    const funding = document.querySelector('input[name=add_hepB_funding]');
    const eligibility = document.querySelector('select[name=add_hepB_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}
// Fetch Hep B information based on option selected to EDIT
function edit_hepB(){
    var id = document.getElementById("edit_hepB_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_hepB_name").value = data.vaccines;
            document.getElementById("edit_hepB_lot").value = data.lot;
            document.getElementById("edit_hepB_ndc").value = data.ndc;
            document.getElementById("edit_hepB_exp").value = data.exp;
            document.getElementById("edit_hepB_funding").value = data.funding_source;
            document.getElementById("edit_hepB_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing Hep B
function edit_validate_hepB() {
    const funding = document.querySelector('input[name=edit_hepB_funding]');
    const eligibility = document.querySelector('select[name=edit_hepB_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}

// Fetch Rotavirus information based on option selected to ADD
function add_rota(){
    var id = document.getElementById("rota_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_rota_vaccines").value = data.vaccines;
            document.getElementById("add_rota_lot").value = data.lot;
            document.getElementById("add_rota_ndc").value = data.ndc;
            document.getElementById("add_rota_exp").value = data.exp;
            document.getElementById("add_rota_funding").value = data.funding_source;
            document.getElementById("add_rota_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding Rotavirus
function add_validate_rota() {
    const funding = document.querySelector('input[name=add_rota_funding]');
    const eligibility = document.querySelector('select[name=add_rota_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}
// Fetch Rotavirus information based on option selected to EDIT
function edit_rota(){
    var id = document.getElementById("edit_rota_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_rota_name").value = data.vaccines;
            document.getElementById("edit_rota_lot").value = data.lot;
            document.getElementById("edit_rota_ndc").value = data.ndc;
            document.getElementById("edit_rota_exp").value = data.exp;
            document.getElementById("edit_rota_funding").value = data.funding_source;
            document.getElementById("edit_rota_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing Rotavirus
function edit_validate_rota() {
    const funding = document.querySelector('input[name=edit_rota_funding]');
    const eligibility = document.querySelector('select[name=edit_rota_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}

// Fetch DTaP information based on option selected to ADD
function add_dtap(){
    var id = document.getElementById("dtap_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_dtap_vaccines").value = data.vaccines;
            document.getElementById("add_dtap_lot").value = data.lot;
            document.getElementById("add_dtap_ndc").value = data.ndc;
            document.getElementById("add_dtap_exp").value = data.exp;
            document.getElementById("add_dtap_funding").value = data.funding_source;
            document.getElementById("add_dtap_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding DTaP
function add_validate_dtap() {
    const funding = document.querySelector('input[name=add_dtap_funding]');
    const eligibility = document.querySelector('select[name=add_dtap_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}
// Fetch DTaP information based on option selected to EDIT
function edit_dtap(){
    var id = document.getElementById("edit_dtap_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_dtap_name").value = data.vaccines;
            document.getElementById("edit_dtap_lot").value = data.lot;
            document.getElementById("edit_dtap_ndc").value = data.ndc;
            document.getElementById("edit_dtap_exp").value = data.exp;
            document.getElementById("edit_dtap_funding").value = data.funding_source;
            document.getElementById("edit_dtap_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing DTaP
function edit_validate_dtap() {
    const funding = document.querySelector('input[name=edit_dtap_funding]');
    const eligibility = document.querySelector('select[name=edit_dtap_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}

// Fetch Hib information based on option selected to ADD
function add_hib(){
    var id = document.getElementById("hib_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_hib_vaccines").value = data.vaccines;
            document.getElementById("add_hib_lot").value = data.lot;
            document.getElementById("add_hib_ndc").value = data.ndc;
            document.getElementById("add_hib_exp").value = data.exp;
            document.getElementById("add_hib_funding").value = data.funding_source;
            document.getElementById("add_hib_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding Hib
function add_validate_hib() {
    const funding = document.querySelector('input[name=add_hib_funding]');
    const eligibility = document.querySelector('select[name=add_hib_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}
// Fetch Hib information based on option selected to EDIT
function edit_hib(){
    var id = document.getElementById("edit_hib_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_hib_name").value = data.vaccines;
            document.getElementById("edit_hib_lot").value = data.lot;
            document.getElementById("edit_hib_ndc").value = data.ndc;
            document.getElementById("edit_hib_exp").value = data.exp;
            document.getElementById("edit_hib_funding").value = data.funding_source;
            document.getElementById("edit_hib_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing Hib
function edit_validate_hib() {
    const funding = document.querySelector('input[name=edit_hib_funding]');
    const eligibility = document.querySelector('select[name=edit_hib_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}

// Fetch PCV information based on option selected to ADD
function add_pcv(){
    var id = document.getElementById("pcv_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_pcv_vaccines").value = data.vaccines;
            document.getElementById("add_pcv_lot").value = data.lot;
            document.getElementById("add_pcv_ndc").value = data.ndc;
            document.getElementById("add_pcv_exp").value = data.exp;
            document.getElementById("add_pcv_funding").value = data.funding_source;
            document.getElementById("add_pcv_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding PCV
function add_validate_pcv() {
    const funding = document.querySelector('input[name=add_pcv_funding]');
    const eligibility = document.querySelector('select[name=add_pcv_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}
// Fetch PCV information based on option selected to EDIT
function edit_pcv(){
    var id = document.getElementById("edit_pcv_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_pcv_name").value = data.vaccines;
            document.getElementById("edit_pcv_lot").value = data.lot;
            document.getElementById("edit_pcv_ndc").value = data.ndc;
            document.getElementById("edit_pcv_exp").value = data.exp;
            document.getElementById("edit_pcv_funding").value = data.funding_source;
            document.getElementById("edit_pcv_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing PCV
function edit_validate_pcv() {
    const funding = document.querySelector('input[name=edit_pcv_funding]');
    const eligibility = document.querySelector('select[name=edit_pcv_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}

// Fetch IPV information based on option selected to ADD
function add_ipv(){
    var id = document.getElementById("ipv_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_ipv_vaccines").value = data.vaccines;
            document.getElementById("add_ipv_lot").value = data.lot;
            document.getElementById("add_ipv_ndc").value = data.ndc;
            document.getElementById("add_ipv_exp").value = data.exp;
            document.getElementById("add_ipv_funding").value = data.funding_source;
            document.getElementById("add_ipv_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding IPV
function add_validate_ipv() {
    const funding = document.querySelector('input[name=add_ipv_funding]');
    const eligibility = document.querySelector('select[name=add_ipv_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}
// Fetch IPV information based on option selected to EDIT
function edit_ipv(){
    var id = document.getElementById("edit_ipv_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_ipv_name").value = data.vaccines;
            document.getElementById("edit_ipv_lot").value = data.lot;
            document.getElementById("edit_ipv_ndc").value = data.ndc;
            document.getElementById("edit_ipv_exp").value = data.exp;
            document.getElementById("edit_ipv_funding").value = data.funding_source;
            document.getElementById("edit_ipv_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing IPV
function edit_validate_ipv() {
    const funding = document.querySelector('input[name=edit_ipv_funding]');
    const eligibility = document.querySelector('select[name=edit_ipv_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}

// Fetch COVID information based on option selected to ADD
function add_covid(){
    var id = document.getElementById("covid_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_covid_vaccines").value = data.vaccines;
            document.getElementById("add_covid_lot").value = data.lot;
            document.getElementById("add_covid_ndc").value = data.ndc;
            document.getElementById("add_covid_exp").value = data.exp;
            document.getElementById("add_covid_funding").value = data.funding_source;
            document.getElementById("add_covid_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding COVID
function add_validate_covid() {
    const funding = document.querySelector('input[name=add_covid_funding]');
    const eligibility = document.querySelector('select[name=add_covid_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}
// Fetch COVID information based on option selected to EDIT
function edit_covid(){
    var id = document.getElementById("edit_covid_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_covid_name").value = data.vaccines;
            document.getElementById("edit_covid_lot").value = data.lot;
            document.getElementById("edit_covid_ndc").value = data.ndc;
            document.getElementById("edit_covid_exp").value = data.exp;
            document.getElementById("edit_covid_funding").value = data.funding_source;
            document.getElementById("edit_covid_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing COVID
function edit_validate_covid() {
    const funding = document.querySelector('input[name=edit_covid_funding]');
    const eligibility = document.querySelector('select[name=edit_covid_eligibility]');
     
    if(eligibility.value === funding.value ||
        eligibility.value === "VFC Eligible - Medical/Medicaid" ||
        eligibility.value === "VFC Eligible - Uninsured" ||
        eligibility.value === "VFC Eligible - Underinsured" ||
        eligibility.value === "VFC Eligible - Native American" ||
        eligibility.value === "VFC Eligible - Alaskan Native"){
        eligibility.setCustomValidity('');
    }
    else{
        eligibility.setCustomValidity('Funding Source and Eligibility does not match');
    }
}
  
</script>
