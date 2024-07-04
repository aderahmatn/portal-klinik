<div class="row px-3 py-2 bg-info rounded-top">
    <div class="col-sm-1 pl-0">
        <img src="<?= base_url() . 'assets/images/kk.png' ?>" alt="Responsive image" height="50px">
    </div>
    <div class="col-sm-10 float-sm-right">
        <h5 class="mb-0 text-white font-weight-bold">DETAIL KARYAWAN</h5>
        <p class="mb-0 text-white font-weight-light">Data korban kecelakaan kerja</p>

    </div>
    <div class="col-sm-1 align-content-center">
        <div class="float-sm-right align-content-center">
            <button aria-hidden="true" data-dismiss="modal" class="close btn-lg" type="button" style="font-size: 1.8rem;">×</button>
            <!-- <img src="<?= base_url() . 'assets/images/kunjungan.png' ?>" alt="Responsive image" height="50px"> -->
        </div>
    </div>
</div>

<div class="row px-3 bg-light pt-3 text-uppercase">
    <div class="col-md-4">
        <strong>NIK</strong>
        <span class="text-muted"><?= $kk->nik ?></span>
        <hr class="m-1">
        <strong>Nama Lengkap</strong>
        <span class="text-muted">
            <?= $kk->nama_lengkap ?>
        </span>
        <hr class="m-1">
        <strong>Tanggal Lahir</strong>
        <span class="text-muted"><?= TanggalIndo($kk->tgl_lahir)  ?> (<?= date('Y', strtotime($kk->tgl_kejadian)) - date('Y', strtotime($kk->tgl_lahir))  ?>)</span>
        <hr class="m-1">
        <strong>Pendidikan Terakhir</strong>
        <span class="text-muted"><?= $kk->pendidikan_terakhir  ?></span>

    </div>
    <div class="col-md-4 pb-3">
        <strong>Tgl Join</strong>
        <span class="text-muted"><?= TanggalIndo($kk->tgl_join)  ?></span>
        <hr class="m-1">
        <strong>Masa Kerja</strong>
        <span class="text-muted"><?= date('Y', strtotime($kk->tgl_kejadian)) - date('Y', strtotime($kk->tgl_join))  . ' Tahun - ' ?><?= date('m', strtotime($kk->tgl_kejadian)) - date('m', strtotime($kk->tgl_join))  . ' Bulan' ?></span>
        <hr class="m-1">
        <strong>Perusahaan</strong>
        <span class="text-muted"><?= $kk->perusahaan  ?></span>
        <hr class="m-1">
        <strong>Divisi</strong>
        <span class="text-muted"><?= $kk->nama_divisi  ?></span>

    </div>
    <div class="col-md-4 pb-3">
        <strong>Departemen</strong>
        <span class="text-muted"><?= $kk->nama_departemen  ?></span>
        <hr class="m-1">
        <strong>Bagian</strong>
        <span class="text-muted"><?= $kk->bagian  ?></span>
        <hr class="m-1">
        <strong>Status</strong>
        <span class="text-muted"><?= $kk->status  ?></span>
        <hr class="m-1">
        <strong>Nama Atasan</strong>
        <span class="text-muted"><?= $kk->nama_atasan  ?></span>
    </div>
</div>
<div class="row px-3 py-2 bg-info">
    <div class="col-sm-6">
        <h5 class="mb-0 text-white font-weight-bold">DETAIL KEJADIAN</h5>
        <p class="mb-0 text-white font-weight-light">Detail kejadian kecelakaan kerja</p>

    </div>
    <div class="col-sm-6">
        <div class="float-sm-right justify-content-center">
            <!-- <img src="<?= base_url() . 'assets/images/kk.png' ?>" alt="Responsive image" height="50px"> -->
        </div>
    </div>
</div>
<div class="row px-3 bg-light pt-3 rounded-bottom text-uppercase">
    <div class="col-md-4">
        <strong>Waktu Kejadian</strong>
        <p class="text-muted">
            <?= NumberWeek($kk->tgl_kejadian) . ' ' . '(' . TanggalIndo($kk->tgl_kejadian) . ')'  ?> <?= ' Shif ' . $kk->shif . ' ' ?> <?= '(' . $kk->jam_kejadian . ')' ?>
        </p>
        <hr class="m-1">
        <strong> Area Kejadian</strong>
        <p class="text-muted">
            <?= $kk->area_kejadian ?>
        </p>
        <hr class="m-1">
        <strong> Kategori KK </strong>
        <p class="text-muted">
            <?= $kk->kategori ?>
        </p>
        <hr class="m-1">
        <strong> Rujukan </strong>
        <p class="text-muted">
            <?= $kk->is_rujuk == 0 ? 'Tidak' : 'Ya' ?>
        </p>
        <hr class="m-1">
        <strong> Tipe KK </strong>
        <p class="text-muted">
            <?= $kk->tipe_kecelakaan ?>
        </p>
        <hr class="m-1">
        <strong> Input data oleh </strong>
        <p class="text-muted">
            <?= $kk->nama_user ?>
        </p>
    </div>
    <div class="col-md-4">
        <strong> Lost Time Injury (LTI)</strong>
        <p class="text-muted">
            <?= $kk->lost_time_injury ?>
        </p>

        <hr class="m-1">
        <strong>Bagian yang Cidera</strong>
        <p class="text-muted">
            <?= $kk->bagian_cidera ?>
        </p>
        <hr class="m-1">
        <strong> Medical Treatment (MT) </strong>
        <p class="text-muted">
            <?= $kk->medical_treatment ?>
        </p>
        <hr class="m-1">
        <strong> Faskes Penanganan </strong>
        <p class="text-muted">
            <?= $kk->faskes_penanganan ?>
        </p>
        <hr class="m-1">
        <strong> Penyebab Kecelakaan</strong>
        <p class="text-muted">
            <?= $kk->penyebab_kecelakaan ?>
        </p>
    </div>
    <div class="col-md-4">
        <strong> Kronologi Kejadian</strong>
        <p class="text-muted">
            <?= $kk->kronologi_kejadian ?>
        </p>

        <hr class="m-1">
        <strong>Catatan</strong>
        <p class="text-muted">
            <?= $kk->catatan ?>
        </p>
        <hr class="m-1">
        <strong> Tindakan Setelah Dirujuk </strong>
        <p class="text-muted">
            <?= $kk->tindakan_rujuk ?>
        </p>
        <hr class="m-1">
        <strong> Update Pemantauan Medis </strong>
        <p class="text-muted">
            <?= $kk->update_pemantauan_medis ?>
        </p>
        <hr class="m-1">
        <strong> Lampiran</strong>
        <p class="link">
            <a href="#" type="button" onclick="showFile('<?= $kk->file ?>')" data-toggle="tooltip" title="LIHAT FILE MCU">
                <i class="far fa-file-pdf  mr-1"></i> <?= $kk->file ?>
            </a>
        </p>
    </div>

</div>