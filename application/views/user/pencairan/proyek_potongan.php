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
             Potongan Pencairan Proyek </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url("pencairan/detail/".$proyek['id_proyek']); ?>" class="btn btn-primary btn-sm text-white"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>

    <div class="card-body">
      <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>
      <?php echo form_open_multipart("pencairan/potongan/".$pencairan['id']."/".$proyek['id_proyek']."/".$this->uri->segment(5));?>
         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
                <label for="area" class="control-label">Kode Proyek</label>
                <input type="text" name="kd_proyek2" class="form-control" value="<?= $proyek['kd_proyek']; ?>" id="kd_proyek2" readonly>
                <input type="hidden" name="id_proyek" class="form-control" value="<?= $proyek['id_proyek']; ?>" id="id_proyek" readonly>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
                <label for="area" class="control-label">Nilai Pencairan</label>

                <input type="text" name="nilai_bruto" class="form-control" id="nilai_bruto" value="<?= number_format($pencairan['nilai_bruto'],'2',',','.') ?>" placeholder="Nilai" style="text-align:right;" readonly>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label">Akun</label>
                <select id="kd_acc" name="kd_acc" class="form-control">
                  <option value="">No Selected</option>
                  <option value="5041405"> PPN</option>
                  <option value="5041401"> PPH Pasal 21</option>
                  <option value="5041402"> PPH Pasal 22</option>
                  <option value="5041403"> PPH Pasal 23</option>
                  <option value="5041406"> Pajak Lainnya (Infaq, SP3)</option>
                  <option value="5041501"> Administrasi Bank</option>
                </select>
              <input type="hidden" name="nm_acc" class="form-control" id="areas" >
            </div>
          </div>
          </div>

          <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                    <label for="area" class="control-label">Nilai</label>
                    <input type="text" name="nilai" class="form-control" id="nilai" value="0" placeholder="Nilai" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))"  required>
                </div>
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                      <label for="dinas" class="control-label">Nilai HPP</label>
                      <input type="text" name="pnet" id="pnet" class="form-control"  style="background:none;text-align:right;" readonly >
                  </div>
              </div>
              <div class="col-md-3" >
                 <div class="form-group" id="myDIV2">
                      <label for="dinas" class="control-label">Realisasi</label>
                      <input type="text" name="thpp" id="thpp" class="form-control"   style="background:none;text-align:right;"readonly >
                  </div>
              </div>
              <div class="col-md-3">
               <div class="form-group">
                    <label for="dinas" class="control-label">Sisa</label>
                    <input type="text" name="sisa" id="sisa" class="form-control"   style="background:none;text-align:right;"readonly >
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
  $("#pencairan> a").addClass('active');
</script>
<script type="text/javascript">
    $(document).ready(function(){
      $('.select2').select2()
      
      document.getElementById("nilai").onkeyup   = function() {hitung()};

      $('#kd_acc').change(function(){ 
      var kd_coa        = $(this).val();
      var kode_proyek = $('#kd_proyek2').val();

      if (kd_coa=='5041501'){
          document.getElementById('thpp').value='';
          document.getElementById('sisa').value='';
          document.getElementById('pnet').value=$('#nilai_bruto').val();
          nil_hpp = $('#nilai_bruto').val();
          get_realisasi2(kode_proyek,nil_hpp);
      }else{
          get_nilai(kd_coa,kode_proyek);
      }
        
      return false;
  });


    });

function hitung(){
  var sisa          = number($('#sisa').val());
  var nilai_bruto   = number($('#nilai_bruto').val());
  var nilai         = number($('#nilai').val());
  var kd_acc        = $('#kd_acc').val();

  if (kd_acc=='5041501'){
      if (nilai>nilai_bruto){
        alert('Nilai melebihi Nilai Cair');
        document.getElementById("submit").disabled = true;
        return;
      }else{
        document.getElementById("submit").disabled = false;
      }
  }else{
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

  
}

function get_nilai(kd_coa,kode_proyek){
        $.ajax({
        url : "<?php echo site_url('pencairan/get_nilai');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kode_proyek,no_acc:kd_coa},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="pnet"]').val(number_format(value.total,"2",",",".")).trigger('change');

                get_realisasi(kd_coa,kode_proyek,value.total)
            });

        }
    });
}

function get_realisasi(kd_coa,kode_proyek,nil_hpp){

        var id_proyek = $('#id_proyek').val();
        $.ajax({
        url : "<?php echo site_url('pencairan/get_realisasi');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: id_proyek,no_acc:kd_coa},
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


function get_realisasi2(kode_proyek,nil_hpp){

        var id_proyek = $('#id_proyek').val();
        $.ajax({
        url : "<?php echo site_url('pencairan/get_realisasi2');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: id_proyek},
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



    var table = $('#na_datatable_potongan').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('pencairan/datatable_json_rincian_potongan/'.$pencairan["id"].'/'.$proyek["id_proyek"].'/'.$this->uri->segment(5))?>",
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