<section class="content-header align-content-center rounded">
    <div class="container-fluid title-page rounded">
        <div class="row">
            <div class="col-sm-6">
                <p class="mb-0 text-white text-sm text-underline font-weight-light">Detail data karyawan & rekam medis</p>
                <h1 class=" mb-4 text-white font-weight-bold text-uppercase"><?= $karyawan->nama_lengkap ?> </h1>
            </div>

            <div class="col-sm-6">
                <div class=" float-sm-right justify-content-center">
                    <a class="btn btn-md btn-primary mt-2" href="<?= base_url('karyawaN') ?>">KEMBALI</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="text-uppercase">
                    <div class=" text-white font-weight-light">
                        <strong class="text-bold">NIK</strong>
                        <span><?= $karyawan->nik ?></span>
                        <hr class="mx-0 my-1">
                    </div>
                    <div class=" text-white font-weight-light">
                        <strong class="text-bold">Jenis Kelamin</strong>
                        <span><?= $karyawan->jenkel == "L" ? 'Pria' : 'Wanita' ?></span>
                        <hr class="mx-0 my-1">
                    </div>
                    <div class=" text-white font-weight-light">
                        <strong class="text-bold">Tanggal Lahir</strong>
                        <span><?= TanggalIndo($karyawan->tgl_lahir)  ?> (<?= date('Y', strtotime(date('Y-m-d'))) - date('Y', strtotime($karyawan->tgl_lahir))  ?>)</span>
                        <hr class="mx-0 my-1">
                    </div>
                    <div class=" text-white font-weight-light">
                        <strong class="text-bold">Tanggal Join</strong>
                        <span><?= TanggalIndo($karyawan->tgl_join) ?></span>
                        <hr class="mx-0 my-1">
                    </div>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="text-uppercase">
                    <div class=" text-white font-weight-light">
                        <strong class="text-bold">Perusahaan</strong>
                        <span><?= $karyawan->perusahaan ?></span>
                        <hr class="mx-0 my-1">
                    </div>
                    <div class=" text-white font-weight-light">
                        <strong class="text-bold">Divisi</strong>
                        <span><?= $karyawan->nama_divisi ?></span>
                        <hr class="mx-0 my-1">
                    </div>
                    <div class=" text-white font-weight-light">
                        <strong class="text-bold">Departemen</strong>
                        <span><?= $karyawan->nama_departemen ?></span>
                        <hr class="mx-0 my-1">
                    </div>

                    <div class=" text-white font-weight-light">
                        <strong class="text-bold">Bagian</strong>
                        <span><?= $karyawan->bagian ?></span>
                        <hr class="mx-0 my-1">
                    </div>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="text-uppercase">
                    <div class=" text-white font-weight-light">
                        <strong class="text-bold">Status Kerja</strong>
                        <span><?= $karyawan->status ?></span>
                        <hr class="mx-0 my-1">
                    </div>
                    <div class=" text-white font-weight-light">
                        <strong class="text-bold">BPJS Kesehatan</strong>
                        <span><?= $karyawan->bpjs == null ? "-" : $karyawan->bpjs ?></span>
                        <hr class="mx-0 my-1">
                    </div>
                    <div class=" text-white font-weight-light">
                        <strong class="text-bold">BPJS Ketenagakerjaan</strong>
                        <span><?= $karyawan->bpjs_tk == null ? "-" : $karyawan->bpjs_tk ?></span>
                        <hr class="mx-0 my-1">
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.container-fluid -->
    <section class="mt-4">
        <div class="card card-success ">
            <div class=" card-header">
                <h3 class="card-title ">Riwayat Kunjungan Klinik</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                The body of the card
            </div>
        </div>
    </section>
    <section class="mt-4">
        <div class="card card-maroon ">
            <div class=" card-header">
                <h3 class="card-title ">Riwayat Surat Keterangan Dokter (SKD)</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                The body of the card
            </div>
        </div>
    </section>
    <section class="mt-4">
        <div class="card card-navy ">
            <div class=" card-header">
                <h3 class="card-title ">Riwayat Kecelakaan Kerja (KK)</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                The body of the card
            </div>
        </div>
    </section>
    <section class="mt-4">
        <div class="card card-purple ">
            <div class=" card-header">
                <h3 class="card-title ">Riwayat Medical Check Up (MCU)</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                The body of the card
            </div>
        </div>
    </section>
</section>