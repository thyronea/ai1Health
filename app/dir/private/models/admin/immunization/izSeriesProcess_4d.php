<?php
if(mysqli_num_rows($verify_completion_run) <= 0){
    $shot = mysqli_real_escape_string($con, "1");
    // INSERT to immunization table 
    include(PRIVATE_MODELS_PATH . '/admin/immunization/izAdministerProcess.php'); 
    // INSERTs to admin_log, patientLog, data_iz
    include(PRIVATE_MODELS_PATH . '/admin/immunization/izLog.php');
}
if(mysqli_num_rows($verify_completion_run) == 1){
    // Verify if using the same brand
    include(PRIVATE_MODELS_PATH . '/admin/immunization/izVerifyBrand.php');
    
    if($vaccine !== $brand){
        $_SESSION['warning'] = "Please only administer the same brand!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
    }
    else{
        $shot = mysqli_real_escape_string($con, "2");
        // INSERT to immunization table 
        include(PRIVATE_MODELS_PATH . '/admin/immunization/izAdministerProcess.php'); 
        // INSERTs to admin_log, patientLog, data_iz
        include(PRIVATE_MODELS_PATH . '/admin/immunization/izLog.php');
    }
}
if(mysqli_num_rows($verify_completion_run) == 2){
    // Verify if using the same brand
    include(PRIVATE_MODELS_PATH . '/admin/immunization/izVerifyBrand.php');
    
    if($vaccine !== $brand){
        $_SESSION['warning'] = "Please only administer the same brand!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
    }
    else{
        $shot = mysqli_real_escape_string($con, "3");
        // INSERT to immunization table 
        include(PRIVATE_MODELS_PATH . '/admin/immunization/izAdministerProcess.php'); 
        // INSERTs to admin_log, patientLog, data_iz
        include(PRIVATE_MODELS_PATH . '/admin/immunization/izLog.php');
    }
}
if(mysqli_num_rows($verify_completion_run) == 3){
    // Verify if using the same brand
    include(PRIVATE_MODELS_PATH . '/admin/immunization/izVerifyBrand.php');
    
    if($vaccine !== $brand){
        $_SESSION['warning'] = "Please only administer the same brand!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
    }
    else{
        $shot = mysqli_real_escape_string($con, "4");
        // INSERT to immunization table 
        include(PRIVATE_MODELS_PATH . '/admin/immunization/izAdministerProcess.php'); 
        // Series complete - INSERTs to admin_log, patientLog, data_iz
        include(PRIVATE_MODELS_PATH . '/admin/immunization/izLogSeriesComplete.php');
    }
}
?>