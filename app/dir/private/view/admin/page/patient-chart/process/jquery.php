<script>
  // Edit Administered RSV
  $(document).ready(function () {
    $('.edit_rsv_btn').on('click', function() {
      $('#edit_administered_rsv').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#rsv_edit_ID').val(data[0]);
      $('#rsv_edit_uniqueID').val(data[1]);
      $('#delete_rsv_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_rsv_name').val(data[4]);
      $('#delete_rsv_name').val(data[4]);
      $('#edit_rsv_lot').val(data[5]);
      $('#edit_rsv_ndc').val(data[6]);
      $('#edit_rsv_exp').val(data[7]);
      $('#rsv_edit_site').val(data[8]);
      $('#rsv_edit_route').val(data[9]);
      $('#rsv_edit_vis_given').val(data[10]);
      $('#rsv_edit_vis').val(data[11]);
      $('#edit_rsv_funding').val(data[12]);
      $('#edit_rsv_eligibility').val(data[12]);
      $('#rsvadministered_by').val(data[13]);
      $('#rsv_edit_comment').val(data[14]);
    });
  });

  // Edit Administered Hep B
  $(document).ready(function () {
    $('.edit_hepB_btn').on('click', function() {
      $('#edit_administered_hepb').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#hepB_edit_ID').val(data[0]);
      $('#hepB_edit_uniqueID').val(data[1]);
      $('#delete_hepB_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_hepB_name').val(data[4]);
      $('#delete_hepB_name').val(data[4]);
      $('#edit_hepB_lot').val(data[5]);
      $('#edit_hepB_ndc').val(data[6]);
      $('#edit_hepB_exp').val(data[7]);
      $('#hepB_edit_site').val(data[8]);
      $('#hepB_edit_route').val(data[9]);
      $('#hepB_edit_vis_given').val(data[10]);
      $('#hepB_edit_vis').val(data[11]);
      $('#edit_hepB_funding').val(data[12]);
      $('#edit_hepB_eligibility').val(data[12]);
      $('#hepBadministered_by').val(data[13]);
      $('#hepB_edit_comment').val(data[14]);
    });
  });

  // Edit Administered Rotavirus
  $(document).ready(function () {
    $('.edit_rota_btn').on('click', function() {
      $('#edit_administered_rota').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#rota_edit_ID').val(data[0]);
      $('#rota_edit_uniqueID').val(data[1]);
      $('#delete_rota_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_rota_name').val(data[4]);
      $('#delete_rota_name').val(data[4]);
      $('#edit_rota_lot').val(data[5]);
      $('#edit_rota_ndc').val(data[6]);
      $('#edit_rota_exp').val(data[7]);
      $('#rota_edit_site').val(data[8]);
      $('#rota_edit_route').val(data[9]);
      $('#rota_edit_vis_given').val(data[10]);
      $('#rota_edit_vis').val(data[11]);
      $('#edit_rota_funding').val(data[12]);
      $('#edit_rota_eligibility').val(data[12]);
      $('#rotaadministered_by').val(data[13]);
      $('#rota_edit_comment').val(data[14]);
    });
  });

  // Edit Administered DTaP
  $(document).ready(function () {
    $('.edit_dtap_btn').on('click', function() {
      $('#edit_administered_dtap').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#dtap_edit_ID').val(data[0]);
      $('#dtap_edit_uniqueID').val(data[1]);
      $('#delete_dtap_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_dtap_name').val(data[4]);
      $('#delete_dtap_name').val(data[4]);
      $('#edit_dtap_lot').val(data[5]);
      $('#edit_dtap_ndc').val(data[6]);
      $('#edit_dtap_exp').val(data[7]);
      $('#dtap_edit_site').val(data[8]);
      $('#dtap_edit_route').val(data[9]);
      $('#dtap_edit_vis_given').val(data[10]);
      $('#dtap_edit_vis').val(data[11]);
      $('#edit_dtap_funding').val(data[12]);
      $('#edit_dtap_eligibility').val(data[12]);
      $('#dtapadministered_by').val(data[13]);
      $('#dtap_edit_comment').val(data[14]);
    });
  });

  // Edit Administered Hib
  $(document).ready(function () {
    $('.edit_hib_btn').on('click', function() {
      $('#edit_administered_hib').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#hib_edit_ID').val(data[0]);
      $('#hib_edit_uniqueID').val(data[1]);
      $('#delete_hib_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_hib_name').val(data[4]);
      $('#delete_hib_name').val(data[4]);
      $('#edit_hib_lot').val(data[5]);
      $('#edit_hib_ndc').val(data[6]);
      $('#edit_hib_exp').val(data[7]);
      $('#hib_edit_site').val(data[8]);
      $('#hib_edit_route').val(data[9]);
      $('#hib_edit_vis_given').val(data[10]);
      $('#hib_edit_vis').val(data[11]);
      $('#edit_hib_funding').val(data[12]);
      $('#edit_hib_eligibility').val(data[12]);
      $('#hibadministered_by').val(data[13]);
      $('#hib_edit_comment').val(data[14]);
    });
  });
  
  // Edit Administered PCV
  $(document).ready(function () {
    $('.edit_pcv_btn').on('click', function() {
      $('#edit_administered_pcv').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#pcv_edit_ID').val(data[0]);
      $('#pcv_edit_uniqueID').val(data[1]);
      $('#delete_pcv_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_pcv_name').val(data[4]);
      $('#delete_pcv_name').val(data[4]);
      $('#edit_pcv_lot').val(data[5]);
      $('#edit_pcv_ndc').val(data[6]);
      $('#edit_pcv_exp').val(data[7]);
      $('#pcv_edit_site').val(data[8]);
      $('#pcv_edit_route').val(data[9]);
      $('#pcv_edit_vis_given').val(data[10]);
      $('#pcv_edit_vis').val(data[11]);
      $('#edit_pcv_funding').val(data[12]);
      $('#edit_pcv_eligibility').val(data[12]);
      $('#pcvadministered_by').val(data[13]);
      $('#pcv_edit_comment').val(data[14]);
    });
  });
  
  // Edit Administered IPV
  $(document).ready(function () {
    $('.edit_ipv_btn').on('click', function() {
      $('#edit_administered_ipv').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#ipv_edit_ID').val(data[0]);
      $('#ipv_edit_uniqueID').val(data[1]);
      $('#delete_ipv_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_ipv_name').val(data[4]);
      $('#delete_ipv_name').val(data[4]);
      $('#edit_ipv_lot').val(data[5]);
      $('#edit_ipv_ndc').val(data[6]);
      $('#edit_ipv_exp').val(data[7]);
      $('#ipv_edit_site').val(data[8]);
      $('#ipv_edit_route').val(data[9]);
      $('#ipv_edit_vis_given').val(data[10]);
      $('#ipv_edit_vis').val(data[11]);
      $('#edit_ipv_funding').val(data[12]);
      $('#edit_ipv_eligibility').val(data[12]);
      $('#ipvadministered_by').val(data[13]);
      $('#ipv_edit_comment').val(data[14]);
    });
  });
  
  // Edit Administered MMR
  $(document).ready(function () {
    $('.edit_mmr_btn').on('click', function() {
      $('#edit_administered_mmr').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#mmr_edit_ID').val(data[0]);
      $('#mmr_edit_uniqueID').val(data[1]);
      $('#delete_mmr_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_mmr_name').val(data[4]);
      $('#delete_mmr_name').val(data[4]);
      $('#edit_mmr_lot').val(data[5]);
      $('#edit_mmr_ndc').val(data[6]);
      $('#edit_mmr_exp').val(data[7]);
      $('#mmr_edit_site').val(data[8]);
      $('#mmr_edit_route').val(data[9]);
      $('#mmr_edit_vis_given').val(data[10]);
      $('#mmr_edit_vis').val(data[11]);
      $('#edit_mmr_funding').val(data[12]);
      $('#edit_mmr_eligibility').val(data[12]);
      $('#mmradministered_by').val(data[13]);
      $('#mmr_edit_comment').val(data[14]);
    });
  });
  
  // Edit Administered Varicella
  $(document).ready(function () {
    $('.edit_var_btn').on('click', function() {
      $('#edit_administered_var').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#var_edit_ID').val(data[0]);
      $('#var_edit_uniqueID').val(data[1]);
      $('#delete_var_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_var_name').val(data[4]);
      $('#delete_var_name').val(data[4]);
      $('#edit_var_lot').val(data[5]);
      $('#edit_var_ndc').val(data[6]);
      $('#edit_var_exp').val(data[7]);
      $('#var_edit_site').val(data[8]);
      $('#var_edit_route').val(data[9]);
      $('#var_edit_vis_given').val(data[10]);
      $('#var_edit_vis').val(data[11]);
      $('#edit_var_funding').val(data[12]);
      $('#edit_var_eligibility').val(data[12]);
      $('#varadministered_by').val(data[13]);
      $('#var_edit_comment').val(data[14]);
    });
  });
  
  // Edit Administered Hep A
  $(document).ready(function () {
    $('.edit_hepa_btn').on('click', function() {
      $('#edit_administered_hepa').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#hepa_edit_ID').val(data[0]);
      $('#hepa_edit_uniqueID').val(data[1]);
      $('#delete_hepa_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_hepa_name').val(data[4]);
      $('#delete_hepa_name').val(data[4]);
      $('#edit_hepa_lot').val(data[5]);
      $('#edit_hepa_ndc').val(data[6]);
      $('#edit_hepa_exp').val(data[7]);
      $('#hepa_edit_site').val(data[8]);
      $('#hepa_edit_route').val(data[9]);
      $('#hepa_edit_vis_given').val(data[10]);
      $('#hepa_edit_vis').val(data[11]);
      $('#edit_hepa_funding').val(data[12]);
      $('#edit_hepa_eligibility').val(data[12]);
      $('#hepaadministered_by').val(data[13]);
      $('#hepa_edit_comment').val(data[14]);
    });
  });
  
  // Edit Administered Tdap
  $(document).ready(function () {
    $('.edit_tdap_btn').on('click', function() {
      $('#edit_administered_tdap').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#tdap_edit_ID').val(data[0]);
      $('#tdap_edit_uniqueID').val(data[1]);
      $('#delete_tdap_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_tdap_name').val(data[4]);
      $('#delete_tdap_name').val(data[4]);
      $('#edit_tdap_lot').val(data[5]);
      $('#edit_tdap_ndc').val(data[6]);
      $('#edit_tdap_exp').val(data[7]);
      $('#tdap_edit_site').val(data[8]);
      $('#tdap_edit_route').val(data[9]);
      $('#tdap_edit_vis_given').val(data[10]);
      $('#tdap_edit_vis').val(data[11]);
      $('#edit_tdap_funding').val(data[12]);
      $('#edit_tdap_eligibility').val(data[12]);
      $('#tdapadministered_by').val(data[13]);
      $('#tdap_edit_comment').val(data[14]);
    });
  });
  
  // Edit Administered HPV
  $(document).ready(function () {
    $('.edit_hpv_btn').on('click', function() {
      $('#edit_administered_hpv').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#hpv_edit_ID').val(data[0]);
      $('#hpv_edit_uniqueID').val(data[1]);
      $('#delete_hpv_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_hpv_name').val(data[4]);
      $('#delete_hpv_name').val(data[4]);
      $('#edit_hpv_lot').val(data[5]);
      $('#edit_hpv_ndc').val(data[6]);
      $('#edit_hpv_exp').val(data[7]);
      $('#hpv_edit_site').val(data[8]);
      $('#hpv_edit_route').val(data[9]);
      $('#hpv_edit_vis_given').val(data[10]);
      $('#hpv_edit_vis').val(data[11]);
      $('#edit_hpv_funding').val(data[12]);
      $('#edit_hpv_eligibility').val(data[12]);
      $('#hpvadministered_by').val(data[13]);
      $('#hpv_edit_comment').val(data[14]);
    });
  });
  
  // Edit Administered MCV
  $(document).ready(function () {
    $('.edit_mcv_btn').on('click', function() {
      $('#edit_administered_mcv').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#mcv_edit_ID').val(data[0]);
      $('#mcv_edit_uniqueID').val(data[1]);
      $('#delete_mcv_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_mcv_name').val(data[4]);
      $('#delete_mcv_name').val(data[4]);
      $('#edit_mcv_lot').val(data[5]);
      $('#edit_mcv_ndc').val(data[6]);
      $('#edit_mcv_exp').val(data[7]);
      $('#mcv_edit_site').val(data[8]);
      $('#mcv_edit_route').val(data[9]);
      $('#mcv_edit_vis_given').val(data[10]);
      $('#mcv_edit_vis').val(data[11]);
      $('#edit_mcv_funding').val(data[12]);
      $('#edit_mcv_eligibility').val(data[12]);
      $('#mcvadministered_by').val(data[13]);
      $('#mcv_edit_comment').val(data[14]);
    });
  });
  
  // Edit Administered Men B
  $(document).ready(function () {
    $('.edit_menb_btn').on('click', function() {
      $('#edit_administered_menb').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#menb_edit_ID').val(data[0]);
      $('#menb_edit_uniqueID').val(data[1]);
      $('#delete_menb_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_menb_name').val(data[4]);
      $('#delete_menb_name').val(data[4]);
      $('#edit_menb_lot').val(data[5]);
      $('#edit_menb_ndc').val(data[6]);
      $('#edit_menb_exp').val(data[7]);
      $('#menb_edit_site').val(data[8]);
      $('#menb_edit_route').val(data[9]);
      $('#menb_edit_vis_given').val(data[10]);
      $('#menb_edit_vis').val(data[11]);
      $('#edit_menb_funding').val(data[12]);
      $('#edit_menb_eligibility').val(data[12]);
      $('#menbadministered_by').val(data[13]);
      $('#menb_edit_comment').val(data[14]);
    });
  });
  
  // Edit Administered COVID-19
  $(document).ready(function () {
    $('.edit_covid_btn').on('click', function() {
      $('#edit_administered_covid').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#covid_edit_ID').val(data[0]);
      $('#covid_edit_uniqueID').val(data[1]);
      $('#delete_covid_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_covid_name').val(data[4]);
      $('#delete_covid_name').val(data[4]);
      $('#edit_covid_lot').val(data[5]);
      $('#edit_covid_ndc').val(data[6]);
      $('#edit_covid_exp').val(data[7]);
      $('#covid_edit_site').val(data[8]);
      $('#covid_edit_route').val(data[9]);
      $('#covid_edit_vis_given').val(data[10]);
      $('#covid_edit_vis').val(data[11]);
      $('#edit_covid_funding').val(data[12]);
      $('#edit_covid_eligibility').val(data[12]);
      $('#covidadministered_by').val(data[13]);
      $('#covid_edit_comment').val(data[14]);
    });
  });
  
  // Edit Administered Influenza
  $(document).ready(function () {
    $('.edit_flu_btn').on('click', function() {
      $('#edit_administered_flu').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#flu_edit_ID').val(data[0]);
      $('#flu_edit_uniqueID').val(data[1]);
      $('#delete_flu_uniqueID').val(data[1]);
      $('#patient_ID').val(data[2]);
      $('#group_ID').val(data[3]);
      $('#edit_flu_name').val(data[4]);
      $('#delete_flu_name').val(data[4]);
      $('#edit_flu_lot').val(data[5]);
      $('#edit_flu_ndc').val(data[6]);
      $('#edit_flu_exp').val(data[7]);
      $('#flu_edit_site').val(data[8]);
      $('#flu_edit_route').val(data[9]);
      $('#flu_edit_vis_given').val(data[10]);
      $('#flu_edit_vis').val(data[11]);
      $('#edit_flu_funding').val(data[12]);
      $('#edit_flu_eligibility').val(data[12]);
      $('#fluadministered_by').val(data[13]);
      $('#flu_edit_comment').val(data[14]);
    });
  });
</script>