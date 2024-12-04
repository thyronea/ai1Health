<?php

if(isset($_GET['patientID'])){
    
    // Single Antigen (add/edit/delete modals)
    include('modal/immunization/history/iz-history.php');
    include('modal/immunization/rsv/add-rsv.php');
    include('modal/immunization/rsv/edit-rsv.php');
    include('modal/immunization/rsv/delete-rsv.php');
    include('modal/immunization/hepB/add-hepb.php');
    include('modal/immunization/hepB/edit-hepb.php');
    include('modal/immunization/hepB/delete-hepb.php');
    include('modal/immunization/rota/add-rota.php');
    include('modal/immunization/rota/edit-rota.php');
    include('modal/immunization/rota/delete-rota.php');
    include('modal/immunization/dtap/add-dtap.php');
    include('modal/immunization/dtap/edit-dtap.php');
    include('modal/immunization/dtap/delete-dtap.php');
    include('modal/immunization/hib/add-hib.php');
    include('modal/immunization/hib/edit-hib.php');
    include('modal/immunization/hib/delete-hib.php');
    include('modal/immunization/pcv/add-pcv.php');
    include('modal/immunization/pcv/edit-pcv.php');
    include('modal/immunization/pcv/delete-pcv.php');
    include('modal/immunization/ipv/add-ipv.php');
    include('modal/immunization/ipv/edit-ipv.php');
    include('modal/immunization/ipv/delete-ipv.php');
    include('modal/immunization/mmr/add-mmr.php');
    include('modal/immunization/mmr/edit-mmr.php');
    include('modal/immunization/mmr/delete-mmr.php');
    include('modal/immunization/var/add-var.php');
    include('modal/immunization/var/edit-var.php');
    include('modal/immunization/var/delete-var.php');
    include('modal/immunization/hepA/add-hepa.php');
    include('modal/immunization/hepA/edit-hepa.php');
    include('modal/immunization/hepA/delete-hepa.php');
    include('modal/immunization/tdap/add-tdap.php');
    include('modal/immunization/tdap/edit-tdap.php');
    include('modal/immunization/tdap/delete-tdap.php');
    include('modal/immunization/hpv/add-hpv.php');
    include('modal/immunization/hpv/edit-hpv.php');
    include('modal/immunization/hpv/delete-hpv.php');
    include('modal/immunization/mcv/add-mcv.php');
    include('modal/immunization/mcv/edit-mcv.php');
    include('modal/immunization/mcv/delete-mcv.php');
    include('modal/immunization/menb/add-menb.php');
    include('modal/immunization/menb/edit-menb.php');
    include('modal/immunization/menb/delete-menb.php');
    include('modal/immunization/covid/add-covid.php');
    include('modal/immunization/covid/edit-covid.php');
    include('modal/immunization/covid/delete-covid.php'); 

    // Combo Vaccines (add/edit/delete modals)
    include('modal/immunization/combo/add-pediarix.php');
    include('modal/immunization/combo/add-pentacel.php');
    include('modal/immunization/combo/add-vaxelis.php');
    include('modal/immunization/combo/add-quadracel.php');
    include('modal/immunization/combo/add-kinrix.php');
    include('modal/immunization/combo/add-proquad.php');

    // Registry Status
    include('modal/immunization/registry/status.php');
  }      
  else{
    exit(0);
  }                                
?>
