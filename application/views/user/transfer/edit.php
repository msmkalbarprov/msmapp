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
             Edit Transfer</h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('transfer'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
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
         <?php echo form_open_multipart('transfer/edit_pdo_keterangan/'.$data_transfer["no_transfer"].'/1');?>
         <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="item_hpp" class="control-label">No. Transfer</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="text" name="nomor" id="nomor" class="form-control" value="<?= $data_transfer["no_transfer"]; ?>" readonly>
              <input type="hidden" name="urut" id="urut" class="form-control" readonly>
            </div>
          </div>
          
          <div class="col-md-4">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Tanggal Transfer</label>
              <input type="date" name="tgl_transfer" id="tgl_transfer" value="<?= $data_transfer["tgl_transfer"]; ?>" class="form-control"  readonly >
          </div>
          </div>
   
          <div class="col-md-4">
            <div class="form-group">
              <label for="area" class="control-label"><?= trans('area') ?></label>
                <select name="area" id ="area" class="form-control select2" style="width: 100%;" readonly >
                <option value="">No Selected</option>
                <?php foreach($data_area as $area): ?>
                    <?php if($area['kd_area']==$data_transfer["kd_area"]) : ?>
                      <option value="<?= $area['kd_area']; ?>" selected><?= $area['nm_area']; ?></option>
                    <?php else: ?>
                      <option value="<?= $area['kd_area']; ?>"><?= $area['nm_area']; ?></option>
                  <?php endif; ?>
                  <?php endforeach; ?>
                </select>

            </div>
          </div>
            

         </div>

        <div class="form-group">
          <div class="col-md-12" align="center">
            <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal">Tambah Rincian</a>
        </div>
      
      <?php echo form_close( ); ?>

      <div class="col-md-12">
          <div class="card-body table-responsive">
            <table id="na_datatable" class="table table-bordered table-striped" width="100%">
              <thead>
                <tr>
                  <th>No. Transfer</th>
                  <th width="10%">Tgl. Transfer</th>
                  <th>No. Pencairan</th>
                  <th>Nilai</th>
                  <th>Potongan</th>
                  <th width="5%">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>


<!-- large modal -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Tambah Rincian</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
         <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="proyek" class="control-label">No. Pencairan</label>
                <input type="hidden" name="id_proyek" id="id_proyek" class="form-control" readonly>
                <input type="hidden" name="kd_proyek" id="kd_proyek" class="form-control" readonly>
                <select name="projek"  id="projek" class="form-control" required>
                  <option value="">No Selected</option>
                </select>                

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="item_hpp" class="control-label">Tujuan Transfer</label>
                <select name="item_hpp"  id="item_hpp" class="form-control" required>
                <option value="">No Selected</option>
                <?php foreach($item_hpp as $item_hpp): ?>
                      <option value="<?= $item_hpp['no_acc']; ?>"><?= $item_hpp['nm_acc']; ?></option>
                  <?php endforeach; ?>
                </select> 

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
           <div class="form-group">
              <label for="dinas" class="control-label">Nilai Transfer</label>
               <input type="text" name="nilai" id="nilai" class="form-control" value="0" style="background:none;text-align:right;" readonly >
          </div>
          </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        <button name="butsave" id="butsave"  class="btn btn-success btn-sm"> Simpan </button>
      </div>
    </div>
  </div>
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
  $("#transfer> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    get_pencairan();

    var kodepdo   = $('#nomor').val();
    var nomortransfer  = kodepdo.replace(/\//g,'f58ff891333ec9048109908d5f720903');
    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('transfer/datatable_json_edit'.'/')?>"+ nomortransfer+'/<?= $this->uri->segment(3); ?>',
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "no_transfer", 'searchable':true, 'orderable':false},
    { "targets": 1, "name": "tgl_transfer", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "no_cair", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });


$('#projek').change(function(){ 
    var idproyek    = $(this).val();
    var kodearea    = document.getElementById("area").value;
    
    // get_nomor_urut(kodearea,idproyek);
     $.ajax({
        url : "<?php echo site_url('transfer/get_nilai_cair_netto');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: idproyek},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="nilai"]').val(number_format(value.nilai_netto,"2",",",".")).trigger('change');
                $('[name="id_proyek"]').val(value.id_proyek).trigger('change');
                $('[name="kd_proyek"]').val(value.kd_proyek).trigger('change');
            });

        }
    });
    return false;
});


function get_pencairan(argument) {
  var kodearea=document.getElementById("area").value;
    $.ajax({
        url : "<?php echo site_url('transfer/get_pq_pencairan_by_area');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kodearea},
        async : true,
        dataType : 'json',
        success: function(data){
            $('select[name="projek"]').empty();
            $('select[name="projek"]').append('<option value="">No Selected</option>');
            $.each(data, function(key, value) {
                $('select[name="projek"]').append('<option value="'+ value.nomor +'">'+ value.nomor +' - Rp.'+value.nilai_bruto +'</option>');
            });

        }
    });
    return false;
}


function reload_data_cair() {
  var kodearea=document.getElementById("area").value;
    $.ajax({
        url : "<?php echo site_url('transfer/get_pq_pencairan_by_area');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kodearea},
        async : true,
        dataType : 'json',
        success: function(data){
            $('select[name="projek"]').empty();
            $('select[name="projek"]').append('<option value="">No Selected</option>');
            $.each(data, function(key, value) {
                $('select[name="projek"]').append('<option value="'+ value.nomor +'">'+ value.nomor +' - Rp.'+value.nilai_bruto +'</option>');
            });

        }
    });
    return false;
}

$('#butsave').on('click', function() {
    var no_transfer   = $('#nomor').val();
    var tgl_transfer  = $('#tgl_transfer').val();
    var nourut        = $('#urut').val();
    var no_cair       = $('#projek').val();
    var nilai         = number($('#nilai').val());
    var area          = $('#area').val();
    var id_proyek     = $('#id_proyek').val();
    var kd_proyek     = $('#kd_proyek').val();
    var item_hpp      = $('#item_hpp').val();
    
    

    if(tgl_transfer==""){
      alert('Tanggal tidak boleh kosong')
      return;
    }
    if(projek==""){
      alert('Nomor Cair tidak boleh kosong')
      return;
    }
    
    if(nilai=="" || nilai==0){
      alert('Nilai tidak boleh kosong')
      return;
    }

    if(area==""){
      alert('Area tidak boleh kosong')
      return;
    }

    if(item_hpp==""){
      alert('Tujuan transfer tidak boleh kosong')
      return;
    }

      
      $.ajax({
        url: "<?php echo base_url("transfer/edit/");?>",
        type: "POST",
        data: {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          type          : 1,
          area          : area,
          no_cair       : no_cair,
          id_proyek     : id_proyek,
          tgl_transfer  : tgl_transfer,
          no_transfer   : no_transfer,
          no_urut       : nourut,
          nilai         : nilai,
          kd_proyek     : kd_proyek,
          nourut        : nourut,
          item_hpp      : item_hpp

        },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){
            document.getElementById("projek").value='';
            document.getElementById("nilai").value='';
            document.getElementById("item_hpp").value='';
            nomortransfer = no_transfer.replace(/\//g,'f58ff891333ec9048109908d5f720903');
            nocair        = no_cair.replace(/\//g,'f58ff891333ec9048109908d5f720903');
            $('#largeModal').modal('toggle');
            load_rincian(nomortransfer,nocair);

            $("#error").hide();
            reload_data_cair()
          }
          else if(dataResult.statusCode==201){
            $("#error").show();
            $("#success").hide();
            $('#error').html('Gagal Simpan');
          }
        }
      });
    
  });

function load_rincian(nomortransfer,nocair) {
        table.ajax.url("<?=base_url('transfer/datatable_json_transfer_edit'.'/')?>"+ nomortransfer+'/'+nocair);
        table.ajax.reload();
}



  }); 


</script>