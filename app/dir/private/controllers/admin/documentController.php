<?php
include(PRIVATE_MODELS_PATH . '/admin/sessions.php'); 
include(PRIVATE_VIEW_PATH . '/modals/documentModals.php'); 

// Add document
if(isset($_POST['upload_doc'])){ 
  
    include(PRIVATE_MODELS_PATH . '/admin/documents/uploadDocCred.php');  

    if(($_FILES['docname']['size'] >= $maxsize) || ($_FILES["docname"]["size"] == 0)){

        $_SESSION['warning'] = "Unable to Upload File. File must be less than 2MB";
        header("Location: /private/view/admin/documents/");
        exit(0);

    }
    else {

        include(PRIVATE_MODELS_PATH . '/verification/docVerification.php'); 

        if(mysqli_num_rows($check_file_run) > 0) {

            $_SESSION['warning'] = "Unable to Upload File. File Already Exist!";
            header("Location: /private/view/admin/documents/");
            exit(0);
            
        }
        else{

            include(PRIVATE_MODELS_PATH . '/admin/documents/uploadDocProcess.php');  

            if(move_uploaded_file($tempname, "$folder/$docname")){
                $_SESSION['success'] = "Successfully Uploaded File!";
                header("Location: /private/view/admin/documents/");
            exit(0);
            }
            else{
                $_SESSION['warning'] = "Unable to Upload File!";
                header("Location: /private/view/admin/documents/");
            exit(0);
            }
            
        }
    }
}

// Delete File
if(isset($_POST['filedeletebtn'])){
  
    include(PRIVATE_MODELS_PATH . '/admin/documents/deleteDocCred.php');  
    include(PRIVATE_MODELS_PATH . '/admin/documents/deleteDocProcess.php');  

    if($stmt->execute()){
        $_SESSION['success'] = "File Successfully Deleted!";
        header("Location: /private/view/admin/documents/");
        exit(0);
    }
    else{
        $_SESSION['warning'] = "Unable to Delete File!";
        header("Location: /private/view/admin/documents/");
        exit(0);
    }

}
?>