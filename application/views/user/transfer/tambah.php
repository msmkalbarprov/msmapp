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
             Tambah data transfer</h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('transfer'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
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
         <?php echo form_open(base_url('transfer/add_transfer'), 'class="form-horizontal"' )?> 
         <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="item_hpp" class="control-label">No. Transfer</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="text" name="nomor" id="nomor" class="form-control" readonly>
              <input type="hidden" name="urut" id="urut" class="form-control" readonly>
            </div>
          </div>
          
          <div class="col-md-4">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Tanggal Transfer</label>
              <input type="date" name="tgl_transfer" id="tgl_transfer" class="form-control"  required >
          </div>
          </div>
   
          <div class="col-md-4">
            <div class="form-group">
              <label for="area" class="control-label"><?= trans('area') ?></label>
                <input type="hidden" name="kode_area" id="kode_area" class="form-control" readonly>
                <select name="area" id ="area" class="form-control select2" style="width: 100%;" required >
                <option value="">No Selected</option>
                <?php foreach($data_area as $area): ?>
                      <option value="<?= $area['kd_area']; ?>"><?= $area['nm_area']; ?></option>
                  <?php endforeach; ?>
                </select>

            </div>
          </div>
            

         </div>

         


        
        <div class="form-group">
          <div class="col-md-12" align="center">
            <!-- <button name="but_tambah" id="but_tambah"  class="btn btn-success btn-sm"> Tambah </button> -->
            <!-- <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal">Tambah Rincian</a> -->
            <a href="#" id="but_tambah" class="btn btn-sm btn-success">Tambah Rincian</a>
            <!-- <button onclick="javascript:opendialog();" class="btn btn-success btn-sm" id="buttontambah"> Tambah</button> -->
            <input type="submit" name="submit" id="tombolsimpan" value="Simpan" class="btn btn-primary btn-sm">
          </div>
        </div>
      <?php echo form_close(); ?>
      <!-- datatable -->
      
        <div class="col-md-12">
          <div class="card-body table-responsive">
            <table id="na_datatable" class="table table-bordered table-striped" width="100%">
              <thead>
                <tr>
                  <!-- <th>#No</th> -->
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
      <!-- /.box-body -->
    </div>
  </section> 
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
    $('.select2').select2()
    $('[name="s_transfer"]').val('0').trigger('change');
  $('#c_transfer').click(function() {
      if ($('#c_transfer').prop('checked') == true){
          $('[name="s_transfer"]').val('1').trigger('change');
      }else{
        $('[name="s_transfer"]').val('0').trigger('change');
      }
});

    nomortransfer=0;
    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ordering": true, // Set true agar bisa di sorting
    "ajax": 
    // "<?=base_url('cpdo/datatable_json_pdo_proyek'.'/')?>"+ nomortransfer,
    {
                "url": "<?=base_url('transfer/view'.'/')?>"+ nomortransfer, // URL file untuk proses select datanya
                "type": "POST",
                "data" : {
                        "<?php echo $this->security->get_csrf_token_name(); ?>" : "<?php echo $this->security->get_csrf_hash(); ?>"
                      }
            },
    "deferRender": true,
    "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],

     "columns": [
                { "data": "no_transfer" }, // Tampilkan no_acc
                { "data": "tgl_transfer" },  // Tampilkan nama
                { "data": "no_cair" }, // Tampilkan qty
                { "data": "nilai" , render: $.fn.dataTable.render.number(',', '.', 2, ''), "className": "text-right"}, // Tampilkan total
                { "data": "nilai" , render: $.fn.dataTable.render.number(',', '.', 2, ''), "className": "text-right"}, // Tampilkan total
                {
                    "data": null,
                    "render": function(data) {

                        return '<button class="btn btn-danger btn-sm del_btn" id="'+data.no_acc+'"><i class="fa fa-trash-o"></i></button>';
                    }
                }
            ],
  });

$('#na_datatable').on('click', 'tbody .del_btn', function () {
    var data_row = table.row($(this).closest('tr')).data();
    // alert(data_row.no_acc+' - '+data_row.id)

    var id_hapus  = data_row.id;
    var no_pdo    = $('#kd_pdo').val();
    var nomorpdo  = no_pdo.replace(/\//g,'abcde')

    // proses hapus
    $.ajax({
        url: "<?php echo base_url("cpdo/delete_pdo_project_temp2/");?>",
        type: "POST",
        data: {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          type:1,
          id:id_hapus

        },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){
            $("#success").show();
            $('#success').html('Data Berhasil ditambahkan !'); 
            
            load_rincian_temp(nomorpdo);
          }
          else if(dataResult.statusCode==201){
            $("#error").show();
            $("#success").hide();
            $('#error').html('Gagal Simpan');
          }
        }
      });
})


$('#myModal').modal('show');


// get pq projek

$('#area').change(function(){ 
    var kodearea=$(this).val();

    document.getElementById("kode_area").value=kodearea; 
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
});

$('#but_tambah').on('click', function() {
  var tgl_transfer  = document.getElementById("tgl_transfer").value;
  var area          = document.getElementById("area").value;
  var tahun         = tgl_transfer.substr(0,4);

  if(tahun==''){
    alert('Tanggal tidak boleh kosong!!!');
    return;
  }
  $('#largeModal').modal('show');
  get_nomor_urut(area,tahun)
  document.getElementById("tgl_transfer").disabled=true;
  document.getElementById("area").disabled=true;

});

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

function load_rincian(nomortransfer) {
        table.ajax.url("<?=base_url('transfer/view'.'/')?>"+ nomortransfer);
        table.ajax.reload();
}






function get_nomor_urut(area,tahun){
        var tanggal   = tahun;
        $.ajax({
        url : "<?php echo site_url('transfer/get_nomor');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          area: area},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="urut"]').val(value.nomor).trigger('change');
                var nomorpdo = 'TF/'+tanggal+'/'+area+'/'+value.nomor;
                $('[name="nomor"]').val(nomorpdo).trigger('change');
                nomortransfer = nomorpdo.replace(/\//g,'abcde')
                load_rincian(nomortransfer)

            });

        }
    });
}


    function get_projekcombo(){ 
                var kodearea=document.getElementById("area").value;
                $.ajax({
                      url : "<?php echo site_url('cpdo/get_pq_projek_gaji_by_area');?>",
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
                              $('select[name="projek"]').append('<option value="'+ value.kd_pqproyek +'">'+ value.kd_pqproyek +' '+value.nm_paket_proyek +'</option>');
                          });

                      }
                  });
                return false;
            };

// Hitung total


    // SAVE
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
        url: "<?php echo base_url("transfer/add/");?>",
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
            nomortransfer = no_transfer.replace(/\//g,'abcde')
            $('#largeModal').modal('toggle');
            load_rincian(nomortransfer);
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

  }); 


</script>