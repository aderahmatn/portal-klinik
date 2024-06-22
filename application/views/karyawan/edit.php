<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <div class="card ">
                    <!-- card-body -->
                    <div class="card-body">
                        <section class=" mx-0 content-header align-content-center rounded">
                            <div class="container-fluid title-page rounded">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3 class="mb-0 text-white font-weight-bold">EDIT DATA KARYAWAN</h3>
                                        <!-- <p class="mb-0 text-white font-weight-light"><?= decrypt_url($this->session->userdata('email'))  ?></p> -->
                                    </div>
                                    <div class="col-sm-6">
                                        <div class=" float-sm-right justify-content-center">
                                            <img src="<?= base_url() . 'assets/images/karyawan.png' ?>" alt="Responsive image" class="img-header">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.container-fluid -->
                        </section>
                        <form role="form" method="POST" action="" autocomplete="off">
                            <input type="hidden" name="fid_karyawan" value="<?= $data->id_karyawan ?>">
                            <div class="form-group required">
                                <label class="control-label" for="fnik">NIK</label>
                                <input type="text" class="form-control <?= form_error('fnik') ? 'is-invalid' : '' ?>" id="fnik" name="fnik" placeholder="NIK" value="<?= $data->nik ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fnik') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fnama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control <?= form_error('fnama_lengkap') ? 'is-invalid' : '' ?>" id="fnama_lengkap" name="fnama_lengkap" placeholder="Nama lengkap" value="<?= $data->nama_lengkap ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fnama_lengkap') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="ftgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control <?= form_error('ftgl_lahir') ? 'is-invalid' : '' ?>" id="ftgl_lahir" name="ftgl_lahir" placeholder="Tanggal lahir" value="<?= $data->tgl_lahir ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('ftgl_lahir') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fjenkel">Jenis Kelamin</label>
                                <select class="form-control <?php echo form_error('fjenkel') ? 'is-invalid' : '' ?>" id="fjenkel" name="fjenkel">
                                    <option hidden value="" selected>Pilih Jenis Kelamin </option>
                                    <option value="P" <?= $data->jenkel == "P" ? "selected" : '' ?>>PEREMPUAN</option>
                                    <option value="L" <?= $data->jenkel == "L" ? "selected" : '' ?>>LAKI-LAKI</option>
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
                                        <option value="<?= $key->id_divisi ?>" <?= $data->id_divisi == $key->id_divisi ? 'selected' : '' ?>><?= strtoupper($key->nama_divisi)  ?></option>

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
                                        <option value="<?= $key->id_departemen ?>" <?= $data->id_departemen == $key->id_departemen ? 'selected' : '' ?>><?= strtoupper($key->nama_departemen)  ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('fdepartemen') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fbagian">Bagian</label>
                                <input type="text" class="form-control <?= form_error('fbagian') ? 'is-invalid' : '' ?>" id="fbagian" name="fbagian" placeholder="Bagian" value="<?= $data->bagian ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fbagian') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fstatus">Status Karyawan</label>
                                <select class="form-control <?php echo form_error('fstatus') ? 'is-invalid' : '' ?>" id="fstatus" name="fstatus">
                                    <option hidden value="" selected>Pilih Status Karyawan </option>
                                    <option value="MAGANG" <?= $data->status == "MAGANG" ? 'selected' : '' ?>>MAGANG</option>
                                    <option value="OUTSOURCE" <?= $data->status == "OUTSOURCE" ? 'selected' : '' ?>>OUTSOURCE</option>
                                    <option value="PKWT" <?= $data->status == "PKWT" ? 'selected' : '' ?>>PKWT</option>
                                    <option value="HT" <?= $data->status == "HT" ? 'selected' : '' ?>>HT</option>
                                    <option value="STAFF" <?= $data->status == "STAFF" ? 'selected' : '' ?>>STAFF</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('fstatus') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fperusahaan">Perusahaan</label>
                                <input type="text" class="form-control <?= form_error('fperusahaan') ? 'is-invalid' : '' ?>" id="fperusahaan" name="fperusahaan" placeholder="Nama perusahaan" value="<?= $data->perusahaan ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fperusahaan') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="ftgl_join">Tanggal Join</label>
                                <input type="date" class="form-control <?= form_error('ftgl_join') ? 'is-invalid' : '' ?>" id="ftgl_join" name="ftgl_join" placeholder="Nama perusahaan" value="<?= $data->tgl_join ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('ftgl_join') ?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="fbpjs">No BPJS Kesehatan</label>
                                <input type="text" class="form-control <?= form_error('fbpjs') ? 'is-invalid' : '' ?>" id="fbpjs" name="fbpjs" placeholder="Nomor BPJS" value="<?= $data->bpjs ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fbpjs') ?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="fbpjs_tk">No BPJS Ketenagakerjaan</label>
                                <input type="text" class="form-control <?= form_error('fbpjs_tk') ? 'is-invalid' : '' ?>" id="fbpjs_tk" name="fbpjs_tk" placeholder="Nomor BPJS" value="<?= $data->bpjs_tk ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fbpjs_tk') ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right mt-2">Simpan</button>
                            <a href="<?= base_url('karyawan') ?>" class="btn btn-secondary float-left mt-2">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>