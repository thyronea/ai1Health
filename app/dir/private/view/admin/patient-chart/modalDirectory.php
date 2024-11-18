<div align="center">
<?php
if(isset($_GET['patientID'])){
  // Snapshot
  include('modals/snapshot/send-patient-email.php'); 

  // Demographics
  include('modals/demographics/patient-add-image.php');
  include('modals/demographics/patient-add-diversity.php');
  include('modals/demographics/patient-edit-name.php');
  include('modals/demographics/patient-add-address.php'); 
  include('modals/demographics/patient-edit-address.php'); 
  include('modals/demographics/patient-edit-email.php'); 
  include('modals/demographics/patient-edit-phone.php'); 
  include('modals/demographics/patient-add-emergency.php'); 
  include('modals/demographics/patient-edit-emergency.php'); 
  include('modals/demographics/patient-delete-emergency.php'); 
  include('modals/demographics/patient-add-plan.php'); 
  include('modals/demographics/patient-edit-plan.php');
  include('modals/demographics/patient-remove.php');
  include('modals/demographics/send-emergency-email.php'); 

  // Single Antigen (add/edit/delete modals)
  include('modals/immunization/history/iz-history.php');
  include('modals/immunization/rsv/add-rsv.php');
  include('modals/immunization/rsv/edit-rsv.php');
  include('modals/immunization/rsv/delete-rsv.php');
  include('modals/immunization/hepB/add-hepb.php');
  include('modals/immunization/hepB/edit-hepb.php');
  include('modals/immunization/hepB/delete-hepb.php');
  include('modals/immunization/rota/add-rota.php');
  include('modals/immunization/rota/edit-rota.php');
  include('modals/immunization/rota/delete-rota.php');
  include('modals/immunization/dtap/add-dtap.php');
  include('modals/immunization/dtap/edit-dtap.php');
  include('modals/immunization/dtap/delete-dtap.php');
  include('modals/immunization/hib/add-hib.php');
  include('modals/immunization/hib/edit-hib.php');
  include('modals/immunization/hib/delete-hib.php');
  include('modals/immunization/pcv/add-pcv.php');
  include('modals/immunization/pcv/edit-pcv.php');
  include('modals/immunization/pcv/delete-pcv.php');
  include('modals/immunization/ipv/add-ipv.php');
  include('modals/immunization/ipv/edit-ipv.php');
  include('modals/immunization/ipv/delete-ipv.php');
  include('modals/immunization/mmr/add-mmr.php');
  include('modals/immunization/mmr/edit-mmr.php');
  include('modals/immunization/mmr/delete-mmr.php');
  include('modals/immunization/var/add-var.php');
  include('modals/immunization/var/edit-var.php');
  include('modals/immunization/var/delete-var.php');
  include('modals/immunization/hepA/add-hepa.php');
  include('modals/immunization/hepA/edit-hepa.php');
  include('modals/immunization/hepA/delete-hepa.php');
  include('modals/immunization/tdap/add-tdap.php');
  include('modals/immunization/tdap/edit-tdap.php');
  include('modals/immunization/tdap/delete-tdap.php');
  include('modals/immunization/hpv/add-hpv.php');
  include('modals/immunization/hpv/edit-hpv.php');
  include('modals/immunization/hpv/delete-hpv.php');
  include('modals/immunization/mcv/add-mcv.php');
  include('modals/immunization/mcv/edit-mcv.php');
  include('modals/immunization/mcv/delete-mcv.php');
  include('modals/immunization/menb/add-menb.php');
  include('modals/immunization/menb/edit-menb.php');
  include('modals/immunization/menb/delete-menb.php');
  include('modals/immunization/covid/add-covid.php');
  include('modals/immunization/covid/edit-covid.php');
  include('modals/immunization/covid/delete-covid.php'); 
  include('modals/immunization/flu/add-flu.php');
  include('modals/immunization/flu/edit-flu.php');
  include('modals/immunization/flu/delete-flu.php'); 

  // Combo Vaccines (add/edit/delete modalss)
  include('modals/immunization/combo/add-pediarix.php');
  include('modals/immunization/combo/add-pentacel.php');
  include('modals/immunization/combo/add-vaxelis.php');
  include('modals/immunization/combo/add-quadracel.php');
  include('modals/immunization/combo/add-kinrix.php');
  include('modals/immunization/combo/add-proquad.php');

  // Registry Status
  include('modals/immunization/registry/status.php');
  
}      
else{
  exit(0);
}
?>
</div>