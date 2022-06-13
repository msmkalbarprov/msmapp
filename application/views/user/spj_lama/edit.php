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
             Edit SPJ </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('spj'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
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
         <?php echo form_open_multipart('spj/edit_keterangan/'.$data_spj["no_spj"].'/'.$data_spj["kd_area"]);?>
         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="item_hpp" class="control-label">No. SPJ</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="text" name="no_spj" id="no_spj" class="form-control" value="<?= $data_spj['no_spj']; ?>" readonly>

            </div>
          </div>
          
          <div class="col-md-3">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Tanggal SPJ</label>
              <input type="date" name="tgl_spj" id="tgl_spj" class="form-control" value="<?= $data_spj['tgl_spj']; ?>"  readonly >
          </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label"><?= trans('area') ?></label>
                <input type="text" name="area" id="area" class="form-control" value="<?= $data_spj['nm_area']; ?>" readonly>
                <input type="hidden" name="kdarea" id="kdarea" class="form-control" value="<?= $data_spj['kd_area']; ?>" readonly>
            </div>
          </div>
         </div>

         <div class="row">
          
          <div class="col-md-3">
            <div class="form-group">
              <label for="proyek" class="control-label">Jenis PDO</label>
                <select name="jns_pdo"  id="jns_pdo" class="form-control" readonly>
                  <option value="">No Selected</option>
                  <option value="1">Proyek</option>
                  <option value="2">Operasional</option>
                </select>                

            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="proyek" class="control-label">No.PDO</label>
              <input type="text" name="pdo" id="pdo" class="form-control" value="<?= $data_spj['nm_proyek']; ?>"  readonly>
              <input type="hidden" name="no_pdo" id="no_pdo" class="form-control" value="<?= $data_spj['kd_pdo']; ?>"  readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="proyek" class="control-label">Divisi</label>
                
               <input type="text" name="divisi" id="divisi" class="form-control" value="<?= $data_spj['nm_divisi']; ?>" readonly>

            </div>
          </div>
          
         </div>

        <div class="row">
          <div class="col-md-12">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Keterangan</label>
              <textarea type="text" name="keterangan" id="keterangan" class="form-control"  placeholder="" ><?= $data_spj['keterangan']; ?></textarea>
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
                  <th width="10%">No. SPJ</th>
                  <th width="10%">No. PDO</th>
                  <th>Akun</th>
                  <th>Uraian</th>
                  <th>Nilai</th>
                  <th>Bukti</th>
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
      <form class="form-horizontal" id="formtest">
      <div class="modal-body">
         

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="item_hpp" class="control-label">Proyek</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
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
              <input type="hidden" name="uraian" id="uraian" class="form-control"  readonly >
              <input type="text" name="uraian_spj" id="uraian_spj" class="form-control"  >
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
           <div class="form-group">
            <label for="dinas" class="control-label">Bukti kwitansi</label>
               <input type="file" name="gambar" class="form-control" id="gambar">
          </div>
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
        <button class="btn btn-success" id="btn_upload" type="submit">Upload</button>
        <!-- <button name="butsave" id="butsave"  class="btn btn-success btn-sm"> Simpan </button> -->
      </div>
      </form>
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
    get_project();
    var jenis_pdo = "<?= $data_spj['jns_spj']; ?>";
    $('[name="jns_pdo"]').val(jenis_pdo).trigger('change');
    

    var nomorspj   = $('#no_spj').val();
    // var nomorspj  = nospj.replace(/\//g,'abcde');
    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('spj/datatable_json_spj_edit'.'/')?>"+ nomorspj+'/<?= $this->uri->segment(4); ?>',
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "no_spj", 'searchable':true, 'orderable':false},
    { "targets": 1, "name": "kd_pdo", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "akun", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "uraian", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "Nilai", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "bukti", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });

$('#c_transfer').click(function() {
  if ($('#c_transfer').prop('checked') == true){
      $('[name="s_transfer"]').val('1').trigger('change');
  }else{
    $('[name="s_transfer"]').val('0').trigger('change');
  }
});



function get_nilai(kode_pqproyek,no_acc){
        $.ajax({
        url : "<?php echo site_url('spj/get_nilai');?>",
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
        url : "<?php echo site_url('spj/get_nilai2');?>",
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
        url : "<?php echo site_url('spj/get_realisasi');?>",
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
        url : "<?php echo site_url('spj/get_realisasi2');?>",
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


function hitung_total() {
  var harga     = number(document.getElementById("harga").value);
  var volume    = number(document.getElementById("qty").value);
  let totalrow = 0;

  totalrow = harga*volume;
  $('[name="total"]').val(number_format(totalrow,"2",",",".")).trigger('change');
}


function get_project(){ 
    var no_pdos    = $('#no_pdo').val();
    var nomorurut   = $('#no_spj').val();
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
                if (value.jenis_tk == '' || value.jenis_tk == null){
                  $('select[name="project"]').append('<option value="'+value.kd_project+'">'+ value.kd_project +' '+value.nm_paket_proyek +'</option>');
                }else{
                  $('select[name="project"]').append('<option value="'+ value.kd_project+value.jenis_tk+'">'+ value.kd_project +' '+value.nm_paket_proyek +'</option>');

                }


            });

        }
    });
    return false;
}

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



$('#formtest').submit(function(e){
            e.preventDefault();
            var file_data = $('#gambar').prop('files')[0];
            var form_data = new FormData(this);
          
            
            var kd_item_pdo       = $('#item_hpp').val();
            var kd_item_spj       = $('#no_acc').val();
            var no_spj            = $('#no_spj').val();
            var tgl_spj           = $('#tgl_spj').val();
            var jns_pdo           = $('#jns_pdo').val();
            var nourut            = $('#urut').val();
            var no_pdo            = $('#no_pdo').val();
            var nilai             = number($('#total').val());
            var kdarea              = $('#kdarea').val();
            var uraian            = $('#uraian_spj').val();
            var divisi            = $('#project').val().substr(8,1);
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
              
            
            form_data.append('no_spj', no_spj);
            form_data.append('kdarea', kdarea);
            form_data.append('divisi', divisi);
            form_data.append('tgl_spj', tgl_spj);
            form_data.append('jns_pdo', jns_pdo);
            form_data.append('urut', nourut);
            form_data.append('no_pdo', no_pdo);
            form_data.append('kode_pqproyek', kode_pqproyek);
            form_data.append('file', file_data);

            
            $.ajax({
                url:'<?php echo base_url();?>index.php/spj/uploadgambar2',
                dataType: 'json',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(data,status){
                    //alert(php_script_response); // display response from the PHP script, if any
                    if (data.status!='error') {
                        $('#gambar').val('');
                          document.getElementById("item_hpp").value='';
                          document.getElementById("no_acc").value='';
                          document.getElementById("uraian").value='';
                          document.getElementById("uraian_spj").value='';
                          document.getElementById("project").value='';
                          document.getElementById("total").value='';
                          document.getElementById("pnet").value='';
                          document.getElementById("thpp").value='';
                          document.getElementById("shpp").value='';
                          document.getElementById("sisa").value='';
                          load_rincian_temp(no_spj);
                          $('#largeModal').modal('toggle');
                          $("#error").hide();

                        alert(data.msg);
                    }else{
                        alert(data.msg);
                    }
                }
            });
        })

// $('#butsave').on('click', function() {
//     var kd_item_pdo       = $('#item_hpp').val();
//     var kd_item_spj       = $('#no_acc').val();
//     var no_spj            = $('#no_spj').val();
//     var tgl_spj           = $('#tgl_spj').val();
//     var jns_pdo           = $('#jns_pdo').val();
//     var nourut            = $('#urut').val();
//     var no_pdo            = $('#no_pdo').val();
//     var nilai             = number($('#total').val());
//     var area              = $('#kdarea').val();
//     var uraian            = $('#uraian').val();
//     var divisi            = $('#divisi').val();
//     var project           = $('#project').val();
//     var sisa              = number($('#sisa').val());
//     var kode_pqproyek     = 'PQ/'+project;
    
//     if (jns_pdo=='1'){
//       var kd_divisi = project.substr(8,1);
//     }else{
//       var kd_divisi= null;
//     }
//     if(nilai>sisa){
//       alert('Gagal! Nilai Melebihi sisa PDO');
//       return;
//     }


//     if(tgl_spj==""){
//       alert('Tanggal tidak boleh kosong')
//       return;
//     }
//     if(project==""){
//       alert('Projek tidak boleh kosong')
//       return;
//     }
//     if(kd_item_pdo==""){
//       alert('Kode Akun PDO tidak boleh kosong')
//       return;
//     }
//     if(kd_item_spj==""){
//       alert('Kode Akun spj tidak boleh kosong')
//       return;
//     }
//     if(nilai=="" || total==0){
//       alert('Total tidak boleh kosong')
//       return;
//     }

//     if(area==""){
//       alert('Area tidak boleh kosong')
//       return;
//     }

      
//       $.ajax({
//         url: "<?php echo base_url("spj/edit_spj/");?>",
//         type: "POST",
//         data: {
//           '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
//           type:1,
//           area:area,
//           project:project,
//           kd_divisi:kd_divisi,
//           no_pdo:no_pdo,
//           kode_pqproyek:kode_pqproyek,
//           tgl_spj:tgl_spj,
//           kd_item_pdo :kd_item_pdo,
//           kd_item_spj :kd_item_spj,
//           uraian:uraian,
//           nilai:nilai,
//           no_spj:no_spj,
//           nourut:nourut,
//           jns_pdo:jns_pdo
//         },
//         cache: false,
//         success: function(dataResult){
//           var dataResult = JSON.parse(dataResult);
//           if(dataResult.statusCode==200){
//             // document.getElementById("tombolsimpan").disabled = false;
//             document.getElementById("item_hpp").value='';
//             document.getElementById("no_acc").value='';
//             document.getElementById("uraian").value='';
//             document.getElementById("project").value='';
//             document.getElementById("total").value='';
//             document.getElementById("pnet").value='';
//             document.getElementById("thpp").value='';
//             document.getElementById("shpp").value='';
//             document.getElementById("sisa").value='';
//             load_rincian_temp(no_spj);
//             $('#largeModal').modal('toggle');
//             $("#error").hide();
//           }
//           else if(dataResult.statusCode==201){
//             $("#error").show();
//             $("#success").hide();
//             $('#error').html('Gagal Simpan');
//           }
//         }
//       });
    
//   });

function load_rincian_temp(nomorspj) {
        var area      = $('#kdarea').val();

        table.ajax.url("<?=base_url('spj/datatable_json_spj_edit'.'/')?>"+ nomorspj+'/'+area);
        table.ajax.reload();
}

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




  }); 


</script>