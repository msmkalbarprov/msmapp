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
            <h3 class="card-title"> <i class="fa fa-check"></i>
             Potongan Transfer </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url("transfer/edit/".$this->uri->segment(4)); ?>" class="btn btn-primary btn-sm text-white"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>

    <div class="card-body">
      <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>
      <?php echo form_open_multipart("transfer/potongan/".$transfer['id']."/".$this->uri->segment(4)."/".$this->uri->segment(5));?>
         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
                <label for="area" class="control-label">No. Transfer</label>
                <input type="text" name="no_transfer" class="form-control" value="<?= $transfer['no_transfer']; ?>" id="no_transfer" readonly>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
                <label for="area" class="control-label">Nilai Transfer</label>

                <input type="text" name="nilai_bruto" class="form-control" id="nilai_bruto" value="<?= number_format($transfer['nilai'],'2',',','.') ?>" placeholder="Nilai" style="text-align:right;" readonly>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="area" class="control-label">Akun</label>
                <select id="kd_acc" name="kd_acc" class="form-control">
                  <option value="">No Selected</option>
                  <option value="5041501"> Administrasi Bank</option>
                </select>
              <input type="hidden" name="nm_acc" class="form-control" id="areas" >
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
              <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm">
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
    });


    var table = $('#na_datatable_potongan').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('transfer/datatable_json_rincian_potongan/'.$transfer["id"].'/'.$this->uri->segment(4).'/'.$this->uri->segment(5))?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "no_acc", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "nm_acc", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "Action", 'searchable':false, 'orderable':false}
    ]
  });


  </script>