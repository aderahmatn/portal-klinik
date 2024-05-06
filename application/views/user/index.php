<section class="content-header align-content-center rounded">
    <div class="container-fluid title-page rounded">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0 text-white font-weight-bold">DATA USER</h3>
                <p class="mb-0 text-white font-weight-light">Kelola data master user perawat dan administrator portal klinik</p>
            </div>
            <div class="col-sm-6">
                <div class=" float-sm-right justify-content-center">
                    <a class="btn btn-md btn-primary mt-2" href="<?= base_url('user/create') ?>">TAMBAH USER</a>
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
                <div class="card-body table-responsive-sm">

                    <table id="tableUSer" class="display nowrap " style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 15px">No</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>WHATSAPP</th>
                                <th>USERNAME</th>
                                <th>LEVEL</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($user as $key) : ?>
                                <tr class="text-uppercase">
                                    <td>
                                        <?= $no++ ?>
                                    </td>
                                    <td>
                                        <?= $key->nama_user ?>
                                    </td>
                                    <td>
                                        <?= $key->email_user ?>
                                    </td>
                                    <td>
                                        <?= $key->whatsapp_user ?>
                                    </td>
                                    <td>
                                        <?= $key->username  ?>
                                    </td>
                                    <td>
                                        <?= $key->level  ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('user/edit/') . encrypt_url($key->id_user) ?>" class="btn btn-xs btn-primary">EDIT</a>
                                        <a href="#" class="btn btn-xs btn-danger" onclick="deleteConfirm('<?= base_url() . 'user/delete/' . encrypt_url($key->id_user) ?>')">delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
<script type="text/javascript">
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>