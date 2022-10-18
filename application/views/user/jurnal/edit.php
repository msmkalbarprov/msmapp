  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
    <style type="text/css">
.select2-container .select2-selection {
  height: 37px; 
}
    </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-plus"></i>
             Tambah Jurnal Umum</h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('jurnal'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>
        <div class="card-body">
         <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>

        <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
         <!-- For Messages -->
        <?php $this->load->view('admin/includes/_messages.php') ?>
        <!-- <form class="form-horizontal" id="formtest"> -->
        <?php echo form_open_multipart("jurnal/edit/".$this->uri->segment(3));?>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="item_hpp" class="control-label">No. Voucher</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="text" name="no_voucher" id="no_voucher" value="<?= $jurnal['no_voucher']; ?>" class="form-control"  readonly >
            </div>
          </div>
          
          <div class="col-md-6">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Tanggal Voucher</label>
              <input type="date" name="tgl_voucher" id="tgl_voucher" class="form-control" value="<?= $jurnal['tgl_voucher']; ?>"  readonly >
          </div>
          </div>
         </div>

         <div class="row">
         <div class="col-md-6">
                  <div class="form-group">
                    <label for="id" class="control-label">Divisi</label>
                    <select name="divisi" id="divisi" class="form-control select2" style="width: 100%;" required>
                      <option value="">No Selected</option>
                      <?php foreach($data_jnsproyek as $jnsproyek): ?>
                        <option value="<?= $jnsproyek['kd_projek']; ?>"><?= $jnsproyek['kd_projek'].' - '.$jnsproyek['nm_projek']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
         <div class="col-md-6">
                  <label for="id" class="control-label">Area</label>
                  <select name="area" id="area" class="form-control select2" style="width: 100%;" required>
                    <option value="">No Selected</option>
                  </select>
                </div>
            
         </div>
         <div class="row">
         
         <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label">Akun</label>
                <select name="no_acc" id ="no_acc" class="form-control select2" style="width: 100%;" required >
                <option value="">No Selected</option>
                <?php foreach($data_akun as $akun): ?>
                      <option value="<?= $akun['no_acc']; ?>"><?= $akun['nm_acc']; ?></option>
                  <?php endforeach; ?>
                </select>

            </div>
          </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="Uraian" class="control-label">Uraian</label>
                <textarea type="text" name="uraian" id="uraian" rows="1" class="form-control"  placeholder="" ></textarea>
              </div>
            </div>
         </div>

         <div class="row">
         <div class="col-md-3">
                <div class="form-group">
                      <label for="item_hpp" class="control-label">Jenis Jurnal</label>
                        <select name="jns_jurnal"  id="jns_jurnal" class="form-control" required>
                          <option value="">No Selected</option>
                          <!-- <option value="1">Proyek</option> -->
                          <option value="2">Akumulasi Penyusutan</option>
                          <option value="3">Penyusaian</option>
                        </select> 
                </div>
            </div>
         <div class="col-md-3">
              <div class="form-group">
                <label for="item_hpp" class="control-label">Kredit/Debet</label><br>
                    <small>Kredit</small>
                    <input class='tgl-ios tgl_checkbox' id='c_kd' name="c_kd"  type='checkbox' />
                    <label for='c_kd'></label>
                    <small>Debet</small>
                    <input id='s_kd' name="s_kd"  type='hidden' />

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="Uraian" class="control-label">Uraian</label>
                <input type="text" name="nilai" style="background:none;text-align:right;" id="nilai" 
                placeholder="0,00" value="0" onkeypress="return(currencyFormat(this,'.',',',event))"  class="form-control" >
              </div>
            </div>
         </div>
        
        <div class="form-group">
          <div class="col-md-12" align="right">
            <input type="submit" name="submit" id="submit" value="Simpan" class="btn btn-primary btn-sm">
          </div>
        </div>
        <?php echo form_close( ); ?>
      <!-- </form> -->
      <!-- datatable -->
      
        <div class="col-md-12">
          <div class="card-body table-responsive">
            <table id="na_datatable" class="table table-bordered table-striped" width="100%">
              <thead>
                  <tr>
                    <th width="5%">No.</th>
                    <th>No. Voucher</th>
                    <th>Tanggal Voucher</th>
                    <!-- <th>Kode Area</th> -->
                    <th>Area</th>
                    <th>Divisi</th>
                    <th>Akun</th>
                    <th>Keterangan</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                    <th width="5%"><?= trans('action') ?></th>
                  </tr>
              </thead>
            </table>
          </div>
        </div>

      </div>
      <!-- /.box-body -->
    </div>
  </section> 
</div>



<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
  <script>
  $("#spj_pegawai> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    $('.select2').select2()
    // document.getElementById("jns_ta").disabled=true;
    no_voucher="<?= $this->uri->segment(3); ?>";
    kd_pegawai=0;

    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('jurnal/view/')?>"+no_voucher,
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "no_voucher", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "tgl_voucher", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "area", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "akun", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "keterangan", 'searchable':true, 'orderable':false},
    { "targets": 7, "name": "debet", 'searchable':true, 'orderable':false},
    { "targets": 8, "name": "kredit", 'searchable':true, 'orderable':false},
    { "targets": 9, "name": "Action", 'searchable':false, 'orderable':false}
    ]
  });


  $('#divisi').change(function(){ 
      var divisi = $(this).val();
      // if (area=='00'){
        // document.getElementById('divisi').disabled=true;
                $.ajax({
                    url : "<?php echo site_url('jurnal/get_area_pengeluaran');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: divisi},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="area"]').empty();
                        $('select[name="area"]').append('<option value="">No Selected</option>');
                        // $('select[name="no_acc"]').append('<option value="5041501">5041501 - Administrasi Bank</option>');
                        $.each(data, function(key, value) {
                            $('select[name="area"]').append('<option value="'+ value.kd_area +'">'+value.kd_area +' - '+ value.nm_area +'</option>');
                          
                        });

                    }
                });
                
      // }else{
      //   document.getElementById('divisi').disabled=false;
      //   $('select[name="no_acc"]').empty();
      // }
  }); 

function get_akun(jns_spj,kd_proyek){
    $.ajax({
        url : "<?php echo site_url('spj_pegawai/get_item_spj');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          jns_spj:jns_spj,kd_proyek:kd_proyek
            },
        async : true,
        dataType : 'json',
        success: function(data){
            $('select[name="no_acc"]').empty();
            $('select[name="no_acc"]').append('<option value="">No Selected</option>');
            $.each(data, function(key, value) {
                  $('select[name="no_acc"]').append('<option value="'+ value.no_acc+'">'+ value.no_acc +' '+value.nm_acc +'</option>');
            });

        }
    });
    return false;
}
   
  }); 

  

</script>