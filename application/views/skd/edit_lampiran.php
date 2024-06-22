<form role="form" method="POST" action="<?= base_url('skd/update_lampiran') ?>" autocomplete="off" enctype="multipart/form-data">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
    <input type="hidden" name="fid_skd" id="fid_skd" value="<?= $id_skd  ?>" style="display: none">
    <div class="form-group required">
        <label for="flampiran" class="control-label">Lampiran</label>
        <input type="file" class="pb-4 form-control <?= form_error('flampiran') ? 'is-invalid' : '' ?>" id="flampiran" name="flampiran" required>
        <small id="flampiran" class="form-text text-muted">Format file harus .pdf
            maksimal 2Mb </small>
    </div>
    <hr class="mt-1 ">
    <button class="btn btn-default " type="button" data-dismiss="modal"> Batal</button>
    <button type="submit" class="btn btn-primary float-right mt-2">Simpan</button>
</form>