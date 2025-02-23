<?php

// Administer RSV,  Tdap
if(isset($_POST['administer_1ds'])){ 
    
  // Contains vaccine information
  include(PRIVATE_MODELS_PATH . '/admin/immunization/izCred.php');

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Public" && $eligibility == "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Private" && $eligibility !== "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{
    // Verify iz completion
    include(PRIVATE_MODELS_PATH . '/admin/immunization/izVerifySeries.php');  

    if(mysqli_num_rows($verify_completion_run)  > 0){
      $_SESSION['warning'] = "$type is already complete!";
      header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
      exit(0);
    }
    else{
      
      // INSERT to immunization table 
      include(PRIVATE_MODELS_PATH . '/admin/immunization/izAdministerProcess.php'); 

      // INSERTs to admin_log, patientLog, data_iz
      include(PRIVATE_MODELS_PATH . '/admin/immunization/izLog.php');

      // Deducts inventory and archives if at 0
      include(PRIVATE_MODELS_PATH . '/admin/immunization/izInventoryUpdate.php');
  
      if($stmt = $con->prepare($administer_iz)){
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
      }
      else{
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
      }
    }
  }
}

// Administer Hep B or RV
if(isset($_POST['administer_3ds'])){ 

  // Contains vaccine information
  include(PRIVATE_MODELS_PATH . '/admin/immunization/izCred.php');

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Public" && $eligibility == "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Private" && $eligibility !== "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{

      // Verify iz completion
      include(PRIVATE_MODELS_PATH . '/admin/immunization/izVerifySeries.php');  

      // Error if series is complete
      if(mysqli_num_rows($verify_completion_run)  >= 3){
        $_SESSION['warning'] = "3 Dose Series for $type is already complete!";
          header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
          exit(0);
      }
        
      // 3 dose series process - INSERT to immunization accordingly
      include(PRIVATE_MODELS_PATH . '/admin/immunization/izSeriesProcess_3d.php');

      // Deducts inventory and archives if at 0
      include(PRIVATE_MODELS_PATH . '/admin/immunization/izInventoryUpdate.php');

      if($stmt = $con->prepare($administer_iz)){
          $_SESSION['success'] = "$vaccine Was Successfully Administered!";
          header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
          exit(0);
      }
      else{
          $_SESSION['warning'] = "Unable to Administer $vaccine!";
          header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
          exit(0);
      }
      
    
  } 
}

// Administer DTaP
if(isset($_POST['administer_5ds'])){ 

  include(PRIVATE_MODELS_PATH . '/admin/immunization/izCred.php');

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Public" && $eligibility == "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Private" && $eligibility !== "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{

    // Verify iz completion
    include(PRIVATE_MODELS_PATH . '/admin/immunization/izVerifySeries.php');  
    
    if(mysqli_num_rows($sql_run)  >= 5){
      $_SESSION['warning'] = "5 Dose Series for $type is already complete!";
      header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
    }
    else{

      // Verify iz completion
      include(PRIVATE_MODELS_PATH . '/admin/immunization/izVerifySeries.php');  
      
       // 3 dose series process - INSERT to immunization accordingly
       include(PRIVATE_MODELS_PATH . '/admin/immunization/izSeriesProcess_5d.php');

       // Deducts inventory and archives if at 0
       include(PRIVATE_MODELS_PATH . '/admin/immunization/izInventoryUpdate.php');

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

// Administer Hib, PCV or IPV
if(isset($_POST['administer_4ds'])){ 

  include(PRIVATE_MODELS_PATH . '/admin/immunization/izCred.php');

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Public" && $eligibility == "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Private" && $eligibility !== "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{

    // Verify iz completion
    include(PRIVATE_MODELS_PATH . '/admin/immunization/izVerifySeries.php');  
    
    if(mysqli_num_rows($sql_run)  >= 5){
      $_SESSION['warning'] = "5 Dose Series for $type is already complete!";
      header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
    }
    else{

      // Verify iz completion
      include(PRIVATE_MODELS_PATH . '/admin/immunization/izVerifySeries.php');  
      
       // 3 dose series process - INSERT to immunization accordingly
       include(PRIVATE_MODELS_PATH . '/admin/immunization/izSeriesProcess_4d.php');

       // Deducts inventory and archives if at 0
       include(PRIVATE_MODELS_PATH . '/admin/immunization/izInventoryUpdate.php');

      if($stmt = $con->prepare($administer_iz))
      {
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
      }
      else
      {
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

// Administer MMR, VAR, Hep A, HPV, MCV, or Men B
if(isset($_POST['administer_2ds'])){ 

  include(PRIVATE_MODELS_PATH . '/admin/immunization/izCred.php');

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Public" && $eligibility == "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Private" && $eligibility !== "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{

    // Verify iz completion
    include(PRIVATE_MODELS_PATH . '/admin/immunization/izVerifySeries.php');  
    
    if(mysqli_num_rows($sql_run)  >= 5){
      $_SESSION['warning'] = "5 Dose Series for $type is already complete!";
      header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
    }
    else{

      // Verify iz completion
      include(PRIVATE_MODELS_PATH . '/admin/immunization/izVerifySeries.php');  
      
       // 3 dose series process - INSERT to immunization accordingly
       include(PRIVATE_MODELS_PATH . '/admin/immunization/izSeriesProcess_2d.php');

       // Deducts inventory and archives if at 0
       include(PRIVATE_MODELS_PATH . '/admin/immunization/izInventoryUpdate.php');

      if($stmt = $con->prepare($administer_iz)){
        $_SESSION['success'] = "$vaccine Was Successfully Administered!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
      }
      else{
        $_SESSION['warning'] = "Unable to Administer $vaccine!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
      }
    }
  } 
}

// Administer Flu and Covid
if(isset($_POST['administer_'])){ 
    
  // Contains vaccine information
  include(PRIVATE_MODELS_PATH . '/immunization/patients/izCred.php');

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Public" && $eligibility == "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Private" && $eligibility !== "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{
    // INSERT to immunization table 
    include(PRIVATE_MODELS_PATH . '/admin/immunization/izAdministerProcess.php'); 

    // INSERTs to admin_log, patientLog, data_iz
    include(PRIVATE_MODELS_PATH . '/admin/immunization/izLog.php');

    // Deducts inventory and archives if at 0
    include(PRIVATE_MODELS_PATH . '/admin/immunization/izInventoryUpdate.php');

    if($stmt = $con->prepare($administer_iz)){
      $_SESSION['success'] = "$vaccine Was Successfully Administered!";
      header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
      exit(0);
    }
    else{
      $_SESSION['warning'] = "Unable to Administer $vaccine!";
      header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
      exit(0);
    }
  }
}

// Administer Pediarix
if(isset($_POST['administer_pediarix'])){ 

  include(PRIVATE_MODELS_PATH . '/admin/immunization/pediarixCred.php');
  include(PRIVATE_MODELS_PATH . '/admin/immunization/izCred.php');
  
  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Public" && $eligibility == "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Private" && $eligibility !== "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{

    include(PRIVATE_MODELS_PATH . '/admin/immunization/pediarixVerifyAdminister.php');
    
  }
}

// Administer Pentacel
if(isset($_POST['administer_pentacel'])){ 

  include(PRIVATE_MODELS_PATH . '/admin/immunization/pentacelCred.php');
  include(PRIVATE_MODELS_PATH . '/admin/immunization/izCred.php');

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Public" && $eligibility == "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Private" && $eligibility !== "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{

    include(PRIVATE_MODELS_PATH . '/admin/immunization/pentacelVerifyAdminister.php');
    
  }
}

// Administer Vaxelis
if(isset($_POST['administer_vaxelis'])){ 

  include(PRIVATE_MODELS_PATH . '/admin/immunization/vaxelisCred.php');
  include(PRIVATE_MODELS_PATH . '/admin/immunization/izCred.php');

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Public" && $eligibility == "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Private" && $eligibility !== "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{

    include(PRIVATE_MODELS_PATH . '/admin/immunization/vaxelisVerifyAdminister.php');
    
  }
}

// Administer Quadracel
if(isset($_POST['administer_quadracel'])){ 

  include(PRIVATE_MODELS_PATH . '/admin/immunization/quadracelCred.php');
  include(PRIVATE_MODELS_PATH . '/admin/patients/izCred.php');

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Public" && $eligibility == "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Private" && $eligibility !== "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{

    include(PRIVATE_MODELS_PATH . '/admin/immunization/quadracelVerifyAdminister.php');
    
  }
}

// Administer Kinrix
if(isset($_POST['administer_kinrix'])){
  
  include(PRIVATE_MODELS_PATH . '/admin/immunization/kinrixCred.php');
  include(PRIVATE_MODELS_PATH . '/admin/immunization/izCred.php');

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Public" && $eligibility == "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Private" && $eligibility !== "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{

    include(PRIVATE_MODELS_PATH . '/admin/immunization/kinrixVerifyAdminister.php');
    
  }
}

// Administer Proquad
if(isset($_POST['administer_proquad'])){
  
  include(PRIVATE_MODELS_PATH . '/admin/immunization/proquadCred.php');
  include(PRIVATE_MODELS_PATH . '/admin/immunization/izCred.php');

  if($funding_source && $eligibility == "Public"){
    $_SESSION['warning'] = "Please Choose an Eligibility Type When Public Funding is Selected";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Public" && $eligibility == "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  if($funding_source == "Private" && $eligibility !== "Private"){
    $_SESSION['warning'] = "You selected a $funding_source stock but the patient is $eligibility. Please choose the correct Eligibility Type";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{

    include(PRIVATE_MODELS_PATH . '/admin/immunization/proquadVerifyAdminister.php');
    
  }
}

// Delete administered vaccine
if(isset($_POST['delete_administered_vax'])){

  // Process delete administered vaccine
  include(PRIVATE_MODELS_PATH . '/admin/immunization/izDelete.php');  

  if($stmt = $con->prepare($delete)){
    $_SESSION['success'] = "Administered $vaccine Successfully Deleted!";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
  else{
    $_SESSION['warning'] = "Unable to Delete Administered $vaccine";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
  }
}

?>

