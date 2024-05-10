<script>

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
function add_rsv() {
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
  
</script>
