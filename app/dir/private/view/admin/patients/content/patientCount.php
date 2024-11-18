<div class="col-md-9 mb-4">
    <div class="row">

            <!-- All -->
            <div class="col">
                <div class="card shadow" style="border-radius: 50%">
                    <div class="card-body">
                        <a><small>All</small></a><hr>
                        <h3><?=$all['count(*)']; ?></h3>
                    </div>
                </div>
            </div>

            <!-- Pediatric -->
            <div class="col">
                <div class="card shadow" style="border-radius: 50%">
                    <div class="card-body">
                        <a><small>Pediatric</small></a><hr>
                        <h3><?=$peds['count(*)']; ?></h3>
                    </div>
                </div>
            </div>

            <!-- Adult -->
            <div class="col">
                <div class="card shadow" style="border-radius: 50%">
                    <div class="card-body">
                        <a><small>Adult</small></a><hr>
                        <h3><?=$adult['count(*)']; ?></h3>
                    </div>
                </div>
            </div>

    </div>
</div>