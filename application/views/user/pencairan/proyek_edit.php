  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/select2/select2.min.css">
  <!-- Content Wrapper. Contains page content -->
  <style type="text/css">
.select2-container .select2-selection {
  height: 37px; 
}
    </style>
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header bg-warning">
          <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-check"></i>
             Pencairan Proyek </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('pencairan'); ?>" class="btn btn-primary btn-sm text-white"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>

         
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label">Kode Proyek</label>
                <input type="text" name="kd_proyek" class="form-control" id="kd_proyek" placeholder="Nama Paket pekerjaan" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label for="area" class="control-label">&nbsp;</label>
                <input type="text" name="status_cair" class="form-control" id="status_cair" style="border:none;background:none" readonly>
                <input type="hidden" name="status_cair2" class="form-control" id="status_cair2" >
            </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label"><?= trans('area') ?></label>
                <select name="area" id="area"  class="form-control select2" readonly>
                <option value="">No Selected</option>
                <?php foreach($data_area as $area): ?>
                  <?php if($area['kd_area'] == $this->session->userdata('kd_area')): ?>
                    <option value="<?= $area['kd_area']; ?>" selected><?= $area['nm_area']; ?></option>
                    <?php else: ?>
                      <option value="<?= $area['kd_area']; ?>"><?= $area['nm_area']; ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>

            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="sub_area" class="control-label"><?= trans('sub_area') ?></label>
              <select name="subarea" id="subarea" class="form-control select2" readonly>
                  <option value="">No Selected</option>
              </select>
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="jenis_proyek" class="control-label">Jenis proyek</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <select name="jnsproyek" id="jnsproyek" class="form-control" readonly>
                  <option value="">No Selected</option>
                  <?php foreach($data_jnsproyek as $jnsproyek): ?>
                    <option value="<?= $jnsproyek['kd_projek']; ?>"><?= $jnsproyek['nm_projek']; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="jenis_sub_proyek" class="control-label"><?= trans('jenis_sub_proyek') ?></label>
              <select class="form-control select2" id="jnssubproyek" name="jnssubproyek" readonly>
                <option value="">No Selected</option>
              </select>
          </div>
          </div>
         </div>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="perusahaan" class="control-label"><?= trans('perusahaan') ?></label>
                <select name="perusahaan" id="perusahaan" class="form-control select2" readonly>
                  <option value="">No Selected</option>
                  <?php foreach($data_perusahaan as $perusahaan): ?>
                    <option value="<?= $perusahaan['akronim']; ?>"><?= $perusahaan['nama']; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="dinas" class="control-label"><?= trans('nm_dinas') ?></label>
              <select name="dinas" id="dinas" class="form-control select2" readonly>
                <option value="">No Selected</option>
              </select>
          </div>
          </div>
         </div>

         <div class="row">
            <div class="col-md-6">
            <div class="form-group">
              <label for="thn_ang" class="control-label">Tahun Anggaran</label>
                <select name="thn_ang" id="thn_ang" class="form-control" readonly>
                  <option value="">No Selected</option>
                  <option value="<?= date('Y')-1;?>"><?= date('Y')-1;?></option>
                  <option value="<?= date('Y')?>"><?= date('Y')?></option>
                  <option value="<?= date('Y')+1;?>"><?= date('Y')+1;?></option>
                </select>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="nilai" class="control-label">Nama Paket pekerjaan</label>
              <input type="text" name="paketproyek" class="form-control" id="paketproyek" placeholder="Nama Paket pekerjaan" readonly>
          </div>
          </div>
         </div>
         <div class="row">
          <div class="col-md-12">
           <div class="form-group">
              <label for="jns_pph" class="control-label">Keterangan</label>
              <textarea name="catatan" id="catatan" class="form-control" rows="1" readonly></textarea>
          </div>
          </div>
         </div>

              


        
      </div>
      <!-- /.box-body -->
    </div>
    <div class="card card-default">
      <div class="card-body">
           <div class="row">
            <div class="col-md-12">
              <div class="card-body table-responsive">
                <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr>
                      <th>#id</th>
                      <th>Pagu</th>
                      <th>PPH</th>
                      <th>Jenis Pengadaan</th>
                      <th>tanggal</th>
                      <th>tanggal selesai</th>
                      <th>Nilai</th>
                      <th>no dokumen</th>
                      <th>Dokumen</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
           </div>
      </div>
    </div>
    <div class="card card-default">
    <div class="card-header bg-success">
      Input pencairan proyek
    </div>
    <div class="card-body">
      <?php echo form_open(base_url('pencairan/detail/'.$proyek['id_proyek']), 'class="form-horizontal"');  ?> 
         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
                <label for="area" class="control-label">Kode Proyek</label>
                <input type="text" name="kd_proyek2" class="form-control" id="kd_proyek2" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label for="area" class="control-label">Tanggal Cair/PDP</label>
                <input type="date" name="tgl_cair" class="form-control" id="tgl_cair" >
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label for="area" class="control-label">Nomor PDP</label>
                <input type="text" name="nomor" class="form-control" id="nomor">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label for="area" class="control-label">Jenis pencairan</label>
                <select id="jns_pencairan" name="jns_pencairan" class="form-control">
                  <option value="">No Selected</option>
                  <option value="1">Uang Muka</option>
                  <option value="2">Termin 1</option>
                  <option value="3">Termin 2</option>
                  <option value="4">Termin 3</option>
                  <option value="5">Termin 4</option>
                  <option value="6">Termin 5</option>
                  <option value="7">Termin 6</option>
                  <option value="8">Termin 7</option>
                  <option value="9">Termin 8</option>
                  <option value="10">Termin 9</option>
                  <option value="11">Termin 10</option>
                  <option value="12">Termin 11</option>
                  <option value="13">Termin 12</option>
                  <option value="14">Termin 13</option>
                  <option value="15">Termin 14</option>
                  <option value="16">Termin 15</option>
                  <option value="100">Lunas</option>
                </select>
            </div>
          </div>
         </div>
         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
                <label for="nilai" class="control-label">Nilai Proyek</label>
                <input type="text" name="nilai_proyek" class="form-control" id="nilai_proyek" placeholder="Nilai" style="text-align:right;"  readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label for="area" class="control-label">Nilai Bruto</label>
                <input type="text" name="nilai_bruto" class="form-control" id="nilai_bruto" value="0" placeholder="Nilai" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))"  required>
            </div>
          </div>
          <div class="col-md-2">
                    <label for="area" class="control-label">Jenis PPN</label><br>
                    <small>11%</small>
                    <input class='tgl-ios tgl_checkbox' id='c_ppn' name="c_ppn"  type='checkbox' />
                    <label for='c_ppn'></label>
                    <small>10%</small>
                    <input id='s_ppn' name="s_ppn"  type='hidden' />
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <label for="area" class="control-label">Nilai PPN</label>
                <input type="text" name="ppn" class="form-control" value="0" id="ppn" placeholder="Nilai" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))"  required>
            </div>
          </div>
         </div>
         <div class="row">
          <div class="col-md-3">
                  <label for="area" class="control-label">jenis PPH 21 <small>(Hanya untuk PPH 21)</small> </label><br>
                    <input type="radio" name="jenispph" id="jenispph1" class="radio" value="1"> 5%&nbsp;&nbsp;
                    <input type="radio" name="jenispph" id="jenispph2" class="radio" value="2"> 7,5%&nbsp;&nbsp;
                    <input type="radio" name="jenispph" id="jenispph3" class="radio" value="3"> 15% &nbsp;&nbsp;
                    <input type="radio" name="jenispph" id="jenispph4" class="radio" value="4"> 50% * 5%

                    <input id='s_pph' name="s_pph"  type='hidden' />
          </div>

          <div class="col-md-3">
            <div class="form-group">
                <label for="area" class="control-label">Nilai PPH <span id="nilaijnspph"></span></label>
                <input type="hidden" name="jnspph" id="jnspph">
                <input type="text" name="pph" class="form-control" id="pph" value="0" placeholder="Nilai" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))"  required>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label for="area" class="control-label">Nilai Netto</label>
                <input type="text" name="nilai_netto" class="form-control" id="nilai_netto" placeholder="Nilai" style="text-align:right;"  readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label for="area" class="control-label">Nilai Pencairan</label>
                <input type="text" name="realisasi" class="form-control" id="realisasi" placeholder="Nilai" style="text-align:right;"  readonly>
            </div>
          </div>
         </div>
          <div class="form-group">
            <div class="col-md-12" align="right">
              <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
          </div>
      <?php echo form_close( ); ?>
    </div>
  </div>
    <div class="card card-default">
      <div class="card-body">
           <div class="row">
            <div class="col-md-12">
              <div class="card-body table-responsive">
                <table id="na_datatable_cair" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr>
                      <th width="5%">#id</th>
                      <th>Nomor</th>
                      <th>Tanggal/Jenis</th>
                      <th>Nilai Bruto</th>
                      <th>PPN</th>
                      <th>PPH</th>
                      <th>Netto</th>
                      <th width="10%">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
           </div>
      </div>
    </div>
  </section> 
</div>
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/dist/js/jquery-3.3.1.js'?>"></script> -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?= base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
  <script>
  // $("#proyek").addClass('menu-open');
  $("#pencairan> a").addClass('active');
</script>
<script type="text/javascript">
    $(document).ready(function(){
      $('.select2').select2()
       get_data_detail();
       $("#area").prop("disabled", true).change();  

$('.radio').click(function () {
           hitung_total();
       });

$('#c_ppn').click(function() {
    hitung_total();
});

  function get_data_detail(){
              var id = "<?php echo $proyek['id_proyek'] ?>";
              $.ajax({
                url : "<?php echo site_url('pencairan/get_data_detail_edit');?>",
                    method : "POST",
                    data :{
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id :id
                    },
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        $.each(data, function(i, item){
                            jnsproyek     = data[i].jns_proyek;
                            kddinas       = data[i].kd_dinas;
                            kdsubproyek   = data[i].jns_sub_proyek;
                            kdsubarea     = data[i].kd_sub_area;
                          // alert(data[i].kd_usulan);
                            $('[name="area"]').val(data[i].kd_area).trigger('change');
                            $('[name="tgl_cair"]').val(data[i].tgl_cair).trigger('change');

                            if (data[i].status_cair==1){
                              var status_cair ="Sudah dicairkan";
                            }else{
                              var status_cair ="Belum dicairkan";
                            }
                            $('[name="status_cair"]').val(status_cair).trigger('change');
                            $('[name="status_cair2"]').val(data[i].status_cair).trigger('change');
                            $('[name="jnsproyek"]').val(data[i].jns_proyek).trigger('change');

                            $('[name="perusahaan"]').val(data[i].kd_perusahaan).trigger('change');
                            // $('[name="dinas"]').val(data[i].kd_dinas).trigger('change');
                            $('[name="thn_ang"]').val(data[i].thn_anggaran).trigger('change');
                            $('[name="jnspph"]').val(data[i].jns_pph).trigger('change');
                            document.getElementById("nilaijnspph").textContent=data[i].jns_pph;
                            if (data[i].jns_pph =='22' || data[i].jns_pph =='23'){
                              document.getElementById("jenispph1").disabled = true;
                              document.getElementById("jenispph2").disabled = true;
                              document.getElementById("jenispph3").disabled = true;
                              document.getElementById("jenispph4").disabled = true;
                            }

                            
                            $('[name="nilai_proyek"]').val(number_format(data[i].nilai_proyek,"2",",",".")).trigger('change');
                            $('[name="realisasi"]').val(number_format(data[i].realisasi,"2",",",".")).trigger('change');
                            // $('[name="loc"]').val(data[i].loc).trigger('change');
                            $('[name="paketproyek"]').val(data[i].nm_paket_proyek).trigger('change');
                            $('[name="kd_proyek"]').val(data[i].kd_proyek).trigger('change');
                            $('[name="kd_proyek2"]').val(data[i].kd_proyek).trigger('change');
                            $('[name="catatan"]').val(data[i].catatan).trigger('change');
                            // document.getElementById("thn_ang").selectedIndex = data[i].thn_anggaran;
                            get_subareacombo();
                        });
                    }

              });
            }



    function get_subareacombo(){ 
                var subarea=document.getElementById("area").value;
                $.ajax({
                    url : "<?php echo site_url('pencairan/get_area');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: subarea},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="subarea"]').empty();
                        $('select[name="subarea"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {
                        
                          $('select[name="subarea"]').append('<option value="'+ value.kd_subarea +'">'+ value.nm_subarea +'</option>');
                          $('[name="subarea"]').val(kdsubarea).trigger('change');
                          get_dinascombo(kdsubarea);
                            
                        });

                    }
                });
                return false;
            };

  function get_dinascombo(kdsubarea){ 
                var subarea=kdsubarea;
                var area=document.getElementById("area").value;
                // alert(subarea)
                $.ajax({
                    url : "<?php echo site_url('pencairan/get_dinas');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: subarea,area:area},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="dinas"]').empty();
                        $('select[name="dinas"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {
                           
                           $('select[name="dinas"]').append('<option value="'+ value.id +'">'+ value.nama_dinas +'</option>');
                           $('[name="dinas"]').val(kddinas).trigger('change');

                            
                        });

                    }
                });
                return false;
            };

    $('#area').change(function(){ 
                var subarea=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('pencairan/get_area');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: subarea},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="subarea"]').empty();
                        $('select[name="subarea"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {
                            if(kdsubarea==value.kd_subarea){
                                $('select[name="subarea"]').append('<option value="'+ value.kd_subarea +'" selected>'+ value.nm_subarea +'</option>');
                            }else{
                                $('select[name="subarea"]').append('<option value="'+ value.kd_subarea +'">'+ value.nm_subarea +'</option>');
                            }

                        });

                    }
                });
                return false;
            });


      $('#jnsproyek').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('pencairan/get_subproyek');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="jnssubproyek"]').empty();
                        $('select[name="jnssubproyek"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {
                          // if(kdsubproyek==value.kd_subprojek){
                          //       $('select[name="jnssubproyek"]').append('<option value="'+ value.kd_subprojek +'" selected>'+ value.kd_subprojek + '-' + value.nm_subprojek +'</option>');
                          //   }else{
                                $('select[name="jnssubproyek"]').append('<option value="'+ value.kd_subprojek +'">'+ value.kd_subprojek + '-' + value.nm_subprojek +'</option>');
                            // }
                            $('[name="jnssubproyek"]').val(kdsubproyek).trigger('change');
                            
                        });

                    }
                });
                return false;
            }); 

             $('#subarea').change(function(){ 
                var subarea=$(this).val();
                var area=document.getElementById("area").value;
                $.ajax({
                    url : "<?php echo site_url('pencairan/get_dinas');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: subarea,area:area},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="dinas"]').empty();
                        $('select[name="dinas"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {

                           if(kddinas==value.id){
                                $('select[name="dinas"]').append('<option value="'+ value.id +'" selected>'+ value.nama_dinas +'</option>');
                            }else{
                                $('select[name="dinas"]').append('<option value="'+ value.id +'">'+ value.nama_dinas +'</option>');
                            }

                            
                        });

                    }
                });
                return false;
            });     
    });

    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('pencairan/datatable_json_rincian/'.$proyek["id_proyek"])?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "nm_jns_pagu", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "jns_pph", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "tipe_proyek", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "no_dokumen", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "tanggal", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "tanggal2", 'searchable':true, 'orderable':false},
    { "targets": 7, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 8, "name": "dokumen", 'searchable':true, 'orderable':false}
    ]
  });

    var table = $('#na_datatable_cair').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('pencairan/datatable_json_rincian_cair/'.$proyek["id_proyek"])?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "nomor", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "tgl_cair", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "ppn", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "pph", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "netto", 'searchable':true, 'orderable':false},
    { "targets": 7, "name": "Action", 'searchable':false, 'orderable':false}
    ]
  });


  document.getElementById("nilai_bruto").onkeyup   = function() {hitung_total()};
  document.getElementById("pph").onkeyup   = function() {hitung_total()};
  document.getElementById("ppn").onkeyup   = function() {hitung_total()};

  function hitung_total() {
  var nilai_bruto     = number(document.getElementById("nilai_bruto").value);
  var nilai_cair     = number(document.getElementById("realisasi").value);

  var sisa = nilai_bruto-nilai_cair;
  // var pph             = number(document.getElementById("pph").value);
  // var ppn             = number(document.getElementById("ppn").value);

  var pilihpph    = number(document.getElementById("jnspph").value);

  if (pilihpph==21){

    var jenispph =  $('.radio:checked').val();
  }

   // hitung ppn lagi
  if ($('#c_ppn').prop('checked') == true && pilihpph!=21){
    var ppn = (10/100)*((100/110)*nilai_bruto);
    $('[name="s_ppn"]').val('1').trigger('change');
    $('[name="ppn"]').val(number_format(ppn,"2",",",".")).trigger('change');
  }else if ( ($('#c_ppn').prop('checked') == true && pilihpph==21) ){
    var ppn = 0;
    $('[name="s_ppn"]').val('1').trigger('change');
    $('[name="ppn"]').val(number_format(0,"2",",",".")).trigger('change');
  }else if ($('#c_ppn').prop('checked') == false && pilihpph==21){
    var ppn = 0;
    $('[name="s_ppn"]').val('0').trigger('change');
    $('[name="ppn"]').val(number_format(0,"2",",",".")).trigger('change');
  }else{
    var ppn = (11/100)*((100/110)*nilai_bruto);
    $('[name="s_ppn"]').val('0').trigger('change');
    $('[name="ppn"]').val(number_format(ppn,"2",",",".")).trigger('change');
  }
  

    if (pilihpph==22){
    var nilai_pph = (1.5/100)*((100/110)*nilai_bruto);
  }else if (pilihpph==23){
    var nilai_pph = (2/100)*((100/110)*nilai_bruto);
    
  }else if (pilihpph==21){
      if(jenispph==1){
        var nilai_pph         = ((5/100)*nilai_bruto);
        $('[name="s_pph"]').val('1').trigger('change');
      }else if(jenispph==2){
        var nilai_pph         =((7.5/100)*nilai_bruto);
        $('[name="s_pph"]').val('2').trigger('change');
      }else if(jenispph==3){
        var nilai_pph         = ((15/100)*nilai_bruto);
        $('[name="s_pph"]').val('3').trigger('change');
      }else{
        var nilai_pph         = (50/100)*((5/100)*nilai_bruto);
        $('[name="s_pph"]').val('4').trigger('change');
      }
    
    nilai_ppntitipan=0;
  }


  let totalrow = 0;

  totalrow = nilai_bruto-nilai_pph-ppn;


  $('[name="pph"]').val(number_format(nilai_pph,"2",",",".")).trigger('change');
  $('[name="nilai_netto"]').val(number_format(totalrow,"2",",",".")).trigger('change');
  if (totalrow>sisa){
    alert('Nilai Melebihi Sisa Nilai Proyek');
  }
}
  </script>