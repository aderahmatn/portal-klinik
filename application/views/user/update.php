<!-- Main content -->
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
                                        <h3 class="mb-0 text-white font-weight-bold">EDIT DATA USER</h3>
                                        <p class="mb-0 text-white font-weight-light">Edit data user perawat maupun administrator</p>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class=" float-sm-right justify-content-center">
                                            <img src="<?= base_url() . 'assets/images/doctor.png' ?>" alt="Responsive image" class="img-header">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.container-fluid -->
                        </section>
                        <form role="form" method="POST" action="" autocomplete="off">
                            <input type="hidden" name="fid_user" value="<?= encrypt_url($data->id_user) ?>" style="display: none">
                            <div class="form-group required">
                                <label class="control-label" for="fnama_user">Nama Lengkap</label>
                                <input type="text" class="form-control <?= form_error('fnama_user') ? 'is-invalid' : '' ?>" id="fnama_user" name="fnama_user" placeholder="Nama lengkap" value="<?= $data->nama_user ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fnama_user') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="femail_user">Email</label>
                                <input type="email" class="form-control <?= form_error('femail_user') ? 'is-invalid' : '' ?>" id="femail_user" name="femail_user" placeholder="Email" value="<?= $data->email_user ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('femail_user') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fwhatsapp_user">Whatsapp</label>
                                <input type="text" class="form-control <?= form_error('fwhatsapp_user') ? 'is-invalid' : '' ?>" id="fwhatsapp_user" name="fwhatsapp_user" placeholder="Nomor whatsapp" value="<?= $data->whatsapp_user ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fwhatsapp_user') ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="fusername">Username</label>
                                <input type="text" class="form-control <?= form_error('fusername') ? 'is-invalid' : '' ?>" id="fusername" name="fusername" placeholder="Username" value="<?= $data->username ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('fusername') ?>
                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="control-label" for="flevel">Level</label>
                                <select class="form-control <?php echo form_error('flevel') ? 'is-invalid' : '' ?>" id="flevel" name="flevel">
                                    <option hidden value="" selected>Pilih level user </option>
                                    <option value="ADMINISTRATOR" <?= $data->level == "ADMINISTRATOR" ? 'selected' : '' ?>>ADMINISTRATOR</option>
                                    <option value="PERAWAT" <?= $data->level == "PERAWAT" ? 'selected' : '' ?>>PERAWAT</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('flevel') ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right mt-2">Simpan</button>
                            <a href="<?= base_url('user') ?>" class="btn btn-secondary float-left mt-2">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>