<section class="content-header align-content-center rounded">
    <div class="container-fluid title-page rounded">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0 text-white font-weight-bold">DATA DIVISI</h3>
                <p class="mb-0 text-white font-weight-light">Kelola data master divisi karyawan</p>
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
                                <th>DIVISI</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($divisi as $key) : ?>
                                <tr>
                                    <td>
                                        <span class="badge badge-secondary">
                                            <?= $key->id_divisi ?>
                                        </span>
                                    </td>
                                    <td class="text-uppercase">
                                        <?= $key->nama_divisi ?>
                                    </td>
                                    <td>
                                        <a href="javascript:;" data-id="<?= $key->id_divisi ?>" data-divisi="<?= $key->nama_divisi ?>" data-id="<?= $key->id_divisi ?>" data-toggle="modal" data-target="#edit-data">
                                            <button data-toggle="modal" data-target="#ubah-data" class="btn btn-xs btn-primary">EDIT</button>
                                        </a>
                                        <a href="#" class="btn btn-xs btn-danger" onclick="deleteConfirm('<?= base_url() . 'karyawan/delete_divisi/' . encrypt_url($key->id_divisi) ?>')">DELETE</a>

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
                            <label class="control-label" for="fnama_divisi">Tambah Divisi</label>
                            <input type="text" class="form-control <?= form_error('fnama_divisi') ? 'is-invalid' : '' ?>" id="fnama_divisi" name="fnama_divisi" placeholder="Nama divisi" value="<?= $this->input->post('fnama_divisi'); ?>" style="text-transform:uppercase">
                            <div class="invalid-feedback">
                                <?= form_error('fnama_divisi') ?>
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
                <P class="modal-title">EDIT DATA DIVISI</P>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <form class="form-horizontal" action="<?= base_url('karyawan/update_divisi') ?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="form-group required">
                        <input type="hidden" class="form-control" id="fid_divisi" name="fid_divisi" placeholder="ID divisi" value="<?= $this->input->post('fid_divisi'); ?>" readonly>

                        <input type="text" class="form-control <?= form_error('fnama_divisi') ? 'is-invalid' : '' ?>" id="fnama_divisi" name="fnama_divisi" placeholder="Nama divisi" value="<?= $this->input->post('fnama_divisi'); ?>" style="text-transform:uppercase">



                        <div class="invalid-feedback">
                            <?= form_error('fnama_divisi') ?>
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
        // Untuk sunting
        $('#edit-data').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            modal.find('#fnama_divisi').attr("value", div.data('divisi'));
            modal.find('#fid_divisi').attr("value", div.data('id'));
        });
    });

    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>