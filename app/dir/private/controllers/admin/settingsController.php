<!-- Sidebar Menu -->
    <div class="nav flex-column me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button class="nav-link active focus-ring py-1 px-2 btn border rounded-0" data-bs-toggle="pill" data-bs-target="#profile" type="button" role="tab">
            <small>Profile</small>
        </button>
        <button class="nav-link focus-ring py-1 px-2 btn border rounded-0" data-bs-toggle="pill" data-bs-target="#password" type="button" role="tab">
            <small>Password</small>
        </button>
        <a class="nav-link focus-ring py-1 px-2 btn border rounded-0" href="/private/view/admin/dashboard/" type="button" ><small>Back</small></a>
    </div>

    <!-- Content -->
    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="profile" role="tabpanel" tabindex="0">
            <?php 
                include(VIEW_FORMS . '/updateProfile.php');
                include(VIEW_FORMS . '/addProfileIMG.php');
                include(VIEW_FORMS . '/addBackgroundIMG.php'); 
            ?>
        </div>
        <div class="tab-pane fade" id="password" role="tabpanel" tabindex="0">
            <?php include(VIEW_FORMS . '/updatePassword.php');  ?>
        </div>
    </div>
