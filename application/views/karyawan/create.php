<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="mt-2">TAMBAH KARYAWAN</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <div class="card ">
                    <!-- card-body -->
                    <div class="card-body">
                        <form role="form" method="POST" action="" autocomplete="off">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                            <div class="form-group required">
                                <label class="control-label" for="fnik">NIK</label>
                                <input type="text" class="form-control <?= form_error('fnik') ? 'is-invalid' : '' ?>" id="fnik" name="fnik" placeholder="NIK" value="<?= $this->input->post('fnik'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fnik') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fnama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" placeholder="Nama lengkap" value="<?= $this->input->post('fnama_lengkap'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fnama_lengkap') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fjenkel">Jenis Kelamin</label>
                                <select class="form-control <?php echo form_error('fjenkel') ? 'is-invalid' : '' ?>" id="fjenkel" name="fjenkel">
                                    <option hidden value="" selected>Pilih Jenis Kelamin </option>
                                    <option value="P">PEREMPUAN</option>
                                    <option value="L">LAKI-LAKI</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('fjenkel') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fdivisi">Divisi</label>
                                <select class="form-control <?php echo form_error('fdivisi') ? 'is-invalid' : '' ?>" id="fdivisi" name="fdivisi">
                                    <option hidden value="" selected>Pilih Divisi </option>
                                    <?php foreach ($divisi as $key) : ?>
                                        <option value="<?= $key->id_divisi ?>" <?= $this->input->post('fdivisi') == $key->id_divisi ? 'selected' : '' ?>><?= strtoupper($key->nama_divisi)  ?></option>

                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('fdivisi') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fdepartemen">Departemen</label>
                                <select class="form-control <?php echo form_error('fdepartemen') ? 'is-invalid' : '' ?>" id="fdepartemen" name="fdepartemen">
                                    <option hidden value="" selected>Pilih Departemen </option>
                                    <?php foreach ($departemen as $key) : ?>
                                        <option value="<?= $key->id_departemen ?>" <?= $this->input->post('fdepartemen') == $key->id_departemen ? 'selected' : '' ?>><?= strtoupper($key->nama_departemen)  ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('fdepartemen') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fbagian">Bagian</label>
                                <input type="text" class="form-control <?= form_error('fbagian') ? 'is-invalid' : '' ?>" id="fbagian" name="fbagian" placeholder="Bagian" value="<?= $this->input->post('fbagian'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fbagian') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fstatus">Status Karyawan</label>
                                <select class="form-control <?php echo form_error('fstatus') ? 'is-invalid' : '' ?>" id="fstatus" name="fstatus">
                                    <option hidden value="" selected>Pilih Status Karyawan </option>
                                    <option value="MAGANG">MAGANG</option>
                                    <option value="OUTSOURCE">OUTSOURCE</option>
                                    <option value="PKWTL">PKWT</option>
                                    <option value="HT">HT</option>
                                    <option value="STAFF">STAFF</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('fstatus') ?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="fbpjs">No BPJS</label>
                                <input type="text" class="form-control <?= form_error('fbpjs') ? 'is-invalid' : '' ?>" id="fbpjs" name="fbpjs" placeholder="Nomor BPJS" value="<?= $this->input->post('fbpjs'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fbpjs') ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right mt-2">Tambah</button>
                            <a href="<?= base_url('karyawan') ?>" class="btn btn-secondary float-left mt-2">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>