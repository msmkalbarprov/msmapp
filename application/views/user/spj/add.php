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
            <a href="<?= base_url('spj_pegawai'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
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
          <div class="col-md-6">
            <div class="form-group">
              <label for="item_hpp" class="control-label">No. SPJ</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="text" name="no_spj" id="no_spj" class="form-control" readonly>
              <input type="hidden" name="urut" id="urut" class="form-control" readonly>
            </div>
          </div>
          
          <div class="col-md-6">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Tanggal SPJ</label>
              <input type="date" name="tgl_spj" id="tgl_spj" class="form-control"  required >
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
                      <option value="<?= $area['kd_area']; ?>"><?= $area['nm_area']; ?></option>
                  <?php endforeach; ?>
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
                        <label for="item_hpp" class="control-label">Jenis</label>
                        <select name="jns_spj" id="jns_spj" class="form-control">
                            <option value="">No Selected</option>
                            <option value="1">Proyek</option>
                            <option value="2">Operasional</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="item_hpp" class="control-label">No. PQ</label>
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <select name="kd_pqproyek"  id="kd_pqproyek" class="form-control" required>
                            <option value="">No Selected</option>
                        </select> 
                    </div>
                </div>

            </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="item_hpp" class="control-label">Tanggal Bukti</label>
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
                    <label for="dinas" class="control-label">Jenis TKL (khusus akun TKL)</label>
                    <select name="jns_tkl" id="jns_tkl" class="form-control">
                        <option value="">No Selected</option>
                        <option value="programer">Programer</option>
                        <option value="akuntan">Akuntan</option>
                        <option value="rc">RC</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
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
                <label for="dinas" class="control-label">Saldo Kas</label>
                <input type="text" name="kas" id="kas" class="form-control"  style="background:none;text-align:right;"readonly >
            </div>
          </div>
         </div>
         <div class="row">
         <div class="col-md-6">
           <div class="form-group">
                <label for="dinas" class="control-label">Nilai PQ</label>
                <input type="text" name="n_pq" id="n_pq" class="form-control"  style="background:none;text-align:right;"readonly >
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
                <label for="dinas" class="control-label">Realisasi PQ</label>
                <input type="text" name="r_pq" id="r_pq" class="form-control"  style="background:none;text-align:right;"readonly >
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
                <label for="dinas" class="control-label">Sisa PQ</label>
                <input type="text" name="s_pq" id="s_pq" class="form-control"  style="background:none;text-align:right;"readonly >
            </div>
          </div>
         </div>
        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button class="btn btn-success" id="btn_upload" type="submit">Simpan</button>
        <!-- <button name="butsave" id="butsave"  class="btn btn-success btn-sm"> Simpan </button> -->
      </div>
      </form>
    </div>
  </div>
</div>


      </div>
      <!-- /.box-body -->
    </div>
  </section> 
</div>



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
    document.getElementById('jns_tkl').disabled = true;
    nospj=0;
    kd_pegawai=0;
    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ordering": true, // Set true agar bisa di sorting
    "ajax": 
    {
                "url": "<?= base_url('spj_pegawai/view'.'/')?>"+ nospj+'/'+kd_pegawai, // URL file untuk proses select datanya
                "type": "POST",
                "data" : {
                        "<?php echo $this->security->get_csrf_token_name(); ?>" : "<?php echo $this->security->get_csrf_hash(); ?>"
                      }
            },
    "deferRender": true,
    "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],

     "columns": [
                { "data": "no_spj" }, // Tampilkan no_acc
                { "data": "tgl_bukti" }, // Tampilkan kd_pdo
                { "data": "akun" },  // Tampilkan nama
                { "data": "uraian" }, // Tampilkan uraian
                {
                    "data": null,
                    "render": function(data) {
                      // anchor($row['dokumen'], 'preview','target="_blank"');
                        return '<a href="<?php echo base_url('/uploads/spj/'); ?>'+data.bukti+'" target="_blank">Preview</a>';
                    }
                },
                { "data": "nilai" , render: $.fn.dataTable.render.number(',', '.', 2, ''), "className": "text-right"}, // Tampilkan total
                {
                    "data": null,
                    "render": function(data) {

                        return '<button class="btn btn-danger btn-sm del_btn" id="'+data.no_acc+'"><i class="fa fa-trash-o"></i></button>';
                    }
                }
            ],
  });

  
  $('#area').change(function(){ 
                var area=$(this).val()
                get_nomor_urut(area);
                // $.ajax({
                //     url : "<?php echo site_url('spj_pegawai/get_area');?>",
                //     method : "POST",
                //     data : {
                //         '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                //         id: area},
                //     async : true,
                //     dataType : 'json',
                //     success: function(data){
                //         $('select[name="subarea_1"]').empty();
                //         $('select[name="subarea_1"]').append('<option value="">No Selected</option>');
                //         $.each(data, function(key, value) {
                //             $('select[name="subarea_1"]').append('<option value="'+ value.kd_subarea +'">'+ value.nm_subarea +'</option>');
                //         });

                //     }
                // });
                // return false;
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
    
    var id_hapus  = data_row.id;
    var no_spj    = $('#no_spj').val();
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
            
            load_rincian_temp(nospj);
          }
          else if(dataResult.statusCode==201){
            $("#error").show();
            $("#success").hide();
            $('#error').html('Gagal Simpan');
          }
        }
      });
})



$('#kd_pqproyek').change(function(){ 
    get_akun();
});


$('#jns_spj').change(function(){ 
    var kodearea    = $('#area').val();
    var jns_spj   = $(this).val();
    get_nomor_urut(kodearea);
    $.ajax({
        url : "<?php echo site_url('spj/get_pq_by_area');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kodearea,jns_spj:jns_spj},
        async : true,
        dataType : 'json',
        success: function(data){
            $('select[name="kd_pqproyek"]').empty();
            $('select[name="kd_pqproyek"]').append('<option value="">No Selected</option>');
            $.each(data, function(key, value) {
                $('select[name="kd_pqproyek"]').append('<option value="'+ value.kd_pqproyek +'">'+ value.kd_pqproyek+ ' ' +value.nm_paket_proyek +'</option>');
            });

        }
    });
    return false;
});



function load_rincian_temp(nospj) {
        var area      = $('#area').val();

        table.ajax.url("<?=base_url('spj/view'.'/')?>"+ nospj+'/'+area);
        table.ajax.reload();
}

function get_akun(){
    var jns_spj = $('#jns_spj').val();
    var no_pq   = $('#kd_pqproyek').val();
    $.ajax({
        url : "<?php echo site_url('spj/get_item_spj');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          jns_spj:jns_spj,no_pq:no_pq
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
  var area          = $('#area').val();
  var jns_spj          = $('#jns_spj').val();
  var kd_pqproyek   = $('#kd_pqproyek').val();
  var kd_item       = $(this).val();
    get_kas(area);

    if (kd_item=='5010202'){
        document.getElementById('jns_tkl').disabled = false;
    }else{
        document.getElementById('jns_tkl').disabled = true;
        var jns_tkl   = '';
        get_nilai(kd_pqproyek,kd_item,jns_spj,jns_tkl);
    }
    return false;
});

$('#jns_tkl').change(function(){ 
    var jns_spj         = $('#jns_spj').val();
    var kd_pqproyek     = $('#kd_pqproyek').val();
    var kd_item         = $('#no_acc').val();
    var jns_tkl         = $(this).val();
    get_nilai(kd_pqproyek,kd_item,jns_spj,jns_tkl);

});

function get_kas(area){
        var project  = $('#project').val();
        $.ajax({
        url : "<?php echo site_url('spj/get_kas');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: area},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="kas"]').val(number_format(value.total,"2",",",".")).trigger('change');

            });

        }
    });
        
}


function get_nilai(kd_pqproyek,kd_item,jns_spj,jns_tkl){
        $.ajax({
        url : "<?php echo site_url('spj/get_nilai');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kd_pqproyek,no_acc:kd_item,jns_spj:jns_spj,jns_tkl:jns_tkl},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="n_pq"]').val(number_format(value.nilai,"2",",",".")).trigger('change');
                get_realisasi(kd_item,kd_pqproyek,jns_spj,value.nilai,jns_tkl);
            });

        }
    });
}


function get_realisasi(kd_item,kd_pqproyek,jns_spj,nilai,jns_tkl){
        $.ajax({
        url : "<?php echo site_url('spj/get_realisasi');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kd_pqproyek,no_acc:kd_item,jns_spj:jns_spj,jns_tkl:jns_tkl},
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
                nospj = value.nomor;
                load_rincian_temp(nospj);
                $('[name="urut"]').val(value.nomor).trigger('change');
                $('[name="no_spj"]').val(value.nomor).trigger('change');
            });

        }
    });
}

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
            var area1                = $('#area').val();
            var jns_spj1             = $('#jns_spj').val();
            var kd_pqproyek1         = $('#kd_pqproyek').val();
            var jns_tkl1             = $('#jns_tkl').val();
            var uraian1              = $('#uraian').val();
            var kas1                 = number($('#kas').val());
            var sisapq1              = number($('#s_pq').val());


                if (nilai1>sisapq1){
                    alert('Nilai SPJ melebihi Nilai PQ')
                    return;
                }
                
                if(tgl_spj1==""){
                alert('Tanggal tidak boleh kosong')
                return;
                }

                if(tgl_bukti1==""){
                alert('Tanggal bukti tidak boleh kosong')
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

                if(jns_spj1==""){
                alert('Jenis SPJ tidak boleh kosong')
                return;
                }

                if(kd_pqproyek1==""){
                alert('PQ tidak boleh kosong')
                return;
                }
              
            
            form_data.append('no_spj', no_spj1);
            form_data.append('kdarea', area1);
            form_data.append('tgl_spj', tgl_spj1);
            form_data.append('urut', nourut1);
            form_data.append('file', file_data);

            
            $.ajax({
                url:'<?php echo base_url();?>index.php/spj/simpan_spj_file',
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
                        document.getElementById("jns_tkl").value='';
                        document.getElementById("kd_pqproyek").value='';
                        document.getElementById("s_pq").value='';
                        document.getElementById("n_pq").value='';
                        document.getElementById("r_pq").value='';
                        load_rincian_temp(no_spj1);
                        $('#largeModal').modal('toggle');
                        $("#error").hide();
                        alert(data.msg);
                    }else{
                        alert(data.msg);
                    }
                }
            });
        });


//     // SAVE LAMA
// $('#butsave').on('click', function() {
//     var no_akun1             = $('#no_acc').val();
//     var no_spj1              = $('#no_spj').val();
//     var tgl_spj1             = $('#tgl_spj').val();
//     var tgl_bukti1           = $('#tgl_bukti').val();
//     var nourut1              = $('#urut').val();
//     var nilai1               = number($('#total').val());
//     var area1                = $('#area').val();
//     var jns_spj1             = $('#jns_spj').val();
//     var kd_pqproyek1         = $('#kd_pqproyek').val();
//     var jns_tkl1             = $('#jns_tkl').val();
//     var uraian1              = $('#uraian').val();
//     var kas1                 = number($('#kas').val());
//     var sisapq1              = number($('#s_pq').val());

//     if (nilai1>sisapq1){
//         alert('Nilai SPJ melebihi Nilai PQ')
//         return;
//     }
    
//     if(tgl_spj1==""){
//       alert('Tanggal tidak boleh kosong')
//       return;
//     }

//     if(tgl_bukti1==""){
//       alert('Tanggal bukti tidak boleh kosong')
//       return;
//     }
    
    
//     if(no_spj1==""){
//       alert('Nomor SPJ tidak boleh kosong')
//       return;
//     }
//     if(no_akun1==""){
//       alert('Kode Akun spj tidak boleh kosong')
//       return;
//     }
//     if(nilai1=="" || nilai1==0){
//       alert('Total tidak boleh kosong')
//       return;
//     }

//     if(area1==""){
//       alert('Area tidak boleh kosong')
//       return;
//     }

//     if(jns_spj1==""){
//       alert('Jenis SPJ tidak boleh kosong')
//       return;
//     }

//     if(kd_pqproyek1==""){
//       alert('PQ tidak boleh kosong')
//       return;
//     }

      
//       $.ajax({
//         url: "<?php echo base_url("spj/add/");?>",
//         type: "POST",
//         data: {
//             '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
//             type:1,
//             area:area1,
//             jns_spj:jns_spj1,
//             kd_pqproyek:kd_pqproyek1,
//             tgl_spj:tgl_spj1,
//             tgl_bukti:tgl_bukti1,
//             no_akun:no_akun1,
//             uraian:uraian1,
//             nilai:nilai1,
//             no_spj:no_spj1,
//             jns_tkl:jns_tkl1,
//             nourut:nourut1
//             },
//             cache: false,
//             success: function(dataResult){
//                 var dataResult = JSON.parse(dataResult);
//                 if(dataResult.statusCode==200){
//                     document.getElementById("no_acc").value='';
//                     document.getElementById("uraian").value='';
//                     document.getElementById("total").value='';
//                     document.getElementById("tgl_bukti").value='';
//                     document.getElementById("kas").value='';
//                     document.getElementById("jns_tkl").value='';
//                     document.getElementById("kd_pqproyek").value='';
//                     document.getElementById("s_pq").value='';
//                     document.getElementById("n_pq").value='';
//                     document.getElementById("r_pq").value='';
//                     load_rincian_temp(no_spj1);
//                     $('#largeModal').modal('toggle');
//                     $("#error").hide();
//                 }
//                 else if(dataResult.statusCode==201){
//                     $("#error").show();
//                     $("#success").hide();
//                     $('#error').html('Gagal Simpan');
//                 }
//             }
//       });
    
//   });

  }); 


</script>