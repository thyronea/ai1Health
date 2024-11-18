<div class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">

    <nav class="navbar bg-body-tertiary">
      <div class="container">
        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
          </svg>
        </a>

        <ul class="dropdown-menu" style="font-size: 12px;">
          <li ><a class="dropdown-item"><small>Group ID: <b><?=htmlspecialchars($_SESSION["groupID"]);?></b></small></a></li>
          <li><hr class="dropdown-divider" /></li>
          <li ><a class="dropdown-item" href="../../admin/profile/?userID=<?=htmlspecialchars($_SESSION['userID']);?>" target="_blank"><small><?=htmlspecialchars($_SESSION['fname']); ?> <?=htmlspecialchars($_SESSION['lname']); ?></small></a></li>
          <li><hr class="dropdown-divider" /></li>
          <li><a class="dropdown-item" href="../../admin/dashboard/"><small>Back to Admin</small></a></li>
          <li><hr class="dropdown-divider" /></li>
          <li><a class="dropdown-item" value="logout" href="/private/controllers/auth/logoutController.php"><small>Logout</small></a></li>
        </ul>
        <ul></ul>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button style="color:black" class="nav-link active" id="snapshot-tab" data-bs-toggle="tab" data-bs-target="#snapshot-tab-pane" type="button" role="tab" aria-controls="snapshot-tab-pane" aria-selected="true"><small>Snapshot</small></button>
          </li>
          <li class="nav-item" role="presentation">
            <button style="color:black" class="nav-link" id="demographic-tab" data-bs-toggle="tab" data-bs-target="#demographics-tab-pane" type="button" role="tab" aria-controls="demographics-tab-pane" aria-selected="true"><small>Demographics</small></button>
          </li>
          <li class="nav-item" role="presentation">
            <button style="color:black" class="nav-link" id="immunization-tab" data-bs-toggle="tab" data-bs-target="#immunization-tab-pane" type="button" role="tab" aria-controls="immunization-tab-pane" aria-selected="true"><small>Immunization</small></button>
          </li>
        </ul>
      </div>
    </nav>

  </div>
</div>
