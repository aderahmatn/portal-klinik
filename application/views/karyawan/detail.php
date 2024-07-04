<section class="content-header align-content-center rounded">
    <div class="container-fluid title-page rounded">
        <div class="row">
            <div class="col-sm-6">
                <p class="mb-0 text-white text-sm text-underline font-weight-light">Detail data karyawan & rekam medis</p>
                <h1 class=" mb-4 text-white font-weight-bold text-uppercase"><?= $karyawan->nama_lengkap ?> </h1>
            </div>

            <div class="col-sm-6">
                <div class=" float-sm-right justify-content-center">
                    <button class="btn btn-success mt-2" id="btn-load" disabled><span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>DOWNLOADING..</button>
                    <a class="btn btn-md btn-success mt-2" href="<?= base_url('karyawan/excel/') . encrypt_url($karyawan->id_karyawan) ?>" onclick="load()" id="btn-export">EXPORT SPREADSHEET</a>

                    <a class="btn btn-md btn-primary mt-2" href="<?= base_url('karyawan') ?>">KEMBALI</a>
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
                <div class="row">
                    <div class="col-md-auto">
                        <img src="<?= base_url() . 'assets/images/kunjungan.png' ?>" height="50px" class="float-left d-md-none  d-sm-none d-lg-block">
                    </div>
                    <div class="col-md-auto d-flex align-items-center">
                        <h5 class=" card-title">Riwayat Kunjungan Klinik</h5>
                    </div>
                    <div class="col pr-0">
                        <div class="float-right">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-success" style="display: block;">
                <table id="tableUSer" class="display nowrap table-success" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>TGL & JAM</th>
                            <th>USIA</th>
                            <th>ANAMNESA</th>
                            <th>DIAGNOSA</th>
                            <th>TERAPHY FISIK</th>
                            <th>TERAPHY OBAT</th>
                            <th>CATATAN</th>
                            <th>PERAWAT</th>
                        </tr>
                    </thead>
                    <tbody class="text-uppercase">
                        <?php
                        foreach ($kunjungan as $key) : ?>
                            <tr class="text-uppercase">

                                <td>
                                    <?= TanggalIndo($key->tgl_kunjungan) . ' ' . $key->jam_kunjungan ?>
                                </td>
                                <td>
                                    <?= date('Y', strtotime($key->tgl_kunjungan)) - date('Y', strtotime($key->tgl_lahir))  ?>
                                </td>

                                <td>
                                    <?= $key->anamnesa ?>
                                </td>
                                <td>
                                    <?= get_diagnosa_kunjungan_by_id_kunjungan($key->id_kunjungan) ?>
                                </td>
                                <td>
                                    <?= $key->teraphy ?>
                                </td>
                                <td>
                                    <?= get_obat_kunjungan_by_id_kunjungan($key->id_kunjungan) ?>
                                </td>
                                <td>
                                    <?= $key->catatan_kunjungan ?>
                                </td>
                                <td>
                                    <?= $key->nama_user ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="mt-4">
        <div class="card card-maroon ">
            <div class=" card-header">
                <div class="row">
                    <div class="col-md-auto">
                        <img src="<?= base_url() . 'assets/images/skd.png' ?>" height="50px" class="float-left d-md-none  d-sm-none d-lg-block">
                    </div>
                    <div class="col-md-auto d-flex align-items-center">
                        <h5 class=" card-title">Riwayat Surat Keterangan Dokter (SKD)</h5>
                    </div>
                    <div class="col pr-0">
                        <div class="float-right">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-danger" style="display: block;">
                <table id="tableSkd" class="display nowrap table-danger" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>TGL SKD</th>
                            <th>USIA</th>
                            <th>PEMBAYARAN</th>
                            <th>FASKES</th>
                            <th>STATUS SKD</th>
                            <th>DIAGNOSA</th>
                            <th>ANAMNESA</th>
                            <th>CATATAN</th>
                            <th>TGL PENYERAHAN</th>
                            <th>LAMPIRAN</th>
                            <th>PERAWAT</th>
                        </tr>
                    </thead>
                    <tbody class="text-uppercase">
                        <?php
                        foreach ($skd as $key) : ?>
                            <tr class="text-uppercase">
                                <td>
                                    <?= TanggalIndo($key->tgl_mulai_skd) . ' - ' . TanggalIndo($key->tgl_akhir_skd) ?> (<?= $key->jumlah_hari ?> Hari)
                                </td>
                                <td>
                                    <?= date('Y', strtotime($key->tgl_mulai_skd)) - date('Y', strtotime($key->tgl_lahir))  ?>
                                </td>
                                <td>
                                    <?= $key->pembayaran ?>
                                </td>
                                <td>
                                    <?= $key->faskes ?>
                                </td>
                                <td>
                                    <?= $key->status_skd ?>
                                </td>
                                <td>
                                    <?= get_diagnosa_skd_by_id_skd($key->id_skd) ?>
                                </td>
                                <td>
                                    <?= $key->jenis_penyakit ?>
                                </td>
                                <td>
                                    <?= $key->catatan_skd ?>
                                </td>
                                <td>
                                    <?= TanggalIndo($key->tgl_penyerahan)  ?>
                                </td>
                                <td>
                                    <a href="#" type="button" onclick="showFile('<?= $key->lampiran ?>')" data-toggle="tooltip" title="LIHAT FILE MCU">
                                        <i class="far fa-file-pdf  mr-1"></i> <?= $key->lampiran ?>
                                    </a>
                                </td>
                                <td>
                                    <?= $key->nama_user ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="mt-4">
        <div class="card card-navy ">
            <div class=" card-header">
                <div class="row">
                    <div class="col-md-auto">
                        <img src="<?= base_url() . 'assets/images/kk.png' ?>" height="50px" class="float-left d-md-none  d-sm-none d-lg-block">
                    </div>
                    <div class="col-md-auto d-flex align-items-center">
                        <h5 class=" card-title">Riwayat Kecelakaan Kerja (KK)</h5>
                    </div>
                    <div class="col pr-0">
                        <div class="float-right">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-primary">
                <table id="tableKk" class="display table-primary" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>TGL & JAM KEJADIAN</th>
                            <th>USIA</th>
                            <th>PENDIDIKAN TERAKHIR</th>
                            <th>KATEGORI </th>
                            <th>TIPE KECELAKAAN </th>
                            <th>AREA KEJADIAN</th>
                            <th>ATASAN</th>
                            <th>PENYEBAB</th>
                            <th>CIDERA</th>
                            <th>MEDICAL TREATMENT</th>
                            <th>LOST TIME INJURY</th>
                            <th>DIRUJUK</th>
                            <th>FASKES PENANGANAN</th>
                            <th>TINDAKAN RUJUK</th>
                            <th>KRONOLOGI</th>
                            <th>CATATAN</th>
                            <th>UPDATE PEMANTAUAN MEDIS</th>
                            <th>PERAWAT</th>
                            <th>LAMPIRAN</th>
                        </tr>
                    </thead>
                    <tbody class="text-uppercase">
                        <?php
                        foreach ($kk as $key) : ?>
                            <tr class="text-uppercase">

                                <td>
                                    <?= TanggalIndo($key->tgl_kejadian) . ' ' . $key->jam_kejadian . ' SHIF ' . $key->shif ?>
                                </td>
                                <td>
                                    <?= date('Y', strtotime($key->tgl_kejadian)) - date('Y', strtotime($key->tgl_lahir))  ?>
                                </td>
                                <td><?= $key->pendidikan_terakhir ?></td>
                                <td><?= $key->kategori ?></td>
                                <td><?= $key->tipe_kecelakaan ?></td>
                                <td><?= $key->area_kejadian ?></td>
                                <td><?= $key->nama_atasan ?></td>
                                <td><?= $key->penyebab_kecelakaan ?></td>
                                <td><?= $key->bagian_cidera ?></td>
                                <td><?= $key->medical_treatment ?></td>
                                <td><?= $key->lost_time_injury ?></td>
                                <td><?= $key->is_rujuk ?></td>
                                <td><?= $key->faskes_penanganan ?></td>
                                <td><?= $key->tindakan_rujuk ?></td>
                                <td><?= $key->kronologi_kejadian ?></td>
                                <td><?= $key->catatan ?></td>
                                <td><?= $key->update_pemantauan_medis ?></td>
                                <td><?= $key->nama_user ?></td>
                                <td><a href="#" type="button" onclick="showFileKk('<?= $key->file ?>')" data-toggle="tooltip" title="LIHAT FILE MCU">
                                        <i class="far fa-file-pdf  mr-1"></i> <?= $key->file ?>
                                    </a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="mt-4">
        <div class="card card-warning ">
            <div class=" card-header">
                <div class="row">
                    <div class="col-md-auto">
                        <img src="<?= base_url() . 'assets/images/mcu.png' ?>" height="50px" class="float-left d-md-none  d-sm-none d-lg-block">
                    </div>
                    <div class="col-md-auto d-flex align-items-center">
                        <h5 class=" card-title">Riwayat Medical Check Up (MCU)</h5>
                    </div>
                    <div class="col pr-0">
                        <div class="float-right">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-warning" style="display: block;">
                <table id="tableMCU" class="display table-warning" style="width: 100%;">
                    <thead>
                        <tr>

                            <th>TGL MCU</th>
                            <th>USIA</th>
                            <th>KATEGORI</th>
                            <th>KESIMPULAN</th>
                            <th>SARAN</th>
                            <th>FILE MCU</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($mcu as $key) : ?>
                            <tr>
                                <td class="text-uppercase text-sm">
                                    <?= TanggalIndo($key->tgl_mcu)  ?>
                                </td>
                                <td class="text-uppercase text-sm">
                                    <?= date('Y', strtotime($key->tgl_mcu)) - date('Y', strtotime($key->tgl_lahir))  ?>
                                </td>

                                <td class="text-uppercase text-lg">
                                    <span class="badge <?= $key->kategori_mcu == 1 ? 'badge-success' : '' ?><?= $key->kategori_mcu == 2 ? 'badge-warning' : '' ?> <?= $key->kategori_mcu == 3 ? 'badge-danger' : '' ?>">
                                        <?= $key->kategori_mcu ?>
                                    </span>
                                </td>

                                <td class="text-uppercase">
                                    <?= $key->kesimpulan ?>
                                </td>
                                <td class="text-uppercase">
                                    <?= $key->saran ?>
                                </td>
                                <td class="text-uppercase">
                                    <a href="#" type="button" onclick="showFileMCU('<?= $key->nama_lengkap ?>','<?= $key->file_mcu ?>')" data-toggle="tooltip" title="LIHAT FILE MCU">
                                        <i class="fas fa-file-pdf fa-sm"></i>
                                        <?= $key->file_mcu ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</section>
<!-- Modal PDF SKD-->
<div class="modal fade" id="modal_pdf" style="z-index : 10040 !important;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title">LAMPIRAN SKD</P>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="bodymodal_modal_pdf">
            </div>
        </div>
    </div>
</div>
<!-- End Modal PDF SKD-->
<!-- Modal PDF KK-->
<div class="modal fade" id="modal_pdf_kk" style="z-index : 10040 !important;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title">LAMPIRAN KECELAKAAN KERJA</P>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="bodymodal_modal_pdf_kk">
            </div>
        </div>
    </div>
</div>
<!-- End Modal PDF KK-->
<!-- Modal PDF MCU -->
<div class="modal fade" id="modal_pdf_mcu">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div id="nama"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="bodymodal_modal_pdf_mcu">
            </div>
        </div>
    </div>
</div>
<!-- end Modal PDF MCU-->
<script>
    $('#btn-load').hide();

    function load() {
        $('#btn-export').hide();
        $('#btn-load').show();
        setTimeout(() => {
            $('#btn-export').show();
            $('#btn-load').hide();
        }, 3000);
    }

    function showFile(file) {
        $('#modal_pdf').modal('show')
        $(`<embed type="application/pdf" src="<?= base_url("uploads/skd/") ?>${file}" width="100%" height="650"></embed>`).appendTo('#bodymodal_modal_pdf')
    }
    $('#modal_pdf').on('hidden.bs.modal', function(e) {
        $('#nama').empty()
        $('#bodymodal_modal_pdf').empty()
    });

    function showFileKk(file) {
        $('#modal_pdf_kk').modal('show')
        $(`<embed type="application/pdf" src="<?= base_url("uploads/kk/") ?>${file}" width="100%" height="650"></embed>`).appendTo('#bodymodal_modal_pdf_kk')
    }
    $('#modal_pdf_kk').on('hidden.bs.modal', function(e) {
        $('#nama').empty()
        $('#bodymodal_modal_pdf_kk').empty()
    });

    function showFileMCU(nama, file) {
        $('#modal_pdf_mcu').modal('show')
        $('<p class="text-uppercase modal-title text-bold">FILE MCU ' + nama + '</p>').appendTo('#nama')
        $(`<embed type="application/pdf" src="<?= base_url("uploads/mcu/") ?>${file}" width="100%" height="650"></embed>`).appendTo('#bodymodal_modal_pdf_mcu')
    }
    $('#modal_pdf_mcu').on('hidden.bs.modal', function(e) {
        $('#nama').empty()
        $('#bodymodal_modal_pdf_mcu').empty()
    });
</script>