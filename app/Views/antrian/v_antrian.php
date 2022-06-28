<?= $this->extend('master'); ?>

<?= $this->section('content'); ?>
<div class="card mt-4 bg-secondary text-white">
    <div class="card-body d-flex justify-content-between">
        <h2 class="my-3">Daftar Antrian</h2>
    </div>
</div>

<div class="row mt-4    ">
    <div class="col-md-4">
        <div class="card bg-transparent border-warning">
            <!-- <div class="card-body"> -->
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-transparent border-warning text-white">
                        
                    </li>
                    <li class="list-group-item bg-transparent border-warning text-white">An item</li>
                    <li class="list-group-item bg-transparent border-warning text-white">An item</li>
                    <li class="list-group-item bg-transparent border-warning text-white">An item</li>
                </ul>

            <!-- </div> -->
            <div class="card-footer bg-warning">
                <h4 class="my-auto text-center">Loket 1</h4>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>