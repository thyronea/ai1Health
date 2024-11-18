<?php
// Add Storage Unit
if(isset($_POST['add_unit'])):{

    // Add unit process
    include(PRIVATE_MODELS_PATH . '/admin/temperature/addUnitProcess.php');  
    
    //  Successfully processed
    if($stmt->execute()){
      $_SESSION['success'] = "Storage Unit Successfully Added!";
      header("Location: /private/view/admin/temperature/");
      exit(0);
    }
    // Error
    else{
      $_SESSION['warning'] = "Unable to Add Unit!";
      header("Location: /private/view/admin/temperature/");
      exit(0);
    }
}endif;

// Edit Storage Unit
if(isset($_POST['updatestorage_btn'])):{
    
    // Edit unit process
    include(PRIVATE_MODELS_PATH . '/admin/temperature/editUnitProcess.php');  

    if($stmt->execute())
    {
      $_SESSION['success'] = "$unit_name Successfully Updated!";
      header("Location: /private/view/admin/temperature/");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Update $unit_name!";
      header("Location: /private/view/admin/temperature/");
      exit(0);
    }
}endif;

// Delete Storage Unit
if(isset($_POST['storagedeletebtn'])):{
    
    // Delete thermometer process
    include(PRIVATE_MODELS_PATH . '/admin/temperature/deleteUnitProcess.php');  

    if($stmt->execute())
    {
      $_SESSION['success'] = "$storage_name Successfully Updated!";
      header("Location: /private/view/admin/temperature/");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Update $storage_name!";
      header("Location: /private/view/admin/temperature/");
      exit(0);
    }
}endif;

// Add Thermometer
if(isset($_POST['add_thermometer'])):{
  
  // Add thermometer process
  include(PRIVATE_MODELS_PATH . '/admin/temperature/addThermometerProcess.php');  

  if($stmt->execute())
  {
    $_SESSION['success'] = "Storage Unit Successfully Added!";
    header("Location: /private/view/admin/temperature/");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Add Unit!";
    header("Location: /private/view/admin/temperature/");
    exit(0);
  }
}endif;

// Edit Thermometer
if(isset($_POST['updatethermometer_btn'])):{
  
  // Edit thermometer process
  include(PRIVATE_MODELS_PATH . '/admin/temperature/editThermometerProcess.php');  

  if($stmt->execute())
  {
    $_SESSION['success'] = "$therm_name Successfully Updated!";
    header("Location: /private/view/admin/temperature/");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update $therm_name!";
    header("Location: /private/view/admin/temperature/");
    exit(0);
  }
}endif;

// Delete Thermometer
if(isset($_POST['thermometerdeletebtn'])):{
  
  // Delete thermometer process
  include(PRIVATE_MODELS_PATH . '/admin/temperature/deleteThermometerProcess.php');  

  if($stmt->execute())
  {
    $_SESSION['success'] = "$thermometer_name Successfully Updated!";
    header("Location: /private/view/admin/temperature/");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update $thermometer_name!";
    header("Location: /private/view/admin/temperature/");
    exit(0);
  }
}endif;

// Add Temperature
if(isset($_POST['save_temp_btn'])):{

  // Add current, min and max temperature
  include(PRIVATE_MODELS_PATH . '/admin/temperature/addTemperatureProcess.php'); 

  if($stmt = $con->prepare($activity))
  {
    $_SESSION['success'] = "Temperature Logged Successfully";
    header("Location: /private/view/admin/temperature/");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Data Error! Unable to ";
    header("Location: /private/view/admin/temperature/");
    exit(0);
  }
}endif;

?>