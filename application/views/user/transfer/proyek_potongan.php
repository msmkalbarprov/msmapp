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
            <h3 class="card-title"> <i class="fa fa-percent"></i>
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
          <div class="col-md-4">
            <div class="form-group">
                <label for="area" class="control-label">No. Transfer</label>
                <input type="text" name="no_transfer" class="form-control" value="<?= $transfer['no_transfer']; ?>" id="no_transfer" readonly>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
                <label for="area" class="control-label">Nilai Transfer</label>

                <input type="text" name="nilai_bruto" class="form-control" id="nilai_bruto" value="<?= number_format($transfer['nilai'],'2',',','.') ?>" placeholder="Nilai" style="text-align:right;" readonly>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="area" class="control-label">Akun</label>
                <select id="kd_acc" name="kd_acc" class="form-control">
                  <option value="">No Selected</option>
                  <option value="5020101"> Biaya Partner Lokal </option>
                  <option value="5020501"> Potongan Pendapatan </option>
                  <option value="5041501"> Administrasi Bank </option>
                </select>
            </div>
          </div>
         </div>
         <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="no_rek" class="control-label">Rek. Tujuan <small> (Khusus PL dan titipan)</small></label>
                <select name="no_rekening" id ="no_rekening" class="form-control select2" style="width: 100%;" required >
                <option value="">No Selected</option>
                <?php foreach($data_rekening as $rekening): ?>
                      <option value="<?= $rekening['no_rekening']; ?>"><?= $rekening['pemilik'].' - '.$rekening['nm_bank'].' - '.$rekening['no_rekening']; ?></option>
                  <?php endforeach; ?>
                </select>

            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="no_rek" class="control-label">Tanggal Transfer Potongan<small> (Khusus PL dan titipan)</small></label>
                <input type="date" name="tgl_pdo" id="tgl_pdo" class="form-control">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <label for="area" class="control-label">Nilai</label>
                <input type="text" name="nilai" class="form-control" id="nilai" value="0" placeholder="Nilai" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))"  required>
            </div>
          </div>

         </div>

         <div class="row" id="myDIV1">
          <div class="col-md-8">
          </div>
          <div class="col-md-4">
           <div class="form-group">
                <label for="dinas" class="control-label">Nilai HPP<small> (Khusus PL dan titipan)</small></label>
                <input type="text" name="pnet" id="pnet" class="form-control"  style="background:none;text-align:right;" readonly >
            </div>
          </div>
         
         </div>

         <div class="row" id="myDIV2">
          <div class="col-md-8">
          </div>
          <div class="col-md-4" >
           <div class="form-group" id="myDIV2">
                <label for="dinas" class="control-label">Realisasi<small> (Khusus PL dan titipan)</small></label>
                <input type="text" name="thpp" id="thpp" class="form-control"   style="background:none;text-align:right;"readonly >
            </div>
          </div>
         
         </div>

         <div class="row" id="myDIV3">
          <div class="col-md-8">
          </div>
          <div class="col-md-4">
           <div class="form-group">
                <label for="dinas" class="control-label">Sisa<small> (Khusus PL dan titipan)</small></label>
                <input type="text" name="sisa" id="sisa" class="form-control"   style="background:none;text-align:right;"readonly >
            </div>
          </div>
         
         </div>


         
        
          <div class="form-group">
            <div class="col-md-12" align="right">
              <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary btn-sm">
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
      document.getElementById('no_rekening').disabled=true;
      document.getElementById('tgl_pdo').disabled=true;

document.getElementById("nilai").onkeyup   = function() {hitung()};

  $('#kd_acc').change(function(){ 
      var kd_coa        = $(this).val();
      var kode_pqproyek = $('#no_transfer').val();
      if (kd_coa.substr(0,7)=='5020101'|| kd_coa.substr(0,7)=='5020501'){
        document.getElementById('no_rekening').disabled=false;
        document.getElementById('tgl_pdo').disabled=false;
        get_nilai(kd_coa,kode_pqproyek);
      }else{
        document.getElementById('no_rekening').disabled=true;
        document.getElementById('tgl_pdo').disabled=true;

        document.getElementById('thpp').value='';
        document.getElementById('sisa').value='';
        document.getElementById('pnet').value='';
      }
      return false;
  });
});

function get_nilai(kd_coa,kode_pqproyek){
        $.ajax({
        url : "<?php echo site_url('transfer/get_nilai');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kode_pqproyek,no_acc:kd_coa},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="pnet"]').val(number_format(value.total,"2",",",".")).trigger('change');

                get_realisasi(kd_coa,kode_pqproyek,value.total)
            });

        }
    });
}

function get_realisasi(kd_coa,kode_pqproyek,nil_hpp){
        $.ajax({
        url : "<?php echo site_url('transfer/get_realisasi');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kode_pqproyek,no_acc:kd_coa},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="thpp"]').val(number_format(value.total,"2",",",".")).trigger('change');

                $('[name="sisa"]').val(number_format(nil_hpp - value.total,"2",",",".")).trigger('change');

            });

        }
    });
        
}


function hitung(){
  var sisa          = number($('#sisa').val());
  var nilai_bruto   = number($('#nilai_bruto').val());
  var nilai         = number($('#nilai').val());

  if (nilai>sisa){
    alert('Nilai melebihi sisa HPP');
    document.getElementById("submit").disabled = true;
    return;
  }else if (nilai>nilai_bruto){
    alert('Nilai melebihi Nilai Cair');
    document.getElementById("submit").disabled = true;
    return;
  }else{
    document.getElementById("submit").disabled = false;
  }
}


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