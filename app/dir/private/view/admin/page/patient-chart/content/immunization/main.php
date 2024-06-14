<div class="tab-pane fade" id="immunization-tab-pane" role="tabpanel" aria-labelledby="immunization-tab" tabindex="0">
  <div class="container user-select-none" align="center">

    <div class="row flex-nowrap">
      <div class="col-md-12 mt-3">
        <div class="card shadow" style="background-image: linear-gradient(#f5f5f5, #ffffff); height:43rem">
          <div class="card-body table-responsive" id="immunization">

            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-history" type="button" role="tab" aria-controls="nav-home" aria-selected="true" style="color: black;"><small>Overview</small></button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-peds" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" style="color: black;"><small>Pediatric</small></button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-adol" type="button" role="tab" aria-controls="nav-contact" aria-selected="false" style="color: black;"><small>Adolescent</small></button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-adult" type="button" role="tab" aria-controls="nav-contact" aria-selected="false" style="color: black;"><small>Adult</small></button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <?php include('immunization-overview.php');?>
              <div class="tab-pane fade" id="nav-peds" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">...</div>
              <div class="tab-pane fade" id="nav-adol" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">...</div>
              <div class="tab-pane fade" id="nav-adult" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">...</div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Removes scrollbar display -->
<style>
  #immunization::-webkit-scrollbar{
    width: 0;
    height: 0;
  }
</style>