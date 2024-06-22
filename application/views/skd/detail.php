<div class="row px-3 py-2 bg-info rounded-top">
    <div class="col-sm-1 pl-0">
        <img src="<?= base_url() . 'assets/images/skd.png' ?>" alt="Responsive image" height="50px">
    </div>
    <div class="col-sm-10 float-sm-right">
        <h5 class="mb-0 text-white font-weight-bold">DETAIL KARYAWAN</h5>
        <p class="mb-0 text-white font-weight-light">Data karyawan </p>

    </div>
    <div class="col-sm-1 align-content-center">
        <div class="float-sm-right align-content-center">
            <button aria-hidden="true" data-dismiss="modal" class="close btn-lg" type="button" style="font-size: 1.8rem;">×</button>

        </div>
    </div>
</div>

<div class="row px-3 bg-light pt-3 text-uppercase">
    <div class="col-md-6 ">
        <strong>NIK</strong>
        <span class="text-muted"><?= $skd->nik ?></span>
        <hr class="m-1">
        <strong>Nama Lengkap</strong>
        <span class="text-muted">
            <?= $skd->nama_lengkap ?>
        </span>
        <hr class="m-1">
        <strong>Tanggal Lahir</strong>
        <span class="text-muted"><?= TanggalIndo($skd->tgl_lahir)  ?> (<?= date('Y', strtotime($skd->tgl_mulai_skd)) - date('Y', strtotime($skd->tgl_lahir))  ?>)</span>
        <hr class="m-1">
        <strong>Tgl Join</strong>
        <span class="text-muted"><?= TanggalIndo($skd->tgl_join)  ?></span>
        <hr class="m-1">
    </div>
    <div class="col-md-6 pb-3">
        <strong>Perusahaan</strong>
        <span class="text-muted"><?= $skd->perusahaan  ?></span>
        <hr class="m-1">
        <strong>Divisi</strong>
        <span class="text-muted"><?= $skd->nama_divisi  ?></span>
        <hr class="m-1">
        <strong>Departemen</strong>
        <span class="text-muted"><?= $skd->nama_departemen  ?></span>
        <hr class="m-1">
        <strong>Bagian</strong>
        <span class="text-muted"><?= $skd->bagian  ?></span>
        <hr class="m-1">
        <strong>Status</strong>
        <span class="text-muted"><?= $skd->status  ?></span>
    </div>
</div>
<div class="row px-3 py-2 bg-info">
    <div class="col-sm-6">
        <h5 class="mb-0 text-white font-weight-bold">DETAIL SURAT KETERANGAN DOKTER</h5>
        <p class="mb-0 text-white font-weight-light">Data surat keterangan dokter</p>

    </div>
    <div class="col-sm-6">
        <div class="float-sm-right justify-content-center">
            <!-- <img src="<?= base_url() . 'assets/images/skd.png' ?>" alt="Responsive image" height="50px"> -->
        </div>
    </div>
</div>
<div class="row px-3 bg-light pt-3 rounded-bottom text-uppercase">
    <div class="col-md-6">

        <strong> Tanggal skd</strong>
        <p class="text-muted">
            <?= TanggalIndo($skd->tgl_mulai_skd)   ?> - <?= TanggalIndo($skd->tgl_akhir_skd)   ?> (<?= $skd->jumlah_hari ?> Hari)
        </p>
        <hr class="m-1">
        <strong> Pembayaran</strong>
        <p class="text-muted">
            <?= $skd->pembayaran ?>
        </p>
        <hr class="m-1">
        <strong> faskes</strong>
        <p class="text-muted">
            <?= $skd->faskes ?>
        </p>
        <hr class="m-1">
        <strong> Catatan SKD </strong>
        <p class="text-muted">
            <?= $skd->catatan_skd ?>
        </p>
        <hr class="m-1">
        <strong> Lampiran </strong>
        <p class="link">
            <a href="#" type="button" onclick="showFile('<?= $skd->lampiran ?>')" data-toggle="tooltip" title="LIHAT FILE MCU">
                <i class="far fa-file-pdf  mr-1"></i> <?= $skd->lampiran ?>
            </a>
        </p>

    </div>
    <div class="col-md-6 pb-3">
        <strong>Anamnesa</strong>
        <p class="text-muted">
            <?= $skd->jenis_penyakit ?>
        </p>
        <hr class="m-1">

        <strong> Diagnosa</strong>
        <p class="text-muted">
            <?= get_diagnosa_skd_by_id_skd($skd->id_skd) ?>
        </p>
        <hr class="m-1">
        <strong> Tanggal penyerahan SKD</strong>
        <p class="text-muted">
            <?= TanggalIndo($skd->tgl_penyerahan) ?>
        </p>
        <hr class="m-1">
        <strong> Perawat klinik factory</strong>
        <p class="text-muted">
            <?= $skd->nama_user ?>
        </p>
        <hr class="m-1">
        <strong> Status skd</strong>
        <p class="text-muted">
            <span class="badge <?= $skd->status_skd == 'ACC' ? 'badge-success' : 'badge-danger' ?>  badge-pill"><?= $skd->status_skd ?></span>

        </p>

    </div>
</div>