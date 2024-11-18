<?php

// Add vaccine
if(isset($_POST['add_inventory'])):{

    // Process add
    include(PRIVATE_MODELS_PATH . '/admin/inventory/addInventoryProcess.php');  
  
    if($stmt = $con->prepare($inventory)){
        $_SESSION['success'] = "Inventory Added Successfully";
        header("Location: /private/view/admin/inventory/");
        exit(0);
    }
    else{
        $_SESSION['warning'] = "Data Not Inserted";
        header("Location: /private/view/admin/inventory/");
        exit(0);
    }

}endif;

// Edit vaccine
if(isset($_POST['update_inventory_btn'])):{

    // Process edit
    include(PRIVATE_MODELS_PATH . '/admin/inventory/editInventoryProcess.php');  

    if($stmt->execute())
    {
      $_SESSION['success'] = "Vaccine Inventory Successfully Updated!";
      header("Location: /private/view/admin/inventory/");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Update Inventory!";
      header("Location: /private/view/admin/inventory/");
      exit(0);
    }
}endif;

// Delete vaccine
if(isset($_POST['inventorydeletebtn'])):{

  // Process delete
  include(PRIVATE_MODELS_PATH . '/admin/inventory/deleteInventoryProcess.php');  

  if($stmt->execute())
  {
    $_SESSION['success'] = "Inventory Successfully Deleted";
    header("Location: /private/view/admin/inventory/");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Delete Inventory";
    header("Location: /private/view/admin/inventory/");
    exit(0);
  }
}endif;

?>