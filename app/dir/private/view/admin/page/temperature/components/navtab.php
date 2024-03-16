<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
  <div class="container">

    <div class="row g-2">
      <!-- Sidebar Menu Button -->
      <div class="col">
        <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse" class="border-none text-decoration-none" style="color: black;"><i class="bi bi-list bi-lg py-2 p-2"></i></a>
      </div>
      <!-- User's Dropdown Menu-->
      <div class="col dropdown mt-2">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
          </svg>
        </a>
        <ul class="dropdown-menu">
          <li ><a class="dropdown-item"><small>Group ID: <b><?=$_SESSION["groupID"];?></b></small></a></li>
          <li><hr class="dropdown-divider" /></li>
          <li ><a class="dropdown-item" href="../../../../view/profile/index.php?userID=<?=$_SESSION['userID'];?>" target="_blank"><small><?=htmlspecialchars($_SESSION['fname']); ?> <?=htmlspecialchars($_SESSION['lname']); ?></small></a></li>
          <li><hr class="dropdown-divider" /></li>
          <li ><a class="dropdown-item focus-ring" href="../settings/index.php?userID=<?=$_SESSION['userID'];?>"><small>Account Settings</small></a></li>
          <li><hr class="dropdown-divider" /></li>
          <li><a class="dropdown-item" value="logout" href="/../private/access/logout-process.php"><small>Logout</small></a></li>
        </ul>
      </div>
    </div>

    <nav class="navbar bg-body-tertiary">
      <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">

          <!--Home-->
          <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Home" class="nav-item" role="presentation">
            <a class="nav-link" style="color: black; text-decoration: none;" href="../../index.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-house-heart" viewBox="0 0 16 16">
                <path d="M8 6.982C9.664 5.309 13.825 8.236 8 12 2.175 8.236 6.336 5.309 8 6.982Z"/>
                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.707L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.646a.5.5 0 0 0 .708-.707L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
              </svg>
            </a>
          </li>

          <!-- Storage & Handling -->
          <li class="nav-item" role="presentation">
            <a class="nav-link active" style="color: black; text-decoration: none;" href="pages/temperature/index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-thermometer-snow" viewBox="0 0 16 16">
                  <path d="M5 12.5a1.5 1.5 0 1 1-2-1.415V9.5a.5.5 0 0 1 1 0v1.585A1.5 1.5 0 0 1 5 12.5z"/>
                  <path d="M1 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0V2.5zM3.5 1A1.5 1.5 0 0 0 2 2.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0L5 10.486V2.5A1.5 1.5 0 0 0 3.5 1zm5 1a.5.5 0 0 1 .5.5v1.293l.646-.647a.5.5 0 0 1 .708.708L9 5.207v1.927l1.669-.963.495-1.85a.5.5 0 1 1 .966.26l-.237.882 1.12-.646a.5.5 0 0 1 .5.866l-1.12.646.884.237a.5.5 0 1 1-.26.966l-1.848-.495L9.5 8l1.669.963 1.849-.495a.5.5 0 1 1 .258.966l-.883.237 1.12.646a.5.5 0 0 1-.5.866l-1.12-.646.237.883a.5.5 0 1 1-.966.258L10.67 9.83 9 8.866v1.927l1.354 1.353a.5.5 0 0 1-.708.708L9 12.207V13.5a.5.5 0 0 1-1 0v-11a.5.5 0 0 1 .5-.5z"/>
                </svg>
            </a>
          </li>

          <!--Chat-->
          <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Chat" class="nav-item" role="presentation">
            <form method="post">
              <a class="nav-link" style="color: black; text-decoration: none;" href="../chat/index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                  <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                  <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2"/>
                </svg>
              </a>
            </form>
          </li>

          <!--Document-->
          <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Document" class="nav-item" role="presentation">
            <form method="post">
              <a class="nav-link" style="color: black; text-decoration: none;" href="../docs/index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-folder2" viewBox="0 0 16 16">
                  <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v7a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 12.5zM2.5 3a.5.5 0 0 0-.5.5V6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3zM14 7H2v5.5a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5z"/>
                </svg>
              </a>
            </form>
          </li>

          <!--Manager-->
          <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Manager" class="nav-item" role="presentation">
            <a class="nav-link" style="color: black; text-decoration: none;" href="../manager/index.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
              </svg>
            </a>
          </li>

        </ul>
      </div>
    </nav>

    <ul></ul>
    <ul></ul>
    <ul></ul>
    <ul></ul>
    <ul></ul>
    <ul></ul>

    <!-- Main Search Box -->
    <div class="col-md-4">
     <form class="" action="../../page/search/index.php" method="get">
       <div class="input-group input-group-sm">
         <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['']; }?>" class="form-control" placeholder="Search" required>
        <button type="submit" class="focus-ring btn btn-secondary border">Search</button>
      </div>
     </form>
    </div>

  </div>
</nav>
