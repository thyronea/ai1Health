<?php
include(PRIVATE_CONFIG_PATH . '/print.php');
include(PRIVATE_MODELS_PATH . '/admin/patients/patientDisplay.php');
include(PRIVATE_MODELS_PATH . '/admin/patients/izRecDate.php');
include(PRIVATE_MODELS_PATH . '/admin/patients/izSchedule.php');
include(PRIVATE_MODELS_PATH . '/admin/patients/izRecord.php');
include(ADMIN_PATIENT_CHART . '/modalDirectory.php'); 
include(PRIVATE_CONTROLLERS_PATH . '/admin/patientChartController.php');
include(PRIVATE_CONTROLLERS_PATH . '/admin/immunizationController.php');
?>


<div class="tab-content">
    <?php 
        include('content/snapshot/index.php');
        include('content/demographics/index.php');
        include('content/immunization/index.php');
    ?>
</div>