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
            <h3 class="card-title"> 
             Pencairan PDO Proyek </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('pencairan_pdo'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
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
         <?php echo form_open_multipart('pencairan_pdo/batalcair_pdo/'.$data_pdo["id_pdo"].'/1');?>
         
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="item_hpp" class="control-label">No Pencairan</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="text" name="no_cair" id="no_cair" class="form-control" required>

            </div>
          </div>
          
          <div class="col-md-3">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Tanggal Pencairan</label>
              <input type="date" name="tgl_cair" id="tgl_cair" class="form-control" required>
          </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">&nbsp;</label>
              <input type="text" style="border: none;color: green;font-size: 25px;text-align: center;" name="status_cair" id="status_cair" class="form-control" required>
          </div>
          </div>
        </div>
         <br>
         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="item_hpp" class="control-label">Kode PDO</label>
              <input type="text" name="kd_pdo" id="kd_pdo" class="form-control" value="<?= $data_pdo['kd_pdo']; ?>" readonly>

            </div>
          </div>
          
          <div class="col-md-3">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Tanggal PDO</label>
              <input type="date" name="tgl_pdo" id="tgl_pdo" class="form-control" value="<?= $data_pdo['tgl_pdo']; ?>"  readonly >
          </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="area" class="control-label"><?= trans('area') ?></label>
                <input type="text" name="area" id="area" class="form-control" value="<?= $data_pdo['nm_area']; ?>" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="area" class="control-label">Transfer</label><br>
                    <small>Langsung</small>
                    <input class='tgl-ios tgl_checkbox' id='c_transfer' name="c_transfer"  type='checkbox' readonly/>
                    <label for='c_transfer'></label>
                    <small>Kas Daerah</small>
                    <input id='s_transfer' name="s_transfer"  type='hidden' />
            </div>
          </div>
         </div>

         <div class="row">
          

          <div class="col-md-6">
            <div class="form-group">
              <label for="proyek" class="control-label">PQ Proyek</label>
              <input type="text" name="projek" id="projek" class="form-control" value="<?= $data_pdo['nm_proyek']; ?>"  readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="proyek" class="control-label">Divisi</label>
                
               <input type="text" name="divisi" id="divisi" class="form-control" value="<?= $data_pdo['nm_divisi']; ?>" readonly>

            </div>
          </div>
          
         </div>

        <div class="row">
          <div class="col-md-12">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Keterangan</label>
              <textarea type="text" name="keterangan" id="keterangan" class="form-control"  placeholder="" readonly><?= $data_pdo['keterangan']; ?></textarea>
          </div>
          </div>
         </div>

        <div class="form-group">
          <div class="col-md-12" align="right">
            <input type="submit" name="submit" id="tombolsimpan" value="Batal Cair PDO" class="btn btn-danger btn-sm">
            <button class="btn btn-success btn-sm" id="btn_update" type="submit">update tanggal</button>
          </div>
        </div>
      
      <?php echo form_close( ); ?>

      <div class="col-md-12">
          <div class="card-body table-responsive">
            <table id="na_datatable" class="table table-bordered table-striped" width="100%">
              <thead>
                <tr>
                  <th>Kode Proyek</th>
                  <th>Akun</th>
                  <th>Qty</th>
                  <th>Satuan</th>
                  <th>Harga</th>
                  <th>Uraian</th>
                  <th>Nilai</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>


<!-- large modal -->

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
  $("#pencairan_pdo> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    get_akun();
    set_status_transfer();
    get_nomor_urut();

    var kodepdo   = $('#kd_pdo').val();
    var nomorpdo  = kodepdo.replace(/\//g,'abcde');
    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('pencairan_pdo/datatable_json_pdo_proyek_edit'.'/')?>"+ nomorpdo+'/<?= $this->uri->segment(3); ?>',
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "kd_item", 'searchable':true, 'orderable':false},
    { "targets": 1, "name": "nm_item", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "qty", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "satuan", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "harga", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "uraian", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "Nilai", 'searchable':true, 'orderable':false},
    ]
  });

$('#c_transfer').click(function() {
  if ($('#c_transfer').prop('checked') == true){
      $('[name="s_transfer"]').val('1').trigger('change');
  }else{
    $('[name="s_transfer"]').val('0').trigger('change');
  }
});

function set_status_transfer() {
  var status_transfer = "<?= $data_pdo['s_transfer'] ?>";
  if (status_transfer==1){
    $('#c_transfer').attr('checked', 'checked');
    $('[name="s_transfer"]').val('1').trigger('change');
  }
}

function get_nomor_urut(){
    var no_cair   = "<?= $data_pdo["no_cair"]; ?>";
    var tgl_cair  = "<?= $data_pdo["tgl_cair"]; ?>";
        $.ajax({
        url : "<?php echo site_url('pencairan_pdo/get_nomor_bud');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {

                if (no_cair=='' || no_cair== null){
                  $('[name="no_cair"]').val(value.nomor).trigger('change');  
                }else{
                  $('[name="no_cair"]').val(no_cair).trigger('change');
                  $('[name="tgl_cair"]').val(tgl_cair).trigger('change');
                  $('[name="status_cair"]').val("PDO Sudah Cair").trigger('change');
                  
                }
                
            });

        }
    });
}

// Hitung total
// document.getElementById("qty").onmouseup = function() {hitung_total()};
// document.getElementById("qty").onkeyup   = function() {hitung_total()};
// document.getElementById("harga").onkeyup   = function() {hitung_total()};

function hitung_total() {
  var harga     = number(document.getElementById("harga").value);
  var volume    = number(document.getElementById("qty").value);
  let totalrow = 0;

  totalrow = harga*volume;
  $('[name="total"]').val(number_format(totalrow,"2",",",".")).trigger('change');
}


function get_akun() {
    var idproyek   = "<?= $data_pdo['kd_pqproyek']; ?>";
    $.ajax({
        url : "<?php echo site_url('pengesahan_pdo/get_item_pq_by_pq');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: idproyek},
        async : true,
        dataType : 'json',
        success: function(data){
            $('select[name="item_hpp"]').empty();
            $('select[name="item_hpp"]').append('<option value="">No Selected</option>');

            $.each(data, function(key, value) {
                if (value.jenis_tk == '' || value.jenis_tk == null){
                  $('select[name="item_hpp"]').append('<option value="'+value.kd_item+'">'+ value.kd_item +' '+value.nm_item +'</option>');
                }else{
                  $('select[name="item_hpp"]').append('<option value="'+ value.kd_item+value.jenis_tk+'">'+ value.kd_item +' '+value.nm_item +' ('+ value.jenis_tk +')</option>');

                }


            });

        }
    });
  // body...
}


function load_rincian_temp(nomorpdo) {
        table.ajax.url("<?=base_url('pengesahan_pdo/datatable_json_pdo_proyek_edit'.'/')?>"+ nomorpdo);
        table.ajax.reload();
}

// SAVE
$('#btn_update').on('click', function() {
    var no_cair             = $('#no_cair').val();
    var kd_pdo              = $('#kd_pdo').val();    
    var tgl_cair            = $('#tgl_cair').val();

    if(kd_pdo==""){
      alert('No PDO tidak boleh kosong')
      return;
    }

    if(tgl_cair==""){
      alert('Tanggal pencairan tidak boleh kosong')
      return;
    }
    
    if(no_cair==""){
      alert('No Pencairan tidak boleh kosong')
      return;
    }

      $.ajax({
        url: "<?php echo base_url("pencairan_pdo/update_tanggal/");?>",
        type: "POST",
        data: {
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
            type:1,
            no_cair:no_cair,
            kd_pdo:kd_pdo,
            tgl_cair:tgl_cair
            },
            cache: false,
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#largeModal').modal('toggle');
                    $("#error").hide();
                    $("#success").show();
                    $('#success').html('berhasil diubah');
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