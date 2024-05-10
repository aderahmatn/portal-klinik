<section class="content-header align-content-center rounded">
    <div class="container-fluid title-page rounded">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0 text-white font-weight-bold">TAMBAH STOK OBAT</h3>
                <p class="mb-0 text-white font-weight-light">Tambah stok obat baru</p>
                <a class="btn btn-md btn-primary mt-2" href="<?= base_url('obat') ?>">KEMBALI</a>
            </div>

            <div class="col-sm-6">
                <div class=" float-sm-right justify-content-center">
                    <img src="<?= base_url() . 'assets/images/obat.png' ?>" alt="Responsive image" class="img-header">
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">Form Input Data Obat Masuk</h3>
                </div>
                <!-- card-body -->
                <div class="card-body">
                    <form role="form" method="POST" action="" autocomplete="off">
                        <input type="hidden" name="fid_obat" id="fid_obat" value="" style="display: none">
                        <div class="form-group required">
                            <label class="control-label" for="ftgl_masuk">Tanggal Masuk</label>
                            <input type="date" class="form-control" id="ftgl_masuk" name="ftgl_masuk" value="<?= date('Y') . '-' . date('m') . '-' . date('d') ?>">
                            <div class="invalid-feedback">
                                <?= form_error('ftgl_masuk') ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="fnama_obat">Nama Obat</label>
                            <div class="input-group ">
                                <input type="text" class=" form-control <?php echo form_error('fnama_obat') ? 'is-invalid' : '' ?>" id="fnama_obat" name="fnama_obat" onfocus="onFocus()" placeholder="Pilih obat">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-default " data-toggle="modal" data-target="#modal_project"><i class="fas fa-search"></i></button>
                                </span>
                            </div>
                            <span class="text-xs text-red">
                                <?= form_error('fnama_obat') ?>
                            </span>
                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="fexpired_date">Tanggal Expired</label>
                            <input type="date" class="form-control" id="fexpired_date" name="fexpired_date" value="<?= $this->input->post('fexpired_date'); ?>">
                            <div class="invalid-feedback">
                                <?= form_error('fexpired_date') ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="fjumlah">Jumlah</label>
                            <input type="number" class="form-control <?= form_error('fjumlah') ? 'is-invalid' : '' ?>" id="fjumlah" name="fjumlah" placeholder="Jumlah obat masuk" value="<?= $this->input->post('fjumlah'); ?>" min="1">
                            <div class="invalid-feedback">
                                <?= form_error('fjumlah') ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right mt-2">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">Data Obat Masuk</h3>
                </div>
                <!-- card-body -->
                <div class="card-body table-responsive-sm">
                    <table id="tableObat123" class="display nowrap " style="width:100%">
                        <thead>
                            <tr>

                                <th>TGL MASUK</th>
                                <th>NAMA OBAT</th>
                                <th>ED</th>
                                <th>JUMLAH</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($stok as $key) : ?>
                                <tr>
                                    <td>


                                        <?= TanggalIndo($key->tgl_masuk)  ?>

                                    </td>
                                    <td class="text-uppercase">

                                        <?= $key->nama_obat ?>

                                    </td>
                                    <td class="text-uppercase">
                                        <?= TanggalIndo($key->expired_date) ?>
                                    </td>
                                    <td class="text-uppercase">
                                        <?= $key->jumlah ?>
                                    </td>

                                    <td>
                                        <a href="javascript:;" data-id="<?= encrypt_url($key->id_stok_obat)  ?>" data-ido="<?= encrypt_url($key->id_obat)  ?>" data-nama="<?= $key->nama_obat ?>" data-masuk="<?= $key->tgl_masuk ?>" data-ed="<?= $key->expired_date ?>" data-jumlah="<?= $key->jumlah ?>" data-fr="edit" data-toggle="modal" data-target="#edit-data">
                                            <button data-toggle="modal" data-target="#ubah-data" class="btn btn-xs btn-primary">EDIT</button>
                                        </a>
                                        <a href="#" class="btn btn-xs btn-danger" onclick="deleteConfirm('<?= base_url() . 'obat/delete_stok/' . encrypt_url($key->id_stok_obat) ?>')">DELETE</a>

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
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="edit-data" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title">Edit Data Master Obat</P>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <form class="form-horizontal" action="<?= base_url('obat/update_stok_obat') ?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <input type="hidden" id="fid_stok" name="fid_stok" value="<?= $this->input->post('fid_stok'); ?>">
                    <div class="form-group required">
                        <label class="control-label" for="ftgl_masuk">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="ftgl_masuk" name="ftgl_masuk" value="<?= date('Y') . '-' . date('m') . '-' . date('d') ?>">
                        <div class="invalid-feedback">
                            <?= form_error('ftgl_masuk') ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <input type="hidden" id="fid_obat_edit" name="fid_obat_edit">
                        <label class="control-label" for="fnama_obat_edit">Nama Obat</label>
                        <div class="input-group ">
                            <input type="text" class="text-uppercase form-control <?php echo form_error('fnama_obat_edit') ? 'is-invalid' : '' ?>" id="fnama_obat_edit" name="fnama_obat_edit" onfocus="onFocusEdit()" placeholder="Pilih obat" autocomplete="off">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-default " data-toggle="modal" data-target="#modal_obat"><i class="fas fa-search"></i></button>
                            </span>
                        </div>
                        <span class="text-xs text-red">
                            <?= form_error('fnama_obat_edit') ?>
                        </span>
                    </div>
                    <div class="form-group required">
                        <label class="control-label" for="fexpired_date">Tanggal Expired</label>
                        <input type="date" class="form-control" id="fexpired_date" name="fexpired_date" value="<?= $this->input->post('fexpired_date'); ?>">
                        <div class="invalid-feedback">
                            <?= form_error('fexpired_date') ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label" for="fjumlah">Jumlah</label>
                        <input type="number" class="form-control <?= form_error('fjumlah') ? 'is-invalid' : '' ?>" id="fjumlah" name="fjumlah" placeholder="Jumlah obat masuk" value="<?= $this->input->post('fjumlah'); ?>" min="1">
                        <div class="invalid-feedback">
                            <?= form_error('fjumlah') ?>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal"> Batal</button>
                    <button id="btn-delete" class="btn btn-primary" type="submit"> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_project">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title text-bold">PILIH OBAT</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="bodymodal_modal_project">
                <div class="card-body table-responsive-sm">
                    <table id="tableOnModal" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>PILIH</th>
                                <th>NAMA OBAT</th>
                                <th>CATATAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($obat as $key) : ?>
                                <tr class="text-uppercase">
                                    <td style="width: 5px;"><button class="btn btn-primary btn-sm" id="select" data-id="<?= encrypt_url($key->id_obat)  ?>" data-nama="<?= $key->nama_obat ?>">
                                            <i class="fa fa-check"></i> Pilih
                                        </button>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->nama_obat) ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->catatan_obat) ?>
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
<div class="modal fade" id="modal_obat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title text-bold">PILIH OBAT</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="bodymodal_modal_project">
                <div class="card-body table-responsive-sm">
                    <table id="tableUSer" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>PILIH</th>
                                <th>NAMA OBAT</th>
                                <th>CATATAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($obat as $key) : ?>
                                <tr class="text-uppercase">
                                    <td style="width: 5px;"><button class="btn btn-primary btn-sm" id="selectedit" data-id="<?= encrypt_url($key->id_obat)  ?>" data-nama="<?= $key->nama_obat ?>">
                                            <i class="fa fa-check"></i> Pilih
                                        </button>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->nama_obat) ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->catatan_obat) ?>
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
<!-- Delete Confirm -->
<script>
    function onFocus() {
        $('#modal_project').modal('show')
    }

    function onFocusEdit() {
        $('#modal_obat').modal('show')
    }
    $(document).on('click', '#select', function() {
        var id = $(this).data('id');
        var nama_obat = $(this).data('nama');
        $('#fid_obat').val(id)
        $('#fnama_obat').val(nama_obat.toUpperCase())
        $('#modal_project').modal('hide')
    })
    $(document).on('click', '#selectedit', function() {
        var id = $(this).data('id');
        var nama_obat = $(this).data('nama');
        $('#fid_obat_edit').val(id)
        $('#fnama_obat_edit').val(nama_obat.toUpperCase())
        $('#modal_obat').modal('hide')
    })
    $(document).ready(function() {
        // Untuk sunting
        $('#edit-data').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            modal.find('#fid_obat_edit').val(div.data('ido'));
            modal.find('#fcatatan_obat').val(div.data('catatan'));
            modal.find('#fnama_obat_edit').attr("value", div.data('nama'));
            modal.find('#fid_stok').attr("value", div.data('id'));
            modal.find('#ftgl_masuk').attr("value", div.data('masuk'));
            modal.find('#fexpired_date').attr("value", div.data('ed'));
            modal.find('#fjumlah').attr("value", div.data('jumlah'));
        });
    });

    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>