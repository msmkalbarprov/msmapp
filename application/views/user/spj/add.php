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
             Input SPJ</h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('spj'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
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
         <?php echo form_open(base_url('spj/add_spj'), 'class="form-horizontal"' )?> 
         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="item_hpp" class="control-label">No. SPJ</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="text" name="no_spj" id="no_spj" class="form-control" readonly>
              <input type="hidden" name="urut" id="urut" class="form-control" readonly>

            </div>
          </div>
          
          <div class="col-md-3">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Tanggal SPJ</label>
              <input type="date" name="tgl_spj" id="tgl_spj" class="form-control"  required >
          </div>
          </div>
          <div class="col-md-6">
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
              <label for="proyek" class="control-label">Jenis PDO</label>
                <select name="jns_pdo"  id="jns_pdo" class="form-control" required>
                  <option value="">No Selected</option>
                  <option value="1">Proyek</option>
                  <option value="2">Operasional</option>
                </select>                

            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="proyek" class="control-label">No. PDO</label>
                <select name="no_pdo"  id="no_pdo" class="form-control" required>
                  <option value="">No Selected</option>
                </select>                

            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Keterangan</label>
              <textarea type="text" name="keterangan" id="keterangan" rows="1" class="form-control"  placeholder="" ></textarea>
          </div>
          </div>
         </div>


        
        <div class="form-group">
          <div class="col-md-12" align="center">
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
                  <th width="10%">No. SPJ</th>
                  <th width="10%">No. PDO</th>
                  <th>Akun</th>
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
              <label for="item_hpp" class="control-label">Proyek</label>
              <input type="hidden" name="proyek" id="proyek" class="form-control" readonly>
                <select name="project"  id="project" class="form-control" required>
                  <option value="">No Selected</option>
                </select> 

            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="item_hpp" class="control-label">Akun PDO</label>
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
              <label for="item_hpp" class="control-label">Akun SPJ</label>
              <input type="hidden" name="jns_tkls" id="jns_tkls" class="form-control" readonly>
                <select name="no_acc"  id="no_acc" class="form-control" required>
                  <option value="">No Selected</option>
                </select> 

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="item_hpp" class="control-label">Uraian</label>
              <input type="text" name="uraian" id="uraian" class="form-control"  readonly >
            </div>
          </div>
        </div>


         <div class="row">
          <div class="col-md-6">
           <div class="form-group">
              <label for="dinas" class="control-label">Nilai SPJ </label>
               <input type="text" name="total" id="total" class="form-control"  placeholder="" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
          </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
                <label for="dinas" class="control-label">Nilai PDO</label>
                <input type="text" name="pnet" id="pnet" class="form-control"  style="background:none;text-align:right;"readonly >
            </div>
          </div>
         
         </div>

         <div class="row">
          <div class="col-md-6" >
           <div class="form-group">
                <label for="dinas" class="control-label">Realisasi Akun PDO</label>
                <input type="text" name="thpp" id="thpp" class="form-control"   style="background:none;text-align:right;"readonly >
            </div>
          </div>
          <div class="col-md-6" >
           <div class="form-group">
                <label for="dinas" class="control-label">Realisasi Akun SPJ</label>
                <input type="text" name="shpp" id="shpp" class="form-control"   style="background:none;text-align:right;"readonly >
            </div>
          </div>
         
         </div>

         <div class="row">
          <div class="col-md-6">
            &nbsp;
          </div>
          <div class="col-md-6">
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
  $("#spj> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    $('.select2').select2()
    // $("#tombolsimpan").attr("disabled", "disabled");
    $('[name="s_transfer"]').val('0').trigger('change');
    // get_pqproyek()
    // get_datatable();
    get_projekcombo()
    $('#divisi').prop('disabled', true)

  $('#c_transfer').click(function() {
      if ($('#c_transfer').prop('checked') == true){
          $('[name="s_transfer"]').val('1').trigger('change');
          document.getElementById("no_rekening").disabled = true;
          $('[name="no_rekening"]').val('').trigger('change');
      }else{
        $('[name="s_transfer"]').val('0').trigger('change');
        document.getElementById("no_rekening").disabled = false;
      }
});




    nomorpdo=0;
    no_pdo=0;
    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ordering": true, // Set true agar bisa di sorting
    "ajax": 
    // "<?=base_url('cpdo/datatable_json_pdo_proyek'.'/')?>"+ nomorpdo,
    {
                "url": "<?=base_url('cpdo/view'.'/')?>"+ nomorpdo+'/'+no_pdo, // URL file untuk proses select datanya
                "type": "POST",
                "data" : {
                        "<?php echo $this->security->get_csrf_token_name(); ?>" : "<?php echo $this->security->get_csrf_hash(); ?>"
                      }
            },
    "deferRender": true,
    "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],

     "columns": [
                { "data": "kd_project" }, // Tampilkan no_acc
                { "data": "kd_pdo" }, // Tampilkan kd_pdo
                { "data": "nm_acc" },  // Tampilkan nama
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

$('#na_datatable').on('click', 'tbody .del_btn', function () {
    var data_row = table.row($(this).closest('tr')).data();
    // alert(data_row.no_acc+' - '+data_row.id)

    var id_hapus  = data_row.id;
    var no_spj    = $('#no_spj').val();
    var nomorpdo  = no_spj.replace(/\//g,'abcde')

    // proses hapus
    $.ajax({
        url: "<?php echo base_url("spj/delete_spj_temp2/");?>",
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
            $('#success').html('Data Berhasil dihapus !'); 
            
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


// get pq projek

$('#jns_pdo').change(function(){ 
    var kodearea    = $('#area').val();
    var jenis_pdo   = $(this).val();
    get_nomor_urut(kodearea);
    $.ajax({
        url : "<?php echo site_url('spj/get_pdo_by_area');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kodearea,jenis_pdo:jenis_pdo},
        async : true,
        dataType : 'json',
        success: function(data){
            $('select[name="no_pdo"]').empty();
            $('select[name="no_pdo"]').append('<option value="">No Selected</option>');
            $.each(data, function(key, value) {
                $('select[name="no_pdo"]').append('<option value="'+ value.kd_pdo +'">'+ value.kd_pdo +'</option>');
            });

        }
    });
    return false;
});


$('#no_pdo').change(function(){ 
    var no_pdos    = $(this).val();
    var nomorurut   = $('#urut').val();
    var jenis_pdo   = $('#jns_pdo').val();
    $.ajax({
        url : "<?php echo site_url('spj/get_project_by_pdo');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: no_pdos,jenis_pdo:jenis_pdo},
        async : true,
        dataType : 'json',
        success: function(data){
            $('select[name="project"]').empty();
            $('select[name="project"]').append('<option value="">No Selected</option>');

                load_rincian_temp(nomorurut)

            $.each(data, function(key, value) {

              var kodedivisi = no_pdos.substr(11,1);
                $('[name="divisi"]').val(kodedivisi).trigger('change');

                                

                if (value.jenis_tk == '' || value.jenis_tk == null){
                  $('select[name="project"]').append('<option value="'+value.kd_project+'">'+ value.kd_project +' '+value.nm_paket_proyek +'</option>');
                }else{
                  $('select[name="project"]').append('<option value="'+ value.kd_project+value.jenis_tk+'">'+ value.kd_project +' '+value.nm_paket_proyek +'</option>');

                }


            });

        }
    });
    return false;
});

$('#project').change(function(){ 
    var idproyek    = $(this).val();
    var nomorurut   = $('#urut').val();
    var jenis_pdo   = $('#jns_pdo').val();
    $.ajax({
        url : "<?php echo site_url('spj/get_item_by_pdo');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: idproyek,jenis_pdo:jenis_pdo},
        async : true,
        dataType : 'json',
        success: function(data){
            $('select[name="item_hpp"]').empty();
            $('select[name="item_hpp"]').append('<option value="">No Selected</option>');

            $.each(data, function(key, value) {
                
                if (value.jenis_tk == '' || value.jenis_tk == null){
                  $('select[name="item_hpp"]').append('<option value="'+value.no_acc+value.uraian+'">'+ value.no_acc +' '+value.nm_acc +'</option>');
                }else{
                  $('select[name="item_hpp"]').append('<option value="'+ value.no_acc+value.jenis_tk+'">'+ value.no_acc +' '+value.nm_acc +' ('+ value.jenis_tk +')</option>');

                }


            });

        }
    });
    return false;
});


function load_rincian_temp(nomorpdo) {
        var no_pdo      = $('#no_pdo').val().replace(/\//g,'abcde');

        table.ajax.url("<?=base_url('spj/view'.'/')?>"+ nomorpdo+'/'+no_pdo);
        table.ajax.reload();
}


$('#item_hpp').change(function(){ 
    var jenis_pdo   = $('#jns_pdo').val();
    if (jenis_pdo=='1'){
      var itemhpp    = $(this).val().substr('0','7');
    var uraian_hpp    = $(this).val().substr(7);
    }else{
      var itemhpp    = $(this).val().substr('0','5');
      var uraian_hpp    = $(this).val().substr(5);
    }
    

    document.getElementById("uraian").value=uraian_hpp;
    $.ajax({
        url : "<?php echo site_url('spj/get_item_spj_by_pdo');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: itemhpp,jenis_pdo:jenis_pdo},
        async : true,
        dataType : 'json',
        success: function(data){
            $('select[name="no_acc"]').empty();
            $('select[name="no_acc"]').append('<option value="">No Selected</option>');
            $.each(data, function(key, value) {
                  $('select[name="no_acc"]').append('<option value="'+ value.no_acc+'">'+ value.no_acc +' '+value.nm_acc +'</option>');
            });

        }
    });
    return false;
});


$('#item_hpp').change(function(){ 
  var jenis_pdo   = $('#jns_pdo').val();
  if (jenis_pdo=='1'){
    var item_pdo      = $(this).val().substr('0','7');
  }else{
    var item_pdo      = $(this).val().substr('0','5');
  }
  
  var no_pdo      = $('#no_pdo').val();
  get_nilai(item_pdo,no_pdo);
   return false;
});

$('#no_acc').change(function(){ 
  var item_spj      = $(this).val();
  var no_pdo      = $('#no_pdo').val();
  get_realisasi2(item_spj,no_pdo);
   return false;
});


function get_nilai(item_pdo,no_pdo){
        $.ajax({
        url : "<?php echo site_url('spj/get_nilai');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: no_pdo,no_acc:item_pdo},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="pnet"]').val(number_format(value.nilai,"2",",",".")).trigger('change');
                get_realisasi(item_pdo,no_pdo,value.nilai);
            });

        }
    });
}

function get_realisasi(item_pdo,no_pdo,nil_hpp){
      var project           = $('#project').val();
        $.ajax({
        url : "<?php echo site_url('spj/get_realisasi');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: no_pdo,no_acc:item_pdo,project:project},
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

function get_realisasi2(item_spj,no_pdo){
        var project           = $('#project').val();
        $.ajax({
        url : "<?php echo site_url('spj/get_realisasi2');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: no_pdo,no_acc:item_spj,project:project},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="shpp"]').val(number_format(value.total,"2",",",".")).trigger('change');

            });

        }
    });
        
}


function get_nomor_urut(area){
        $.ajax({
        url : "<?php echo site_url('spj/get_nomor');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          area: area},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="urut"]').val(value.nomor).trigger('change');
                $('[name="no_spj"]').val(value.nomor).trigger('change');
            });

        }
    });
}


    function get_projekcombo(){ 
                var kodearea=document.getElementById("area").value;
                $.ajax({
                      url : "<?php echo site_url('cpdo/get_pq_projek_by_area');?>",
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


function hitung_total() {
  var harga     = number(document.getElementById("harga").value);
  var volume    = number(document.getElementById("qty").value);
  let totalrow = 0;

  totalrow = harga*volume;
  $('[name="total"]').val(number_format(totalrow,"2",",",".")).trigger('change');
}


    // SAVE
$('#butsave').on('click', function() {
    var kd_item_pdo       = $('#item_hpp').val();
    var kd_item_spj       = $('#no_acc').val();
    var no_spj            = $('#no_spj').val();
    var tgl_spj           = $('#tgl_spj').val();
    var jns_pdo           = $('#jns_pdo').val();
    var nourut            = $('#urut').val();
    var no_pdo            = $('#no_pdo').val();
    var nilai             = number($('#total').val());
    var area              = $('#area').val();
    var uraian            = $('#uraian').val();
    var divisi            = $('#divisi').val();
    var project           = $('#project').val();
    var sisa              = number($('#sisa').val());
    var kode_pqproyek     = 'PQ/'+project;
    
    if (jns_pdo=='1'){
      var kd_divisi = project.substr(8,1);
    }else{
      var kd_divisi= null;
    }
    if(nilai>sisa){
      alert('Gagal! Nilai Melebihi sisa PDO');
      return;
    }


    if(tgl_spj==""){
      alert('Tanggal tidak boleh kosong')
      return;
    }
    if(project==""){
      alert('Projek tidak boleh kosong')
      return;
    }
    if(kd_item_pdo==""){
      alert('Kode Akun PDO tidak boleh kosong')
      return;
    }
    if(kd_item_spj==""){
      alert('Kode Akun spj tidak boleh kosong')
      return;
    }
    if(nilai=="" || total==0){
      alert('Total tidak boleh kosong')
      return;
    }

    if(area==""){
      alert('Area tidak boleh kosong')
      return;
    }

      
      $.ajax({
        url: "<?php echo base_url("spj/add/");?>",
        type: "POST",
        data: {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          type:1,
          area:area,
          project:project,
          kd_divisi:kd_divisi,
          no_pdo:no_pdo,
          kode_pqproyek:kode_pqproyek,
          tgl_spj:tgl_spj,
          kd_item_pdo :kd_item_pdo,
          kd_item_spj :kd_item_spj,
          uraian:uraian,
          nilai:nilai,
          no_spj:no_spj,
          nourut:nourut,
          jns_pdo:jns_pdo
        },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){
            // document.getElementById("tombolsimpan").disabled = false;
            document.getElementById("item_hpp").value='';
            document.getElementById("no_acc").value='';
            document.getElementById("uraian").value='';
            document.getElementById("project").value='';
            document.getElementById("total").value='';
            document.getElementById("pnet").value='';
            document.getElementById("thpp").value='';
            document.getElementById("shpp").value='';
            document.getElementById("sisa").value='';
            load_rincian_temp(no_spj);
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