<script>

// Fetch RSV information based on option selected
function rsv_info(){
    var id = document.getElementById("rsv_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("rsv_vaccines").value = data.vaccines;
            document.getElementById("rsv_lot").value = data.lot;
            document.getElementById("rsv_ndc").value = data.ndc;
            document.getElementById("rsv_exp").value = data.exp;
        }
    })
}


// Fetch Hep B information based on option selected
function hepB_info(){
    var id = document.getElementById("hepB_ID").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("hepB_vaccines").value = data.vaccines;
            document.getElementById("hepB_lot").value = data.lot;
            document.getElementById("hepB_ndc").value = data.ndc;
            document.getElementById("hepB_exp").value = data.exp;
            document.getElementById("hepB_funding").value = data.funding_source;
            document.getElementById("hepB_eligibility").value = data.funding_source;
        }
    })
}


// Funding source validation
function onChange() {
    const funding = document.querySelector('input[name=funding]');
    const eligibility = document.querySelector('select[name=eligibility]');
     
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
