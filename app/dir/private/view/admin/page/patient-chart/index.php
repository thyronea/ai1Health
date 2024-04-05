<?php
session_start();
include('../../../../security/dbcon.php');
include('../../../../security/encrypt_decrypt.php');
include('../../components/header.php');
?>

<!-- Login session -->
<?php if (isset($_SESSION["userID"])): ?>

<?php $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]); ?>

<!-- Navtab -->
<?php include('components/navtab.php'); ?>
<!-- Navtab Result -->
<div class="tab-content">
  <?php include('content/patient-chart-snapshot.php'); ?>
  <?php include('content/patient-chart-demographic.php'); ?>
  <?php include('content/patient-chart-immunization.php'); ?>
  <?php include('content/patient-chart-progress-notes.php'); ?>
</div>

<?php
// Update vcode - move this code inside "sql.php" and include the file directory on top.
if(isset($_SESSION["userID"])){
    $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
    $new_vcode = rand(1000,9999); // Generates random verification token
    $update_vcode = "UPDATE token SET v_code='$new_vcode' WHERE userID='$userID' ";
    $update_vcode_run = mysqli_query($con, $update_vcode);
  }
?>

<!-- Modal -->
<?php include('modal/administer-vaccine.php'); ?>
<?php include('modal/administer-hepB-1st.php'); ?>
<?php include('modal/administer-hepB-2nd.php'); ?>
<?php include('modal/administer-hepB-3rd.php'); ?>
<?php include('modal/administer-rv-1st.php'); ?>
<?php include('modal/administer-rv-2nd.php'); ?>
<?php include('modal/administer-rv-3rd.php'); ?>
<?php include('modal/administer-DTaP-1st.php'); ?>
<?php include('modal/administer-DTaP-2nd.php'); ?>
<?php include('modal/administer-DTaP-3rd.php'); ?>
<?php include('modal/administer-DTaP-4th.php'); ?>
<?php include('modal/administer-DTaP-5th.php'); ?>
<?php include('modal/administer-Hib-1st.php'); ?>
<?php include('modal/administer-Hib-2nd.php'); ?>
<?php include('modal/administer-Hib-3rd.php'); ?>
<?php include('modal/administer-Hib-4th.php'); ?>
<?php include('modal/administer-PCV-1st.php'); ?>
<?php include('modal/administer-PCV-2nd.php'); ?>
<?php include('modal/administer-PCV-3rd.php'); ?>
<?php include('modal/administer-PCV-4th.php'); ?>
<?php include('modal/administer-IPV-1st.php'); ?>
<?php include('modal/administer-IPV-2nd.php'); ?>
<?php include('modal/administer-IPV-3rd.php'); ?>
<?php include('modal/administer-IPV-4th.php'); ?>
<?php include('modal/administer-covid.php'); ?>
<?php include('modal/administer-flu.php'); ?>
<?php include('modal/administer-mmr-1st.php'); ?>
<?php include('modal/administer-mmr-2nd.php'); ?>
<?php include('modal/administer-varicella-1st.php'); ?>
<?php include('modal/administer-varicella-2nd.php'); ?>
<?php include('modal/administer-hepA-1st.php'); ?>
<?php include('modal/administer-hepA-2nd.php'); ?>
<?php include('modal/hepB-1st-vaccine.php'); ?>
<?php include('modal/hepB-1st-edit.php'); ?>
<?php include('modal/hepB-2nd-vaccine.php'); ?>
<?php include('modal/hepB-2nd-edit.php'); ?>
<?php include('modal/hepB-3rd-vaccine.php'); ?>
<?php include('modal/hepB-3rd-edit.php'); ?>
<?php include('modal/delete-hepB-1st.php'); ?>
<?php include('modal/delete-hepB-2nd.php'); ?>
<?php include('modal/delete-hepB-3rd.php'); ?>
<?php include('modal/rv-1st-vaccine.php'); ?>
<?php include('modal/rv-1st-edit.php'); ?>
<?php include('modal/rv-2nd-vaccine.php'); ?>
<?php include('modal/rv-2nd-edit.php'); ?>
<?php include('modal/rv-3rd-vaccine.php'); ?>
<?php include('modal/rv-3rd-edit.php'); ?>
<?php include('modal/delete-rv-1st.php'); ?>
<?php include('modal/delete-rv-2nd.php'); ?>
<?php include('modal/delete-rv-3rd.php'); ?>
<?php include('modal/dtap-1st-vaccine.php'); ?>
<?php include('modal/dtap-1st-edit.php'); ?>
<?php include('modal/dtap-2nd-vaccine.php'); ?>
<?php include('modal/dtap-2nd-edit.php'); ?>
<?php include('modal/dtap-3rd-vaccine.php'); ?>
<?php include('modal/dtap-3rd-edit.php'); ?>
<?php include('modal/dtap-4th-vaccine.php'); ?>
<?php include('modal/dtap-4th-edit.php'); ?>
<?php include('modal/dtap-5th-vaccine.php'); ?>
<?php include('modal/dtap-5th-edit.php'); ?>
<?php include('modal/delete-dtap-1st.php'); ?>
<?php include('modal/delete-dtap-2nd.php'); ?>
<?php include('modal/delete-dtap-3rd.php'); ?>
<?php include('modal/delete-dtap-4th.php'); ?>
<?php include('modal/delete-dtap-5th.php'); ?>
<?php include('modal/hib-1st-vaccine.php'); ?>
<?php include('modal/hib-1st-edit.php'); ?>
<?php include('modal/hib-2nd-vaccine.php'); ?>
<?php include('modal/hib-2nd-edit.php'); ?>
<?php include('modal/hib-3rd-vaccine.php'); ?>
<?php include('modal/hib-3rd-edit.php'); ?>
<?php include('modal/hib-4th-vaccine.php'); ?>
<?php include('modal/hib-4th-edit.php'); ?>
<?php include('modal/delete-hib-1st.php'); ?>
<?php include('modal/delete-hib-2nd.php'); ?>
<?php include('modal/delete-hib-3rd.php'); ?>
<?php include('modal/delete-hib-4th.php'); ?>
<?php include('modal/pcv-1st-vaccine.php'); ?>
<?php include('modal/pcv-1st-edit.php'); ?>
<?php include('modal/pcv-2nd-vaccine.php'); ?>
<?php include('modal/pcv-2nd-edit.php'); ?>
<?php include('modal/pcv-3rd-vaccine.php'); ?>
<?php include('modal/pcv-3rd-edit.php'); ?>
<?php include('modal/pcv-4th-vaccine.php'); ?>
<?php include('modal/pcv-4th-edit.php'); ?>
<?php include('modal/delete-pcv-1st.php'); ?>
<?php include('modal/delete-pcv-2nd.php'); ?>
<?php include('modal/delete-pcv-3rd.php'); ?>
<?php include('modal/delete-pcv-4th.php'); ?>
<?php include('modal/ipv-1st-vaccine.php'); ?>
<?php include('modal/ipv-1st-edit.php'); ?>
<?php include('modal/ipv-2nd-vaccine.php'); ?>
<?php include('modal/ipv-2nd-edit.php'); ?>
<?php include('modal/ipv-3rd-vaccine.php'); ?>
<?php include('modal/ipv-3rd-edit.php'); ?>
<?php include('modal/ipv-4th-vaccine.php'); ?>
<?php include('modal/ipv-4th-edit.php'); ?>
<?php include('modal/delete-ipv-1st.php'); ?>
<?php include('modal/delete-ipv-2nd.php'); ?>
<?php include('modal/delete-ipv-3rd.php'); ?>
<?php include('modal/delete-ipv-4th.php'); ?>
<?php include('modal/mmr-1st-vaccine.php'); ?>
<?php include('modal/mmr-1st-edit.php'); ?>
<?php include('modal/mmr-2nd-vaccine.php'); ?>
<?php include('modal/mmr-2nd-edit.php'); ?>
<?php include('modal/delete-mmr-1st.php'); ?>
<?php include('modal/delete-mmr-2nd.php'); ?>
<?php include('modal/var-1st-vaccine.php'); ?>
<?php include('modal/var-1st-edit.php'); ?>
<?php include('modal/var-2nd-vaccine.php'); ?>
<?php include('modal/var-2nd-edit.php'); ?>
<?php include('modal/delete-var-1st.php'); ?>
<?php include('modal/delete-var-2nd.php'); ?>
<?php include('modal/hepA-1st-vaccine.php'); ?>
<?php include('modal/hepA-1st-edit.php'); ?>
<?php include('modal/hepA-2nd-vaccine.php'); ?>
<?php include('modal/hepA-2nd-edit.php'); ?>
<?php include('modal/delete-hepA-1st.php'); ?>
<?php include('modal/delete-hepA-2nd.php'); ?>
<?php include('modal/tdap-vaccine.php'); ?>
<?php include('modal/tdap-edit.php'); ?>
<?php include('modal/delete-tdap.php'); ?>
<?php include('modal/mcv-1st-vaccine.php'); ?>
<?php include('modal/mcv-1st-edit.php'); ?>
<?php include('modal/mcv-2nd-vaccine.php'); ?>
<?php include('modal/mcv-2nd-edit.php'); ?>
<?php include('modal/delete-mcv-1st.php'); ?>
<?php include('modal/delete-mcv-2nd.php'); ?>
<?php include('modal/hpv-1st-vaccine.php'); ?>
<?php include('modal/hpv-1st-edit.php'); ?>
<?php include('modal/hpv-2nd-vaccine.php'); ?>
<?php include('modal/hpv-2nd-edit.php'); ?>
<?php include('modal/hpv-3rd-vaccine.php'); ?>
<?php include('modal/hpv-3rd-edit.php'); ?>
<?php include('modal/delete-hpv-1st.php'); ?>
<?php include('modal/delete-hpv-2nd.php'); ?>
<?php include('modal/delete-hpv-3rd.php'); ?>
<?php include('modal/covid-vaccine.php'); ?>
<?php include('modal/covid-history.php'); ?>
<?php include('modal/covid-edit.php'); ?>
<?php include('modal/delete-covid.php'); ?>
<?php include('modal/influenza-vaccine.php'); ?>
<?php include('modal/influenza-history.php'); ?>
<?php include('modal/influenza-edit.php'); ?>
<?php include('modal/delete-influenza.php'); ?>
<?php include('modal/send-patient-email.php'); ?>



<!-- auto logout/login session -->
<?php else: ?>
<?php include('../../content/logged_out.php') ?>
<?php endif; ?>

<?php include('../../components/footer.php'); ?>

