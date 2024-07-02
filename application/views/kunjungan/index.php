<section class="content-header align-content-center rounded">
    <div class="container-fluid title-page rounded">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0 text-white font-weight-bold">DATA KUNJUNGAN</h3>
                <p class="mb-0 text-white font-weight-light">Kelola data kunjungan klinik</p>
                <a class="btn btn-md btn-primary mt-2" href="<?= base_url('kunjungan/create') ?>">TAMBAH KUNJUNGAN</a>
                <a class="btn btn-md btn-success mt-2" href="javascript:;" onclick="exportXls()" data-toggle="modal" data-target="#modal_xls" data-toggle="tooltip" title="EXPORT SPREADSHEET">EXPORT SPREADSHEET</a>

            </div>
            <div class="col-sm-6">
                <div class=" float-sm-right justify-content-center">
                    <img src="<?= base_url() . 'assets/images/kunjungan.png' ?>" alt="Responsive image" class="img-header">

                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <!-- card-body -->
                <div class="card-body table-responsive-sm ">

                    <table id="tableUSer" class="display nowrap " style="width:100%">
                        <thead>
                            <tr>
                                <th>TGL & JAM</th>
                                <th>NAMA</th>
                                <th>L/P</th>
                                <th>TGL LAHIR</th>
                                <th>USIA</th>
                                <th>PERUSAHAAN</th>
                                <th>DIVISI</th>
                                <th>DEPT</th>
                                <th>BAGIAN</th>
                                <th>STATUS</th>
                                <th>CATATAN</th>
                                <th>ANAMNESA</th>
                                <th>DIAGNOSA</th>
                                <th>OPSI</th>
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
                                        <?= $key->nama_lengkap ?>
                                    </td>
                                    <td>
                                        <?= $key->jenkel ?>
                                    </td>
                                    <td>
                                        <?= TanggalIndo($key->tgl_lahir)  ?>
                                    </td>
                                    <td>
                                        <?= date('Y', strtotime($key->tgl_kunjungan)) - date('Y', strtotime($key->tgl_lahir))  ?>
                                    </td>
                                    <td>
                                        <?= $key->perusahaan ?>
                                    </td>
                                    <td>
                                        <?= $key->nama_divisi ?>
                                    </td>
                                    <td>
                                        <?= $key->nama_departemen ?>
                                    </td>
                                    <td>
                                        <?= $key->bagian ?>
                                    </td>
                                    <td>
                                        <?= $key->status ?>
                                    </td>
                                    <td>
                                        <?= $key->catatan_kunjungan ?>
                                    </td>
                                    <td>
                                        <?= $key->anamnesa ?>
                                    </td>
                                    <td>
                                        <?= get_diagnosa_kunjungan_by_id_kunjungan($key->id_kunjungan) ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                OPSI
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:;" onclick="getDetail('<?= encrypt_url($key->id_kunjungan) ?>')" data-toggle="modal" data-target="#modal_detail" data-toggle="tooltip" title="LIHAT DETAIL">
                                                    <button data-toggle="modal" data-target="#ubah-data" class="dropdown-item ">
                                                        <div class="row">
                                                            <div class="col-2"><i class="fas fa-eye fa-sm"></i></div>
                                                            <div class="col">Lihat Detail</div>
                                                        </div>

                                                    </button>
                                                </a>
                                                <a href="javascript:;" data-id="<?= encrypt_url($key->id_kunjungan)  ?>" data-tgl="<?= $key->tgl_kunjungan ?>" data-idkaryawan="<?= encrypt_url($key->id_karyawan)  ?>" data-namakaryawan="<?= $key->nama_lengkap ?>" data-jam="<?= $key->jam_kunjungan ?>" data-anamnesa="<?= $key->anamnesa ?>" data-catatan="<?= $key->catatan_kunjungan ?>" data-teraphy="<?= $key->teraphy ?>" data-diagnosa='<?= get_diagnosa_kunjungan_by_id_kunjungan($key->id_kunjungan) ?>' data-obat='<?= get_obat_kunjungan_by_id_kunjungan($key->id_kunjungan) ?>' data-toggle="modal" data-target="#edit-data" data-toggle="tooltip" title="EDIT DATA">
                                                    <button data-toggle="modal" data-target="#ubah-data" class="dropdown-item">
                                                        <div class="row">
                                                            <div class="col-2"><i class="fas fa-edit fa-sm"></i></div>
                                                            <div class="col">Edit Data</div>
                                                        </div>
                                                    </button>
                                                </a>
                                                <a href="#" class="dropdown-item" onclick="deleteConfirm('<?= base_url() . 'kunjungan/delete/' . encrypt_url($key->id_kunjungan) ?>')" data-toggle="tooltip" title="HAPUS DATA">
                                                    <div class="row">
                                                        <div class="col-2"><i class="fas fa-trash-alt fa-sm"></i></div>
                                                        <div class="col text-capitalize">Hapus Data</div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

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
<!-- Delete Confirm -->

<!-- Modal detail -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="modal_detail" class="modal fade  ">
    <div class="modal-dialog modal-lg bg-primary">
        <div class="modal-content">
            <div class="modal-body p-0" id="bodymodal_Detail">
            </div>
        </div>
    </div>
</div>
<!-- END Modal detail -->

<!-- Modal Ubah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="edit-data" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title">EDIT DATA KUNJUNGAN</P>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <form class="form-horizontal" action="<?= base_url('kunjungan/update_kunjungan') ?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <input type="hidden" id="fid_kunjungan" name="fid_kunjungan" value="<?= $this->input->post('fid_kunjungan'); ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label class="control-label" for="ftgl_kunjungan">Tanggal Kunjungan</label>
                                <input type="date" class="form-control <?= form_error('ftgl_kunjungan') ? 'is-invalid' : '' ?>" id="ftgl_kunjungan" name="ftgl_kunjungan" placeholder="Tanggal kunjungan" value="<?= date('Y') . '-' . date('m') . '-' . date('d') ?>" required>
                                <div class="invalid-feedback">
                                    <?= form_error('ftgl_kunjungan') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label class="control-label" for="fjam_kunjungan">Jam Kunjungan</label>
                                <input type="time" class="form-control <?= form_error('fjam_kunjungan') ? 'is-invalid' : '' ?>" id="fjam_kunjungan" name="fjam_kunjungan" placeholder="Jam kunjungan" value="<?= date('H') . ':' . date('m')   ?>" required>
                                <div class="invalid-feedback">
                                    <?= form_error('fjam_kunjungan') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group required">
                        <input type="hidden" id="fid_karyawan" name="fid_karyawan" value="<?= $this->input->post('fid_karyawan') ?>">
                        <label class="control-label" for="fkaryawan">Nama Karyawan</label>
                        <div class="input-group ">
                            <input type="text" class="text-uppercase form-control <?php echo form_error('fkaryawan') ? 'is-invalid' : '' ?>" id="fkaryawan" name="fkaryawan" onfocus="onFocus()" placeholder="Pilih Karyawan" autocomplete="off" value="<?= $this->input->post('fkaryawan') ?>" required>
                            <span class="input-group-append">
                                <button type="button" class="btn btn-default " data-toggle="modal" data-target="#modal_karyawan"><i class="fas fa-search"></i></button>
                            </span>
                        </div>
                        <span class="text-xs text-red">
                            <?= form_error('fkaryawan') ?>
                        </span>
                    </div>
                    <div class="form-group required">
                        <label class="control-label" for="fanamnesa">Anamnesa</label>
                        <input type="text" class="text-uppercase form-control <?= form_error('fanamnesa') ? 'is-invalid' : '' ?>" id="fanamnesa" name="fanamnesa" placeholder="Anamnesa" value="<?= $this->input->post('fanamnesa'); ?>" required>
                        <div class="invalid-feedback">
                            <?= form_error('fanamnesa') ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label" for="fcatatan_kunjungan">Catatan Kunjungan</label>
                        <textarea name="fcatatan_kunjungan" class="form-control <?= form_error('fcatatan_kunjungan') ? 'is-invalid' : '' ?> text-uppercase" id="fcatatan_kunjungan" placeholder="Catatan" style="text-transform:uppercase" required><?= $this->input->post('fcatatan_kunjungan'); ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('fcatatan_kunjungan') ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label" for="ftheraphy">Teraphy Fisik</label>
                        <textarea name="ftheraphy" class="form-control <?= form_error('ftheraphy') ? 'is-invalid' : '' ?> text-uppercase" id="ftheraphy" placeholder="Therapy Fisik" style="text-transform:uppercase"></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('ftheraphy') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="diagnosa">Teraphy Obat </label> <a id="link-obat" data-toggle="modal" data-target="#edit-obat" data-toggle="tooltip" title="EDIT DATA" href="#" class="text-sm float-right"><i class="fas fa-edit fa-sm"></i> Edit Teraphy Obat</a>
                        <div id="obat" class="text-uppercase"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="diagnosa">Diagnosa </label><a id="link-diagnosa" data-toggle="modal" data-target="#edit-diagnosa" data-toggle="tooltip" title="EDIT DATA" href="#" class="text-sm float-right"><i class="fas fa-edit fa-sm"></i> Edit Diagnosa</a>
                        <div id="diagnosa" class="text-uppercase"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal"> Batal</button>
                    <button id="btn-delete" class="btn btn-primary" type="submit"> Simpan</button>
                </div>
        </div>
    </div>
    </form>
</div>
</div>
<!-- END Modal Ubah -->
<!-- Modal edit diagnosa -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="edit-diagnosa" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title">LIST DIAGNOSA KUNJUNGAN</P>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>

            <div class="modal-body " id="body-edit-diagnosa">

            </div>
        </div>
    </div>
</div>
<!-- END Modal edit diagnosa -->
<!-- Modal edit obat -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="edit-obat" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title">LIST TERAPHY OBAT</P>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>

            <div class="modal-body " id="body-edit-obat">

            </div>
        </div>
    </div>
</div>
<!-- END Modal edit obat -->
<!-- Modal export xls -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="modal_xls" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title">EXPORT SPREADSHEET</P>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>

            <div class="modal-body " id="body-xls">

            </div>
        </div>
    </div>
</div>
<!-- END Modal export xls -->
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
<script type="text/javascript">
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
    $(document).ready(function() {
        $('#edit-data').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            var id = div.data('id');
            modal.find('#fid_karyawan').val(div.data('idkaryawan'));
            modal.find('#fid_kunjungan').val(div.data('id'));
            modal.find('#fkaryawan').val(div.data('namakaryawan'));
            modal.find('#fanamnesa').val(div.data('anamnesa'));
            modal.find('#fjam_kunjungan').val(div.data('jam'));
            modal.find('#ftgl_kunjungan').val(div.data('tgl'));
            modal.find('#fcatatan_kunjungan').val(div.data('catatan'));
            modal.find('#ftheraphy').val(div.data('teraphy'));
            modal.find('#diagnosa').html(div.data('diagnosa'));
            modal.find('#obat').html(div.data('obat'));
            modal.find('#link-diagnosa').attr('onclick', `editDiagnosa('${id}')`);
            modal.find('#link-obat').attr('onclick', `editObat('${id}')`);


        });
        $(document).on('click', '#select', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            $('#fid_karyawan').val(id)
            $('#fkaryawan').val(nama.toUpperCase())
            $('#modal_karyawan').modal('hide')
        })
    });

    function onFocus() {
        $('#modal_karyawan').modal('show')
    }

    function getDetail(id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('kunjungan/detail/'); ?>" + id,
            dataType: "html",
            success: function(response) {
                $('#bodymodal_Detail').empty();
                $('#bodymodal_Detail').append(response);
            }
        });
    }

    function exportXls() {
        $.ajax({
            type: "get",
            url: "<?= site_url('kunjungan/filter_xls/'); ?>",
            dataType: "html",
            success: function(response) {
                $('#body-xls').empty();
                $('#body-xls').append(response);
            }
        });
    }

    function editDiagnosa(idkunjungan) {
        $.ajax({
            type: "get",
            url: "<?= site_url('kunjungan/edit_diagnosa/'); ?>" + idkunjungan,
            dataType: "html",
            success: function(response) {
                $('#body-edit-diagnosa').empty();
                $('#body-edit-diagnosa').append(response);
            }
        });
    }

    function editObat(idkunjungan) {
        $.ajax({
            type: "get",
            url: "<?= site_url('kunjungan/edit_obat/'); ?>" + idkunjungan,
            dataType: "html",
            success: function(response) {
                $('#body-edit-obat').empty();
                $('#body-edit-obat').append(response);
            }
        });
    }
</script>