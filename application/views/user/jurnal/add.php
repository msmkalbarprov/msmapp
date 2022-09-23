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
             Tambah Jurnal Umum</h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('jurnal'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
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
        <!-- <form class="form-horizontal" id="formtest"> -->
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="item_hpp" class="control-label">No. Voucher</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="text" name="no_voucher" id="no_voucher" class="form-control"  required >
            </div>
          </div>
          
          <div class="col-md-6">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Tanggal Voucher</label>
              <input type="date" name="tgl_voucher" id="tgl_voucher" class="form-control"  required >
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
                      <label for="item_hpp" class="control-label">Jenis Jurnal</label>
                        <select name="jns_jurnal"  id="jns_jurnal" class="form-control" required>
                          <option value="">No Selected</option>
                          <!-- <option value="1">Proyek</option> -->
                          <option value="2">Penyusutan</option>
                        </select> 
                </div>
            </div>

          
         </div>
         <div class="row">
         <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label">Akun</label>
                <select name="no_acc" id ="no_acc" class="form-control select2" style="width: 100%;" required >
                <option value="">No Selected</option>
                <?php foreach($data_akun as $akun): ?>
                      <option value="<?= $akun['no_acc']; ?>"><?= $akun['nm_acc']; ?></option>
                  <?php endforeach; ?>
                </select>

            </div>
          </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="Uraian" class="control-label">Uraian</label>
                <textarea type="text" name="keterangan" id="keterangan" rows="1" class="form-control"  placeholder="" ></textarea>
              </div>
            </div>
         </div>

         <div class="row">
         <div class="col-md-6">
              <div class="form-group">
                <label for="item_hpp" class="control-label">Kredit/Debet</label><br>
                    <small>Kredit</small>
                    <input class='tgl-ios tgl_checkbox' id='c_kd' name="c_kd"  type='checkbox' />
                    <label for='c_kd'></label>
                    <small>Debet</small>
                    <input id='s_kd' name="s_kd"  type='hidden' />

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="Uraian" class="control-label">Uraian</label>
                <input type="text" name="nilai" style="background:none;text-align:right;" id="nilai" 
                placeholder="0,00" value="0" onkeypress="return(currencyFormat(this,'.',',',event))"  class="form-control" >
              </div>
            </div>
         </div>
        
        <div class="form-group">
          <div class="col-md-12" align="right">
            <!-- <button name="butsave" id="butsave"  class="btn btn-success btn-sm"> Tambah Rincian </button> -->
            <a href="#" id="btn_tambah" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal">Tambah Rincian</a>
            <input type="submit" name="submit" id="submit" value="Simpan" class="btn btn-primary btn-sm">
            <!-- <button class="btn btn-primary btn-sm" id="btn_upload" type="submit">Simpan</button> -->
          </div>
        </div>
      <!-- </form> -->
      <!-- datatable -->
      
        <div class="col-md-12">
          <div class="card-body table-responsive">
            <table id="na_datatable" class="table table-bordered table-striped" width="100%">
              <thead>
                  <tr>
                    <th width="5%">No.</th>
                    <th>No. Voucher</th>
                    <th>Tanggal Voucher</th>
                    <th>Kode Area</th>
                    <th>Area</th>
                    <th>Kode Akun</th>
                    <th>Akun</th>
                    <th>Keterangan</th>
                    <th>Kredit</th>
                    <th>Debet</th>
                    <th>jns_jurnal</th>
                    <th width="5%"><?= trans('action') ?></th>
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



<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
  <script>
  $("#spj_pegawai> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    $('.select2').select2()
    // document.getElementById("jns_ta").disabled=true;
    nospj=0;
    kd_pegawai=0;
    var t = $('#na_datatable').DataTable( {
    // "processing": true,
    // "serverSide": true,
    // "ordering": true, // Set true agar bisa di sorting
    // "ajax": 
    // {
  //               "url": "<?= base_url('spj_pegawai/view'.'/')?>"+ nospj+'/'+kd_pegawai, // URL file untuk proses select datanya
  //               "type": "POST",
  //               "data" : {
  //                       "<?php echo $this->security->get_csrf_token_name(); ?>" : "<?php echo $this->security->get_csrf_hash(); ?>"
  //                     }
  //           },
  //   "deferRender": true,
  //   "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],

     "columns": [
                { "data": "urut" }, // Tampilkan no_acc
                { "data": "no_voucher" }, // Tampilkan kd_pdo
                { "data": "tgl_voucher" },  // Tampilkan nama
                { "data": "kd_area" },  // Tampilkan nama
                { "data": "nm_area" },  // Tampilkan nama
                { "data": "no_acc" },  // Tampilkan nama
                { "data": "nm_acc" },  // Tampilkan nama
                { "data": "uraian" }, // Tampilkan uraian
                { "data": "kredit" , "className": "text-right"}, // Tampilkan total
                { "data": "debet" , "className": "text-right"}, // Tampilkan total
                { "data": "jns_jurnal" }, // Tampilkan uraian
                {
                    "data": null,
                    "render": function(data) {

                        return '<button class="btn btn-danger btn-sm del_btn" id="'+data.urut+'"><i class="fa fa-trash-o"></i></button>';
                    }
                }
            ],
  });


    var t = $('#na_datatable').DataTable();
    t.columns([3,5,10]).visible(false);
    counter = 1;
    var data_jurnal = '';
    $('#btn_tambah').on('click', function () {
      var akun          = $('#no_acc').select2('data')
      var akun_id       = akun[0].id;
      var akun_text       = akun[0].text;
      var area          = $('#area').select2('data')
      var area_id       = area[0].id;
      var area_text     = area[0].text;
      var no_voucher    = $('#no_voucher').val()
      var tgl_voucher   = $('#tgl_voucher').val()
      var keterangan    = $('#keterangan').val()
      var nilai         = $('#nilai').val()
      var jns_jurnal    = $('#jns_jurnal').val()
      var tombol        =  '<button class="btn btn-danger btn-sm del_btn" id="'+counter+'"><i class="fa fa-trash-o"></i></button>';

      if ($('#c_kd').prop('checked') == true){
        var debet   = nilai;
        var kredit  = 0;
      }else{
        var debet   = 0;
        var kredit  = nilai;
      }
      
      
      
        t.row.add({ 'urut': counter,'no_voucher': no_voucher,'tgl_voucher': tgl_voucher, 'kd_area':area_id, 'nm_area': area_text, 'no_acc': akun_id,
          'nm_acc': akun_text,'uraian': keterangan, 'kredit': kredit, 'debet': debet,'jns_jurnal':jns_jurnal, 'tombol': tombol}).draw(false);
        counter++;

        
    });

    
    // $('#na_datatable').on( 'click', 'tbody tr', function () {
    //   myTable.row( this ).remove();
    // } );

    $('#na_datatable').on('click', 'tbody .del_btn', function () {
      t.rows($(this).parents('tr')).remove().draw();

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
   
  }); 

  $("#submit").click(function(e) {
      var t           = $('#na_datatable').DataTable();
      var datasimpan  = t.rows().data().toArray();
      // alert(t.rows().count());
      // alert(datasimpan);
      if(datasimpan==''){
        alert('Data belum ditambahkan')
        return;
      }
                
      $.ajax({
            url: "<?php echo base_url("jurnal/simpan_jurnal_umum");?>",
            type: "POST",
            data: {
              type: 1,
              '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
              datasimpan: datasimpan,
            },
            cache: false,
            success: function(dataResult){
              var dataResult = JSON.parse(dataResult);
              if(dataResult.statusCode==200){
                $("#butsave").removeAttr("disabled");
                $('#fupForm').find('input:text').val('');
                $("#success").show();
                $('#success').html('Data added successfully !');
                window.location.replace('<?php echo base_url();?>index.php/jurnal');
              }
              else if(dataResult.statusCode==201){
                alert("Error occured !");
              }
              
            }
          });
});


</script>