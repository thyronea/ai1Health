<script>
//  Fetch vaccine information based on option selected
function vaccine_info(){
    var id = document.getElementById("id").value;
    $.ajax({
        url:"process/immunization/vaccine-info.php",
        method:"POST",
        data:{
            x: id
        },
        dataType:"JSON",
        success: function(data){
            document.getElementById("vaccines").value = data.vaccines;
            document.getElementById("lot").value = data.lot;
            document.getElementById("ndc").value = data.ndc;
            document.getElementById("exp").value = data.exp;
        }
    })
}
</script>

<!-- Script for generating random uniqueID -->
<script>
 function randomNumber(len) {
  var randomNumber;
  var n = '';

  for (var count = 0; count < len; count++) {
    randomNumber = Math.floor((Math.random() * 9) + 1);
    n += randomNumber.toString();
  }
  return n;
  }
  document.getElementById("uniqueID_").value = randomNumber(8);
</script>