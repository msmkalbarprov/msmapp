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
             Edit SPJ Pegawai</h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('spj_pegawai'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
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
         <?php echo form_open_multipart('spj_pegawai/edit_keterangan/'.$data_spj["no_spj"].'/'.$data_spj["kd_pegawai"]);?>
         <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="item_hpp" class="control-label">No. SPJ</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="text" name="no_spj" id="no_spj" class="form-control" value="<?= $data_spj["no_spj"]; ?>" readonly>
              <input type="hidden" name="urut" id="urut" class="form-control" value="<?= $data_spj["no_spj"]; ?>" readonly>
            </div>
          </div>
          
          <div class="col-md-4">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Tanggal SPJ</label>
              <input type="date" name="tgl_spj" id="tgl_spj" class="form-control" value="<?= $data_spj["tgl_spj"]; ?>"  required >
          </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="area" class="control-label"><?= trans('area') ?></label>
                <input type="text" name="area" id="area" class="form-control" value="<?= $data_spj["nm_area"]; ?>">
                <input type="hidden" name="kd_area" id="kd_area" class="form-control" value="<?= $data_spj["kd_area"]; ?>">

            </div>
          </div>
          
         </div>

         <div class="row">
         <div class="col-md-4">
            <div class="form-group">
              <label for="subarea1" class="control-label">Sub Area</label>
              <input type="text" name="subarea" id="subarea" class="form-control" value="<?= $data_spj["nm_sub_area"]; ?>">
                <input type="hidden" name="kd_sub_area" id="kd_sub_area" class="form-control" value="<?= $data_spj["kd_sub_area"]; ?>">

            </div>
          </div>
          <div class="col-md-4">
          <div class="form-group">
                <label for="item_hpp" class="control-label">Pegawai</label>
                <input type="text" name="pegawai" id="pegawai" class="form-control" value="<?= $data_spj["nama"]; ?>">
                <input type="hidden" name="kd_pegawai" id="kd_pegawai" class="form-control" value="<?= $data_spj["kd_pegawai"]; ?>">

              </div>
          </div>
          <div class="col-md-4">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Keterangan</label>
              <textarea type="text" name="keterangan" id="keterangan" rows="1" class="form-control" ><?= $data_spj["keterangan"]; ?></textarea>
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
                    <th width="10%">Tanggal</th>
                    <th>Akun</th>
                    <th>Uraian</th>
                    <th>Bukti</th>
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
      <form class="form-horizontal" id="formtest">
        <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                      <label for="item_hpp" class="control-label">jenis SPJ</label>
                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <select name="jns_spj"  id="jns_spj" class="form-control" required>
                          <option value="">No Selected</option>
                          <option value="1">Proyek</option>
                          <option value="2">Operasional</option>
                        </select> 
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                    <label for="item_hpp" class="control-label">Proyek</label>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="hidden" name="proyek" id="proyek" class="form-control" readonly>
                      <select name="projek"  id="projek" class="form-control" required>
                        <option value="">No Selected</option>
                      </select> 

                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="item_hpp" class="control-label">Tanggal Bukti</label>
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <input type="date" name="tgl_bukti" id="tgl_bukti" class="form-control" require>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="item_hpp" class="control-label">Akun SPJ</label>
                  <select name="no_acc"  id="no_acc" class="form-control" required>
                    <option value="">No Selected</option>
                  </select> 

              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="item_hpp" class="control-label">Uraian</label>
                <input type="text" name="uraian" id="uraian" class="form-control"  >
              </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="dinas" class="control-label">Nilai SPJ </label>
                    <input type="text" name="total" id="total" class="form-control"  placeholder="" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
                </div>
            </div>
          </div>
         <div class="row">
          <div class="col-md-6">
           <div class="form-group">
                <label for="dinas" class="control-label">Saldo Kas</label>
                <input type="text" name="kas" id="kas" class="form-control"  style="background:none;text-align:right;"readonly >
                <input type="hidden" name="n_pq" id="n_pq" class="form-control"  style="background:none;text-align:right;"readonly >
                <input type="hidden" name="r_pq" id="r_pq" class="form-control"  style="background:none;text-align:right;"readonly >
                <input type="hidden" name="s_pq" id="s_pq" class="form-control"  style="background:none;text-align:right;"readonly >
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="dinas" class="control-label">Bukti kwitansi</label>
               <input type="file" name="gambar" class="form-control" id="gambar">
          </div>
          </div>
         </div>
        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button class="btn btn-success" id="btn_upload" type="submit">Simpan</button>
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
  $("#spj_pegawai> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    
    var no_spj   = $('#no_spj').val();
    var kd_pegawai     = $('#kd_pegawai').val();
    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('spj_pegawai/datatable_json_spj_edit/')?>"+ no_spj+'/'+kd_pegawai,
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "no_spj", 'searchable':true, 'orderable':false},
    { "targets": 1, "name": "tgl_spj", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "akun", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "uraian", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "bukti", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "Nilai", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });





  function get_akun(jns_spj,kd_proyek){
    $.ajax({
        url : "<?php echo site_url('spj_pegawai/get_item_spj');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          jns_spj:jns_spj,kd_proyek:kd_proyek
            },
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
}

$('#no_acc').change(function(){ 
  var kd_pegawai      = $('#kd_pegawai').val();

  var area          = $('#kd_area').val();
  var jns_spj       = $('#jns_spj').val();
  var projek        = $('#projek').val();
  var kd_item       = $(this).val();


    get_kas(kd_pegawai);
    get_nilai(projek,kd_item,jns_spj);
    return false;
});


function get_nilai(projek,kd_item,jns_spj){
        $.ajax({
        url : "<?php echo site_url('spj_pegawai/get_nilai');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: projek,no_acc:kd_item,jns_spj:jns_spj},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="n_pq"]').val(number_format(value.nilai,"2",",",".")).trigger('change');
                get_realisasi(kd_item,projek,jns_spj,value.nilai);
            });

        }
    });
}


function get_realisasi(kd_item,projek,jns_spj,nilai){
        $.ajax({
        url : "<?php echo site_url('spj_pegawai/get_realisasi');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: projek,no_acc:kd_item,jns_spj:jns_spj},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="r_pq"]').val(number_format(value.total,"2",",",".")).trigger('change');
                $('[name="s_pq"]').val(number_format(nilai - value.total,"2",",",".")).trigger('change');

            });

        }
    });
        
}

function get_kas(kd_pegawai){
        var project           = $('#project').val();
        $.ajax({
        url : "<?php echo site_url('spj_pegawai/get_kas');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kd_pegawai},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="kas"]').val(number_format(value.total,"2",",",".")).trigger('change');

            });

        }
    });
        
}

$('#jns_spj').change(function(){ 
    var jns_spj     = $(this).val();
    var subarea     = $('#kd_sub_area').val();
    var area        = $("#kd_area").val();
    $.ajax({
        url : "<?php echo site_url('spj_pegawai/get_proyek_by_area_subarea');?>",
        method : "POST",
        data : {
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
            id: subarea,area:area,jns_spj:jns_spj},
        async : true,
        dataType : 'json',
        success: function(data){
            $('select[name="projek"]').empty();
            $('select[name="projek"]').append('<option value="">No Selected</option>');
            $.each(data, function(key, value) {
                $('select[name="projek"]').append('<option value="'+ value.kd_proyek +'">'+value.kd_proyek + ' - ' + value.nm_paket_proyek +'</option>');
            });

        }
    });
    return false;
});
$('#projek').change(function(){ 
  var jns_spj     = $('#jns_spj').val();
  var kd_proyek     = $('#projek').val();
    get_akun(jns_spj,kd_proyek);
});

$('#formtest').submit(function(e){
            e.preventDefault();
            var file_data = $('#gambar').prop('files')[0];
            var form_data = new FormData(this);
          
            
            var no_akun1             = $('#no_acc').val();
            var no_spj1              = $('#no_spj').val();
            var tgl_spj1             = $('#tgl_spj').val();
            var tgl_bukti1           = $('#tgl_bukti').val();
            var nourut1              = $('#urut').val();
            var nilai1               = number($('#total').val());
            var area1                = $('#kd_area').val();
            var subarea1             = $('#kd_sub_area').val();
            var uraian1              = $('#uraian').val();
            var pegawai1             = $('#kd_pegawai').val();
            var project1             = $('#projek').val();
            var jns_spj1             = $('#jns_spj').val();
            var kas1                 = number($('#kas').val());


          if(tgl_spj1==""){
          alert('Tanggal tidak boleh kosong')
          return;
          }

          if(tgl_bukti1==""){
          alert('Tanggal bukti tidak boleh kosong')
          return;
          }

          if(project1==""){
          alert('Projek tidak boleh kosong')
          return;
          }
          if(no_spj1==""){
          alert('Nomor SPJ tidak boleh kosong')
          return;
          }
          if(no_akun1==""){
          alert('Kode Akun spj tidak boleh kosong')
          return;
          }
          if(nilai1=="" || nilai1==0){
          alert('Total tidak boleh kosong')
          return;
          }

          if(area1==""){
          alert('Area tidak boleh kosong')
          return;
          }

          if(subarea1==""){
          alert('Sub Area tidak boleh kosong')
          return;
          }

          if(pegawai1==""){
          alert('Pegawai tidak boleh kosong')
          return;
          }
              
            
            form_data.append('no_spj', no_spj1);
            form_data.append('kd_area', area1);
            form_data.append('kd_sub_area', subarea1);
            form_data.append('kd_pegawai', pegawai1);
            form_data.append('tgl_spj', tgl_spj1);
            form_data.append('jns_spj', jns_spj1);
            form_data.append('kd_projek', project1);
            form_data.append('urut', nourut1);
            form_data.append('file', file_data);

            
            $.ajax({
                url:'<?php echo base_url();?>index.php/spj_pegawai/simpan_spj_file2',
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
                        document.getElementById("no_acc").value='';
                        document.getElementById("uraian").value='';
                        document.getElementById("total").value='';
                        document.getElementById("tgl_bukti").value='';
                        document.getElementById("kas").value='';
                        load_rincian_temp(no_spj1);
                        $('#largeModal').modal('toggle');
                        $("#error").hide()
                        alert(data.msg);
                    }else{
                        alert(data.msg);
                    }
                }
            });
        });

  //   // SAVE
  //   $('#butsave').on('click', function() {
  //   var no_akun1             = $('#no_acc').val();
  //   var no_spj1              = $('#no_spj').val();
  //   var tgl_spj1             = $('#tgl_spj').val();
  //   var tgl_bukti1           = $('#tgl_bukti').val();
  //   var nourut1              = $('#urut').val();
  //   var nilai1               = number($('#total').val());
  //   var area1                = $('#kd_area').val();
  //   var subarea1             = $('#kd_sub_area').val();
  //   var uraian1              = $('#uraian').val();
  //   var pegawai1             = $('#kd_pegawai').val();
  //   var project1             = $('#kd_projek').val();
  //   var kas1                 = number($('#kas').val());

    
    
  //   if(tgl_spj1==""){
  //     alert('Tanggal tidak boleh kosong')
  //     return;
  //   }

  //   if(tgl_bukti1==""){
  //     alert('Tanggal bukti tidak boleh kosong')
  //     return;
  //   }
    
  //   if(project1==""){
  //     alert('Projek tidak boleh kosong')
  //     return;
  //   }
  //   if(no_spj1==""){
  //     alert('Nomor SPJ tidak boleh kosong')
  //     return;
  //   }
  //   if(no_akun1==""){
  //     alert('Kode Akun spj tidak boleh kosong')
  //     return;
  //   }
  //   if(nilai1=="" || nilai1==0){
  //     alert('Total tidak boleh kosong')
  //     return;
  //   }

  //   if(area1==""){
  //     alert('Area tidak boleh kosong')
  //     return;
  //   }

  //   if(subarea1==""){
  //     alert('Sub Area tidak boleh kosong')
  //     return;
  //   }

  //   if(pegawai1==""){
  //     alert('Pegawai tidak boleh kosong')
  //     return;
  //   }

      
  //     $.ajax({
  //       url: "<?php echo base_url("spj_pegawai/edit_spj/");?>",
  //       type: "POST",
  //       data: {
  //           '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
  //           type:1,
  //           area:area1,
  //           subarea:subarea1,
  //           project:project1,
  //           pegawai:pegawai1,
  //           tgl_spj:tgl_spj1,
  //           tgl_bukti:tgl_bukti1,
  //           no_akun:no_akun1,
  //           uraian:uraian1,
  //           nilai:nilai1,
  //           no_spj:no_spj1,
  //           nourut:nourut1
  //           },
  //           cache: false,
  //           success: function(dataResult){
  //               var dataResult = JSON.parse(dataResult);
  //               if(dataResult.statusCode==200){
  //                   document.getElementById("no_acc").value='';
  //                   document.getElementById("uraian").value='';
  //                   document.getElementById("total").value='';
  //                   document.getElementById("tgl_bukti").value='';
  //                   document.getElementById("kas").value='';
  //                   load_rincian_temp(no_spj1);
  //                   $('#largeModal').modal('toggle');
  //                   $("#error").hide();
  //               }
  //               else if(dataResult.statusCode==201){
  //                   $("#error").show();
  //                   $("#success").hide();
  //                   $('#error').html('Gagal Simpan');
  //               }
  //           }
  //     });
    
  // });

function load_rincian_temp(nospj) {
    var kd_pegawai      = $('#kd_pegawai').val();

    table.ajax.url("<?=base_url('spj_pegawai/datatable_json_spj_edit'.'/')?>"+ nospj+'/'+kd_pegawai);
    table.ajax.reload();
}




  }); 


</script>