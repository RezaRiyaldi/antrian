<?= $this->extend('master') ?>

<?= $this->section('content') ?>

<div class="row mt-5">
    <div class="col-xl-4 col-md-6 col-sm-8 col-10 mx-auto">
        <div class="card bg-secondary text-white">
            <form action="<?= base_url() ?>/ubah-pelayanan/<?= $pelayanan->id_pelayanan ?>" method="post">
                <div class="card-header">
                    <h2 class="my-3 text-center">Ubah Pelayanan</h2>
                </div>

                <div class="card-body py-4">
                    <div class="mb-3">
                        <label for="" class="form-label">Kode Pelayanan</label>
                        <input type="text" class="form-control bg-dark text-white" maxlength="2" name="kode_pelayanan" placeholder="Contoh: CS" value="<?= $pelayanan->kode_pelayanan ?>">
                    </div>

                    <div class="">
                        <label for="" class="form-label">Nama Pelayanan</label>
                        <input type="text" class="form-control bg-dark text-white" name="nama_pelayanan"placeholder="Contoh: Customer Services" value="<?= $pelayanan->nama_pelayanan ?>">
                    </div>
                </div>

                <div class="card-footer p-3">
                    <button type="submit" class="btn btn-warning">Ubah</button>
                </div>
            </form>
        </div>

    </div>
</div>
<?= $this->endSection() ?>