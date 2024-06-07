<?php
if ($obat) {
    foreach ($obat as $key) : ?>
        <p class="m-1"> <span class="badge badge-success badge-pill text-uppercase"><?= $key->nama_obat . '(' . $key->jumlah_keluar . ')' ?> <a href="#" onclick="deleteObat('<?= encrypt_url($key->id_obat_kunjungan) ?>')" class="btn rounded btn-xs btn-danger ml-2" data-toggle="tooltip" title="HAPUS OBAT">delete</a></span></p>

<?php endforeach;
} else {
    echo 'Tidak ada data..';
}
?>
<hr>
<!-- <?= base_url() . 'kunjungan/delete_diagnosa/' . encrypt_url($key->id_diagnosa_kunjungan) ?> -->
<form role="form" method="POST" action="<?= base_url('kunjungan/update_obat') ?>" autocomplete="off">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
    <input type="hidden" name="fid_kunjungan" id="fid_kunjungan" value="<?= $id_kunjungan  ?>" style="display: none">
    <div class="form-group">
        <label class="control-label" for="fid_obat[]">Teraphy Obat Baru</label>
        <div id="form_obat">
            <div class="row mb-2">
                <div class="col-md-6"> <select class="form-control select-obat  <?= form_error('fid_obat[]') ? 'is-invalid' : '' ?>" id="fid_obat[]" name="fid_obat[]" required>
                        <option></option>
                        <?php foreach ($allobat as $key) : ?>
                            <option value="<?= $key->id_obat ?>"><?= strtoupper($key->nama_obat)  ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="stok-text">
                    </div>
                </div>
                <div class="col-md-3">
                    <input type="number" class="text-uppercase jumlah-obat form-control" id="fjumlah_obat[]" name="fjumlah_obat[]" placeholder="Jumlah obat" min=0 required>
                </div>
                <div class="col-md-3 align-content-top">
                    <button type="button" class="btn  btn-default align-center" id="addForm"><i class="fa fa-plus"></i> Field</button>
                </div>
            </div>
        </div>
    </div>
    <hr class="mt-1 ">
    <button class="btn btn-default " type="button" data-dismiss="modal"> Batal</button>
    <button type="submit" class="btn btn-primary float-right mt-2">Simpan</button>
</form>

<script>
    $('.select-obat').select2({
        placeholder: "PILIH OBAT",
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

    function deleteObat(id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('kunjungan/delete_obat/'); ?>" + id,
            dataType: "html",
            success: function(response) {
                location.reload()
            }
        });
    }
    $(document).ready(function() {
        var i = 2;
        $("#addForm").on('click', function() {
            row = '<div class="row mb-2" id="item' + i + '">' +
                '<div class="col-md-6"> <select class="form-control select-obat' + i + '<?= form_error('fid_obat[]') ? 'is-invalid' : '' ?>"id ="fid_obat[]" name = "fid_obat[]" required>' +
                '<option></option>' +
                '<?php foreach ($allobat as $key) : ?>' +
                '<option value = "<?= $key->id_obat ?>" > <?= strtoupper($key->nama_obat)  ?> </option>' +
                '<?php endforeach ?>' +
                '</select>' +
                '<div class="stok-text' + i + '">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-3">' +
                '<input type="number" class="text-uppercase jumlah-obat' + i + ' form-control <?= form_error('fanamnesa') ? 'is-invalid' : '' ?>" id = "fjumlah_obat[]" name = "fjumlah_obat[]" placeholder = "Jumlah obat"  min = 0 required>' +
                '<div class = "invalid-feedback" >' +
                '<?= form_error('fjumlah_obat[]') ?>' +
                '</div></div>' +
                '<div class = "col-md-3 align-content-top">' +
                '<button type="button" class="btn btn-warning align-center btn_remove" id="' + i + '" > <i class="fa fa-minus"> </i> Field</button>'
            $(row).appendTo('#form_obat');
            $('.select-obat' + i + '').select2({
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
    })
</script>