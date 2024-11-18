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
            document.getElementById("add_pediarix_manu").value = data.manufacturer;
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

// Fetch PENTACEL information based on option selected to ADD
function add_pentacel(){
    var id = document.getElementById("pentacel_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_pentacel_vaccines").value = data.vaccines;
            document.getElementById("add_pentacel_manu").value = data.manufacturer;
            document.getElementById("add_pentacel_lot").value = data.lot;
            document.getElementById("add_pentacel_ndc").value = data.ndc;
            document.getElementById("add_pentacel_exp").value = data.exp;
            document.getElementById("add_pentacel_funding").value = data.funding_source;
            document.getElementById("add_pentacel_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding PENTACEL
function add_validate_pentacel() {
    const funding = document.querySelector('input[name=add_pentacel_funding]');
    const eligibility = document.querySelector('select[name=add_pentacel_eligibility]');
     
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

// Fetch VAXELIS information based on option selected to ADD
function add_vaxelis(){
    var id = document.getElementById("vaxelis_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_vaxelis_vaccines").value = data.vaccines;
            document.getElementById("add_vaxelis_manu").value = data.manufacturer;
            document.getElementById("add_vaxelis_lot").value = data.lot;
            document.getElementById("add_vaxelis_ndc").value = data.ndc;
            document.getElementById("add_vaxelis_exp").value = data.exp;
            document.getElementById("add_vaxelis_funding").value = data.funding_source;
            document.getElementById("add_vaxelis_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding VAXELIS
function add_validate_vaxelis() {
    const funding = document.querySelector('input[name=add_vaxelis_funding]');
    const eligibility = document.querySelector('select[name=add_vaxelis_eligibility]');
     
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

// Fetch QUADRACEL information based on option selected to ADD
function add_quadracel(){
    var id = document.getElementById("quadracel_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_quadracel_vaccines").value = data.vaccines;
            document.getElementById("add_quadracel_manu").value = data.manufacturer;
            document.getElementById("add_quadracel_lot").value = data.lot;
            document.getElementById("add_quadracel_ndc").value = data.ndc;
            document.getElementById("add_quadracel_exp").value = data.exp;
            document.getElementById("add_quadracel_funding").value = data.funding_source;
            document.getElementById("add_quadracel_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding QUADRACEL
function add_validate_quadracel() {
    const funding = document.querySelector('input[name=add_quadracel_funding]');
    const eligibility = document.querySelector('select[name=add_quadracel_eligibility]');
     
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

// Fetch KINRIX information based on option selected to ADD
function add_kinrix(){
    var id = document.getElementById("kinrix_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_kinrix_vaccines").value = data.vaccines;
            document.getElementById("add_kinrix_manu").value = data.manufacturer;
            document.getElementById("add_kinrix_lot").value = data.lot;
            document.getElementById("add_kinrix_ndc").value = data.ndc;
            document.getElementById("add_kinrix_exp").value = data.exp;
            document.getElementById("add_kinrix_funding").value = data.funding_source;
            document.getElementById("add_kinrix_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding KINRIX
function add_validate_kinrix() {
    const funding = document.querySelector('input[name=add_kinrix_funding]');
    const eligibility = document.querySelector('select[name=add_kinrix_eligibility]');
     
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

// Fetch PROQUAD information based on option selected to ADD
function add_proquad(){
    var id = document.getElementById("proquad_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_proquad_vaccines").value = data.vaccines;
            document.getElementById("add_proquad_manu").value = data.manufacturer;
            document.getElementById("add_proquad_lot").value = data.lot;
            document.getElementById("add_proquad_ndc").value = data.ndc;
            document.getElementById("add_proquad_exp").value = data.exp;
            document.getElementById("add_proquad_funding").value = data.funding_source;
            document.getElementById("add_proquad_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding PROQUAD
function add_validate_proquad() {
    const funding = document.querySelector('input[name=add_proquad_funding]');
    const eligibility = document.querySelector('select[name=add_proquad_eligibility]');
     
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
            document.getElementById("add_rsv_manu").value = data.manufacturer;
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
            document.getElementById("add_hepB_manu").value = data.manufacturer;
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
            document.getElementById("add_rota_manu").value = data.manufacturer;
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
            document.getElementById("add_dtap_manu").value = data.manufacturer;
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
            document.getElementById("add_hib_manu").value = data.manufacturer;
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
            document.getElementById("add_pcv_manu").value = data.manufacturer;
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
            document.getElementById("add_ipv_manu").value = data.manufacturer;
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
            document.getElementById("add_covid_manu").value = data.manufacturer;
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

// Fetch Influenza information based on option selected to ADD
function add_flu(){
    var id = document.getElementById("flu_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_flu_vaccines").value = data.vaccines;
            document.getElementById("add_flu_manu").value = data.manufacturer;
            document.getElementById("add_flu_lot").value = data.lot;
            document.getElementById("add_flu_ndc").value = data.ndc;
            document.getElementById("add_flu_exp").value = data.exp;
            document.getElementById("add_flu_funding").value = data.funding_source;
            document.getElementById("add_flu_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding Influenza
function add_validate_flu() {
    const funding = document.querySelector('input[name=add_flu_funding]');
    const eligibility = document.querySelector('select[name=add_flu_eligibility]');
     
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
// Fetch Influenza information based on option selected to EDIT
function edit_flu(){
    var id = document.getElementById("edit_flu_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_flu_name").value = data.vaccines;
            document.getElementById("edit_flu_lot").value = data.lot;
            document.getElementById("edit_flu_ndc").value = data.ndc;
            document.getElementById("edit_flu_exp").value = data.exp;
            document.getElementById("edit_flu_funding").value = data.funding_source;
            document.getElementById("edit_flu_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing Influenza
function edit_validate_flu() {
    const funding = document.querySelector('input[name=edit_flu_funding]');
    const eligibility = document.querySelector('select[name=edit_flu_eligibility]');
     
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

// Fetch MMR information based on option selected to ADD
function add_mmr(){
    var id = document.getElementById("mmr_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_mmr_vaccines").value = data.vaccines;
            document.getElementById("add_mmr_manu").value = data.manufacturer;
            document.getElementById("add_mmr_lot").value = data.lot;
            document.getElementById("add_mmr_ndc").value = data.ndc;
            document.getElementById("add_mmr_exp").value = data.exp;
            document.getElementById("add_mmr_funding").value = data.funding_source;
            document.getElementById("add_mmr_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding MMR
function add_validate_mmr() {
    const funding = document.querySelector('input[name=add_mmr_funding]');
    const eligibility = document.querySelector('select[name=add_mmr_eligibility]');
     
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
// Fetch MMR information based on option selected to EDIT
function edit_mmr(){
    var id = document.getElementById("edit_mmr_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_mmr_name").value = data.vaccines;
            document.getElementById("edit_mmr_lot").value = data.lot;
            document.getElementById("edit_mmr_ndc").value = data.ndc;
            document.getElementById("edit_mmr_exp").value = data.exp;
            document.getElementById("edit_mmr_funding").value = data.funding_source;
            document.getElementById("edit_mmr_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing MMR
function edit_validate_mmr() {
    const funding = document.querySelector('input[name=edit_mmr_funding]');
    const eligibility = document.querySelector('select[name=edit_mmr_eligibility]');
     
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

// Fetch Varicella information based on option selected to ADD
function add_var(){
    var id = document.getElementById("var_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_var_vaccines").value = data.vaccines;
            document.getElementById("add_var_manu").value = data.manufacturer;
            document.getElementById("add_var_lot").value = data.lot;
            document.getElementById("add_var_ndc").value = data.ndc;
            document.getElementById("add_var_exp").value = data.exp;
            document.getElementById("add_var_funding").value = data.funding_source;
            document.getElementById("add_var_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding Varicella
function add_validate_var() {
    const funding = document.querySelector('input[name=add_var_funding]');
    const eligibility = document.querySelector('select[name=add_var_eligibility]');
     
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
// Fetch Varicella information based on option selected to EDIT
function edit_var(){
    var id = document.getElementById("edit_var_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_var_name").value = data.vaccines;
            document.getElementById("edit_var_lot").value = data.lot;
            document.getElementById("edit_var_ndc").value = data.ndc;
            document.getElementById("edit_var_exp").value = data.exp;
            document.getElementById("edit_var_funding").value = data.funding_source;
            document.getElementById("edit_var_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing Varicella
function edit_validate_var() {
    const funding = document.querySelector('input[name=edit_var_funding]');
    const eligibility = document.querySelector('select[name=edit_var_eligibility]');
     
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

// Fetch Hepatitis A information based on option selected to ADD
function add_hepa(){
    var id = document.getElementById("hepa_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_hepa_vaccines").value = data.vaccines;
            document.getElementById("add_hepa_manu").value = data.manufacturer;
            document.getElementById("add_hepa_lot").value = data.lot;
            document.getElementById("add_hepa_ndc").value = data.ndc;
            document.getElementById("add_hepa_exp").value = data.exp;
            document.getElementById("add_hepa_funding").value = data.funding_source;
            document.getElementById("add_hepa_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding Hepatitis A
function add_validate_hepa() {
    const funding = document.querySelector('input[name=add_hepa_funding]');
    const eligibility = document.querySelector('select[name=add_hepa_eligibility]');
     
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
// Fetch Hepatitis A information based on option selected to EDIT
function edit_hepa(){
    var id = document.getElementById("edit_hepa_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_hepa_name").value = data.vaccines;
            document.getElementById("edit_hepa_lot").value = data.lot;
            document.getElementById("edit_hepa_ndc").value = data.ndc;
            document.getElementById("edit_hepa_exp").value = data.exp;
            document.getElementById("edit_hepa_funding").value = data.funding_source;
            document.getElementById("edit_hepa_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing Hepatitis A
function edit_validate_hepa() {
    const funding = document.querySelector('input[name=edit_hepa_funding]');
    const eligibility = document.querySelector('select[name=edit_hepa_eligibility]');
     
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

// Fetch Tdap information based on option selected to ADD
function add_tdap(){
    var id = document.getElementById("tdap_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_tdap_vaccines").value = data.vaccines;
            document.getElementById("add_tdap_manu").value = data.manufacturer;
            document.getElementById("add_tdap_lot").value = data.lot;
            document.getElementById("add_tdap_ndc").value = data.ndc;
            document.getElementById("add_tdap_exp").value = data.exp;
            document.getElementById("add_tdap_funding").value = data.funding_source;
            document.getElementById("add_tdap_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding Tdap
function add_validate_tdap() {
    const funding = document.querySelector('input[name=add_tdap_funding]');
    const eligibility = document.querySelector('select[name=add_tdap_eligibility]');
     
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
// Fetch Tdap information based on option selected to EDIT
function edit_tdap(){
    var id = document.getElementById("edit_tdap_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_tdap_name").value = data.vaccines;
            document.getElementById("edit_tdap_lot").value = data.lot;
            document.getElementById("edit_tdap_ndc").value = data.ndc;
            document.getElementById("edit_tdap_exp").value = data.exp;
            document.getElementById("edit_tdap_funding").value = data.funding_source;
            document.getElementById("edit_tdap_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing Tdap
function edit_validate_tdap() {
    const funding = document.querySelector('input[name=edit_tdap_funding]');
    const eligibility = document.querySelector('select[name=edit_tdap_eligibility]');
     
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

// Fetch HPV information based on option selected to ADD
function add_hpv(){
    var id = document.getElementById("hpv_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_hpv_vaccines").value = data.vaccines;
            document.getElementById("add_hpv_manu").value = data.manufacturer;
            document.getElementById("add_hpv_lot").value = data.lot;
            document.getElementById("add_hpv_ndc").value = data.ndc;
            document.getElementById("add_hpv_exp").value = data.exp;
            document.getElementById("add_hpv_funding").value = data.funding_source;
            document.getElementById("add_hpv_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding HPV
function add_validate_hpv() {
    const funding = document.querySelector('input[name=add_hpv_funding]');
    const eligibility = document.querySelector('select[name=add_hpv_eligibility]');
     
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
// Fetch HPV information based on option selected to EDIT
function edit_hpv(){
    var id = document.getElementById("edit_hpv_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_hpv_name").value = data.vaccines;
            document.getElementById("edit_hpv_lot").value = data.lot;
            document.getElementById("edit_hpv_ndc").value = data.ndc;
            document.getElementById("edit_hpv_exp").value = data.exp;
            document.getElementById("edit_hpv_funding").value = data.funding_source;
            document.getElementById("edit_hpv_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing HPV
function edit_validate_hpv() {
    const funding = document.querySelector('input[name=edit_hpv_funding]');
    const eligibility = document.querySelector('select[name=edit_hpv_eligibility]');
     
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

// Fetch MCV information based on option selected to ADD
function add_mcv(){
    var id = document.getElementById("mcv_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_mcv_vaccines").value = data.vaccines;
            document.getElementById("add_mcv_manu").value = data.manufacturer;
            document.getElementById("add_mcv_lot").value = data.lot;
            document.getElementById("add_mcv_ndc").value = data.ndc;
            document.getElementById("add_mcv_exp").value = data.exp;
            document.getElementById("add_mcv_funding").value = data.funding_source;
            document.getElementById("add_mcv_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding MCV
function add_validate_mcv() {
    const funding = document.querySelector('input[name=add_mcv_funding]');
    const eligibility = document.querySelector('select[name=add_mcv_eligibility]');
     
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
// Fetch MCV information based on option selected to EDIT
function edit_mcv(){
    var id = document.getElementById("edit_mcv_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_mcv_name").value = data.vaccines;
            document.getElementById("edit_mcv_lot").value = data.lot;
            document.getElementById("edit_mcv_ndc").value = data.ndc;
            document.getElementById("edit_mcv_exp").value = data.exp;
            document.getElementById("edit_mcv_funding").value = data.funding_source;
            document.getElementById("edit_mcv_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing MCV
function edit_validate_mcv() {
    const funding = document.querySelector('input[name=edit_mcv_funding]');
    const eligibility = document.querySelector('select[name=edit_mcv_eligibility]');
     
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

// Fetch Men B information based on option selected to ADD
function add_menb(){
    var id = document.getElementById("menb_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("add_menb_vaccines").value = data.vaccines;
            document.getElementById("add_menb_manu").value = data.manufacturer;
            document.getElementById("add_menb_lot").value = data.lot;
            document.getElementById("add_menb_ndc").value = data.ndc;
            document.getElementById("add_menb_exp").value = data.exp;
            document.getElementById("add_menb_funding").value = data.funding_source;
            document.getElementById("add_menb_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when adding Men B
function add_validate_menb() {
    const funding = document.querySelector('input[name=add_menb_funding]');
    const eligibility = document.querySelector('select[name=add_menb_eligibility]');
     
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
// Fetch Men B information based on option selected to EDIT
function edit_menb(){
    var id = document.getElementById("edit_menb_vaccines").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("edit_menb_name").value = data.vaccines;
            document.getElementById("edit_menb_lot").value = data.lot;
            document.getElementById("edit_menb_ndc").value = data.ndc;
            document.getElementById("edit_menb_exp").value = data.exp;
            document.getElementById("edit_menb_funding").value = data.funding_source;
            document.getElementById("edit_menb_eligibility").value = data.funding_source;
        }
    })
}
// Validate eligbility and funding when editing Men B
function edit_validate_menb() {
    const funding = document.querySelector('input[name=edit_menb_funding]');
    const eligibility = document.querySelector('select[name=edit_menb_eligibility]');
     
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