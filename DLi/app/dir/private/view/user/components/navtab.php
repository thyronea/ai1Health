<nav class="navbar bg-body-tertiary">
  <div class="container">

      <nav class="navbar">
        <div class="container">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#home" style="color:black">
                <small>Home</small>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <div class="dropend mt-2">
                <a class="dropdown-toggle m-3" href="#" role="button" data-bs-toggle="dropdown" style="color:black;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
                  </svg>
                </a>
                <ul class="dropdown-menu">
                  <li><a style="color:black" class="dropdown-item focus-ring btn btn-outline" type="button" href="page/settings/index.php?userID=<?=$_SESSION['userID']?>"><small>Settings <i class="m-3 bi bi-gear"></i></i></small></a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a style="color:black" class="dropdown-item focus-ring btn btn-outline" type="button" data-bs-toggle="modal" data-bs-target="#logoutModal"><small>Logout <i class="m-3 bi bi-door-open"></i></small></a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Main Search Box -->
      <div style="width:305px">
       <form class="" action="../user/page/search/index.php" method="get">
         <div class="input-group input-group-sm">
           <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['']; }?>" class="form-control" placeholder="Search" required>
          <button type="submit" class="focus-ring btn btn-secondary border"><small>Search</small></button>
        </div>
       </form>
      </div>

  </div>
</nav>
