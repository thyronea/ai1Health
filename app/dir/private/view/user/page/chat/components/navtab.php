<nav class="navbar bg-body-tertiary">
  <div class="container">

  <!-- Sidebar Menu Button -->
  <div class="row g-2">
        <!-- User's Dropdown Menu-->
        <div class="col dropdown mt-2">
          <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
              <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
            </svg>
          </a>
          <ul class="dropdown-menu">
            <li ><a class="dropdown-item user-select-none"><small>Group ID: <b><?=htmlspecialchars($_SESSION["groupID"]);?></b></small></a></li>
            <li><hr class="dropdown-divider" /></li>
            <li ><a class="dropdown-item focus-ring" href="../../view/profile/index.php?userID=<?=$_SESSION['userID'];?>" target="_blank"><small><?=htmlspecialchars($_SESSION['fname']); ?> <?=htmlspecialchars($_SESSION['lname']); ?></small></a></li>
            <li><hr class="dropdown-divider" /></li>
            <li ><a class="dropdown-item focus-ring" href="page/settings/index.php?userID=<?=$_SESSION['userID'];?>"><small>Account Settings</small></a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a style="color:black" class="dropdown-item focus-ring btn btn-outline" type="button" data-bs-toggle="modal" data-bs-target="#logoutModal"><small>Logout <i class="m-3 bi bi-door-open"></i></small></a></li>
          </ul>
        </div>
      </div>

      <nav class="navbar">
        <div class="container">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
          
          <!-- Home -->
          <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Home" class="nav-item" role="presentation">
            <a class="nav-link" style="color: black; text-decoration: none;" href="../../index.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-house-heart" viewBox="0 0 16 16">
                <path d="M8 6.982C9.664 5.309 13.825 8.236 8 12 2.175 8.236 6.336 5.309 8 6.982Z"/>
                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.707L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.646a.5.5 0 0 0 .708-.707L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
              </svg>
            </a>
          </li>

          <!--Chat-->
          <li data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Chat" class="nav-item" role="presentation">
            <form method="post">
              <a class="nav-link active" style="color: black; text-decoration: none;" href="../chat/index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                  <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                  <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2"/>
                </svg>
              </a>
            </form>
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
      <ul></ul>
      <ul></ul>
      <ul></ul>

      <!-- Main Search Box -->
      <div style="width:305px">
       <form class="" action="../search/index.php" method="get">
         <div class="input-group input-group-sm">
           <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['']; }?>" class="form-control" placeholder="Search" required>
          <button type="submit" class="focus-ring btn btn-secondary border"><small>Search</small></button>
        </div>
       </form>
      </div>

  </div>
</nav>
