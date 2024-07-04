 <form role="form" method="POST" action="<?= base_url('mcu/excel') ?>" autocomplete="off">
     <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
     <div class="field">
         <div class="row">
             <div class="col-md-4">
                 <div class="form-group required">
                     <label class="control-label" for="ftgl_awal">Range Awal Tanggal MCU</label>
                     <input type="date" class="form-control <?= form_error('ftgl_awal') ? 'is-invalid' : '' ?>" id="ftgl_awal" name="ftgl_awal" placeholder="Tanggal MCU" value="<?= date('Y') . '-' . date('m') . '-' . date('d') ?>" required>
                     <div class="invalid-feedback">
                         <?= form_error('ftgl_awal') ?>
                     </div>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="form-group required">
                     <label class="control-label" for="ftgl_akhir">Range Akhir Tanggal MCU</label>
                     <input type="date" class="form-control <?= form_error('ftgl_akhir') ? 'is-invalid' : '' ?>" id="ftgl_akhir" name="ftgl_akhir" placeholder="Tanggal MCU" value="<?= date('Y') . '-' . date('m') . '-' . date('d') ?>" required>
                     <div class="invalid-feedback">
                         <?= form_error('ftgl_akhir') ?>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-md-4">
                 <div class="form-group required">
                     <label class="control-label" for="fkategori_awal[]">Kategori MCU Awal</label>
                     <select class="form-control select-diagnosa  <?php echo form_error('fkategori_awal[]') ? 'is-invalid' : '' ?>" id="fkategori_awal[]" name="fkategori_awal[]" multiple="multiple" required>
                         <option value="all" selected>SEMUA KATEGORI</option>
                         <option value="1">[1] BAIK - FIT TO WORK</option>
                         <option value="2">[2] CUKUP - FIT WITH NOTE</option>
                         <option value="3">[3] KURANG - TEMPORARY UNFIT</option>
                     </select>
                     <div class="invalid-feedback">
                         <?= form_error('fkategori_awal[]') ?>
                     </div>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="form-group required">
                     <label class="control-label" for="fkategori_folup[]">Kategori MCU Follow Up</label>
                     <select class="form-control select-diagnosa  <?php echo form_error('fkategori_folup[]') ? 'is-invalid' : '' ?>" id="fkategori_folup[]" name="fkategori_folup[]" multiple="multiple" required>
                         <option value="all" selected>SEMUA KATEGORI</option>
                         <option value="1">[1] BAIK - FIT TO WORK</option>
                         <option value="2">[2] CUKUP - FIT WITH NOTE</option>
                         <option value="3">[3] KURANG - TEMPORARY UNFIT</option>
                     </select>
                     <div class="invalid-feedback">
                         <?= form_error('fkategori_folup[]') ?>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-md-4">
                 <div class="form-group required">
                     <label class="control-label" for="fdivisi[]">Divisi</label>
                     <select class="form-control select-divisi  <?php echo form_error('fdivisi[]') ? 'is-invalid' : '' ?>" id="fdivisi[]" name="fdivisi[]" multiple="multiple" required>
                         <option value="all" selected>SEMUA DIVISI</option>
                         <?php foreach ($divisi as $key) : ?>
                             <option value="<?= $key->id_divisi ?>"><?= strtoupper($key->nama_divisi)  ?></option>
                         <?php endforeach ?>
                     </select>
                     <div class="invalid-feedback">
                         <?= form_error('fdivisi[]') ?>
                     </div>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="form-group required">
                     <label class="control-label" for="fdepartemen[]">Departemen</label>
                     <select class="form-control select-departemen  <?php echo form_error('fdepartemen[]') ? 'is-invalid' : '' ?>" id="fdepartemen[]" name="fdepartemen[]" multiple="multiple" required>
                         <option value="all" selected>SEMUA DEPARTEMEN</option>
                         <?php foreach ($dept as $key) : ?>
                             <option value="<?= $key->id_departemen ?>"><?= strtoupper($key->nama_departemen)  ?></option>
                         <?php endforeach ?>
                     </select>
                     <div class="invalid-feedback">
                         <?= form_error('fdepartemen[]') ?>
                     </div>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="form-group required">
                     <label class="control-label" for="fstatus[]">Status Karyawan</label>
                     <select class="form-control select-status  <?php echo form_error('fstatus[]') ? 'is-invalid' : '' ?>" id="fstatus[]" name="fstatus[]" multiple="multiple" required>
                         <option value="all" selected>SEMUA STATUS</option>
                         <option value="MAGANG">MAGANG</option>
                         <option value="OUTSOURCE">OUTSOURCE</option>
                         <option value="PKWT">PKWT</option>
                         <option value="HT">HT</option>
                         <option value="STAFF">STAFF</option>

                     </select>
                     <div class="invalid-feedback">
                         <?= form_error('fstatus[]') ?>
                     </div>
                 </div>
             </div>
         </div>

         <div class="form-group required">
             <table id="tableKar" class="display nowrap text-sm table-sm mt-4" style="width:100%">
                 <thead>
                     <tr>
                         <th><input type='checkbox' class='check-item' name='karyawan[]' value='all' id="check-all"> <label for="check-all">SELECT ALL</label></th>
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
                             <td><input type='checkbox' class='check-item align-center ml-2 mr-1' name='karyawan[]' value=<?= $key->id_karyawan ?> id="check<?= $key->nik ?>"><label for="check<?= $key->nik ?>"> SELECT</label>
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

         <hr class="mt-5">
         <button type="submit" class="btn btn-success float-right mt-2" id="btn-print" disabled onclick="load()"><i class="far fa-file-excel"></i> GENERATE SPREADSHEET</button>
         <button class="btn btn-success float-right mt-2" id="btn-load" disabled><span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>DOWNLOADING..</button>

 </form>

 <script>
     $(document).ready(function() {
         $('#btn-load').hide();
         var checkbox = $(".check-item");
         checkbox.click(function() {
             if ($(this).is(":checked")) {
                 $("#btn-print").removeAttr("disabled");
             } else {
                 $("#btn-print").attr("disabled", "disabled");
             }
         });
         $("#check-all").click(function() {
             if ($(this).is(":checked")) {
                 $(".check-item").prop("checked", true);
                 $("#btn-print").removeAttr("disabled");
             } else {
                 $(".check-item").prop("checked", false);
                 $("#btn-print").attr("disabled", "disabled");
             }
         });


     });
     $("#tableKar").DataTable({
         // rowReorder: {
         //     selector: 'td:nth-child(2)'
         // },
         order: [],
         responsive: true,
     });
     $('.select-divisi').select2({
         placeholder: "PILIH DIVISI",
     });
     $('.select-departemen').select2({
         placeholder: "PILIH DEPARTEMEN",
     });
     $('.select-status').select2({
         placeholder: "PILIH STATUS",
     });
     $('.select-diagnosa').select2({
         placeholder: "PILIH DIAGNOSA",
     });

     function load() {
         $('#btn-print').hide();
         $('#btn-load').show();
         setTimeout(() => {
             $('#btn-print').show();
             $('#btn-load').hide();
         }, 3000);
     }
 </script>