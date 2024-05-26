<section class="content-header align-content-center rounded">
    <div class="container-fluid title-page rounded">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0 text-white font-weight-bold">DATA MEDICAL CHECK UP</h3>
                <p class="mb-0 text-white font-weight-light">Kelola catatan data medical check up karyawan</p>
            </div>

            <div class="col-sm-6">
                <div class=" float-sm-right justify-content-center">
                    <img src="<?= base_url() . 'assets/images/mcu.png' ?>" alt="Responsive image" class="img-header">
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data MCU</h3>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
                        <div class="form-group required">
                            <label class="control-label" for="ftgl_mcu">Tanggal MCU</label>
                            <input type="date" class="form-control <?= form_error('ftgl_mcu') ? 'is-invalid' : '' ?>" id="ftgl_mcu" name="ftgl_mcu" placeholder="Tanggal MCU" value="<?= $this->input->post('ftgl_mcu'); ?>" style="text-transform:uppercase">
                            <div class="invalid-feedback">
                                <?= form_error('ftgl_mcu') ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <input type="hidden" id="fid_karyawan" name="fid_karyawan">
                            <label class="control-label" for="fkaryawan">Nama Karyawan</label>
                            <div class="input-group ">
                                <input type="text" class="text-uppercase form-control <?php echo form_error('fkaryawan') ? 'is-invalid' : '' ?>" id="fkaryawan" name="fkaryawan" onfocus="onFocus()" placeholder="Pilih Karyawan" autocomplete="off">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-default " data-toggle="modal" data-target="#modal_karyawan"><i class="fas fa-search"></i></button>
                                </span>
                            </div>
                            <span class="text-xs text-red">
                                <?= form_error('fkaryawan') ?>
                            </span>
                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="fkesimpulan">Kesimpulan MCU</label>
                            <textarea name="fkesimpulan" class="form-control <?= form_error('fkesimpulan') ? 'is-invalid' : '' ?> text-uppercase" id="fkesimpulan" placeholder="Kesimpulan MCU" style="text-transform:uppercase"></textarea>
                            <div class="invalid-feedback">
                                <?= form_error('fkesimpulan') ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="fsaran">Saran MCU</label>
                            <textarea name="fsaran" class="form-control <?= form_error('fsaran') ? 'is-invalid' : '' ?> text-uppercase" id="fsaran" placeholder="Saran MCU" style="text-transform:uppercase"></textarea>
                            <div class="invalid-feedback">
                                <?= form_error('fsaran') ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="fkategori">Kategori MCU</label>
                            <select class="text-uppercase form-control <?php echo form_error('fkategori') ? 'is-invalid' : '' ?>" id="fkategori" name="fkategori">
                                <option hidden value="" selected>Pilih kategori </option>
                                <option value="1">[1] BAIK - FIT TO WORK</option>
                                <option value="2">[2] CUKUP - FIT WITH NOTE</option>
                                <option value="3">[3] KURANG - TEMPORARY UNFIT</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('fkategori') ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="flampiran" class="control-label">File MCU</label>
                            <input type="file" class="pb-4 form-control <?= form_error('flampiran') ? 'is-invalid' : '' ?>" id="flampiran" name="flampiran" required>
                            <small id="flampiran" class="form-text text-muted">Format file harus .pdf
                                maksimal 2Mb </small>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card ">
                <!-- card-body -->
                <div class="card-body table-responsive-sm">
                    <table id="tableMCU" class="display " style="width: 100%;">
                        <thead>
                            <tr>

                                <th>TGL MCU</th>
                                <th>KARYAWAN</th>
                                <th>L/P</th>
                                <th>TGL LAHIR</th>
                                <th>USIA</th>
                                <th>KATEGORI</th>
                                <th>OPSI</th>

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
                                        <?= $key->nama_lengkap ?>
                                    </td>
                                    <td class="text-uppercase text-sm">
                                        <?= $key->jenkel ?>
                                    </td>
                                    <td class="text-uppercase text-sm">
                                        <?= TanggalIndo($key->tgl_lahir) ?>
                                    </td>
                                    <td class="text-uppercase text-sm">
                                        <?= date('Y', strtotime($key->tgl_mcu)) - date('Y', strtotime($key->tgl_lahir))  ?>
                                    </td>

                                    <td class="text-uppercase text-lg">
                                        <span class="badge <?= $key->kategori_mcu == 1 ? 'badge-success' : '' ?><?= $key->kategori_mcu == 2 ? 'badge-warning' : '' ?> <?= $key->kategori_mcu == 3 ? 'badge-danger' : '' ?>">
                                            <?= $key->kategori_mcu ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                OPSI
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:;" data-id="<?= encrypt_url($key->id_mcu)  ?>" data-namakaryawan="<?= $key->nama_lengkap ?>" data-kesimpulan="<?= $key->kesimpulan ?>" data-saran="<?= $key->saran ?>" data-toggle="modal" data-target="#modal_detail" data-toggle="tooltip" title="LIHAT DETAIL">
                                                    <button data-toggle="modal" data-target="#ubah-data" class="dropdown-item ">
                                                        <div class="row">
                                                            <div class="col-2"><i class="fas fa-eye fa-sm"></i></div>
                                                            <div class="col">Lihat Detail</div>
                                                        </div>

                                                    </button>
                                                </a>
                                                <a href="#" type="button" onclick="showFile('<?= $key->nama_lengkap ?>','<?= $key->file_mcu ?>')" class="dropdown-item " data-toggle="tooltip" title="LIHAT FILE MCU">
                                                    <div class="row">
                                                        <div class="col-2"><i class="fas fa-file-pdf fa-sm"></i></div>
                                                        <div class="col">Lihat File MCU</div>
                                                    </div>

                                                </a>

                                                <a href="javascript:;" data-id="<?= encrypt_url($key->id_mcu)  ?>" data-tglmcu="<?= $key->tgl_mcu ?>" data-idkaryawan="<?= encrypt_url($key->id_karyawan)  ?>" data-namakaryawan="<?= $key->nama_lengkap ?>" data-kesimpulan="<?= $key->kesimpulan ?>" data-saran="<?= $key->saran ?>" data-kategori="<?= $key->kategori_mcu ?>" data-toggle="modal" data-target="#edit-data" data-toggle="tooltip" title="EDIT DATA">
                                                    <button data-toggle="modal" data-target="#ubah-data" class="dropdown-item">
                                                        <div class="row">
                                                            <div class="col-2"><i class="fas fa-edit fa-sm"></i></div>
                                                            <div class="col">Edit Data</div>
                                                        </div>
                                                    </button>
                                                </a>
                                                <a href="#" class="dropdown-item" onclick="deleteConfirm('<?= base_url() . 'mcu/delete/' . encrypt_url($key->id_mcu) ?>')" data-toggle="tooltip" title="HAPUS DATA">
                                                    <div class="row">
                                                        <div class="col-2"><i class="fas fa-trash-alt fa-sm"></i></div>
                                                        <div class="col">Hapus Data</div>
                                                    </div>

                                                </a>

                                            </div>
                                        </div>
                                    </td>
                                    <!-- <td class="text-uppercase">
                                        <?= $key->kesimpulan ?>
                                    </td>
                                    <td class="text-uppercase">
                                        <?= $key->saran ?>
                                    </td> -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- modal karyawan -->
<div class="modal fade" id="modal_karyawan">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title text-bold">PILIH KARYAWAN</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="bodymodal_modal_project">
                <div class="card-body table-responsive-xs">
                    <table id="tableUSer" class="display nowrap text-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>PILIH</th>
                                <th>NIK</th>
                                <th>NAMA</th>
                                <th>TGL LAHIR</th>
                                <th>USIA</th>
                                <th>BPJS</th>
                                <th>PERUSAHAAN</th>
                                <th>DIVISI</th>
                                <th>DEPT</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($karyawan as $key) : ?>
                                <tr class="text-uppercase">
                                    <td style="width: 5px;"><button class="btn btn-primary btn-sm" id="select" data-id="<?= encrypt_url($key->id_karyawan)  ?>" data-nama="<?= $key->nama_lengkap ?>">
                                            <i class="fa fa-check"></i> Pilih
                                        </button>
                                    </td>

                                    <td>
                                        <?= strtoupper($key->nik) ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->nama_lengkap) ?>
                                    </td>
                                    <td>
                                        <?= TanggalIndo($key->tgl_lahir)  ?>
                                    </td>
                                    <td>
                                        <?= date('Y') - date('Y', strtotime($key->tgl_lahir))  ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->bpjs) ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->perusahaan)  ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->nama_divisi)  ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->nama_departemen)  ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->status)  ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal karyawan -->

<div class="modal fade" id="modal_pdf">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div id="nama"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="bodymodal_modal_pdf">
            </div>
        </div>
    </div>
</div>
<!--Delete Confirmation-->
<div class="modal fade" id="deleteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-3 d-flex justify-content-center">
                        <i class="fa  fa-exclamation-triangle" style="font-size: 70px; color:red;"></i>
                    </div>
                    <div class="col-9 pt-2">
                        <h5>Apakah anda yakin?</h5>
                        <span>Data yang dihapus tidak akan bisa dikembalikan.</span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal"> Batal</button>
                <a id="btn-delete" class="btn btn-danger" href="#"> Hapus</a>
            </div>
        </div>
    </div>
</div>
<!-- END Delete Confirm -->
<!-- modal karyawan (edit) -->
<div class="modal fade" id="modal_karyawan_edit" style="z-index : 10040 !important;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title text-bold">PILIH KARYAWAN</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="bodymodal_modal_project">
                <div class="card-body table-responsive-xs">
                    <table id="tableKaryawan" class="display nowrap text-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>PILIH</th>
                                <th>NIK</th>
                                <th>NAMA</th>
                                <th>TGL LAHIR</th>
                                <th>USIA</th>
                                <th>BPJS</th>
                                <th>PERUSAHAAN</th>
                                <th>DIVISI</th>
                                <th>DEPT</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($karyawan as $key) : ?>
                                <tr class="text-uppercase">
                                    <td style="width: 5px;"><button class="btn btn-primary btn-sm" id="selectedit" data-id="<?= encrypt_url($key->id_karyawan)  ?>" data-nama="<?= $key->nama_lengkap ?>">
                                            <i class="fa fa-check"></i> Pilih
                                        </button>
                                    </td>

                                    <td>
                                        <?= strtoupper($key->nik) ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->nama_lengkap) ?>
                                    </td>
                                    <td>
                                        <?= TanggalIndo($key->tgl_lahir)  ?>
                                    </td>
                                    <td>
                                        <?= date('Y') - date('Y', strtotime($key->tgl_lahir))  ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->bpjs) ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->perusahaan)  ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->nama_divisi)  ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->nama_departemen)  ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->status)  ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal karyawan (edit)-->
<!-- Modal Ubah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="edit-data" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title">EDIT DATA MCU</P>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <form class="form-horizontal" action="<?= base_url('mcu/update_mcu') ?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <input type="hidden" id="fid_mcu" name="fid_mcu" value="<?= $this->input->post('fid_mcu'); ?>">
                    <div class="form-group required">
                        <label class="control-label" for="ftgl_mcu">Tanggal MCU</label>
                        <input type="date" class="form-control <?= form_error('ftgl_mcu') ? 'is-invalid' : '' ?>" id="ftgl_mcu" name="ftgl_mcu" placeholder="Tanggal MCU" value="<?= $this->input->post('ftgl_mcu'); ?>" style="text-transform:uppercase">
                        <div class="invalid-feedback">
                            <?= form_error('ftgl_mcu') ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <input type="hidden" id="fid_karyawan_edit" name="fid_karyawan_edit">
                        <label class="control-label" for="fkaryawan_edit">Nama Karyawan</label>
                        <div class="input-group ">
                            <input type="text" class="text-uppercase form-control <?php echo form_error('fkaryawan_edit') ? 'is-invalid' : '' ?>" id="fkaryawan_edit" name="fkaryawan_edit" onfocus="onFocusEdit()" placeholder="Pilih Karyawan" autocomplete="off">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-default " data-toggle="modal" data-target="#modal_karyawan_edit"><i class="fas fa-search"></i></button>
                            </span>
                        </div>
                        <span class="text-xs text-red">
                            <?= form_error('fkaryawan_edit') ?>
                        </span>
                    </div>
                    <div class="form-group required">
                        <label class="control-label" for="fkesimpulan">Kesimpulan MCU</label>
                        <textarea name="fkesimpulan" class="form-control <?= form_error('fkesimpulan') ? 'is-invalid' : '' ?> text-uppercase" id="fkesimpulan" placeholder="Kesimpulan MCU" style="text-transform:uppercase"></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('fkesimpulan') ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label" for="fsaran">Saran MCU</label>
                        <textarea name="fsaran" class="form-control <?= form_error('fsaran') ? 'is-invalid' : '' ?> text-uppercase" id="fsaran" placeholder="Saran MCU" style="text-transform:uppercase"></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('fsaran') ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label" for="fkategori">Kategori MCU</label>
                        <select class="text-uppercase form-control <?php echo form_error('fkategori') ? 'is-invalid' : '' ?>" id="fkategori" name="fkategori">
                            <option hidden value="" selected>Pilih kategori </option>
                            <option value="1">[1] BAIK - FIT TO WORK</option>
                            <option value="2">[2] CUKUP - FIT WITH NOTE</option>
                            <option value="3">[3] KURANG - TEMPORARY UNFIT</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= form_error('fkategori') ?>
                        </div>
                    </div>
                    <a href="">Ganti file MCU</a>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal"> Batal</button>
                        <button id="btn-delete" class="btn btn-primary" type="submit"> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Modal Ubah -->
<!-- Modal detail -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="modal_detail" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title text-uppercase">DETAIL DATA MCU | </P>
                <P class="modal-title text-uppercase" id="nama_detail"></P>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <strong>KESIMPULAN</strong>
                    <p class="text-muted" id="kesimpulan">

                    </p>
                    <hr>
                    <strong>SARAN</strong>
                    <p class="text-muted" id="saran"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Modal detail -->

<script type="text/javascript">
    function onFocus() {
        $('#modal_karyawan').modal('show')
    }

    function onFocusEdit() {
        $('#modal_karyawan_edit').modal('show')
    }


    function showFile(nama, file) {
        $('#modal_pdf').modal('show')
        $('<p class="text-uppercase modal-title text-bold">FILE MCU ' + nama + '</p>').appendTo('#nama')
        $(`<embed type="application/pdf" src="<?= base_url("uploads/mcu/") ?>${file}" width="100%" height="650"></embed>`).appendTo('#bodymodal_modal_pdf')
    }
    $('#modal_pdf').on('hidden.bs.modal', function(e) {
        $('#nama').empty()
        $('#bodymodal_modal_pdf').empty()
    });


    $(document).on('click', '#select', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        $('#fid_karyawan').val(id)
        $('#fkaryawan').val(nama.toUpperCase())
        $('#modal_karyawan').modal('hide')
    })
    $(document).on('click', '#selectedit', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        $('#fid_karyawan_edit').val(id)
        $('#fkaryawan_edit').val(nama.toUpperCase())
        $('#modal_karyawan_edit').modal('hide')
    })

    $(document).ready(function() {
        // Untuk sunting
        $('#edit-data').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            modal.find('#fkaryawan_edit').val(div.data('namakaryawan'));
            modal.find('#fid_karyawan_edit').val(div.data('idkaryawan'));
            modal.find('#ftgl_mcu').val(div.data('tglmcu'));
            modal.find('#fid_mcu').val(div.data('id'));
            modal.find('#fkesimpulan').val(div.data('kesimpulan'));
            modal.find('#fsaran').val(div.data('saran'));
            modal.find('#fkategori').val(div.data('kategori'));
        });
        $('#modal_detail').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            modal.find('#nama_detail').append(div.data('namakaryawan'));
            modal.find('#saran').append(div.data('saran'));
            modal.find('#kesimpulan').append(div.data('kesimpulan'));

        });
    });
    $('#modal_detail').on('hidden.bs.modal', function(e) {
        $('#nama_detail').empty()
        $('#saran').empty()
        $('#kesimpulan').empty()
    });

    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>