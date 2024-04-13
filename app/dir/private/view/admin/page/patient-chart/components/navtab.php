<div class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">

    <!-- User's Dropdown Menu-->
    <div class="dropdown mt-2">
      <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
          <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
        </svg>
      </a>
      <ul class="dropdown-menu">
        <li ><a class="dropdown-item"><small>Group ID: <b><?=htmlspecialchars($_SESSION["groupID"]);?></b></small></a></li>
        <li><hr class="dropdown-divider" /></li>
        <li ><a class="dropdown-item" href="../../../../view/profile/index.php?userID=<?=htmlspecialchars($_SESSION['userID']);?>" target="_blank"><small><?=htmlspecialchars($_SESSION['fname']); ?> <?=htmlspecialchars($_SESSION['lname']); ?></small></a></li>
        <li><hr class="dropdown-divider" /></li>
        <li><a class="dropdown-item" href="../../../admin/index.php"><small>Back to Admin</small></a></li>
        <li><hr class="dropdown-divider" /></li>
        <li><a class="dropdown-item" value="logout" href="/private/access/logout-process.php"><small>Logout</small></a></li>
      </ul>
    </div>

    <nav class="navbar bg-body-tertiary">
      <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button style="color:black" class="nav-link active" id="snapshot-tab" data-bs-toggle="tab" data-bs-target="#snapshot-tab-pane" type="button" role="tab" aria-controls="snapshot-tab-pane" aria-selected="true"><small>Snapshot</small></button>
          </li>
          <li class="nav-item" role="presentation">
            <button style="color:black" class="nav-link" id="demographic-tab" data-bs-toggle="tab" data-bs-target="#demographic-tab-pane" type="button" role="tab" aria-controls="demographic-tab-pane" aria-selected="true"><small>Demographic</small></button>
          </li>
          <li class="nav-item" role="presentation">
            <button style="color:black" class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false"><small>History</small></button>
          </li>
          <li class="nav-item" role="presentation">
            <button style="color:black" class="nav-link" id="progress-notes-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="progress-notes-tab-pane" aria-selected="true"><small>Notes</small></button>
          </li>
          <li class="nav-item" role="presentation">
            <button style="color:black" class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false"><small>Vitals</small></button>
          </li>
          <li class="nav-item" role="presentation">
            <button style="color:black" class="nav-link" id="immunization-tab" data-bs-toggle="tab" data-bs-target="#immunization-tab-pane" type="button" role="tab" aria-controls="immunization-tab-pane" aria-selected="true"><small>Immunization</small></button>
          </li>
          <li class="nav-item" role="presentation">
            <button style="color:black" class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false"><small>Medication</small></button>
          </li>
          <li class="nav-item" role="presentation">
            <button style="color:black" class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false"><small>Allergies</small></button>
          </li>
          <li class="nav-item" role="presentation">
            <button style="color:black" class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false"><small>Lab</small></button>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Main Search Box -->
    <div class="col-md-3" style="width:305px">
     <form class="" action="../../../search-page.php" method="get">
       <div class="input-group input-group-sm">
         <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['']; }?>" class="form-control" placeholder="Search" required>
        <button type="submit" class="focus-ring btn btn-secondary border"><small>Search</small></button>
      </div>
     </form>
    </div>

  </div>
</div>
