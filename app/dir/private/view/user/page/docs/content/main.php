<style>
  #documents:hover{
    background-color: #e6effc;
    transition: all 1s ease;
  }
</style>

<div class="card border-0 m-2" style="width: auto; height: auto; overflow: auto;">
  <div class="card-body">

    <!-- SQL query for data visualization -->
    <?php include('process/math.php'); ?>
    <?php include('process/scripts.php'); ?>
    <?php include('process/sql.php'); ?>

    <!-- Google Pie Chart -->
    <div class="col-md-12">
      <div class="row g-2">
        <div class="col">
          <div id="doc_chart" style="width: 525px; height: 485px;"></div>
        </div>
        <div class="col" style="height: 32rem; overflow:auto;">
          <div class="card border-0">
            <div class="card-body">
              <table class="table align-middle table-borderless table-sm text-nowrap">
                <thead>
                </thead>
                <tbody align="center" style="text-align: left">
                  <?php
                  $groupID = htmlspecialchars($_SESSION["groupID"]); // this code will only show users from the same groupID
                  $query = "SELECT * FROM docs WHERE groupID='$groupID' ";
                  $query_run = mysqli_query($con, $query);

                  if(mysqli_num_rows($query_run) > 0)
                  {
                    foreach($query_run as $file)
                    {
                      ?>
                      <tr>
                        <td hidden><?=$file['id'];?></td>
                        <td hidden><?=$file['userID'];?></td>
                        <td hidden><?=$file['groupID'];?></td>
                        <td>
                          <div class="card shadow" id="documents">
                            <div class="card-body">
                              <small class="col"><a href="../../../docs/<?=$file['docname'];?>" target="_blank" style="text-decoration:none;"><?= $file['docname'];?></a></small>
                            </div>
                          </div>
                        </td>
                        <td hidden><?=$file['type'];?></td>
                        <td><small class="col"><a title="Delete File" type="button" href="#" class="filedelete" data-bs-toggle="modal" data-bs-target="#filedeletemodal" style="color:black"><i class="bi bi-trash"></i></a></small></td>
                      </tr>
                      <?php
                    }
                  }
                  else
                  {
                  ?>
                  <!--
                      <tr>
                        <td colspan="6" align="center">No Data Found</td>
                      </tr>
                  -->
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

  </div>
</div>