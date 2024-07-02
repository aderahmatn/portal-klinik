<section class="content-header align-content-center rounded">
    <div class="container-fluid title-page rounded">
        <div class="row">
            <div class="col-sm-1">
                <div class=" float-sm-left justify-content-center">
                    <img src="<?= base_url() . 'assets/images/dashboard.png' ?>" alt="Responsive image" class="mr-0 mb-n3" height="100px">
                </div>
            </div>
            <div class="col-sm-6 ml-4">
                <p class="mb-0 text-white font-weight-light">Selamat datang,</p>
                <h3 class="mb-0 text-white font-weight-bold"><?= ucwords(decrypt_url($this->session->userdata('nama_user'))) ?></h3>
                <p class="mb-0 text-white font-weight-light"><?= decrypt_url($this->session->userdata('email'))  ?></p>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-3">
            <a href="<?= base_url('kunjungan') ?>">
                <div class="card">
                    <div class="card-body elevation-1">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?= base_url('assets/images/kunjungan.png') ?>" alt="" height="110px" class="">
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0 text-info font-weight-light">Main Menu</p>
                                <h4 class="mb-0 text-info font-weight-bold">Kunjungan Klinik</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= base_url('skd') ?>">
                <div class="card">
                    <div class="card-body elevation-1">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?= base_url('assets/images/skd.png') ?>" alt="" height="110px" class="">
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0 text-info font-weight-light">Main Menu</p>
                                <h4 class="mb-0 text-info font-weight-bold">Surat Keterangan Dokter</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= base_url('kk') ?>">
                <div class="card">
                    <div class="card-body elevation-1">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?= base_url('assets/images/kk.png') ?>" alt="" height="110px" class="">
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0 text-info font-weight-light">Main Menu</p>
                                <h4 class="mb-0 text-info font-weight-bold">Kecelakaan Kerja</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= base_url('mcu') ?>">
                <div class="card">
                    <div class="card-body elevation-1">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?= base_url('assets/images/mcu.png') ?>" alt="" height="110px" class="">
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0 text-info font-weight-light">Main Menu</p>
                                <h4 class="mb-0 text-info font-weight-bold">Medical Check Up</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </a>
        </div>
        <!-- <div class="col-md-3">
            <a href="<?= base_url('skd') ?>">
                <div class="card">
                    <div class="card-body elevation-1">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?= base_url('assets/images/skd.png') ?>" alt="" height="130px" class="">
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0 text-info font-weight-light">Main Menu</p>
                                <h3 class="mb-0 text-info font-weight-bold">Surat Keterangan Dokter</h3>
                            </div>
                        </div>

                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= base_url('kk') ?>">
                <div class="card">
                    <div class="card-body elevation-1">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?= base_url('assets/images/kk.png') ?>" alt="" height="130px" class="">
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0 text-info font-weight-light">Main Menu</p>
                                <h3 class="mb-0 text-info font-weight-bold">Kecelakaan Kerja</h3>
                            </div>
                        </div>

                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= base_url('mcu') ?>">
                <div class="card">
                    <div class="card-body elevation-1">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?= base_url('assets/images/mcu.png') ?>" alt="" height="130px" class="">
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0 text-info font-weight-light">Main Menu</p>
                                <h3 class="mb-0 text-info font-weight-bold">Medical Check Up</h3>
                            </div>
                        </div>

                    </div>
                </div>
            </a>
        </div> -->



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
<script type="text/javascript">
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>