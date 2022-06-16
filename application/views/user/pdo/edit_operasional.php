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
             Edit PDO Operasional </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('cpdo/operasional'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
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
         <?php echo form_open_multipart('cpdo/edit_pdo_keterangan/'.$data_pdo["id_pdo"].'/2');?>
         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="item_hpp" class="control-label">Kode PDO</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
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
              <label for="proyek" class="control-label">Tahun Anggaran</label>
              <input type="text" name="thn_ang" id="thn_ang" class="form-control" value="<?= substr($data_pdo['kd_project'],0,4); ?>"  readonly>
            </div>
          </div>
          
          <div class="col-md-3">
            <div class="form-group">
              <label for="area" class="control-label">Area</label>
                <input type="text" name="area" id="area" class="form-control" value="<?= $data_pdo['nm_area']; ?>" readonly>
            </div>
          </div>
         </div>

          <div class="row">
          <div class="col-md-3">
          <div class="form-group">
            <label for="area" class="control-label">Transfer</label><br>
                  <small>Langsung</small>
                  <input class='tgl-ios tgl_checkbox' id='c_transfer' name="c_transfer"  type='checkbox' />
                  <label for='c_transfer'></label>
                  <small>Kas Area</small>
                  <input id='s_transfer' name="s_transfer"  type='hidden' />
          </div>
        </div>
          <div class="col-md-9">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Keterangan</label>
              <textarea type="text" name="keterangan" id="keterangan" class="form-control"  placeholder="" ><?= $data_pdo['keterangan']; ?></textarea>
          </div>
          </div>
         </div>

        <div class="form-group">
          <div class="col-md-12" align="center">
            <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal">Tambah Rincian</a>
            <input type="submit" name="submit" id="tombolsimpan" value="Update" class="btn btn-primary btn-sm">
          </div>
        </div>
      
      <?php echo form_close( ); ?>
      <div class="col-md-12">
          <div class="card-body table-responsive">
            <table id="na_datatable" class="table table-bordered table-striped" width="100%">
              <thead>
                <tr>
                  <th width="10%">Kode</th>
                  <th>Nama Akun</th>
                  <th>Qty</th>
                  <th>Satuan</th>
                  <th>Harga</th>
                  <th>Uraian</th>
                  <th>Rekening</th>
                  <th>Nilai</th>
                  <th width="5%">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <!-- large modal -->
<div class="modal fade bd-example-modal-lg" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Tambah Rincian</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>

        <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="item_hpp" class="control-label">Akun</label>
              <input type="hidden" name="jns_tkls" id="jns_tkls" class="form-control" readonly>
                <select name="item_hpp"  id="item_hpp" class="form-control" required>
                  <option value="">No Selected</option>
                </select> 

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label">Rekening/Pegawai</label><br>
                    <select name="kd_pegawai"  id="kd_pegawai" class="form-control" required>
                    <option value="">No Selected</option>
                  </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="no_rek" class="control-label">Rek. Tujuan</label>
                <select name="no_rekening" id ="no_rekening" class="form-control select2" style="width: 100%;" required >
                <option value="">No Selected</option>
                <?php foreach($data_rekening as $rekening): ?>
                      <option value="<?= $rekening['no_rekening']; ?>"><?= $rekening['pemilik'].' - '.$rekening['nm_bank'].' - '.$rekening['no_rekening']; ?></option>
                  <?php endforeach; ?>
                </select>

            </div>
          </div>
        </div>
         <div class="row">
          <div class="col-md-6">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Qty</label>
              <input type="number" name="qty" id="qty" class="form-control"  >
          </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Satuan</label>
              <input type="text" name="satuan" id="satuan" class="form-control"  >
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-6">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Harga</label>
              <input type="text" name="harga" id="harga" class="form-control"  style="background:none;text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
          </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Uraian</label>
              <input type="text" name="uraian" id="uraian" class="form-control"  placeholder="Uraian" >
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-12">
           <div class="form-group">
              <label for="dinas" class="control-label">Nilai PDO </label>
               <input type="text" name="total" id="total" class="form-control bg-light text-white" placeholder="Input Nilai"  style="background:none;text-align:right;" >
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-12">
           <div class="form-group">
                <label for="dinas" class="control-label">Nilai HPP</label>
                <input type="text" name="pnet" id="pnet" class="form-control"  style="background:none;text-align:right;"readonly >
            </div>
          </div>
         
         </div>

         <div class="row">
          <div class="col-md-12" >
           <div class="form-group">
                <label for="dinas" class="control-label">Realisasi</label>
                <input type="text" name="thpp" id="thpp" class="form-control"   style="background:none;text-align:right;"readonly >
            </div>
          </div>
         
         </div>

         <div class="row">
          <div class="col-md-12">
           <div class="form-group">
                <label for="dinas" class="control-label">Sisa</label>
                <input type="text" name="sisa" id="sisa" class="form-control"   style="background:none;text-align:right;"readonly >
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
  $("#cpdo> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    set_status_transfer();
    
    get_akun();
    var kodepdo   = $('#kd_pdo').val();
    var nomorpdo  = kodepdo.replace(/\//g,'abcde');
    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('cpdo/datatable_json_pdo_operasional_edit'.'/')?>"+ nomorpdo+'/<?= $this->uri->segment(3); ?>',
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "kd_item", 'searchable':true, 'orderable':false},
    { "targets": 1, "name": "nm_item", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "qty", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "satuan", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "harga", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "uraian", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "no_rekening", 'searchable':true, 'orderable':false},
    { "targets": 7, "name": "Nilai", 'searchable':true, 'orderable':false},
    { "targets": 8, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });

$('#c_transfer').click(function() {
  if ($('#c_transfer').prop('checked') == true){
      $('[name="s_transfer"]').val('1').trigger('change');
      var kodearea ="<?= $data_pdo['kd_area']; ?>";
      get_pegawai(kodearea);
  }else{
    $('[name="s_transfer"]').val('0').trigger('change');
  }
});

function set_status_transfer() {
  var status_transfer = "<?= $data_pdo['s_transfer'] ?>";

  if (status_transfer==1){
    $('#c_transfer').attr('checked', 'checked');
    $('[name="s_transfer"]').val('1').trigger('change');
    var kodearea="<?= $data_pdo['kd_area']; ?>";
    get_pegawai(kodearea);
  }
}

function get_pegawai(area) {
    $.ajax({
                    url : "<?php echo site_url('spj_pegawai/get_pegawai_by_area');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: area},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="kd_pegawai"]').empty();
                        $('select[name="kd_pegawai"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {
                            $('select[name="kd_pegawai"]').append('<option value="'+ value.kd_pegawai +'">'+ value.nama +'</option>');
                        });

                    }
                });
}

// function set_status_transfer() {
//   var status_transfer = "<?= $data_pdo['s_transfer'] ?>";
//   if (status_transfer==1){
//     $('#c_transfer').attr('checked', 'checked');
//     $('[name="s_transfer"]').val('1').trigger('change');
//   }
// }

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



function get_realisasi(kode_pqoperasional,nil_hpp){
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

                $('[name="sisa"]').val(number_format(nil_hpp - value.total,"2",",",".")).trigger('change');

            });

        }
    });
        
}

$('#item_hpp').change(function(){ 
  var kode_pqoperasional  = $(this).val();
  $('[name="project"]').val(kode_pqoperasional).trigger('change');
  get_nilai(kode_pqoperasional);
  return false;
});

function get_akun() {
   var kodearea ="<?= $data_pdo['kd_area']; ?>";
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
  // body...
}

function load_rincian_temp(nomorpdo) {
        table.ajax.url("<?=base_url('cpdo/datatable_json_pdo_proyek_edit'.'/')?>"+ nomorpdo);
        table.ajax.reload();
}

document.getElementById("qty").onmouseup = function() {hitung_total()};
document.getElementById("qty").onkeyup   = function() {hitung_total()};
document.getElementById("harga").onkeyup   = function() {hitung_total()};

function hitung_total() {
  var harga     = number(document.getElementById("harga").value);
  var volume    = number(document.getElementById("qty").value);
  let totalrow = 0;

  totalrow = harga*volume;
  $('[name="total"]').val(number_format(totalrow,"2",",",".")).trigger('change');
}

    // SAVE
$('#butsave').on('click', function() {
    var kd_item       = $('#item_hpp').val().substr(11,5);
    var no_pdo        = $('#kd_pdo').val();
    var tgl_pdo       = $('#tgl_pdo').val();
    var nourut        = $('#urut').val();
    var projek        = "<?= $data_pdo['kd_project']; ?>";
    var uraian        = $('#uraian').val();
    var kd_pegawai    = $('#kd_pegawai').val();
    var s_transfer    = $('#s_transfer').val();
    var qty           = $('#qty').val();
    var satuan        = $('#satuan').val();
    var total         = number($('#total').val());
    var harga         = number($('#harga').val());
    var area          = "<?= $data_pdo['kd_area']; ?>";
    var idpdo         = no_pdo.replace(/\//g,'');
    var kodeproject   = projek;
    var sisa          = number($('#sisa').val());
    var no_rekening   = $('#no_rekening').val();
    if(total>sisa){
      alert('Gagal! Nilai Melebihi sisa HPP');
      return;
    }
    
    if(tgl_pdo!="" && projek != "" && kd_item!=""  && total!="" && area!=""){
      // $("#butsave").attr("disabled", "disabled");
      $.ajax({
        url: "<?php echo base_url("cpdo/edit_pdo_operasional"); ?>",
        type: "POST",
        data: {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          type:1,
          area:area,
          projek:projek,
          tgl_pdo:tgl_pdo,
          kd_item :kd_item,
          uraian:uraian,
          kd_pegawai:kd_pegawai,
          qty:qty,
          satuan:satuan,
          harga:harga,
          s_transfer:s_transfer,
          total:total,
          idpdo:idpdo,
          no_pdo:no_pdo,
          kodeproject:kodeproject,
          nourut:nourut,
          no_rekening:no_rekening

        },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){
            document.getElementById("item_hpp").value='';
            document.getElementById("uraian").value='';
            document.getElementById("total").value='';
            document.getElementById("total").value='';
            document.getElementById("pnet").value='';
            document.getElementById("kd_pegawai").value='';
            document.getElementById("thpp").value='';
            document.getElementById("sisa").value='';
            document.getElementById("satuan").value='';
            document.getElementById("qty").value='';
            document.getElementById("harga").value='';
            nomorpdo_temp = no_pdo.replace(/\//g,'abcde');
            document.getElementById("no_rekening").value='';
            load_rincian_temp(nomorpdo_temp);
            $('#largeModal').modal('toggle');
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