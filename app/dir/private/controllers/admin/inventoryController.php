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

// Scan inventory
if(isset($_POST['scan_inventory'])){
  $engineID = $_POST['engineID'];
  $storage = $_POST['storage'];
  $manufacturer = $_POST['manufacturer'];
  $name = $_POST['name'];
  $doses = $_POST['doses'];
  $funding = $_POST['funding'];
  
  $str = $_POST['barcode'];
  $len = strlen($str);
  $ndc = substr($str,5,10);
  $position = strpos($str,'17',14) + 2;
  $date = '20' . substr($str,$position,6);
  $exp = substr($date,0,4) . '-' . substr($date,4,2) . '-' . substr($date,6,2);
  $time = strtotime($exp);
  $exp = date('Y-m-d', $time);
  $start = strpos($str,'10',22) + 2;
  $lot = substr($str, $start);

      // Encrypt Activity Data
      $fullname = "$fname $lname";
      $type = htmlspecialchars("Stored");
      $org_message = "$type $name - $lot";
      $encrypt_fullname = encryptthis($fullname, $key);
      $encrypt_org_message = encryptthis($org_message, $key);

      // stores data in activity table
      $fullname = "$fname $lname";
      $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activity);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
      $stmt->execute();

      // stores data in engine table
      $link = htmlspecialchars("pages/immunization/index.php?inventory=$lot");
      $vaccine_engine = "Lot: $lot / Exp: $exp";
      $engine = "INSERT INTO engine (engineID, groupID, keyword1, keyword2, keyword3, link) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($engine);
      $stmt->bind_param("ssssss", $engineID, $groupID, $name, $manufacturer, $vaccine_engine, $link);
      $stmt->execute();

      // Encrypt Vaccine Data
      $encrypt_name = encryptthis($name, $key);
      $encrypt_storage = encryptthis($storage, $key);
      $encrypt_lot = encryptthis($lot, $key);
      $encrypt_manufacturer = encryptthis($manufacturer, $key);
      $encrypt_ndc = encryptthis($ndc, $key);

      // stores data in vaccines table
      $inventory = "INSERT INTO inventory (engineID, groupID, storage, name, doses, lot, exp, manufacturer, ndc, funding_source) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($inventory);
      $stmt->bind_param("ssssssssss", $engineID, $groupID, $encrypt_storage, $name, $doses, $encrypt_lot, $exp, $encrypt_manufacturer, $encrypt_ndc, $funding);
      $stmt->execute();

  if($stmt = $con->prepare($inventory))
  {
      $_SESSION['success'] = "Inventory Scanned Successfully";
      header("Location: /private/view/admin/inventory/");
      exit(0);
  }
  else
  {
      $_SESSION['warning'] = "Data Not Inserted";
      header("Location: /private/view/admin/inventory/");
      exit(0);
  }
}

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