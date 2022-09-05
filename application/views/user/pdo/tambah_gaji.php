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
             Tambah PDO Gaji / Transportasi dan Akomodasi</h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('cpdo/gaji'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
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
         <?php echo form_open(base_url('cpdo/add_pdo_gaji'), 'class="form-horizontal"' )?> 
         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="item_hpp" class="control-label">Kode PDO</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="text" name="kd_pdo" id="kd_pdo" class="form-control" readonly>
              <input type="hidden" name="urut" id="urut" class="form-control" readonly>

            </div>
          </div>
          
          <div class="col-md-3">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Tanggal PDO</label>
              <input type="date" name="tgl_pdo" id="tgl_pdo" class="form-control"  required >
          </div>
          </div>
          <div class="col-md-3">
              <div class="form-group">
                <label for="area" class="control-label">Jenis PDO</label>
                <select class="form-control" name="jns_pdo" id="jns_pdo">
                  <option value="">No Selected</option>
                  <option value="GJ">Gaji</option>
                  <option value="TA">Transport dan Akomodasi</option>
                </select>
              </div>
            </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="area" class="control-label"><?= trans('area') ?></label>
                <select name="area" id ="area" class="form-control select2" style="width: 100%;" required >
                <option value="">No Selected</option>
                <?php foreach($data_area as $area): ?>
                      <option value="<?= $area['kd_area']; ?>"><?= $area['nm_area']; ?></option>
                  <?php endforeach; ?>
                </select>

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
              <textarea type="text" name="keterangan" id="keterangan" class="form-control"  placeholder="" ></textarea>
          </div>
          </div>
         </div>


        
        <div class="form-group">
          <div class="col-md-12" align="right">
            <!-- <button name="butsave" id="butsave"  class="btn btn-success btn-sm"> Tambah Rincian </button> -->
            <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal">Tambah Rincian</a>
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
                  <th width="10%">Kode Proyek</th>
                  <th>Akun</th>
                  <th>Qty</th>
                  <th>Satuan</th>
                  <th>Harga</th>
                  <th>Uraian</th>
                  <th>Nilai</th>
                  <th width="5%">Action</th>
                </tr>
              </thead>
            </table>
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
         
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="proyek" class="control-label">PQ Proyek</label>
                <select name="projek"  id="projek" class="form-control" required>
                  <option value="">No Selected</option>
                </select>                

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="proyek" class="control-label">Divisi</label>
                
                <select name="divisi2" id ="divisi2" class="form-control select2" style="width: 100%;" required>
                <option value="">No Selected</option>
                  <?php foreach($data_divisi as $divisi2): ?>
                      <option value="<?= $divisi2['kd_projek']; ?>"><?= $divisi2['nm_projek']; ?></option>
                  <?php endforeach; ?>
                </select>

            </div>
          </div>
          
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
          <div class="col-md-6" >
           <div class="form-group">
                <label for="dinas" class="control-label">Realisasi PDO</label>
                <input type="text" name="thpp" id="thpp" class="form-control"   style="background:none;text-align:right;"readonly >
            </div>
          </div>
          <div class="col-md-6" >
           <div class="form-group">
                <label for="dinas" class="control-label">Realisasi SPJ</label>
                <input type="text" name="thpp_spj" id="thpp_spj" class="form-control"   style="background:none;text-align:right;"readonly >
            </div>
          </div>
         </div>

         <div class="row">
         <div class="col-md-6">
           <div class="form-group">
                <label for="dinas" class="control-label">Sisa (HPP-PDO)</label>
                <input type="text" name="sisa" id="sisa" class="form-control"   style="background:none;text-align:right;"readonly >
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
                <label for="dinas" class="control-label">Sisa (HPP-SPJ)</label>
                <input type="text" name="sisa_spj" id="sisa_spj" class="form-control"   style="background:none;text-align:right;"readonly >
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
    $('.select2').select2()
    $("#tombolsimpan").attr("disabled", "disabled");
    $('[name="s_transfer"]').val('0').trigger('change');
    // get_pqproyek()
    // get_datatable();
    get_projekcombo()
    $('#divisi2').prop('disabled', true)

  $('#c_transfer').click(function() {
      if ($('#c_transfer').prop('checked') == true){
          $('[name="s_transfer"]').val('1').trigger('change');
          var kodearea=$('#area').val();
          get_pegawai(kodearea);
      }else{
        $('[name="s_transfer"]').val('0').trigger('change');
      }
});

    nomorpdo=0;
    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ordering": true, // Set true agar bisa di sorting
    "ajax": 
    // "<?=base_url('cpdo/datatable_json_pdo_proyek'.'/')?>"+ nomorpdo,
    {
                "url": "<?=base_url('cpdo/view'.'/')?>"+ nomorpdo, // URL file untuk proses select datanya
                "type": "POST",
                "data" : {
                        "<?php echo $this->security->get_csrf_token_name(); ?>" : "<?php echo $this->security->get_csrf_hash(); ?>"
                      }
            },
    "deferRender": true,
    "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],

     "columns": [
                { "data": "kd_project" }, // Tampilkan no_acc
                { "data": "akun" },  // Tampilkan nama
                { "data": "qty" }, // Tampilkan qty
                { "data": "satuan" }, // Tampilkan satuan
                { "data": "harga" , render: $.fn.dataTable.render.number(',', '.', 2, ''), "className": "text-right"}, // Tampilkan total
                { "data": "uraian" }, // Tampilkan uraian
                { "data": "nilai" , render: $.fn.dataTable.render.number(',', '.', 2, ''), "className": "text-right"}, // Tampilkan total
                {
                    "data": null,
                    "render": function(data) {

                        return '<button class="btn btn-danger btn-sm del_btn" id="'+data.no_acc+'"><i class="fa fa-trash-o"></i></button>';
                    }
                }
            ],
  });


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


$('#jns_pdo').change(function(){ 
  $('[name="area"]').val("").trigger('change');
});


// get pq projek

$('#area').change(function(){ 
    var kodearea=$(this).val();
    var jnspdo  =$("#jns_pdo").val();

    if(jnspdo==''){
      alert('Silahkan pilih Jenis PDO terlebih dahulu');
      return;
    }

    get_nomor_urut(kodearea, jnspdo)
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
});


$('#projek').change(function(){ 
    var idproyek    = $(this).val();
    var nomorurut   = $('#urut').val();
    var jnspdo      = $('#jns_pdo').val();
    var kodedivisi = idproyek.substr(11,1);
    $('[name="divisi2"]').val(kodedivisi).trigger('change');
    $.ajax({
        url : "<?php echo site_url('cpdo/get_item_pq_gaji_by_pq');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: idproyek,jnspdo:jnspdo},
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
    return false;
});

function load_rincian_temp(nomorpdo) {
        table.ajax.url("<?=base_url('cpdo/view'.'/')?>"+ nomorpdo);
        table.ajax.reload();
}


$('#item_hpp').change(function(){ 
   var kd_coa       = $(this).val();
   var kode_pqproyek  = $('#projek').val();
   if (kd_coa.substr(0,7)=='5010202'){
    
    var no_acc = kd_coa.substr(0,7);
    let jns_tk = kd_coa.substr(7,(kd_coa.length-7));
    document.getElementById("jns_tkls").value=jns_tk;
    
    
    get_nilai2(no_acc,kode_pqproyek,jns_tk);
    // get_realisasi2(no_acc,kode_pqproyek,jns_tk);
   
   }else{
    let jns_tk = '';
    get_nilai(kd_coa,kode_pqproyek);
    // get_realisasi(kd_coa,kode_pqproyek);
   
   }
   return false;
});


function get_nilai(kd_coa,kode_pqproyek){
        $.ajax({
        url : "<?php echo site_url('cpdo/get_nilai');?>",
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

function get_nilai2(kd_coa,kode_pqproyek,jns_tk){
        $.ajax({
        url : "<?php echo site_url('cpdo/get_nilai2');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kode_pqproyek,no_acc:kd_coa,jns_tk:jns_tk},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="pnet"]').val(number_format(value.total,"2",",",".")).trigger('change');

                get_realisasi2(kd_coa,kode_pqproyek,jns_tk,value.total);
            });

        }
    });
}


function get_realisasi(kd_coa,kode_pqproyek,nil_hpp){
        $.ajax({
        url : "<?php echo site_url('cpdo/get_realisasi');?>",
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

    $.ajax({
        url : "<?php echo site_url('cpdo/get_realisasi_spj');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kode_pqproyek,no_acc:kd_coa},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="thpp_spj"]').val(number_format(value.total,"2",",",".")).trigger('change');

                $('[name="sisa_spj"]').val(number_format(nil_hpp - value.total,"2",",",".")).trigger('change');

            });

        }
    });
        
}

function get_realisasi2(kd_coa,kode_pqproyek,jns_tk,nil_hpp){
        $.ajax({
        url : "<?php echo site_url('cpdo/get_realisasi2');?>",
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

    $.ajax({
        url : "<?php echo site_url('cpdo/get_realisasi_spj2');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kode_pqproyek,no_acc:kd_coa,jns_tk:jns_tk},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="thpp_spj"]').val(number_format(value.total,"2",",",".")).trigger('change');

                $('[name="sisa_spj"]').val(number_format(nil_hpp - value.total,"2",",",".")).trigger('change');

            });

        }
    });
}

function get_nomor_urut(area,jns_pdo){
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
                var nomorpdo = 'PDO/'+area+'/'+jns_pdo+'/'+value.nomor;

                $('[name="kd_pdo"]').val(nomorpdo).trigger('change');
                nomorpdo_temp = nomorpdo.replace(/\//g,'abcde')
                load_rincian_temp(nomorpdo_temp)

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
    var kd_item       = $('#item_hpp').val();
    var no_pdo        = $('#kd_pdo').val();
    var tgl_pdo       = $('#tgl_pdo').val();
    var nourut        = $('#urut').val();
    var projek        = $('#projek').val();
    var uraian        = $('#uraian').val();
    var no_rekening   = $('#no_rekening').val();
    var total         = number($('#total').val());
    var area          = $('#area').val();
    var qty           = $('#qty').val();
    var satuan        = $('#satuan').val();
    var kd_pegawai    = $('#kd_pegawai').val();
    var harga         = number($('#harga').val());
    var divisi        = $('#divisi2').val();
    var idpdo         = no_pdo.replace(/\//g,'');
    var kodeproject   = projek.replace('PQ/','');

    var jenis_tkl     = $('#jns_tkls').val();
    var sisa          = number($('#sisa').val());
    var sisa_spj          = number($('#sisa_spj').val());
    if(total>sisa){
      alert('Gagal! Nilai Melebihi sisa HPP');
      return;
    }

    if(total>sisa_spj){
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
        url: "<?php echo base_url("cpdo/add_gaji/");?>",
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
          kd_pegawai:kd_pegawai,
          total:total,
          idpdo:idpdo,
          no_rekening:no_rekening,
          no_pdo:no_pdo,
          kodeproject:kodeproject,
          jenis_tkl:jenis_tkl,
          nourut:nourut

        },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){
            document.getElementById("tombolsimpan").disabled = false;
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
    
  });

  }); 


</script>