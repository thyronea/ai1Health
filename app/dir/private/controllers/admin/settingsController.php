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

            <?php include(VIEW_FORMS . '/updateProfile.php');?>
            
            <div class="modal fade" id="add_profile_image" tabindex="-1" data-bs-backdrop="static" aria-labelledby="activityclear-ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header text-center">
                            <h1 class="modal-title w-100 fs-5" id="activityclear-ModalLabel">Add Profile Image</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group mb-2">

                            <form class="" action="../../../controllers/admin/imageController.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="uploadfile" class="form-control form-select-sm" required>

                                <div class="form-group mt-4 mb-3" align="center">
                                <button type="submit" name="upload_profile_image" class="focus-ring btn btn-outline-secondary btn-sm">Upload</button>
                                </div>
                            </form>
                            
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="add_background_image" tabindex="-1" data-bs-backdrop="static" aria-labelledby="activityclear-ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header text-center">
                            <h1 class="modal-title w-100 fs-5" id="activityclear-ModalLabel">Add Background Image</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group mb-2">

                            <form class="" action="../../../controllers/admin/imageController.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="uploadfile" class="form-control form-select-sm" required>

                                <div class="form-group mt-4 mb-3" align="center">
                                <button type="submit" name="upload_background_image" class="focus-ring btn btn-outline-secondary btn-sm">Upload</button>
                                </div>
                            </form>
                            
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="password" role="tabpanel" tabindex="0">
            <?php include(VIEW_FORMS . '/updatePassword.php');  ?>
        </div>
    </div>
