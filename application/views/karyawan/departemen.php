<section class="content-header align-content-center rounded">
    <div class="container-fluid title-page rounded">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0 text-white font-weight-bold">DATA DEPARTEMEN</h3>
                <p class="mb-0 text-white font-weight-light">Kelola data master departemen karyawan</p>
            </div>
            <div class="col-sm-6">
                <div class=" float-sm-right justify-content-center">
                    <a class="btn btn-md btn-primary mt-2" href="<?= base_url('karyawan') ?>">Kembali</a>

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
                    <table id="TabelUser" class="table table-condensed table-sm ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>DEPARTEMEN</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($departemen as $key) : ?>
                                <tr>
                                    <td>
                                        <span class="badge badge-secondary">
                                            <?= $key->id_departemen ?>
                                        </span>
                                    </td>
                                    <td class="text-uppercase">
                                        <?= $key->nama_departemen ?>
                                    </td>
                                    <td>
                                        <a href="javascript:;" data-id="<?= $key->id_departemen ?>" data-departemen="<?= $key->nama_departemen ?>" data-toggle="modal" data-target="#edit-data">
                                            <button data-toggle="modal" data-target="#ubah-data" class="btn btn-xs btn-primary">EDIT</button>
                                        </a>
                                        <a href="#" class="btn btn-xs btn-danger" onclick="deleteConfirm('<?= base_url() . 'karyawan/delete_departemen/' . encrypt_url($key->id_departemen) ?>')">DELETE</a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-4">
            <div class="card ">
                <!-- card-body -->
                <div class="card-body">
                    <form role="form" method="POST" action="" autocomplete="off">
                        <div class="form-group required">
                            <label class="control-label" for="fnama_departemen">Tambah Departemen</label>
                            <input type="text" class="form-control <?= form_error('fnama_departemen') ? 'is-invalid' : '' ?>" id="fnama_departemen" name="fnama_departemen" placeholder="Nama departemen" value="<?= $this->input->post('fnama_departemen'); ?>" style="text-transform:uppercase">
                            <div class="invalid-feedback">
                                <?= form_error('fnama_departemen') ?>
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
                <P class="modal-title">EDIT DATA DEPARTEMEN</P>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <form class="form-horizontal" action="<?= base_url('karyawan/update_departemen') ?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="form-group required">
                        <input type="hidden" class="form-control" id="fid_departemen" name="fid_departemen" placeholder="ID divisi" value="<?= $this->input->post('fid_departemen'); ?>" readonly>

                        <input type="text" class="form-control <?= form_error('fnama_departemen') ? 'is-invalid' : '' ?>" id="fnama_departemen" name="fnama_departemen" placeholder="Nama divisi" value="<?= $this->input->post('fnama_departemen'); ?>" style="text-transform:uppercase">



                        <div class="invalid-feedback">
                            <?= form_error('fnama_departemen') ?>
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
</div>
<!-- END Modal Ubah -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#edit-data').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget)
            var modal = $(this)
            modal.find('#fnama_departemen').attr("value", div.data('departemen'));
            modal.find('#fid_departemen').attr("value", div.data('id'));
        });
    });

    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>