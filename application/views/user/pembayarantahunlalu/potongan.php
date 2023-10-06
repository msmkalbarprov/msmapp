  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/select2/select2.min.css">
  <!-- Content Wrapper. Contains page content -->
  <style type="text/css">
.select2-container .select2-selection {
  height: 37px; 
}
    </style>
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
    <div class="card card-default">
      <div class="card-header bg-white">
          <div class="d-inline-block">
            <h3 class="card-title">Potongan Pembayaran Tahun Lalu</h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url("pembayaran_hutang_tahun_lalu"); ?>" class="btn btn-primary btn-sm text-white"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>

    <div class="card-body">
      <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
      <?php echo form_open_multipart("pembayaran_hutang_tahun_lalu/potongan/".$transfer['no_bukti']);?>
         <div class="row">
         <div class="col-md-1">
            <div class="form-group">
                <label for="area" class="control-label">No Kas</label>
                <input type="text" name="no_kas" class="form-control" id="no_kas" value="<?= $transfer['no_bukti'];?>" placeholder="No_kas" required readonly>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="area" class="control-label">Akun</label>
                <select id="no_acc" name="no_acc" class="form-control">
                  <option value="">No Selected</option>
                  <option value="5041501"> Administrasi Bank </option>
                </select>
            </div>
          </div>
          
            <div class="col-md-4">
                <div class="form-group">
                    <label for="dinas" class="control-label">Keterangan</small></label>
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="1"></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="area" class="control-label">Nilai</label>
                    <input type="text" name="nilai" class="form-control" id="nilai" value="0" placeholder="Nilai" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))"  required>
                </div>
            </div>
        </div>
          <div class="form-group">
            <div class="col-md-12" align="right">
              <input type="submit" name="submit" id="submit" value="Simpan" class="btn btn-primary btn-sm">
            </div>
          </div>
      <?php echo form_close( ); ?>
    </div>
  </div>
    <div class="card card-default">
      <div class="card-body">
           <div class="row">
            <div class="col-md-12">
              <div class="card-body table-responsive">
                <table id="na_datatable_potongan" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr>
                      <th width="5%">#id</th>
                      <th>Kode Akun</th>
                      <th>Nama Akun</th>
                      <th>Uraian</th>
                      <th>Nilai</th>
                      <th width="10%">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
           </div>
      </div>
    </div>
  </section> 
</div>
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/dist/js/jquery-3.3.1.js'?>"></script> -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?= base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
  <script>
  // $("#proyek").addClass('menu-open');
  $("#tranfer> a").addClass('active');
</script>
<script type="text/javascript">
    $(document).ready(function(){
      $('.select2').select2()
      document.getElementById('tgl_spj').disabled=true;

document.getElementById("nilai").onkeyup   = function() {hitung()};


});






    var table = $('#na_datatable_potongan').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('pembayaranTahunLalu/datatable_json_rincian_potongan/'.$transfer["no_bukti"])?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "no_acc", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "nm_acc", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "uraian", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "Action", 'searchable':false, 'orderable':false}
    ]
  });




  </script>