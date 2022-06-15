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
             Batal Pengesahan PDO Proyek </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('pengesahan_pdo'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
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
         <?php echo form_open_multipart('pengesahan_pdo/batal_pdo/'.$data_pdo["id_pdo"].'/1');?>
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
          <div class="col-md-12" align="center">
            <input type="submit" name="submit" id="tombolsimpan" value="Batal" class="btn btn-danger btn-sm">
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
              <label for="item_hpp" class="control-label">Akun</label>
              <input type="hidden" name="jns_tkls" id="jns_tkls" class="form-control" readonly>
                <select name="item_hpp"  id="item_hpp" class="form-control" required>
                  <option value="">No Selected</option>
                </select> 

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="item_hpp" class="control-label">Qty</label>
                <input type="number" name="qty" id="qty" class="form-control"  placeholder="" >

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="item_hpp" class="control-label">Satuan</label>
                <input type="text" name="satuan" id="satuan" class="form-control"  placeholder="" >

            </div>
          </div>
        </div>
          <div class="row">
          <div class="col-md-6">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Harga</label>
              <input type="text" name="harga" id="harga" class="form-control"  placeholder="" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
          </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Uraian</label>
              <input type="text" name="uraian" id="uraian" class="form-control"  placeholder="" >
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-12">
           <div class="form-group">
              <label for="dinas" class="control-label">Nilai PDO </label>
               <input type="text" name="total" id="total" class="form-control" value="0" style="background:none;text-align:right;"readonly >
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
  $("#pengesahan_pdo> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    get_akun();
    set_status_transfer();

    var kodepdo   = $('#kd_pdo').val();
    var nomorpdo  = kodepdo.replace(/\//g,'abcde');
    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('pengesahan_pdo/datatable_json_pdo_proyek_edit'.'/')?>"+ nomorpdo+'/<?= $this->uri->segment(3); ?>',
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

function get_nilai(kode_pqproyek,no_acc){
        $.ajax({
        url : "<?php echo site_url('pengesahan_pdo/get_nilai');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kode_pqproyek,no_acc:no_acc},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="pnet"]').val(number_format(value.total,"2",",",".")).trigger('change');

                get_realisasi(no_acc,kode_pqproyek,value.total)
            });

        }
    });
}

function get_nilai2(kode_pqproyek,no_acc,jenis_tk){
        $.ajax({
        url : "<?php echo site_url('pengesahan_pdo/get_nilai2');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kode_pqproyek,no_acc:no_acc,jns_tk:jenis_tk},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="pnet"]').val(number_format(value.total,"2",",",".")).trigger('change');

                get_realisasi2(no_acc,kode_pqproyek,jenis_tk,value.total);
            });

        }
    });
}


function get_realisasi(kd_coa,kode_pqproyek,nil_hpp){
        $.ajax({
        url : "<?php echo site_url('pengesahan_pdo/get_realisasi');?>",
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

function get_realisasi2(kd_coa,kode_pqproyek,jns_tk,nil_hpp){
        $.ajax({
        url : "<?php echo site_url('pengesahan_pdo/get_realisasi2');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kode_pqproyek,no_acc:kd_coa,jns_tk:jns_tk},
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

// Hitung total
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


$('#butsave').on('click', function() {
    var kd_item       = $('#item_hpp').val();
    var no_pdo        = $('#kd_pdo').val();
    var tgl_pdo       = $('#tgl_pdo').val();
    var nourut        = $('#urut').val();
    var projek        = "<?= $data_pdo['kd_pqproyek'] ?>";
    var uraian        = $('#uraian').val();
    var qty           = $('#qty').val();
    var satuan        = $('#satuan').val();
    var total         = number($('#total').val());
    var harga         = number($('#harga').val());
    var area          = "<?= $data_pdo['kd_area']; ?>"
    var divisi        = "<?= $data_pdo['kd_divisi']; ?>"
    var idpdo         = no_pdo.replace(/\//g,'');
    var kodeproject   = projek.replace('PQ/','');

    var jenis_tkl     = $('#jns_tkls').val();
    var sisa          = number($('#sisa').val());
    if(total>sisa){
      alert('Gagal! Nilai Melebihi sisa HPP');
      return;
    }
    
    if(divisi==""){
      alert('Divisi tidak boleh kosong')
      return;
    }

    if(tgl_pdo==""){
      alert('Tanggal tidak boleh kosong')
      return;
    }
    if(projek==""){
      alert('Projek tidak boleh kosong')
      return;
    }
    if(kd_item==""){
      alert('Kode Akun tidak boleh kosong')
      return;
    }
    if(total=="" || total==0){
      alert('Total tidak boleh kosong')
      return;
    }

    if(area==""){
      alert('Area tidak boleh kosong')
      return;
    }

    if(qty==""){
      alert('Quantity tidak boleh kosong')
      return;
    }

    if(satuan==""){
      alert('Satuan tidak boleh kosong')
      return;
    }

    if(harga==""){
      alert('Harga tidak boleh kosong')
      return;
    }
    
      
      $.ajax({
        url: "<?php echo base_url("pengesahan_pdo/edit_pdo_project/");?>",
        type: "POST",
        data: {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          type:1,
          area:area,
          projek:projek,
          divisi:divisi,
          tgl_pdo:tgl_pdo,
          kd_item :kd_item,
          uraian:uraian,
          qty:qty,
          satuan:satuan,
          harga:harga,
          total:total,
          idpdo:idpdo,
          no_pdo:no_pdo,
          kodeproject:kodeproject,
          jenis_tkl:jenis_tkl,
          nourut:nourut

        },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){
            
            nomorpdo_temp = no_pdo.replace(/\//g,'abcde');
            load_rincian_temp(nomorpdo_temp);
            $('#largeModal').modal('toggle');
            $("#error").hide();

            document.getElementById("satuan").value='';
            document.getElementById("qty").value='';
            document.getElementById("harga").value='';
            document.getElementById("item_hpp").value='';
            document.getElementById("uraian").value='';
            document.getElementById("total").value='';
            document.getElementById("total").value='';
            document.getElementById("pnet").value='';
            document.getElementById("thpp").value='';
            document.getElementById("sisa").value='';
          }
          else if(dataResult.statusCode==201){
            $("#error").show();
            $("#success").hide();
            $('#error').html('Gagal Simpan');
          }
        }
      });
   
  });

function load_rincian_temp(nomorpdo) {
        table.ajax.url("<?=base_url('pengesahan_pdo/datatable_json_pdo_proyek_edit'.'/')?>"+ nomorpdo);
        table.ajax.reload();
}

$('#item_hpp').change(function(){ 
   var kd_coa         = $(this).val();
   var kode_pqproyek  = "<?= $data_pdo['kd_pqproyek'] ?>";
   if (kd_coa.substr(0,7)=='5010202'){
    
    var no_acc      = kd_coa.substr(0,7);
    let jenis_tk    = kd_coa.substr(7,(kd_coa.length-7));
    document.getElementById("jns_tkls").value=jenis_tk;
    
    
    get_nilai2(kode_pqproyek,no_acc,jenis_tk);
    // get_realisasi2(no_acc,kode_pqproyek,jns_tk);
   
   }else{
    let jns_tk = '';
    get_nilai(kode_pqproyek,kd_coa);
    // get_realisasi(kd_coa,kode_pqproyek);
   
   }
   return false;
});

  }); 


</script>