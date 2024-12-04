<style media="screen">
#v-pills-tab button:hover{
  background-color: #e6effc;
  transition: all 1s ease;
}
</style>

<div class="col-auto px-0">

  <!-- Sidebar -->
  <div id="sidebar" class="collapse collapse-horizontal border-none">
      <div class="list-group flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button title="Chat" style="color:black; text-align: left" class="active focus-ring py-1 px-2 btn btn-sm border rounded-0 mt-3" data-bs-toggle="offcanvas" data-bs-target="#notification">
          Notification
        </button>
        <button title="Side Nav #2" style="color:black; text-align: left" class="focus-ring py-1 px-2 btn btn-sm border rounded-0" data-bs-toggle="offcanvas" data-bs-target="#sidenav2" aria-controls="offcanvasBottom">
          Side Nav #2
        </button>
        <button title="Side Nav #3" style="color:black; text-align: left" class="focus-ring py-1 px-2 btn btn-sm border rounded-0" data-bs-toggle="offcanvas" data-bs-target="#sidenav3" aria-controls="offcanvasBottom">
          Side Nav #3
        </button>
        <button title="Side Nav #4" style="color:black; text-align: left" class="focus-ring py-1 px-2 btn btn-sm border rounded-0" data-bs-toggle="offcanvas" data-bs-target="#sidenav4" aria-controls="offcanvasBottom">
          Side Nav #4
        </button>
        <button title="Side Nav #5" style="color:black; text-align: left" class="focus-ring py-1 px-2 btn btn-sm border rounded-0" data-bs-toggle="offcanvas" data-bs-target="#sidenav5" aria-controls="offcanvasBottom">
          Side Nav #5
        </button>

      </div>
  </div>

  <!-- Offcanvas -->
  <div class="tab-content" id="nav-tabContent">
    <!-- Side Nav #1-->
    <div class="tab-pane fade show active" role="tabpanel" tabindex="0">
      <?php include('offcanvas/notification.php'); ?>
    </div>
    <!-- Side Nav #2 -->
    <div class="tab-pane fade show active" role="tabpanel" tabindex="1">
      <?php include('offcanvas/sidenav2.php'); ?>
    </div>
    <!-- Side Nav #3 -->
    <div class="tab-pane fade show active" role="tabpanel" tabindex="2">
      <?php include('offcanvas/sidenav3.php'); ?>
    </div>
    <!-- Side Nav #4 -->
    <div class="tab-pane fade show active" role="tabpanel" tabindex="3">
      <?php include('offcanvas/sidenav4.php'); ?>
    </div>
    <!-- Side Nav #5 -->
    <div class="tab-pane fade show active" role="tabpanel" tabindex="4">
      <?php include('offcanvas/sidenav5.php'); ?>
    </div>
  </div>

</div>
