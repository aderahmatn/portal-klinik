<?php
if ($diagnosa) {
    foreach ($diagnosa as $key) : ?>
        <p class="m-1"> <span class="badge badge-warning text-uppercase"><?= $key->diagnosa  ?> <a href="#" onclick="deleteDiagnosa('<?= encrypt_url($key->id_diagnosa_skd) ?>')" class="btn btn-xs btn-danger ml-2" data-toggle="tooltip" title="HAPUS DIAGNOSA">delete</a></span></p>

<?php endforeach;
} else {
    echo 'Tidak ada data..';
}
?>
<hr>
<form role="form" method="POST" action="<?= base_url('skd/update_diagnosa') ?>" autocomplete="off">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
    <input type="hidden" name="fid_skd" id="fid_skd" value="<?= $id_skd  ?>" style="display: none">
    <div class="form-group required mt-3">
        <label class="control-label" for="fdiagnosa[]">Diagnosa Baru</label>
        <select class="form-control select-diagnosa  <?php echo form_error('fdiagnosa[]') ? 'is-invalid' : '' ?>" id="fdiagnosa[]" name="fdiagnosa[]" multiple="multiple" required>
            <?php foreach ($alldiagnosa as $key) : ?>
                <option value="<?= $key->id_diagnosa ?>"><?= strtoupper($key->diagnosa)  ?></option>
            <?php endforeach ?>
        </select>
        <div class="invalid-feedback">
            <?= form_error('fdiagnosa[]') ?>
        </div>
    </div>
    <hr class="mt-1 ">
    <button class="btn btn-default " type="button" data-dismiss="modal"> Batal</button>
    <button type="submit" class="btn btn-primary float-right mt-2">Simpan</button>
</form>

<script>
    $('.select-diagnosa').select2({
        placeholder: "PILIH DIAGNOSA",
    });

    function deleteDiagnosa(id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('skd/delete_diagnosa/'); ?>" + id,
            dataType: "html",
            success: function(response) {
                location.reload()
            }
        });
    }
</script>