<nav class="navbar fixed-top">
  <div class="container">
    <ul class="nav" id="myTab" role="tablist">

      <li class="nav-item" role="presentation">
        <a class="nav-link active" style="color: black; text-decoration: none;" href="../../admin/dashboard/">
          <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
            <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
            <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
          </svg>
        </a>
      </li>

      <li class="nav-item" role="presentation">
        <a class="nav-link" style="color: black; text-decoration: none;" href="../../admin/search/">
          <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
          </svg>
        </a>
      </li>

    </ul>
  </div>
</nav>

<div class="container" align="center">
  <div class="col-md-12">

      <div class="col-md-4 mb-5" style="padding-top:50px;">
        <form class="" action="" method="get">
          <div class="input-group input-group-sm">
            <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; }?>" class="form-control" placeholder="Search" required>
            <button type="submit" class="focus-ring btn btn-secondary border">Search</button>
          </div>
        </form>
      </div>

        <div class="col-md-8">
          <?php include(VIEW_TABLES . '/searchTable.php'); ?>
        </div>

  </div>
</div>