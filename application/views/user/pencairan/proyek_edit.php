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
        <div class="card-header bg-white">
          <div class="d-inline-block">
            <h3 class="card-title"> Pencairan Proyek
              </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('pencairan'); ?>" class="btn btn-primary btn-sm text-white"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>
      </div>
        <!-- <div class="card-body"> -->
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>
      <!-- accordion -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-info collapsed-card card-outline">
            <div class="card-header">
              Rincian Proyek

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
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
                        <input type="hidden" name="status_cair" class="form-control" id="status_cair" style="border:none;background:none" readonly>
                        <input type="hidden" name="status_cair2" class="form-control" id="status_cair2" >
                    </div>
                  </div>
                </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="area" class="control-label"><?= trans('area') ?></label><br />
                      <select name="area" id="area"  class="form-control select2" style="width:100%"  readonly>
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
                  <label for="sub_area" class="control-label"><?= trans('sub_area') ?></label><br />
                    <select name="subarea" id="subarea" class="form-control select2" style="width:100%" readonly>
                        <option value="">No Selected</option>
                    </select>
                </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="jenis_proyek" class="control-label">Jenis proyek</label><br />
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
                  <label for="jenis_sub_proyek" class="control-label"><?= trans('jenis_sub_proyek') ?></label><br />
                    <select class="form-control select2" style="width:100%" id="jnssubproyek" name="jnssubproyek" readonly>
                      <option value="">No Selected</option>
                    </select>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="perusahaan" class="control-label"><?= trans('perusahaan') ?></label><br />
                      <select name="perusahaan" id="perusahaan" class="form-control select2" style="width:100%" readonly>
                        <option value="">No Selected</option>
                        <?php foreach($data_perusahaan as $perusahaan): ?>
                          <option value="<?= $perusahaan['akronim']; ?>"><?= $perusahaan['nama']; ?></option>
                        <?php endforeach; ?>
                      </select>
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="dinas" class="control-label"><?= trans('nm_dinas') ?></label><br />
                    <select name="dinas" id="dinas" class="form-control select2" style="width:100%" readonly>
                      <option value="">No Selected</option>
                    </select>
                </div>
                </div>
              </div>

              <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="thn_ang" class="control-label">Tahun Anggaran</label><br />
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
                  <label for="nilai" class="control-label">Nama Paket pekerjaan</label><br />
                    <input type="text" name="paketproyek" class="form-control" id="paketproyek" placeholder="Nama Paket pekerjaan" readonly>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                <div class="form-group">
                    <label for="jns_pph" class="control-label">Keterangan</label><br />
                    <textarea name="catatan" id="catatan" class="form-control" rows="1" readonly></textarea>
                </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- end accordion -->
         
         
<div class="row">
  <div class="col-md-12">
    <div class="card card-info collapsed-card card-outline">
      <div class="card-header">
        Tambah Pencairan Proyek

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
          </button>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
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
                  <label for="area" class="control-label">Nomor PDP</label>
                  <input type="text" name="nomor" class="form-control" id="nomor">
                  <input type="hidden" name="urut" class="form-control" id="urut" >
                  <input type="hidden" name="areas" class="form-control" id="areas" >
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="area" class="control-label">Tanggal Cair/PDP</label>
                  <input type="date" name="tgl_cair" class="form-control" id="tgl_cair" required>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                    <label for="area" class="control-label">Jenis pencairan</label>
                    <select id="jns_pencairan" name="jns_pencairan" class="form-control" required>
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
                    <label for="area" class="control-label">Rekening pencairan</label>
                    <select id="rek_pencairan" name="rek_pencairan" class="form-control" required>
                      <option value="">No Selected</option>
                      <option value="1">Rekening Lokal</option>
                      <option value="1010301">Bank BRI MSM - Veteran Rek. 10302</option>
                      <option value="1010302"> Bank BRI UMI - Veteran Rek. 12304</option>
                      <option value="1010303"> Bank BRI RUB - Tanah Abang Rek. 23305</option>
                      <option value="1010304"> Bank BRI PSK - Tanah Abang Rek. 24308</option>
                      <option value="1010305"> Bank BRI MSM - Veteran 42152</option>
                      <option value="1010306"> Bank BRI RUB - Veteran Rek. 87303</option>
                      <option value="1010307"> Bank Rekening Pandawa 81304</option>
                      <option value="1010308"> Bank BCA MSM Harmoni Plaza</option>
                      <option value="1010309"> BRI umi veteran rek 032901003618309</option>
                      <option value="1010310"> BPD Papua PT UMI</option>
                    </select>
                  </div>

                  
              </div>
              <div class="col-md-3">
                <div class="form-group">
                    <label for="nilai" class="control-label">Nilai Proyek</label>
                    <input type="text" name="nilai_proyek" class="form-control" id="nilai_proyek" placeholder="Nilai" style="text-align:right;"  readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                    <label for="area" class="control-label">Realisasi</label>
                    <input type="text" name="realisasi" class="form-control" id="realisasi" placeholder="Nilai" style="text-align:right;"  readonly>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                    <label for="area" class="control-label">Nilai Pencairan</label>
                    <input type="text" name="nilai_bruto" class="form-control" id="nilai_bruto" value="0" placeholder="Nilai" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))"  required>
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
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
              


        
      <!-- </div> -->
      <!-- /.box-body -->
    <div class="card card-default" hidden>
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
    <div class="card-header ">
        Riwayat Pencairan Proyek
      </div>
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
                      <th>Nilai Pencairan</th>
                      <th>Rekening</th>
                      <th>Potongan</th>
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
                            $('[name="areas"]').val(data[i].kd_area).trigger('change');
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



function get_nomor_urut(area){
        var kode_pdp= document.getElementById("kd_proyek").value.substr(0,8);
        $.ajax({
        url : "<?php echo site_url('pencairan/get_nomor');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          area: area},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {

                var nomorurut = "PDP/"+kode_pdp+value.nomor;
                $('[name="nomor"]').val(nomorurut).trigger('change');
                $('[name="urut"]').val(value.nomor).trigger('change');
            });

        }
    });
}

    function get_subareacombo(){ 
                var subarea=document.getElementById("area").value;
                get_nomor_urut(subarea);
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
    { "targets": 4, "name": "rek_pencairan", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "potongan", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "Action", 'searchable':false, 'orderable':false}
    ]
  });


  document.getElementById("nilai_bruto").onkeyup   = function() {hitung_total()};

  function hitung_total() {
  var nilai_bruto     = number(document.getElementById("nilai_bruto").value);
  var nilai_proyek    = number(document.getElementById("nilai_proyek").value);
  var nilai_cair      = number(document.getElementById("realisasi").value);

  var sisa = nilai_proyek-nilai_cair;

  if (nilai_bruto>sisa){
    alert('Nilai Melebihi Sisa Nilai Proyek');
  }
}
  </script>