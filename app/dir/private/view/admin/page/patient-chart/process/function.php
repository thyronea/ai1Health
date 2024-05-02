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
            document.getElementById("hepB_funding_").value = data.funding_source;
            document.getElementById("hepB_funding").value = data.funding_source;
        }
    })
}

</script>
