<div class="row px-3 py-2 bg-info rounded-top">
    <div class="col-sm-1 pl-0">
        <img src="<?= base_url() . 'assets/images/kunjungan.png' ?>" alt="Responsive image" height="50px">
    </div>
    <div class="col-sm-10 float-sm-right">
        <h5 class="mb-0 text-white font-weight-bold">DETAIL KARYAWAN</h5>
        <p class="mb-0 text-white font-weight-light">Data karyawan kunjungan klinik</p>

    </div>
    <div class="col-sm-1 align-content-center">
        <div class="float-sm-right align-content-center">
            <button aria-hidden="true" data-dismiss="modal" class="close btn-lg" type="button" style="font-size: 1.8rem;">×</button>
            <!-- <img src="<?= base_url() . 'assets/images/kunjungan.png' ?>" alt="Responsive image" height="50px"> -->
        </div>
    </div>
</div>

<div class="row px-3 bg-light pt-3 text-uppercase">
    <div class="col-md-6 ">
        <strong>NIK</strong>
        <span class="text-muted"><?= $kunjungan->nik ?></span>
        <hr class="m-1">
        <strong>Nama Lengkap</strong>
        <span class="text-muted">
            <?= $kunjungan->nama_lengkap ?>
        </span>
        <hr class="m-1">
        <strong>Tanggal Lahir</strong>
        <span class="text-muted"><?= TanggalIndo($kunjungan->tgl_lahir)  ?> (<?= date('Y', strtotime($kunjungan->tgl_kunjungan)) - date('Y', strtotime($kunjungan->tgl_lahir))  ?>)</span>
        <hr class="m-1">
        <strong>Tgl Join</strong>
        <span class="text-muted"><?= TanggalIndo($kunjungan->tgl_join)  ?></span>
        <hr class="m-1">
    </div>
    <div class="col-md-6 pb-3">
        <strong>Perusahaan</strong>
        <span class="text-muted"><?= $kunjungan->perusahaan  ?></span>
        <hr class="m-1">
        <strong>Divisi</strong>
        <span class="text-muted"><?= $kunjungan->nama_divisi  ?></span>
        <hr class="m-1">
        <strong>Departemen</strong>
        <span class="text-muted"><?= $kunjungan->nama_departemen  ?></span>
        <hr class="m-1">
        <strong>Bagian</strong>
        <span class="text-muted"><?= $kunjungan->bagian  ?></span>
        <hr class="m-1">
        <strong>Status</strong>
        <span class="text-muted"><?= $kunjungan->status  ?></span>
    </div>
</div>
<div class="row px-3 py-2 bg-info">
    <div class="col-sm-6">
        <h5 class="mb-0 text-white font-weight-bold">DETAIL KUNJUNGAN</h5>
        <p class="mb-0 text-white font-weight-light">Detail kunjungan klinik</p>

    </div>
    <div class="col-sm-6">
        <div class="float-sm-right justify-content-center">
            <!-- <img src="<?= base_url() . 'assets/images/kunjungan.png' ?>" alt="Responsive image" height="50px"> -->
        </div>
    </div>
</div>
<div class="row px-3 bg-light pt-3 rounded-bottom text-uppercase">
    <div class="col-md-6">

        <strong> Tanggal & Jam Kunjungan</strong>
        <p class="text-muted">
            <?= TanggalIndo($kunjungan->tgl_kunjungan)   ?> (<?= $kunjungan->jam_kunjungan ?>)
        </p>
        <hr class="m-1">
        <strong> Perawat</strong>
        <p class="text-muted">
            <?= $kunjungan->nama_user ?>
        </p>

        <hr class="m-1">
        <strong> Catatan </strong>
        <p class="text-muted">
            <?= $kunjungan->catatan_kunjungan ?>
        </p>
        <hr class="m-1">

    </div>
    <div class="col-md-6 pb-3">
        <strong> Diagnosa</strong>
        <p class="text-muted">
            <?= get_diagnosa_kunjungan_by_id_kunjungan($kunjungan->id_kunjungan) ?>
        </p>
        <hr class="m-1">
        <strong> Anamnesa</strong>
        <p class="text-muted">
            <?= $kunjungan->anamnesa ?>
        </p>
        <hr class="m-1">

        <strong> Teraphy Fisik</strong>
        <p class="text-muted">
            <?= $kunjungan->teraphy ?>
        </p>
        <hr class="m-1">
        <strong> Teraphy Obat</strong>
        <p class="text-muted">
            <?= get_obat_kunjungan_by_id_kunjungan($kunjungan->id_kunjungan) ?>
        </p>
    </div>
</div>