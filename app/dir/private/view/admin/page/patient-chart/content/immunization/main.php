<div class="tab-pane fade" id="immunization-tab-pane" role="tabpanel" aria-labelledby="immunization-tab" tabindex="0">
  <div class="container user-select-none" align="center">

    <div class="row flex-nowrap">
      <div class="col-md-12 mt-3">
        <div class="card shadow">
          <div class="card-body table-responsive">

            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-history" type="button" role="tab" aria-controls="nav-home" aria-selected="true" style="color: black;"><small>Overview</small></button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-peds" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" style="color: black;"><small>Pediatric</small></button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-adol" type="button" role="tab" aria-controls="nav-contact" aria-selected="false" style="color: black;"><small>Adolescent</small></button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-adult" type="button" role="tab" aria-controls="nav-contact" aria-selected="false" style="color: black;"><small>Adult</small></button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <?php include('immunization-overview.php');?>
              <div class="tab-pane fade" id="nav-peds" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">...</div>
              <div class="tab-pane fade" id="nav-adol" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">...</div>
              <div class="tab-pane fade" id="nav-adult" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">...</div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php include('process/scripts.php'); ?>
<!-- Modal -->
<?php include('modal/immunization/administer-vaccine.php'); ?>
<?php include('modal/immunization/administer-hepB-1st.php'); ?>
<?php include('modal/immunization/administer-hepB-2nd.php'); ?>
<?php include('modal/immunization/administer-hepB-3rd.php'); ?>
<?php include('modal/immunization/administer-rv-1st.php'); ?>
<?php include('modal/immunization/administer-rv-2nd.php'); ?>
<?php include('modal/immunization/administer-rv-3rd.php'); ?>
<?php include('modal/immunization/administer-DTaP-1st.php'); ?>
<?php include('modal/immunization/administer-DTaP-2nd.php'); ?>
<?php include('modal/immunization/administer-DTaP-3rd.php'); ?>
<?php include('modal/immunization/administer-DTaP-4th.php'); ?>
<?php include('modal/immunization/administer-DTaP-5th.php'); ?>
<?php include('modal/immunization/administer-Hib-1st.php'); ?>
<?php include('modal/immunization/administer-Hib-2nd.php'); ?>
<?php include('modal/immunization/administer-Hib-3rd.php'); ?>
<?php include('modal/immunization/administer-Hib-4th.php'); ?>
<?php include('modal/immunization/administer-PCV-1st.php'); ?>
<?php include('modal/immunization/administer-PCV-2nd.php'); ?>
<?php include('modal/immunization/administer-PCV-3rd.php'); ?>
<?php include('modal/immunization/administer-PCV-4th.php'); ?>
<?php include('modal/immunization/administer-IPV-1st.php'); ?>
<?php include('modal/immunization/administer-IPV-2nd.php'); ?>
<?php include('modal/immunization/administer-IPV-3rd.php'); ?>
<?php include('modal/immunization/administer-IPV-4th.php'); ?>
<?php include('modal/immunization/administer-covid.php'); ?>
<?php include('modal/immunization/administer-flu.php'); ?>
<?php include('modal/immunization/administer-mmr-1st.php'); ?>
<?php include('modal/immunization/administer-mmr-2nd.php'); ?>
<?php include('modal/immunization/administer-varicella-1st.php'); ?>
<?php include('modal/immunization/administer-varicella-2nd.php'); ?>
<?php include('modal/immunization/administer-hepA-1st.php'); ?>
<?php include('modal/immunization/administer-hepA-2nd.php'); ?>
<?php include('modal/immunization/hepB-1st-vaccine.php'); ?>
<?php include('modal/immunization/hepB-1st-edit.php'); ?>
<?php include('modal/immunization/hepB-2nd-vaccine.php'); ?>
<?php include('modal/immunization/hepB-2nd-edit.php'); ?>
<?php include('modal/immunization/hepB-3rd-vaccine.php'); ?>
<?php include('modal/immunization/hepB-3rd-edit.php'); ?>
<?php include('modal/immunization/delete-hepB-1st.php'); ?>
<?php include('modal/immunization/delete-hepB-2nd.php'); ?>
<?php include('modal/immunization/delete-hepB-3rd.php'); ?>
<?php include('modal/immunization/rv-1st-vaccine.php'); ?>
<?php include('modal/immunization/rv-1st-edit.php'); ?>
<?php include('modal/immunization/rv-2nd-vaccine.php'); ?>
<?php include('modal/immunization/rv-2nd-edit.php'); ?>
<?php include('modal/immunization/rv-3rd-vaccine.php'); ?>
<?php include('modal/immunization/rv-3rd-edit.php'); ?>
<?php include('modal/immunization/delete-rv-1st.php'); ?>
<?php include('modal/immunization/delete-rv-2nd.php'); ?>
<?php include('modal/immunization/delete-rv-3rd.php'); ?>
<?php include('modal/immunization/dtap-1st-vaccine.php'); ?>
<?php include('modal/immunization/dtap-1st-edit.php'); ?>
<?php include('modal/immunization/dtap-2nd-vaccine.php'); ?>
<?php include('modal/immunization/dtap-2nd-edit.php'); ?>
<?php include('modal/immunization/dtap-3rd-vaccine.php'); ?>
<?php include('modal/immunization/dtap-3rd-edit.php'); ?>
<?php include('modal/immunization/dtap-4th-vaccine.php'); ?>
<?php include('modal/immunization/dtap-4th-edit.php'); ?>
<?php include('modal/immunization/dtap-5th-vaccine.php'); ?>
<?php include('modal/immunization/dtap-5th-edit.php'); ?>
<?php include('modal/immunization/delete-dtap-1st.php'); ?>
<?php include('modal/immunization/delete-dtap-2nd.php'); ?>
<?php include('modal/immunization/delete-dtap-3rd.php'); ?>
<?php include('modal/immunization/delete-dtap-4th.php'); ?>
<?php include('modal/immunization/delete-dtap-5th.php'); ?>
<?php include('modal/immunization/hib-1st-vaccine.php'); ?>
<?php include('modal/immunization/hib-1st-edit.php'); ?>
<?php include('modal/immunization/hib-2nd-vaccine.php'); ?>
<?php include('modal/immunization/hib-2nd-edit.php'); ?>
<?php include('modal/immunization/hib-3rd-vaccine.php'); ?>
<?php include('modal/immunization/hib-3rd-edit.php'); ?>
<?php include('modal/immunization/hib-4th-vaccine.php'); ?>
<?php include('modal/immunization/hib-4th-edit.php'); ?>
<?php include('modal/immunization/delete-hib-1st.php'); ?>
<?php include('modal/immunization/delete-hib-2nd.php'); ?>
<?php include('modal/immunization/delete-hib-3rd.php'); ?>
<?php include('modal/immunization/delete-hib-4th.php'); ?>
<?php include('modal/immunization/pcv-1st-vaccine.php'); ?>
<?php include('modal/immunization/pcv-1st-edit.php'); ?>
<?php include('modal/immunization/pcv-2nd-vaccine.php'); ?>
<?php include('modal/immunization/pcv-2nd-edit.php'); ?>
<?php include('modal/immunization/pcv-3rd-vaccine.php'); ?>
<?php include('modal/immunization/pcv-3rd-edit.php'); ?>
<?php include('modal/immunization/pcv-4th-vaccine.php'); ?>
<?php include('modal/immunization/pcv-4th-edit.php'); ?>
<?php include('modal/immunization/delete-pcv-1st.php'); ?>
<?php include('modal/immunization/delete-pcv-2nd.php'); ?>
<?php include('modal/immunization/delete-pcv-3rd.php'); ?>
<?php include('modal/immunization/delete-pcv-4th.php'); ?>
<?php include('modal/immunization/ipv-1st-vaccine.php'); ?>
<?php include('modal/immunization/ipv-1st-edit.php'); ?>
<?php include('modal/immunization/ipv-2nd-vaccine.php'); ?>
<?php include('modal/immunization/ipv-2nd-edit.php'); ?>
<?php include('modal/immunization/ipv-3rd-vaccine.php'); ?>
<?php include('modal/immunization/ipv-3rd-edit.php'); ?>
<?php include('modal/immunization/ipv-4th-vaccine.php'); ?>
<?php include('modal/immunization/ipv-4th-edit.php'); ?>
<?php include('modal/immunization/delete-ipv-1st.php'); ?>
<?php include('modal/immunization/delete-ipv-2nd.php'); ?>
<?php include('modal/immunization/delete-ipv-3rd.php'); ?>
<?php include('modal/immunization/delete-ipv-4th.php'); ?>
<?php include('modal/immunization/mmr-1st-vaccine.php'); ?>
<?php include('modal/immunization/mmr-1st-edit.php'); ?>
<?php include('modal/immunization/mmr-2nd-vaccine.php'); ?>
<?php include('modal/immunization/mmr-2nd-edit.php'); ?>
<?php include('modal/immunization/delete-mmr-1st.php'); ?>
<?php include('modal/immunization/delete-mmr-2nd.php'); ?>
<?php include('modal/immunization/var-1st-vaccine.php'); ?>
<?php include('modal/immunization/var-1st-edit.php'); ?>
<?php include('modal/immunization/var-2nd-vaccine.php'); ?>
<?php include('modal/immunization/var-2nd-edit.php'); ?>
<?php include('modal/immunization/delete-var-1st.php'); ?>
<?php include('modal/immunization/delete-var-2nd.php'); ?>
<?php include('modal/immunization/hepA-1st-vaccine.php'); ?>
<?php include('modal/immunization/hepA-1st-edit.php'); ?>
<?php include('modal/immunization/hepA-2nd-vaccine.php'); ?>
<?php include('modal/immunization/hepA-2nd-edit.php'); ?>
<?php include('modal/immunization/delete-hepA-1st.php'); ?>
<?php include('modal/immunization/delete-hepA-2nd.php'); ?>
<?php include('modal/immunization/tdap-vaccine.php'); ?>
<?php include('modal/immunization/tdap-edit.php'); ?>
<?php include('modal/immunization/delete-tdap.php'); ?>
<?php include('modal/immunization/mcv-1st-vaccine.php'); ?>
<?php include('modal/immunization/mcv-1st-edit.php'); ?>
<?php include('modal/immunization/mcv-2nd-vaccine.php'); ?>
<?php include('modal/immunization/mcv-2nd-edit.php'); ?>
<?php include('modal/immunization/delete-mcv-1st.php'); ?>
<?php include('modal/immunization/delete-mcv-2nd.php'); ?>
<?php include('modal/immunization/hpv-1st-vaccine.php'); ?>
<?php include('modal/immunization/hpv-1st-edit.php'); ?>
<?php include('modal/immunization/hpv-2nd-vaccine.php'); ?>
<?php include('modal/immunization/hpv-2nd-edit.php'); ?>
<?php include('modal/immunization/hpv-3rd-vaccine.php'); ?>
<?php include('modal/immunization/hpv-3rd-edit.php'); ?>
<?php include('modal/immunization/delete-hpv-1st.php'); ?>
<?php include('modal/immunization/delete-hpv-2nd.php'); ?>
<?php include('modal/immunization/delete-hpv-3rd.php'); ?>
<?php include('modal/immunization/covid-vaccine.php'); ?>
<?php include('modal/immunization/covid-history.php'); ?>
<?php include('modal/immunization/covid-edit.php'); ?>
<?php include('modal/immunization/delete-covid.php'); ?>
<?php include('modal/immunization/influenza-vaccine.php'); ?>
<?php include('modal/immunization/influenza-history.php'); ?>
<?php include('modal/immunization/influenza-edit.php'); ?>
<?php include('modal/immunization/delete-influenza.php'); ?>
