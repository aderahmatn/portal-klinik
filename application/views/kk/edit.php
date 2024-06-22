<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="card">
                    <!-- card-body -->
                    <div class="card-body">
                        <section class="mx-0 content-header align-content-center rounded">
                            <div class="container-fluid title-page rounded">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3 class="mb-0 text-white font-weight-bold">UPDATE DATA KECELAKAAN KERJA</h3>
                                        <p class="mb-0 text-white font-weight-light">Update data kecelakaan kerja karyawan</p>
                                        <a href="<?= base_url('kk') ?>" class="btn btn-primary float-left mt-2">Kembali</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="float-sm-right justify-content-center">
                                            <img src="<?= base_url() . 'assets/images/kk.png' ?>" alt="Responsive image" class="img-header">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.container-fluid -->
                        </section>
                        <form role="form" method="POST" action="<?= base_url('kk/update') ?>" autocomplete="off" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                            <div class="field">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <input type="hidden" id="fidkk" name="fidkk" value="<?= encrypt_url($kk->id_kk)  ?>">
                                            <input type="hidden" id="fid_karyawan" name="fid_karyawan" value="<?= encrypt_url($kk->id_karyawan)  ?>">
                                            <label class="control-label" for="fkaryawan">Nama Karyawan</label>
                                            <div class="input-group">
                                                <input type="text" class="text-uppercase form-control <?php echo form_error('fkaryawan') ? 'is-invalid' : '' ?>" id="fkaryawan" name="fkaryawan" onfocus="onFocus()" placeholder="PILIH KARYAWAN" autocomplete="off" value="<?= $kk->nama_lengkap ?>" required>
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_karyawan"><i class="fas fa-search"></i></button>
                                                </span>
                                            </div>
                                            <span class="text-xs text-red">
                                                <?= form_error('fkaryawan') ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label class="control-label" for="fpendidikan_terakhir">Pendidikan Terakhir</label>
                                            <select class="text-uppercase form-control <?php echo form_error('fpendidikan_terakhir') ? 'is-invalid' : '' ?>" id="fpendidikan_terakhir" name="fpendidikan_terakhir">
                                                <option hidden value="" selected>Pilih pendidikan </option>
                                                <option value="SD" <?= $kk->pendidikan_terakhir == 'SD' ? 'selected' : '' ?>>SD</option>
                                                <option value="SMA/SMK" <?= $kk->pendidikan_terakhir == 'SMA/SMK' ? 'selected' : '' ?>>SMA/SMK</option>
                                                <option value="DIPLOMA (D3)" <?= $kk->pendidikan_terakhir == 'DIPLOMA (D3)' ? 'selected' : '' ?>>DIPLOMA (D3)</option>
                                                <option value="SARJANA (S1)" <?= $kk->pendidikan_terakhir == 'SARJANA (S1)' ? 'selected' : '' ?>>SARJANA (S1)</option>
                                                <option value="MAGISTER (S2)" <?= $kk->pendidikan_terakhir == 'MAGISTER (S2)' ? 'selected' : '' ?>>MAGISTER (S2)</option>
                                                <option value="DOKTORAL (S3)" <?= $kk->pendidikan_terakhir == 'DOKTORAL (S3)' ? 'selected' : '' ?>>DOKTORAL (S3)</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= form_error('fpendidikan_terakhir') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label class="control-label" for="fnama_atasan">Nama Atasan</label>
                                            <input type="text" class="text-uppercase  form-control <?= form_error('fnama_atasan') ? 'is-invalid' : '' ?>" id="fnama_atasan" name="fnama_atasan" placeholder="NAMA ATASAN" value="<?= $kk->nama_atasan ?>" required>
                                            <div class="invalid-feedback">
                                                <?= form_error('fnama_atasan') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label class="control-label" for="ftgl_kejadian">Tanggal Kejadian</label>
                                            <input type="date" class="form-control <?= form_error('ftgl_kejadian') ? 'is-invalid' : '' ?>" id="ftgl_kejadian" name="ftgl_kejadian" placeholder="TANGGAL KEJADIAN" value="<?= $kk->tgl_kejadian ?>" required>
                                            <div class="invalid-feedback">
                                                <?= form_error('ftgl_kejadian') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label class="control-label" for="fjam_kejadian">Jam Kejadian</label>
                                            <input type="time" class="form-control <?= form_error('fjam_kejadian') ? 'is-invalid' : '' ?>" id="fjam_kejadian" name="fjam_kejadian" placeholder="JAM KEJADIAN" value="<?= $kk->jam_kejadian ?>" required>
                                            <div class="invalid-feedback">
                                                <?= form_error('fjam_kejadian') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label class="control-label" for="fshif">Shift</label>
                                            <input type="text" class="form-control <?= form_error('fshif') ? 'is-invalid' : '' ?>" id="fshif" name="fshif" placeholder="SHIFT" value="<?= $kk->shif ?>" required>
                                            <div class="invalid-feedback">
                                                <?= form_error('fshif') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label class="control-label" for="farea_kejadian">Area Kejadian</label>
                                            <input type="text" class=" text-uppercase form-control <?= form_error('farea_kejadian') ? 'is-invalid' : '' ?>" id="farea_kejadian" name="farea_kejadian" placeholder="AREA KEJADIAN" value="<?= $kk->area_kejadian ?>" required>
                                            <div class="invalid-feedback">
                                                <?= form_error('farea_kejadian') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label class="control-label" for="fkategori">Kategori</label>
                                            <input type="text" class=" text-uppercase form-control <?= form_error('fkategori') ? 'is-invalid' : '' ?>" id="fkategori" name="fkategori" placeholder="KATEGORI" value="<?= $kk->kategori ?>" required>
                                            <div class="invalid-feedback">
                                                <?= form_error('fkategori') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label class="control-label" for="flost_time_injury">Lost Time Injury</label>
                                            <input type="text" class=" text-uppercase  form-control <?= form_error('flost_time_injury') ? 'is-invalid' : '' ?>" id="flost_time_injury" name="flost_time_injury" placeholder="LOST TIME INJURY" value="<?= $kk->lost_time_injury ?>" required>
                                            <div class="invalid-feedback">
                                                <?= form_error('flost_time_injury') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label class="control-label" for="fbagian_cidera">Bagian Cidera</label>
                                            <input type="text" class=" text-uppercase form-control <?= form_error('fbagian_cidera') ? 'is-invalid' : '' ?>" id="fbagian_cidera" name="fbagian_cidera" placeholder="BAGIAN CIDERA" value="<?= $kk->bagian_cidera ?>" required>
                                            <div class="invalid-feedback">
                                                <?= form_error('fbagian_cidera') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label class="control-label" for="fmedical_treatment">Medical Treatment</label>
                                            <input type="text" class="text-uppercase  form-control <?= form_error('fmedical_treatment') ? 'is-invalid' : '' ?>" id="fmedical_treatment" name="fmedical_treatment" placeholder="MEDICAL TREATMENT" value="<?= $kk->medical_treatment ?>" required>
                                            <div class="invalid-feedback">
                                                <?= form_error('fmedical_treatment') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label class="control-label" for="ftipe_kecelakaan">Tipe Kecelakaan</label>
                                            <input type="text" class="text-uppercase form-control <?= form_error('ftipe_kecelakaan') ? 'is-invalid' : '' ?>" id="ftipe_kecelakaan" name="ftipe_kecelakaan" placeholder="TIPE KECELAKAAN" value="<?= $kk->tipe_kecelakaan ?>" required>
                                            <div class="invalid-feedback">
                                                <?= form_error('ftipe_kecelakaan') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group required">
                                                    <label class="control-label" for="fpenyebab_kecelakaan">Penyebab Kecelakaan</label>
                                                    <input type="text" class="text-uppercase form-control <?= form_error('fpenyebab_kecelakaan') ? 'is-invalid' : '' ?>" id="fpenyebab_kecelakaan" name="fpenyebab_kecelakaan" placeholder="PENYEBAB KECELAKAAN" value="<?= $kk->penyebab_kecelakaan ?>" required>
                                                    <div class="invalid-feedback">
                                                        <?= form_error('fpenyebab_kecelakaan') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group required">
                                                    <label class="control-label" for="fis_rujuk">Pasien Dirujuk</label>
                                                    <select class="text-uppercase form-control <?php echo form_error('fis_rujuk') ? 'is-invalid' : '' ?>" id="fis_rujuk" name="fis_rujuk">
                                                        <option hidden value="" selected>Pilih </option>
                                                        <option value="Ya" <?= $kk->is_rujuk == 1 ? 'selected' : '' ?>>Ya</option>
                                                        <option value="Tidak" <?= $kk->is_rujuk == 0 ? 'selected' : '' ?>>Tidak</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= form_error('fis_rujuk') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group required">
                                            <label class="control-label" for="fkronologi_kejadian">Kronologi Kejadian</label>
                                            <textarea class="text-uppercase form-control <?= form_error('fkronologi_kejadian') ? 'is-invalid' : '' ?>" id="fkronologi_kejadian" name="fkronologi_kejadian" rows="5" placeholder="KRONOLOGI KEJADIAN" required><?= $kk->kronologi_kejadian ?></textarea>
                                            <div class="invalid-feedback">
                                                <?= form_error('fkronologi_kejadian') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group required">
                                                    <label class="control-label" for="ffaskes_penanganan">Faskes Penanganan</label>
                                                    <input type="text" class="text-uppercase form-control <?= form_error('ffaskes_penanganan') ? 'is-invalid' : '' ?>" id="ffaskes_penanganan" name="ffaskes_penanganan" placeholder="FASKES PENANGANAN" value="<?= $kk->faskes_penanganan ?>" required>
                                                    <div class="invalid-feedback">
                                                        <?= form_error('ffaskes_penanganan') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group required">
                                                    <label class="control-label" for="flampiran">Lampiran</label>
                                                    <a data-toggle="modal" data-target="#edit-lampiran" title="EDIT DATA" href="#" class="text-sm ml-2" onclick="editLampiran('<?= encrypt_url($kk->id_kk) ?>')">[Edit Lampiran]</a>
                                                    <p>
                                                        <a href="#" type="button" onclick="showFile('<?= $kk->file ?>')" data-toggle="tooltip" title="LIHAT FILE ">
                                                            <i class="far fa-file-pdf  mr-1"></i> <?= $kk->file ?>
                                                        </a>
                                                    </p>

                                                    <!-- <input type="file" class="form-control <?= form_error('flampiran') ? 'is-invalid' : '' ?>" id="flampiran" name="flampiran" required>
                                                    <small id="flampiran" class="form-text text-muted">Format file harus .pdf
                                                        maksimal 2Mb </small>
                                                    <div class="invalid-feedback">
                                                        <?= form_error('flampiran') ?>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="control-label" for="ftindakan_rujuk">Tindakan Rujuk</label>
                                            <textarea class="text-uppercase form-control <?= form_error('ftindakan_rujuk') ? 'is-invalid' : '' ?>" id="ftindakan_rujuk" name="ftindakan_rujuk" rows="5" placeholder="TINDAKAN RUJUK" required><?= $kk->tindakan_rujuk ?></textarea>
                                            <div class="invalid-feedback">
                                                <?= form_error('ftindakan_rujuk') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="control-label" for="fupdate_pemantauan_medis">Update Pemantauan Medis</label>
                                            <textarea class="text-uppercase form-control <?= form_error('fupdate_pemantauan_medis') ? 'is-invalid' : '' ?>" id="fupdate_pemantauan_medis" name="fupdate_pemantauan_medis" rows="5" placeholder="PEMANTAUAN MEDIS" required><?= $kk->update_pemantauan_medis ?></textarea>
                                            <div class="invalid-feedback">
                                                <?= form_error('fupdate_pemantauan_medis') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="control-label" for="fcatatan">Catatan</label>
                                    <textarea class="text-uppercase form-control <?= form_error('fcatatan') ? 'is-invalid' : '' ?>" id="fcatatan" name="fcatatan" rows="3" placeholder="CATATAN" required><?= $kk->catatan ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= form_error('fcatatan') ?>
                                    </div>
                                </div>


                            </div>
                            <button type="submit" class="btn btn-primary float-right mt-2">Simpan</button>
                            <a href="<?= base_url('kk') ?>" class="btn btn-secondary float-left mt-2">Batal</a>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
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
<!-- Modal PDF -->
<div class="modal fade" id="modal_pdf" style="z-index : 10040 !important;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title">LAMPIRAN KECELAKAAN KERJA</P>
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
<script type="text/javascript">
    function showFile(file) {
        $('#modal_pdf').modal('show')
        $(`<embed type="application/pdf" src="<?= base_url("uploads/kk/") ?>${file}" width="100%" height="650"></embed>`).appendTo('#bodymodal_modal_pdf')
    }
    $('#modal_pdf').on('hidden.bs.modal', function(e) {
        $('#nama').empty()
        $('#bodymodal_modal_pdf').empty()
    });
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            $('#fid_karyawan').val(id)
            $('#fkaryawan').val(nama.toUpperCase())
            $('#modal_karyawan').modal('hide')
        })
    })

    function editLampiran(id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('kk/edit_lampiran/'); ?>" + id,
            dataType: "html",
            success: function(response) {
                $('#body-edit-lampiran').empty();
                $('#body-edit-lampiran').append(response);
            }
        });
    }

    function onFocus() {
        $('#modal_karyawan').modal('show')
    }
</script>