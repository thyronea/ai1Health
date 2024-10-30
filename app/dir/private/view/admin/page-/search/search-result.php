<!-- Navtabs for Home and to reset the search page-->
<nav class="navbar">
  <div class="container">
    <ul class="nav" id="myTab" role="tablist">

      <!--Home-->
      <li class="nav-item" role="presentation">
        <a class="nav-link active" style="color: black; text-decoration: none;" href="../../index.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
            <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
            <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
          </svg>
        </a>
      </li>

      <!-- Reset -->
      <li class="nav-item" role="presentation">
        <a class="nav-link" <a style="color: black; text-decoration: none;" href="search-page.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
          </svg>
        </a>
      </li>

    </ul>
  </div>
</nav>

<!-- Main Content -->
<div class="container col-md-10 py-5" align="center">

  <!-- Header Alert -->
  <?php include('../../components/alert.php'); ?>

  <!-- Vaccine Search Box -->
  <div class="col-md-4 mt-3 mb-5">
   <form class="" action="" method="get">
     <div class="input-group input-group-sm">
       <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; }?>" class="form-control" placeholder="Search" required>
      <button type="submit" class="focus-ring btn btn-secondary border">Search</button>
    </div>
   </form>
  </div>
  <div class="col-md-8">
    <table class="focus-ring table-borderless table table-sm text-nowrap">
      <tbody align="center">

        <?php
            // Search in patients table
            if(isset($_GET['search']))
            {
              $engineID = mysqli_real_escape_string($con, $_SESSION['engineID']);
              $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
              $filtervalues = htmlspecialchars($_GET['search']);
              $query = "SELECT * FROM engine WHERE groupID='$groupID' AND CONCAT(keyword1,keyword2,keyword3) LIKE '%$filtervalues%' ORDER BY keyword1";
              $query_run = mysqli_query($con, $query);
              $searchnum = mysqli_num_rows($query_run);
              if($searchnum == 0)
              {
                echo "We were unable to find your search term of '<b>$filtervalues</b>'";
              }
              else
              {
                ?><h5 class="mb-3"><?= $searchnum ?> Results Found For "<?= $filtervalues?>"</h5><?php
                foreach ($query_run as $result)
                {
                  ?>
                  <tr>
                    <td>
                      <div class="card col-md-8 shadow" style="text-align:left;">
                        <div class="card-body">
                          <div class="row">
                            <div class="col">
                              <a type="button" class="text-decoration-none" style="color: black" href="<?= htmlspecialchars($result['link']); ?>" target="_blank">
                                <b><?= htmlspecialchars($result['keyword1']); ?></b><br>
                                <small><?= htmlspecialchars($result['keyword2']); ?></small>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php
                }
              }
            }
        ?>
      </tbody>
    </table>
  </div>

</div>
