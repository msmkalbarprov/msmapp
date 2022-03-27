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
             Tambah PDO Operasional </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('pdo/operasional'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>

        <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
        <?php $this->load->view('admin/includes/_messages.php') ?>
         
         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="item_hpp" class="control-label">Kode PDO</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="text" name="kd_pdo" id="kd_pdo" class="form-control" readonly>
              <input type="hidden" name="urut" id="urut" class="form-control" readonly>
              <input type="hidden" name="project" id="project" class="form-control" readonly>

            </div>
          </div>
          
          <div class="col-md-3">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Tanggal PDO</label>
              <input type="date" name="tgl_pdo" id="tgl_pdo" class="form-control"  required >
          </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="proyek" class="control-label">Tahun Anggaran</label>
                
                <select name="thn_ang" id="thn_ang" class="form-control" required>
                  <option value="">No Selected</option>
                  <option value="<?= date('Y')-1;?>"><?= date('Y')-1;?></option>
                  <option value="<?= date('Y')?>"><?= date('Y')?></option>
                  <option value="<?= date('Y')+1;?>"><?= date('Y')+1;?></option>
                </select>

            </div>
          </div>
         </div>

         <div class="row">
          
          <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label"><?= trans('area') ?></label>
                <select name="area" id ="area" class="form-control select2" style="width: 100%;" required >
                <option value="">No Selected</option>
                <?php foreach($data_area as $area): ?>
                  <?php if($area['kd_area'] == $this->session->userdata('kd_area')): ?>
                    <option value="<?= $area['kd_area']; ?>" selected><?= $area['nm_area']; ?></option>
                    <?php else: ?>
                      <option value="<?= $area['kd_area']; ?>"><?= $area['nm_area']; ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>

            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="item_hpp" class="control-label">Akun</label>
              <input type="hidden" name="jns_tkls" id="jns_tkls" class="form-control" readonly>
                <select name="item_hpp"  id="item_hpp" class="form-control" required>
                  <option value="">No Selected</option>
                </select> 

            </div>
          </div>

          </div>

         <div class="row">
          
          
          <div class="col-md-12">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Uraian</label>
              <input type="text" name="uraian" id="uraian" class="form-control"  placeholder="Uraian" >
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-2">
            
          </div>
          <div class="col-md-2">
          </div>

          <div class="col-md-2">
          </div>

          <div class="col-md-3" align="right">
            <label for="dinas" class="control-label">Nilai PDO </label>
          </div>
          <div class="col-md-3">
           <div class="form-group">
               <input type="text" name="total" id="total" class="form-control bg-light text-white" placeholder="Input Nilai"  style="background:none;text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
          </div>
          </div>
         </div>

         <div class="row">
          
          <div class="col-md-9" align="right">
            <label for="dinas" class="control-label">Nilai PQ Operasional</label>
          </div>
          <div class="col-md-3">
           <div class="form-group">
                <input type="text" name="pnet" id="pnet" class="form-control"  style="background:none;text-align:right;"readonly >
            </div>
          </div>
         
         </div>

         <div class="row">
          
          <div class="col-md-9" align="right">
           <label for="dinas" class="control-label">Realisasi</label>
          </div>
          <div class="col-md-3" >
           <div class="form-group">
                <input type="text" name="thpp" id="thpp" class="form-control"   style="background:none;text-align:right;"readonly >
            </div>
          </div>
         
         </div>

         <div class="row">
          
          <div class="col-md-9" align="right">
           <label for="dinas" class="control-label">Sisa</label>
          </div>
          <div class="col-md-3">
           <div class="form-group">
                <input type="text" name="sisa" id="sisa" class="form-control"   style="background:none;text-align:right;"readonly >
            </div>
          </div>
         
         </div>

        <div class="form-group">
          <div class="col-md-12" align="center">
            <input type="submit" name="submit" id="butsave" value="Simpan" class="btn btn-primary btn-sm">
          </div>
        </div>
      
      <!-- datatable -->
      
        <!-- <div class="col-md-12">
          <div class="card-body table-responsive">
            <table id="na_datatable" class="table table-bordered table-striped" width="100%">
              <thead>
                <tr>
                  <th>#No</th>
                  <th>Kode Akun</th>
                  <th>Item/uraian</th>
                  <th>Nilai</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div> -->
       


      </div>
      <!-- /.box-body -->
    </div>
  </section> 
</div>
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/dist/js/jquery-3.3.1.js'?>"></script> -->
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
  <script>
  $("#pq> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    $('.select2').select2()
    // get_pqproyek()
    // get_datatable();
    
    $('#divisi').prop('disabled', true)


// get pq projek

$('#area').change(function(){ 
    var kodearea=$(this).val();
    get_nomor_urut(kodearea)
    var thn_ang = $('#thn_ang').val();
    $.ajax({
        url : "<?php echo site_url('cpdo/get_pq_operasional_by_area');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kodearea,tahun:thn_ang},
        async : true,
        dataType : 'json',
        success: function(data){
            $('select[name="item_hpp"]').empty();
            $('select[name="item_hpp"]').append('<option value="">No Selected</option>');
            $.each(data, function(key, value) {
                
                $('select[name="item_hpp"]').append('<option value="'+ value.kd_pq_operasional+'">'+ value.kd_item +' - '+value.nm_item +'</option>');
            });

        }
    });
    return false;
});


$('#item_hpp').change(function(){ 
  var kode_pqoperasional  = $(this).val();
  var nomorurut           = $('#urut').val();
  var nomorpdo            = 'PDO/'+kode_pqoperasional+'/'+nomorurut;
  var kd_coa              = kode_pqoperasional.substr(11,5);
  $('[name="kd_pdo"]').val(nomorpdo).trigger('change');
  $('[name="project"]').val(kode_pqoperasional).trigger('change');
  get_nilai(kode_pqoperasional);
  return false;
});


function get_nilai(kode_pqoperasional){
        $.ajax({
        url : "<?php echo site_url('cpdo/get_nilai_op');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          kode_pqoperasional: kode_pqoperasional},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="pnet"]').val(number_format(value.total,"2",",",".")).trigger('change');

                get_realisasi(kode_pqoperasional,value.total)
            });

        }
    });
}



function get_realisasi(kode_pqoperasional,nil_pq){
        $.ajax({
        url : "<?php echo site_url('cpdo/get_realisasi_op');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          kode_pqoperasional: kode_pqoperasional},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="thpp"]').val(number_format(value.total,"2",",",".")).trigger('change');

                $('[name="sisa"]').val(number_format(nil_pq - value.total,"2",",",".")).trigger('change');

            });

        }
    });
        
}


function get_nomor_urut(area){
        $.ajax({
        url : "<?php echo site_url('cpdo/get_nomor');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          area: area},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="urut"]').val(value.nomor).trigger('change');
            });

        }
    });
}




    // SAVE
$('#butsave').on('click', function() {
    var kd_item       = $('#item_hpp').val().substr(11,5);
    var no_pdo        = $('#kd_pdo').val();
    var tgl_pdo       = $('#tgl_pdo').val();
    var nourut        = $('#urut').val();
    var projek        = $('#project').val();//kode_pqoperasional
    var uraian        = $('#uraian').val();
    var total         = number($('#total').val());
    var area          = $('#area').val();
    var idpdo         = no_pdo.replace(/\//g,'');
    var kodeproject   = projek;
    var sisa          = number($('#sisa').val());
    if(total>sisa){
      $("#error").show();
      $("#success").hide();
      $('#error').html('Gagal! Nilai Melebihi sisa PQ operasional');
      return;
    }
    
    if(tgl_pdo!="" && projek != "" && kd_item!=""  && total!="" && area!=""){
      $("#butsave").attr("disabled", "disabled");
      $.ajax({
        url: "<?php echo base_url("cpdo/add_operasional"); ?>",
        type: "POST",
        data: {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          type:1,
          area:area,
          projek:projek,
          tgl_pdo:tgl_pdo,
          kd_item :kd_item,
          uraian:uraian,
          total:total,
          idpdo:idpdo,
          no_pdo:no_pdo,
          kodeproject:kodeproject,
          nourut:nourut

        },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){
            document.getElementById("butsave").disabled = true;
            window.location.replace("<?= base_url('/pdo/operasional') ?>");
            $("#error").hide();
          }
          else if(dataResult.statusCode==201){
            $("#error").show();
            $("#success").hide();
            $('#error').html('Gagal Simpan');
          }
        }
      });
    }
    else{
      alert('Please fill all the field !');
    }
  });

  }); 


</script>