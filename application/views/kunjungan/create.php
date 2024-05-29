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
                                        <h3 class="mb-0 text-white font-weight-bold">TAMBAH DATA KUNJUNGAN</h3>
                                        <p class="mb-0 text-white font-weight-light">Tambah data kunjungan klinik</p>
                                        <a href="<?= base_url('kunjungan') ?>" class="btn btn-primary float-left mt-2">Kembali</a>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class=" float-sm-right justify-content-center">
                                            <img src="<?= base_url() . 'assets/images/kunjungan.png' ?>" alt="Responsive image" class="img-header">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.container-fluid -->
                        </section>
                        <form role="form" method="POST" action="" autocomplete="off">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                            <div class="field">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <label class="control-label" for="ftgl_kunjungan">Tanggal Kunjungan</label>
                                            <input type="date" class="form-control <?= form_error('ftgl_kunjungan') ? 'is-invalid' : '' ?>" id="ftgl_kunjungan" name="ftgl_kunjungan" placeholder="Tanggal kunjungan" value="<?= date('Y') . '-' . date('m') . '-' . date('d') ?>" required>
                                            <div class="invalid-feedback">
                                                <?= form_error('ftgl_kunjungan') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <label class="control-label" for="fjam_kunjungan">Jam Kunjungan</label>
                                            <input type="time" class="form-control <?= form_error('fjam_kunjungan') ? 'is-invalid' : '' ?>" id="fjam_kunjungan" name="fjam_kunjungan" placeholder="Jam kunjungan" value="<?= date('H') . ':' . date('m')   ?>" required>
                                            <div class="invalid-feedback">
                                                <?= form_error('fjam_kunjungan') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <input type="hidden" id="fid_karyawan" name="fid_karyawan" value="<?= $this->input->post('fid_karyawan') ?>">
                                    <label class="control-label" for="fkaryawan">Nama Karyawan</label>
                                    <div class="input-group ">
                                        <input type="text" class="text-uppercase form-control <?php echo form_error('fkaryawan') ? 'is-invalid' : '' ?>" id="fkaryawan" name="fkaryawan" onfocus="onFocus()" placeholder="Pilih Karyawan" autocomplete="off" value="<?= $this->input->post('fkaryawan') ?>" required>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-default " data-toggle="modal" data-target="#modal_karyawan"><i class="fas fa-search"></i></button>
                                        </span>
                                    </div>
                                    <span class="text-xs text-red">
                                        <?= form_error('fkaryawan') ?>
                                    </span>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="fdiagnosa[]">Diagnosa</label>
                                    <select class="form-control select-diagnosa  <?php echo form_error('fdiagnosa[]') ? 'is-invalid' : '' ?>" id="fdiagnosa[]" name="fdiagnosa[]" multiple="multiple" required>
                                        <?php foreach ($diagnosa as $key) : ?>
                                            <option value="<?= $key->id_diagnosa ?>"><?= strtoupper($key->diagnosa)  ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= form_error('fdiagnosa[]') ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="fanamnesa">Anamnesa</label>
                                    <input type="text" class="text-uppercase form-control <?= form_error('fanamnesa') ? 'is-invalid' : '' ?>" id="fanamnesa" name="fanamnesa" placeholder="Anamnesa" value="<?= $this->input->post('fanamnesa'); ?>" required>
                                    <div class="invalid-feedback">
                                        <?= form_error('fanamnesa') ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="fcatatan_kunjungan">Catatan Kunjungan</label>
                                    <textarea name="fcatatan_kunjungan" class="form-control <?= form_error('fcatatan_kunjungan') ? 'is-invalid' : '' ?> text-uppercase" id="fcatatan_kunjungan" placeholder="Catatan" style="text-transform:uppercase" required><?= $this->input->post('fcatatan_kunjungan'); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= form_error('fcatatan_kunjungan') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="ftheraphy">Teraphy Fisik</label>
                                <textarea name="ftheraphy" class="form-control <?= form_error('ftheraphy') ? 'is-invalid' : '' ?> text-uppercase" id="ftheraphy" placeholder="Therapy Fisik" style="text-transform:uppercase"></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('ftheraphy') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="fid_obat[]">Teraphy Obat</label>
                                <div id="form_obat">
                                    <div class="row mb-2">
                                        <div class="col-md-6"> <select class="form-control select-obat  <?= form_error('fid_obat[]') ? 'is-invalid' : '' ?>" id="fid_obat[]" name="fid_obat[]">
                                                <option></option>
                                                <?php foreach ($obat as $key) : ?>
                                                    <option value="<?= $key->id_obat ?>"><?= strtoupper($key->nama_obat)  ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <div class="stok-text">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="text-uppercase jumlah-obat form-control" id="fjumlah_obat[]" name="fjumlah_obat[]" placeholder="Jumlah obat" min=0 required readonly>
                                        </div>
                                        <div class="col-md-2 align-content-top">
                                            <button type="button" class="btn  btn-default align-center" id="addForm"><i class="fa fa-plus"></i> Field</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-5">
                            <button type="submit" class="btn btn-primary float-right mt-2">Simpan</button>
                            <a href="<?= base_url('kunjungan') ?>" class="btn btn-secondary float-left mt-2">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- modal karyawan -->
<div class="modal fade" id="modal_karyawan">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title text-bold">PILIH KARYAWAN</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="bodymodal_modal_project">
                <div class="card-body table-responsive-xs">
                    <table id="tableUSer" class="display nowrap text-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>PILIH</th>
                                <th>NIK</th>
                                <th>NAMA</th>
                                <th>TGL LAHIR</th>
                                <th>USIA</th>
                                <th>BPJS</th>
                                <th>PERUSAHAAN</th>
                                <th>DIVISI</th>
                                <th>DEPT</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($karyawan as $key) : ?>
                                <tr class="text-uppercase">
                                    <td style="width: 5px;"><button class="btn btn-primary btn-sm" id="select" data-id="<?= encrypt_url($key->id_karyawan)  ?>" data-nama="<?= $key->nama_lengkap ?>">
                                            <i class="fa fa-check"></i> Pilih
                                        </button>
                                    </td>

                                    <td>
                                        <?= strtoupper($key->nik) ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->nama_lengkap) ?>
                                    </td>
                                    <td>
                                        <?= TanggalIndo($key->tgl_lahir)  ?>
                                    </td>
                                    <td>
                                        <?= date('Y') - date('Y', strtotime($key->tgl_lahir))  ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->bpjs) ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->perusahaan)  ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->nama_divisi)  ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->nama_departemen)  ?>
                                    </td>
                                    <td>
                                        <?= strtoupper($key->status)  ?>
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
<!-- end modal karyawan -->


<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            $('#fid_karyawan').val(id)
            $('#fkaryawan').val(nama.toUpperCase())
            $('#modal_karyawan').modal('hide')
        })

        $('.select-diagnosa').select2({
            placeholder: "PILIH DIAGNOSA",
        });

        $('.select-obat').select2({
            placeholder: "PILIH OBAT",
            // templateSelection: function(data, container) {
            //     // console.log(data.id)

            // }
        });
        $('.select-obat').on('change', function() {
            var id_obat = $('.select-obat').val();
            $('.jumlah-obat').attr('readonly', true)
            getStokObatSelected(id_obat)
        })

        function getStokObatSelected(id_obat) {
            $.ajax({
                type: "get",
                url: "<?= site_url('obat/get_stok_obat/'); ?>" + id_obat,
                dataType: "html",
                success: function(response) {
                    console.log(response)
                    var max = parseInt(response)
                    $('.jumlah-obat').attr('max', max)
                    $('.stok-text').empty()
                    $('.stok-text').append(`<small class="form-text text-muted">SISA OBAT ${max}</small>`)
                    if (max != 0) {
                        $('.jumlah-obat').attr('readonly', false)
                    } else {
                        $('.jumlah-obat').attr('readonly', true)
                    }

                },
                error: function(xhr, status, error) {
                    alert(error)
                }
            });
        }


        var i = 2;
        $("#addForm").on('click', function() {
            row = '<div class="row mb-2" id="item' + i + '">' +
                '<div class="col-md-6"> <select class="form-control select-obat' + i + '<?= form_error('fid_obat[]') ? 'is-invalid' : '' ?>"id ="fid_obat[]" name = "fid_obat[]" required>' +
                '<option></option>' +
                '<?php foreach ($obat as $key) : ?>' +
                '<option value = "<?= $key->id_obat ?>" > <?= strtoupper($key->nama_obat)  ?> </option>' +
                '<?php endforeach ?>' +
                '</select>' +
                '<div class="stok-text' + i + '">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-4">' +
                '<input type="number" class="text-uppercase jumlah-obat' + i + ' form-control <?= form_error('fanamnesa') ? 'is-invalid' : '' ?>" id = "fjumlah_obat[]" name = "fjumlah_obat[]" placeholder = "Jumlah obat"  min = 0 required>' +
                '<div class = "invalid-feedback" >' +
                '<?= form_error('fjumlah_obat[]') ?>' +
                '</div></div>' +
                '<div class = "col-md-2 align-content-top">' +
                '<button type="button" class="btn btn-warning align-center btn_remove" id="' + i + '" > <i class="fa fa-minus"> </i> Field</button>'
            $(row).appendTo('#form_obat');
            $('.select-obat' + i).select2({
                placeholder: "PILIH OBAT",
            });
            $('.select-obat' + i + '').on('change', function() {
                var i = 2
                var id_obat = $('.select-obat' + i).val();
                $('.jumlah-obat' + i).attr('readonly', true)
                $.ajax({
                    type: "get",
                    url: "<?= site_url('obat/get_stok_obat/'); ?>" + id_obat,
                    dataType: "html",
                    success: function(response) {
                        var i = 2
                        var max = parseInt(response)
                        $('.jumlah-obat' + i).attr('max', max)
                        $('.stok-text' + i).empty()
                        $('.stok-text' + i).append(`<small class="form-text text-muted">SISA OBAT ${max}</small>`)
                        if (max != 0) {
                            $('.jumlah-obat' + i).attr('readonly', false)
                        } else {
                            $('.jumlah-obat' + i).attr('readonly', true)
                        }
                        i++

                    },
                    error: function(xhr, status, error) {
                        alert(error)
                    }
                });
                i++
            })


            i++
        })
        $(document).on('click', '.btn_remove', function() {
            i--;
            var button_id = $(this).attr("id");
            $('#item' + button_id + '').remove();
        });

    });

    function onFocus() {
        $('#modal_karyawan').modal('show')
    }
</script>