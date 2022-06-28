<?= $this->extend('master') ?>

<?= $this->section('content') ?>
<div class="row text-white mt-3">
    <div class="col-md-9 mb-3">
        <div class="bg-secondary p-5 rounded">
            <h1 class="display-4">Selamat Datang</h1>
            <hr>
            <p>Kami siap melayani anda dengan sepenuh hati, namun tentu saja, agar kondusif harap mengambil nomor antrian sesuai apa yang anda butuhkan. Lalu kami akan segera memanggil anda apabila sudah giliran anda. Terima Kasih</p>
            <button class="btn btn-warning mt-3">Ambil Antrian</button>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-center bg-warning h-100">
            <div class="card-header">
                <h5 class="my-auto">Panggilan Antrian</h5>
            </div>

            <div class="card-body d-flex justify-content-center">
                <h1 class="m-auto" style="font-size: 64px">A03</h1>
            </div>

            <div class="card-footer">
                <h4 class="m-auto">Loket 1</h4>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3 text-center text-white">
    <div class="col-md-3">
        <div class="card border-danger bg-transparent">
            <div class="card-body">
                <h2 class="my-3">A04</h2>
            </div>
            <div class="card-footer bg-danger">
                <h4 class="m-auto">Loket 2</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-warning bg-transparent">
            <div class="card-body">
                <h2 class="my-3">B01</h2>
            </div>
            <div class="card-footer bg-warning">
                <h4 class="m-auto">Loket 3</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-success bg-transparent">
            <div class="card-body">
                <h2 class="my-3">C10</h2>
            </div>
            <div class="card-footer bg-success">
                <h4 class="m-auto">Loket 4</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border border-primary bg-transparent">
            <div class="card-body">
                <h2 class="my-3">D11</h2>
            </div>
            <div class="card-footer bg-primary">
                <h4 class="m-auto">Loket 5</h4>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>