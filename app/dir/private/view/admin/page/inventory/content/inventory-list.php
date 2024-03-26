<!-- Private Inventory List -->
<div class="col mb-3">

  <!-- Nav Tabs -->
  <div class="card shadow" style="height:33rem; overflow: auto">
   <div class="card-body">

     <ul class="nav nav-tabs" id="myTab" role="tablist">
       <li class="nav-item" role="presentation">
         <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="all-tab-pane" aria-selected="true" style="color:black;">
           <small>All</small>
         </button>
       </li>
       <li class="nav-item" role="presentation">
         <button class="nav-link" id="private-tab" data-bs-toggle="tab" data-bs-target="#private-tab-pane" type="button" role="tab" aria-controls="private-tab-pane" aria-selected="false" style="color:black;">
           <small>Private</small>
         </button>
       </li>
       <li class="nav-item" role="presentation">
         <button class="nav-link" id="public-tab" data-bs-toggle="tab" data-bs-target="#public-tab-pane" type="button" role="tab" aria-controls="public-tab-pane" aria-selected="false" style="color:black;">
           <small>Public</small>
         </button>
       </li>
     </ul>

     <!-- Nav Tab Content -->
     <div class="tab-content mt-3" id="myTabContent">

       <!-- All Inventory -->
       <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab" tabindex="0">
         <table class="table table-sm table-hover table-borderless text-nowrap">
           <thead>
             <th><small>Name</small></th>
             <th><small>Funding Source</small></th>
           </thead>
           <tbody>

             <?php
               if(isset($_GET['inventory']))
               {
                 $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                 $filtervalues = htmlspecialchars($_GET['inventory']);
                 $query = "SELECT * FROM inventory WHERE groupID='$groupID' ";
                 $query_run = mysqli_query($con, $query);
                 $searchnum = mysqli_num_rows($query_run);
                 if($searchnum > 0)
                 {
                   foreach ($query_run as $vaccine)
                   {
                     ?>
                     <tr>
                       <td hidden><a type="hidden" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['engineID']);?></small></a></td>
                       <td hidden><a type="hidden" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['groupID']);?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><b><?=htmlspecialchars($vaccine['doses']);?></b></a></td>
                       <td ><a type="button" class="text-decoration-none vaccine-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['name']);?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars(decryptthis($vaccine['manufacturer'], $key));?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars(decryptthis($vaccine['ndc'], $key));?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars(decryptthis($vaccine['lot'], $key));?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['exp']);?></small></a></td>
                       <td ><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['funding_source']);?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars(decryptthis($vaccine['storage'], $key));?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['timestamp']);?></small></a></td>
                       <td><a type="button" class="focus-ring text-decoration-none inventorydeletebtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventorydeletemodal"><i class="bi bi-trash"></i></a></td>
                     </tr>
                     <?php
                   }
                 }
               }
               else
               {
                 ?>
                   <tr>
                     <td colspan="5" align="center"><small>No Data Found</small></td>
                   </tr>
                 <?php
               }
             ?>

           </tbody>
         </table>
       </div>
       <!-- Private Inventory -->
       <div class="tab-pane fade" id="private-tab-pane" role="tabpanel" aria-labelledby="private-tab" tabindex="0">
         <table class="table table-sm table-hover table-borderless text-nowrap">
           <thead>
             <th><small>Doses</small></th>
             <th><small>Name</small></th>
             <th><small>Lot</small></th>
             <th><small>Exp</small></th>
           </thead>
           <tbody>

             <?php
               if(isset($_GET['inventory']))
               {
                 $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                 $filtervalues = htmlspecialchars($_GET['inventory']);
                 $query = "SELECT * FROM inventory WHERE groupID='$groupID' AND funding_source='Private' ";
                 $query_run = mysqli_query($con, $query);
                 $searchnum = mysqli_num_rows($query_run);
                 if($searchnum > 0)
                 {
                   foreach ($query_run as $vaccine)
                   {
                     ?>
                     <tr>
                       <td hidden><a type="hidden" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['engineID']);?></small></a></td>
                       <td hidden><a type="hidden" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['groupID']);?></small></a></td>
                       <td ><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><b><?=htmlspecialchars($vaccine['doses']);?></b></a></td>
                       <td ><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['name']);?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars(decryptthis($vaccine['manufacturer'], $key));?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars(decryptthis($vaccine['ndc'], $key));?></small></a></td>
                       <td ><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars(decryptthis($vaccine['lot'], $key));?></small></a></td>
                       <td ><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['exp']);?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['funding_source']);?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars(decryptthis($vaccine['storage'], $key));?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['timestamp']);?></small></a></td>
                       <td><a type="button" class="focus-ring text-decoration-none inventorydeletebtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventorydeletemodal"><i class="bi bi-trash"></i></a></td>
                     </tr>
                     <?php
                   }
                 }
               }
               else
               {
                 ?>
                   <tr>
                     <td colspan="5" align="center"><small>No Data Found</small></td>
                   </tr>
                 <?php
               }
             ?>

           </tbody>
         </table>
       </div>
       <!-- Public Inventory -->
       <div class="tab-pane fade" id="public-tab-pane" role="tabpanel" aria-labelledby="public-tab" tabindex="0">
         <table class="table table-sm table-hover table-borderless text-nowrap">
           <thead>
             <th><small>Doses</small></th>
             <th><small>Name</small></th>
             <th><small>Lot</small></th>
             <th><small>Exp</small></th>
           </thead>
           <tbody>

             <?php
               if(isset($_GET['inventory']))
               {
                 $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
                 $filtervalues = htmlspecialchars($_GET['inventory']);
                 $query = "SELECT * FROM inventory WHERE groupID='$groupID' AND funding_source='Public' ";
                 $query_run = mysqli_query($con, $query);
                 $searchnum = mysqli_num_rows($query_run);
                 if($searchnum > 0)
                 {
                   foreach ($query_run as $vaccine)
                   {
                     ?>
                     <tr>
                       <td hidden><a type="hidden" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['engineID']);?></small></a></td>
                       <td hidden><a type="hidden" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['groupID']);?></small></a></td>
                       <td ><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><b><?=htmlspecialchars($vaccine['doses']);?></b></a></td>
                       <td ><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['name']);?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars(decryptthis($vaccine['manufacturer'], $key));?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars(decryptthis($vaccine['ndc'], $key));?></small></a></td>
                       <td ><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars(decryptthis($vaccine['lot'], $key));?></small></a></td>
                       <td ><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['exp']);?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['funding_source']);?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars(decryptthis($vaccine['storage'], $key));?></small></a></td>
                       <td hidden><a type="button" class="text-decoration-none inventory-editbtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventory-edit"><small><?=htmlspecialchars($vaccine['timestamp']);?></small></a></td>
                       <td><a type="button" class="focus-ring text-decoration-none inventorydeletebtn" style="color: black" data-bs-toggle="modal" data-bs-target="#inventorydeletemodal"><i class="bi bi-trash"></i></a></td>
                     </tr>
                     <?php
                   }
                 }
               }
               else
               {
                 ?>
                   <tr>
                     <td colspan="5" align="center"><small>No Data Found</small></td>
                   </tr>
                 <?php
               }
             ?>

           </tbody>
         </table>
       </div>
     </div>

   </div>
  </div>
</div>
