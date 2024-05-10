<section class="content-header align-content-center rounded">
    <div class="container-fluid title-page rounded">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0 text-white font-weight-bold">INVENTORY OBAT</h3>
                <p class="mb-0 text-white font-weight-light">Kelola inventory data obat-obatan</p>
                <a class="btn btn-md btn-primary mt-2" href="<?= base_url('obat/create') ?>">TAMBAH STOK OBAT</a>
            </div>

            <div class="col-sm-6">
                <div class=" float-sm-right justify-content-center">
                    <img src="<?= base_url() . 'assets/images/obat.png' ?>" alt="Responsive image" class="img-header">
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="card ">
                <!-- card-body -->
                <div class="card-body table-responsive-sm">
                    <table id="tableObat123" class="display nowrap " style="width:100%">
                        <thead>
                            <tr>

                                <th>STOK</th>
                                <th>NAMA OBAT</th>
                                <th>CATATAN</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($obat as $key) : ?>
                                <tr>
                                    <td class="text-uppercase <?= get_stok_obat(encrypt_url($key->id_obat)) == 0 ? 'bg-danger' : '' ?> <?= get_stok_obat(encrypt_url($key->id_obat)) <= $key->minimum_stok ? 'bg-warning' : '' ?> <?= get_stok_obat(encrypt_url($key->id_obat)) > $key->minimum_stok ? 'bg-success' : '' ?> text-lg text-center">


                                        <?= get_stok_obat(encrypt_url($key->id_obat)) ?>

                                    </td>
                                    <td class="text-uppercase">

                                        <?= $key->nama_obat ?>

                                    </td>
                                    <td class="text-uppercase">
                                        <?= $key->catatan_obat ?>
                                    </td>

                                    <td>
                                        <a href="javascript:;" data-id="<?= encrypt_url($key->id_obat)  ?>" data-nama="<?= $key->nama_obat ?>" data-catatan="<?= $key->catatan_obat ?>" data-min="<?= $key->minimum_stok ?>" data-toggle="modal" data-target="#edit-data">
                                            <button data-toggle="modal" data-target="#ubah-data" class="btn btn-xs btn-primary">EDIT</button>
                                        </a>
                                        <a href="#" class="btn btn-xs btn-danger" onclick="deleteConfirm('<?= base_url() . 'obat/delete/' . encrypt_url($key->id_obat) ?>')">DELETE</a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-4">
            <div class="card ">
                <!-- card-body -->
                <div class="card-header">
                    <h3 class="card-title">Tambah Master Obat</h3>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="" autocomplete="off">
                        <input type="hidden" name="fid_obat" id="fid_obat">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_obat">Nama Obat</label>
                            <input type="text" class="form-control <?= form_error('fnama_obat') ? 'is-invalid' : '' ?>" id="fnama_obat" name="fnama_obat" placeholder="Nama obat" value="<?= $this->input->post('fnama_obat'); ?>" style="text-transform:uppercase">
                            <div class="invalid-feedback">
                                <?= form_error('fnama_obat') ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="fcatatan_obat">Catatan Obat</label>
                            <textarea name="fcatatan_obat" class="form-control <?= form_error('fcatatan_obat') ? 'is-invalid' : '' ?> text-uppercase" id="fcatatan_obat" placeholder="Catatan obat" style="text-transform:uppercase"></textarea>
                            <div class="invalid-feedback">
                                <?= form_error('fcatatan_obat') ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="fminimum_stok">Minimum Stok Obat</label>
                            <input type="number" class="text-uppercase form-control <?= form_error('fminimum_stok') ? 'is-invalid' : '' ?>" id="fminimum_stok" name="fminimum_stok" placeholder="Mimimum stok" value="<?= $this->input->post('fminimum_stok'); ?>" min="1">
                            <div class="invalid-feedback">
                                <?= form_error('fminimum_stok') ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Tambah</button>
                    </form>
                </div>
            </div>
            <!-- /.card -->
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

<!-- Modal Ubah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title">Edit Data Master Obat</P>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <form class="form-horizontal" action="<?= base_url('obat/update_master_obat') ?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <input type="hidden" id="fid_obat" name="fid_obat" value="<?= $this->input->post('fid_obat'); ?>">
                    <div class="form-group required">
                        <label class="control-label" for="fnama_obat">Nama Obat</label>
                        <input type="text" class="form-control <?= form_error('fnama_obat') ? 'is-invalid' : '' ?>" id="fnama_obat" name="fnama_obat" placeholder="Nama obat" value="<?= $this->input->post('fnama_obat'); ?>" style="text-transform:uppercase">
                        <div class="invalid-feedback">
                            <?= form_error('fnama_obat') ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label" for="fcatatan_obat">Catatan Obat</label>
                        <textarea name="fcatatan_obat" class="form-control <?= form_error('fcatatan_obat') ? 'is-invalid' : '' ?> text-uppercase" id="fcatatan_obat" placeholder="Catatan obat" style="text-transform:uppercase"></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('fcatatan_obat') ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="control-label" for="fminimum_stok">Jumlah</label>
                        <input type="number" class="form-control <?= form_error('fminimum_stok') ? 'is-invalid' : '' ?>" id="fminimum_stok" name="fminimum_stok" placeholder="Jumlah obat masuk" value="<?= $this->input->post('fminimum_stok'); ?>" min="1">
                        <div class="invalid-feedback">
                            <?= form_error('fminimum_stok') ?>
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

<!-- END Modal Ubah -->

<script type="text/javascript">
    $(document).ready(function() {
        // Untuk sunting
        $('#edit-data').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            // modal.find('#fcatatan_obat').attr("value", div.data('catatan'));
            modal.find('#fminimum_stok').val(div.data('min'));
            modal.find('#fcatatan_obat').val(div.data('catatan'));
            modal.find('#fnama_obat').attr("value", div.data('nama'));
            modal.find('#fid_obat').attr("value", div.data('id'));
        });
    });

    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>