<section class="content-header align-content-center rounded">
    <div class="container-fluid title-page rounded">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0 text-white font-weight-bold">DATA DIAGNOSA</h3>
                <p class="mb-0 text-white font-weight-light">Kelola master data diagnosa</p>
            </div>

            <div class="col-sm-6">
                <div class=" float-sm-right justify-content-center">
                    <img src="<?= base_url() . 'assets/images/diagnosa.png' ?>" alt="Responsive image" class="img-header">
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
                    <table id="tableDiagnosa" class="display nowrap " style="width:100%">
                        <thead>
                            <tr>

                                <th>DIAGNOSA</th>
                                <th>JUMLAH PASSIEN</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($diagnosa as $key) : ?>
                                <tr>

                                    <td class="text-uppercase">

                                        <?= $key->diagnosa ?>

                                    </td>
                                    <td class="text-uppercase">
                                        <?= 12 ?>
                                    </td>

                                    <td>
                                        <a href="javascript:;" data-id="<?= encrypt_url($key->id_diagnosa)  ?>" data-nama="<?= $key->diagnosa ?>" data-toggle="modal" data-target="#edit-data">
                                            <button data-toggle="modal" data-target="#ubah-data" class="btn btn-xs btn-primary">EDIT</button>
                                        </a>
                                        <a href="#" class="btn btn-xs btn-danger" onclick="deleteConfirm('<?= base_url() . 'diagnosa/delete/' . encrypt_url($key->id_diagnosa) ?>')">DELETE</a>

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
                    <h3 class="card-title">Tambah Master Diagnosa</h3>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="" autocomplete="off">
                        <div class="form-group required">
                            <label class="control-label" for="fdiagnosa">Nama Diagnosa</label>
                            <input type="text" class="form-control <?= form_error('fdiagnosa') ? 'is-invalid' : '' ?>" id="fdiagnosa" name="fdiagnosa" placeholder="Nama diagnosa" value="<?= $this->input->post('fdiagnosa'); ?>" style="text-transform:uppercase">
                            <div class="invalid-feedback">
                                <?= form_error('fdiagnosa') ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Tambah</button>
                    </form>
                </div>
            </div>
            <!-- /.card -->
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
<!-- Delete Confirm -->

<!-- Modal Ubah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title">Edit Data Master Diagnosa</P>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <form class="form-horizontal" action="<?= base_url('diagnosa/update_diagnosa') ?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <input type="hidden" id="fid_diagnosa" name="fid_diagnosa" value="<?= $this->input->post('fid_diagnosa'); ?>">
                    <div class="form-group required">
                        <label class="control-label" for="fdiagnosa">Nama Diagnosa</label>
                        <input type="text" class="form-control <?= form_error('fdiagnosa') ? 'is-invalid' : '' ?>" id="fdiagnosa" name="fdiagnosa" placeholder="Nama diagnosa" value="<?= $this->input->post('fdiagnosa'); ?>" style="text-transform:uppercase">
                        <div class="invalid-feedback">
                            <?= form_error('fdiagnosa') ?>
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
            modal.find('#fdiagnosa').val(div.data('nama'));
            modal.find('#fid_diagnosa').attr("value", div.data('id'));
        });
    });

    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>