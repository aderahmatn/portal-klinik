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
                                        <h3 class="mb-0 text-white font-weight-bold">INPUT DATA SKD KARYAWAN</h3>
                                        <p class="mb-0 text-white font-weight-light">Input data surat keterangan dokter</p>
                                        <a href="<?= base_url('skd') ?>" class="btn btn-primary float-left mt-2">Kembali</a>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class=" float-sm-right justify-content-center">
                                            <img src="<?= base_url() . 'assets/images/skd.png' ?>" alt="Responsive image" class="img-header">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.container-fluid -->
                        </section>
                        <form role="form" method="POST" action="" autocomplete="off">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                            <div class="field">
                                <div class="form-group required">
                                    <label class="control-label" for="ftgl_penyerahan">Tanggal Penyerahan SKD</label>
                                    <input type="date" class="form-control <?= form_error('ftgl_penyerahan') ? 'is-invalid' : '' ?>" id="ftgl_penyerahan" name="ftgl_penyerahan" placeholder="Tanggal penyerahan" value="<?= date('Y') . '-' . date('m') . '-' . date('d') ?>" required>
                                    <div class="invalid-feedback">
                                        <?= form_error('ftgl_penyerahan') ?>
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
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group required">
                                            <label class="control-label" for="ftgl_mulai_skd">Tanggal Mulai SKD</label>
                                            <input type="date" class="form-control <?= form_error('ftgl_mulai_skd') ? 'is-invalid' : '' ?>" id="ftgl_mulai_skd" name="ftgl_mulai_skd" placeholder="Tanggal skd" value="<?= $this->input->post('ftgl_mulai_skd') ?>" required>
                                            <div class="invalid-feedback">
                                                <?= form_error('ftgl_mulai_skd') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group required">
                                            <label class="control-label" for="ftgl_akhir_skd">Tanggal Akhir SKD</label>
                                            <input type="date" class="form-control <?= form_error('ftgl_akhir_skd') ? 'is-invalid' : '' ?>" id="ftgl_akhir_skd" name="ftgl_akhir_skd" placeholder="Tanggal skd" value="<?= $this->input->post('ftgl_akhir_skd') ?>" required>
                                            <div class="invalid-feedback">
                                                <?= form_error('ftgl_akhir_skd') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="fjumlah_hari_skd">Jumlah Hari SKD</label>
                                    <input type="number" class="form-control <?= form_error('fjumlah_hari_skd') ? 'is-invalid' : '' ?>" id="fjumlah_hari_skd" name="fjumlah_hari_skd" placeholder="JUMLAH HARI SKD" value="<?= $this->input->post('fjumlah_hari_skd') ?>" min="1" required>
                                    <div class="invalid-feedback">
                                        <?= form_error('fjumlah_hari_skd') ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="ffaskes">Nama Fasilitas Kesehatan</label>
                                    <input type="text" class="text-uppercase form-control <?= form_error('ffaskes') ? 'is-invalid' : '' ?>" id="ffaskes" name="ffaskes" placeholder="NAMA FASKES" value="<?= $this->input->post('ffaskes') ?>" required>
                                    <div class="invalid-feedback">
                                        <?= form_error('ffaskes') ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="fpembayaran">Pembayaran Berobat</label>
                                    <select class="form-control  <?php echo form_error('fpembayaran') ? 'is-invalid' : '' ?>" id="fpembayaran" name="fpembayaran" required>
                                        <option hidden value="" selected>PILIH PEMBAYARAN</option>
                                        <option value="BPJS" <?= $this->input->post('fpembayaran') == 'BPJS' ? 'selected' : '' ?>>BPJS</option>
                                        <option value="BPJS TK" <?= $this->input->post('fpembayaran') == 'BPJS TK' ? 'selected' : '' ?>>BPJS TK</option>
                                        <option value="NON BPJS" <?= $this->input->post('fpembayaran') == 'NON BPJS' ? 'selected' : '' ?>>NON BPJS</option>
                                        <option value="ASURANSI" <?= $this->input->post('fpembayaran') == 'ASURANSI' ? 'selected' : '' ?>>ASURANSI</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= form_error('fpembayaran') ?>
                                    </div>
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
                                    <label class="control-label" for="fjenis_penyakit">Jenis Penyakit</label>
                                    <textarea name="fjenis_penyakit" class="form-control <?= form_error('fjenis_penyakit') ? 'is-invalid' : '' ?> text-uppercase" id="fjenis_penyakit" placeholder="Jenis Penyakit" style="text-transform:uppercase" required><?= $this->input->post('fjenis_penyakit'); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= form_error('fjenis_penyakit') ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="fstatus_skd">Status SKD</label>
                                    <select class="form-control  <?php echo form_error('fstatus_skd') ? 'is-invalid' : '' ?>" id="fstatus_skd" name="fstatus_skd" required>
                                        <option hidden value="" selected>PILIH STATUS</option>
                                        <option value="ACC">ACC</option>
                                        <option value="TIDAK ACC">TIDAK ACC</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= form_error('fstatus_skd') ?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="fcatatan_skd">Catatan SKD</label>
                                    <textarea name="fcatatan_skd" class="form-control <?= form_error('fcatatan_skd') ? 'is-invalid' : '' ?> text-uppercase" id="fcatatan_skd" placeholder="Catatan" style="text-transform:uppercase"><?= $this->input->post('fcatatan_skd'); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= form_error('fcatatan_skd') ?>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-5">
                            <button type="submit" class="btn btn-primary float-right mt-2">Simpan</button>
                            <a href="<?= base_url('skd') ?>" class="btn btn-secondary float-left mt-2">Batal</a>
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
    });

    function daysBetween(first, second) {

        var newDate = Date.now() + -5 * 24 * 3600 * 1000;

        // Copy date parts of the timestamps, discarding the time parts.
        var one = new Date(first[0], first[1], first[2]);
        var two = new Date(second[0], second[1], second[2]);

        // // Do the math.
        var millisecondsPerDay = 1000 * 60 * 60 * 24;
        var millisBetween = two.getTime() - one.getTime();
        var days = millisBetween / millisecondsPerDay;

        // Round down.
        return Math.floor(days);
    }

    $('#ftgl_akhir_skd').blur(function() {
        var start = $('#ftgl_mulai_skd').val().split('-');
        var end = $('#ftgl_akhir_skd').val().split('-');
        console.log(daysBetween(start, end))
        $('#fjumlah_hari_skd').val(daysBetween(start, end))
    })

    function onFocus() {
        $('#modal_karyawan').modal('show')
    }
</script>