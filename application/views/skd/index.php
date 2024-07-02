<section class="content-header align-content-center rounded">
    <div class="container-fluid title-page rounded">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0 text-white font-weight-bold">DATA SURAT KETERANGAN DOKTER</h3>
                <p class="mb-0 text-white font-weight-light">Kelola data surat keterangan dokter</p>
                <a class="btn btn-md btn-primary mt-2" href="<?= base_url('skd/create') ?>">INPUT DATA SKD</a>
                <a class="btn btn-md btn-success mt-2" href="javascript:;" onclick="exportXls()" data-toggle="modal" data-target="#modal_xls" data-toggle="tooltip" title="EXPORT SPREADSHEET">EXPORT SPREADSHEET</a>
            </div>
            <div class="col-sm-6">
                <div class=" float-sm-right justify-content-center">
                    <img src="<?= base_url() . 'assets/images/skd.png' ?>" alt="Responsive image" class="img-header">

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
                                <th>TGL PENYERAHAN</th>
                                <th>NAMA</th>
                                <th>NIK</th>
                                <th>L/P</th>
                                <th>TGL LAHIR</th>
                                <th>USIA</th>
                                <th>PERUSAHAAN</th>
                                <th>DIVISI</th>
                                <th>DEPT</th>
                                <th>BAGIAN</th>
                                <th>STATUS</th>
                                <th>TGL SKD</th>
                                <th>PEMBAYARAN</th>
                                <th>FASKES</th>
                                <th>STATUS SKD</th>
                                <th>DIAGNOSA</th>
                                <th>CATATAN</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>
                        <tbody class="text-uppercase">
                            <?php
                            foreach ($skd as $key) : ?>
                                <tr class="text-uppercase">

                                    <td>
                                        <?= TanggalIndo($key->tgl_penyerahan)  ?>
                                    </td>
                                    <td>
                                        <?= $key->nama_lengkap ?>
                                    </td>
                                    <td>
                                        <?= $key->nik ?>
                                    </td>
                                    <td>
                                        <?= $key->jenkel ?>
                                    </td>
                                    <td>
                                        <?= TanggalIndo($key->tgl_lahir)  ?>
                                    </td>
                                    <td>
                                        <?= date('Y', strtotime($key->tgl_mulai_skd)) - date('Y', strtotime($key->tgl_lahir))  ?>
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
                                        <?= TanggalIndo($key->tgl_mulai_skd) . ' - ' . TanggalIndo($key->tgl_akhir_skd) ?> (<?= $key->jumlah_hari ?> Hari)
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
                                        <?= $key->catatan_skd ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                OPSI
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:;" onclick="getDetail('<?= encrypt_url($key->id_skd) ?>')" data-toggle="modal" data-target="#modal_detail" data-toggle="tooltip" title="LIHAT DETAIL">
                                                    <button data-toggle="modal" data-target="#ubah-data" class="dropdown-item ">
                                                        <div class="row">
                                                            <div class="col-2"><i class="fas fa-eye fa-sm"></i></div>
                                                            <div class="col">Lihat Detail</div>
                                                        </div>

                                                    </button>
                                                </a>
                                                <a href="javascript:;" data-id="<?= encrypt_url($key->id_skd)  ?>" data-tglmulai="<?= $key->tgl_mulai_skd ?>" data-tglakhir="<?= $key->tgl_akhir_skd ?>" data-tglpenyerahan="<?= $key->tgl_penyerahan ?>" data-jumlah="<?= $key->jumlah_hari ?>" data-pembayaran="<?= $key->pembayaran ?>" data-idkaryawan="<?= encrypt_url($key->id_karyawan) ?>" data-namakaryawan="<?= $key->nama_lengkap ?>" data-namakaryawan="<?= $key->nama_lengkap ?>" data-penyakit="<?= $key->jenis_penyakit ?>" data-note="<?= $key->catatan_skd ?>" data-lampiran="<?= $key->lampiran ?>" data-status="<?= $key->status_skd ?>" data-faskes="<?= $key->faskes ?>" data-catatan="<?= $key->catatan_skd ?>" data-diagnosa='<?= get_diagnosa_skd_by_id_skd($key->id_skd) ?>' data-toggle="modal" data-target="#edit-data" data-toggle="tooltip" title="EDIT DATA">
                                                    <button data-toggle="modal" data-target="#ubah-data" class="dropdown-item">
                                                        <div class="row">
                                                            <div class="col-2"><i class="fas fa-edit fa-sm"></i></div>
                                                            <div class="col">Edit Data</div>
                                                        </div>
                                                    </button>
                                                </a>
                                                <a href="#" class="dropdown-item" onclick="deleteConfirm('<?= base_url() . 'skd/delete/' . encrypt_url($key->id_skd) ?>')" data-toggle="tooltip" title="HAPUS DATA">
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title">EDIT DATA SKD</P>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <form class="form-horizontal" action="<?= base_url('skd/update_skd') ?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <input type="hidden" id="fid_skd" name="fid_skd" value="<?= $this->input->post('fid_skd'); ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label class="control-label" for="ftgl_penyerahan">Tanggal Penyerahan SKD</label>
                                <input type="date" class="form-control <?= form_error('ftgl_penyerahan') ? 'is-invalid' : '' ?>" id="ftgl_penyerahan" name="ftgl_penyerahan" placeholder="Tanggal penyerahan" value="<?= date('Y') . '-' . date('m') . '-' . date('d') ?>" required>
                                <div class="invalid-feedback">
                                    <?= form_error('ftgl_penyerahan') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group required">
                                <label class="control-label" for="ftgl_mulai_skd">Tanggal Mulai SKD</label>
                                <input type="date" class="form-control <?= form_error('ftgl_mulai_skd') ? 'is-invalid' : '' ?>" id="ftgl_mulai_skd" name="ftgl_mulai_skd" placeholder="Tanggal skd" value="<?= $this->input->post('ftgl_mulai_skd') ?>" required>
                                <div class="invalid-feedback">
                                    <?= form_error('ftgl_mulai_skd') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group required">
                                <label class="control-label" for="ftgl_akhir_skd">Tanggal Akhir SKD</label>
                                <input type="date" class="form-control <?= form_error('ftgl_akhir_skd') ? 'is-invalid' : '' ?>" id="ftgl_akhir_skd" name="ftgl_akhir_skd" placeholder="Tanggal skd" value="<?= $this->input->post('ftgl_akhir_skd') ?>" required>
                                <div class="invalid-feedback">
                                    <?= form_error('ftgl_akhir_skd') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group required">
                                <label class="control-label" for="fjumlah_hari_skd">Jumlah Hari SKD</label>
                                <input type="number" class="form-control <?= form_error('fjumlah_hari_skd') ? 'is-invalid' : '' ?>" id="fjumlah_hari_skd" name="fjumlah_hari_skd" placeholder="JUMLAH HARI SKD" value="<?= $this->input->post('fjumlah_hari_skd') ?>" min="1" required>
                                <div class="invalid-feedback">
                                    <?= form_error('fjumlah_hari_skd') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group required">
                                <label class="control-label" for="ffaskes">Nama Fasilitas Kesehatan</label>
                                <input type="text" class="text-uppercase form-control <?= form_error('ffaskes') ? 'is-invalid' : '' ?>" id="ffaskes" name="ffaskes" placeholder="NAMA FASKES" value="<?= $this->input->post('ffaskes') ?>" required>
                                <div class="invalid-feedback">
                                    <?= form_error('ffaskes') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group required">
                                <label class="control-label" for="fpembayaran">Pembayaran Berobat</label>
                                <select class="form-control  <?php echo form_error('fpembayaran') ? 'is-invalid' : '' ?>" id="fpembayaran" name="fpembayaran" required>
                                    <option hidden value="" selected>PILIH PEMBAYARAN</option>
                                    <option value="BPJS" <?= $this->input->post('fpembayaran') == 'BPJS' ? 'selected' : '' ?>>BPJS</option>
                                    <option value="BPJS TK" <?= $this->input->post('fpembayaran') == 'BPJS TK' ? 'selected' : '' ?>>BPJS TK</option>
                                    <option value="NON BPJS" <?= $this->input->post('fpembayaran') == 'NON BPJS' ? 'selected' : '' ?>>NON BPJS</option>
                                    <option value="ASURANSI" <?= $this->input->post('fpembayaran') == 'ASURANSI' ? 'selected' : '' ?>>ASURANSI</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('fpembayaran') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group required">
                                <label class="control-label" for="fstatus_skd">Status SKD</label>
                                <select class="form-control  <?php echo form_error('fstatus_skd') ? 'is-invalid' : '' ?>" id="fstatus_skd" name="fstatus_skd" required>
                                    <option hidden value="" selected>PILIH STATUS</option>
                                    <option value="ACC">ACC</option>
                                    <option value="TIDAK ACC">TIDAK ACC</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('fstatus_skd') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label class="control-label" for="fjenis_penyakit">Anamnesa</label>
                                <textarea name="fjenis_penyakit" class="form-control <?= form_error('fjenis_penyakit') ? 'is-invalid' : '' ?> text-uppercase" id="fjenis_penyakit" placeholder="Anamnesa" style="text-transform:uppercase" required><?= $this->input->post('fjenis_penyakit'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('fjenis_penyakit') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="control-label" for="fcatatan_skd">Catatan SKD</label>
                                <textarea name="fcatatan_skd" class="form-control <?= form_error('fcatatan_skd') ? 'is-invalid' : '' ?> text-uppercase" id="fcatatan_skd" placeholder="Catatan" style="text-transform:uppercase"><?= $this->input->post('fcatatan_skd'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('fcatatan_skd') ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="diagnosa">Diagnosa </label><a id="link-diagnosa" data-toggle="modal" data-target="#edit-diagnosa" data-toggle="tooltip" title="EDIT DATA" href="#" class="text-sm ml-2">[Edit Diagnosa]</a>
                                <div id="diagnosa" class="text-uppercase"></div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">

                                <label class="control-label" for="diagnosa">Lampiran </label><a id="link-lampiran" data-toggle="modal" data-target="#edit-lampiran" data-toggle="tooltip" title="EDIT DATA" href="#" class="text-sm ml-2">[Edit Lampiran]</a>
                                <div id='lampiran'></div>

                            </div>
                        </div>
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
<!-- END Modal Ubah -->
<!-- Modal edit diagnosa -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="edit-diagnosa" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title">LIST DIAGNOSA SKD</P>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>

            <div class="modal-body " id="body-edit-diagnosa">

            </div>
        </div>
    </div>
</div>
<!-- END Modal edit diagnosa -->
<!-- Modal edit lampiran -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="edit-lampiran" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title">EDIT LAMPIRAN </P>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>

            <div class="modal-body " id="body-edit-lampiran">

            </div>
        </div>
    </div>
</div>
<!-- END Modal edit lampiran -->
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
<!-- Modal PDF -->
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
<!-- End Modal PDF -->
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
<script type="text/javascript">
    function showFile(file) {
        $('#modal_pdf').modal('show')
        $(`<embed type="application/pdf" src="<?= base_url("uploads/skd/") ?>${file}" width="100%" height="650"></embed>`).appendTo('#bodymodal_modal_pdf')
    }
    $('#modal_pdf').on('hidden.bs.modal', function(e) {
        $('#nama').empty()
        $('#bodymodal_modal_pdf').empty()
    });

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
            modal.find('#fid_skd').val(div.data('id'));
            modal.find('#fkaryawan').val(div.data('namakaryawan'));
            modal.find('#ftgl_mulai_skd').val(div.data('tglmulai'));
            modal.find('#ftgl_akhir_skd').val(div.data('tglakhir'));
            modal.find('#ftgl_penyerahan').val(div.data('tglpenyerahan'));
            modal.find('#ffaskes').val(div.data('faskes'));
            modal.find('#fjumlah_hari_skd').val(div.data('jumlah'));
            modal.find('#fpembayaran').val(div.data('pembayaran'));
            modal.find('#fjenis_penyakit').val(div.data('penyakit'));
            modal.find('#fcatatan_skd').val(div.data('note'));
            modal.find('#fstatus_skd').val(div.data('status'));
            modal.find('#diagnosa').html(div.data('diagnosa'));
            modal.find('#lampiran').html(`<a href="#" type="button" onclick="showFile('${div.data('lampiran')}')" data-toggle="tooltip" title="LIHAT FILE MCU">
                <i class="far fa-file-pdf  mr-1"></i> ${div.data('lampiran')}
            </a>`);
            modal.find('#link-diagnosa').attr('onclick', `editDiagnosa('${id}')`);
            modal.find('#link-lampiran').attr('onclick', `editLampiran('${id}')`);

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
            url: "<?= site_url('skd/detail/'); ?>" + id,
            dataType: "html",
            success: function(response) {
                $('#bodymodal_Detail').empty();
                $('#bodymodal_Detail').append(response);
            }
        });
    }

    function daysBetween(first, second) {

        var newDate = Date.now() + -5 * 24 * 3600 * 1000;

        // Copy date parts of the timestamps, discarding the time parts.
        var one = new Date(first[0], first[1], first[2]);
        var two = new Date(second[0], second[1], second[2]);

        // // Do the math.
        var millisecondsPerDay = 1000 * 60 * 60 * 24;
        var millisBetween = two.getTime() - one.getTime();
        var days = millisBetween / millisecondsPerDay;

        // Round down.
        return Math.floor(days);
    }

    $('#ftgl_akhir_skd').blur(function() {
        var start = $('#ftgl_mulai_skd').val().split('-');
        var end = $('#ftgl_akhir_skd').val().split('-');
        console.log(daysBetween(start, end))
        $('#fjumlah_hari_skd').val(daysBetween(start, end))
    })



    function editDiagnosa(idSkd) {
        $.ajax({
            type: "get",
            url: "<?= site_url('skd/edit_diagnosa/'); ?>" + idSkd,
            dataType: "html",
            success: function(response) {
                $('#body-edit-diagnosa').empty();
                $('#body-edit-diagnosa').append(response);
            }
        });
    }

    function editLampiran(idSkd) {
        $.ajax({
            type: "get",
            url: "<?= site_url('skd/edit_lampiran/'); ?>" + idSkd,
            dataType: "html",
            success: function(response) {
                $('#body-edit-lampiran').empty();
                $('#body-edit-lampiran').append(response);
            }
        });
    }

    function exportXls() {
        $.ajax({
            type: "get",
            url: "<?= site_url('skd/filter_xls/'); ?>",
            dataType: "html",
            success: function(response) {
                $('#body-xls').empty();
                $('#body-xls').append(response);
            }
        });
    }
</script>