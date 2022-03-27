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
        <div class="card-header">
          <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-check"></i>
             Batal Cair Proyek </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('pencairan'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>

         <?php echo form_open(base_url('pencairan/batal/'.$proyek['id_proyek']), 'class="form-horizontal"');  ?> 
         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="area" class="control-label">Kode Proyek</label>
                <input type="text" name="kd_proyek" class="form-control" id="kd_proyek" placeholder="Nama Paket pekerjaan" readonly>
            </div>
          </div>
          <div class="col-md-9">
          
          </div>
         </div>

         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label"><?= trans('area') ?></label>
                <select name="area" id="area"  class="form-control select2" >
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
              <select name="subarea" id="subarea" class="form-control select2" >
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
                <select name="jnsproyek" id="jnsproyek" class="form-control" >
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
              <select class="form-control select2" id="jnssubproyek" name="jnssubproyek" >
                <option value="">No Selected</option>
              </select>
          </div>
          </div>
         </div>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="perusahaan" class="control-label"><?= trans('perusahaan') ?></label>
                <select name="perusahaan" id="perusahaan" class="form-control select2" >
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
              <select name="dinas" id="dinas" class="form-control select2" >
                <option value="">No Selected</option>
              </select>
          </div>
          </div>
         </div>

         <div class="row">
          <!-- <div class="col-md-3">
            <div class="form-group">
              <label for="jns_pph" class="control-label">Jenis PPH</label>
              <select name="jns_pph" id="jns_pph" class="form-control" required>
                    <option value="">No Selected</option>
                    <option value="21">PPH 21</option>
                    <option value="22">PPH 22</option>
                    <option value="23">PPH 23</option>
                  </select>
              </div>
            </div> -->
            <div class="col-md-6">
            <div class="form-group">
              <label for="thn_ang" class="control-label">Tahun Anggaran</label>
                <select name="thn_ang" id="thn_ang" class="form-control" >
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
              <input type="text" name="paketproyek" class="form-control" id="paketproyek" placeholder="Nama Paket pekerjaan" >
          </div>
          </div>
         </div>
         <div class="row">
          <div class="col-md-12">
           <div class="form-group">
              <label for="jns_pph" class="control-label">Keterangan</label>
              <textarea name="catatan" id="catatan" class="form-control" rows="1"></textarea>
          </div>
          </div>
         </div>

              

        <div class="form-group">
          <div class="col-md-12" align="right">
            <input type="submit" name="submit" value="Batal Cair" class="btn btn-danger btn-sm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </div>
        </div>
        <?php echo form_close( ); ?>
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
  </section> 
</div>
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/dist/js/jquery-3.3.1.js'?>"></script> -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?= base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
  <script>
  // $("#proyek").addClass('menu-open');
  $("#proyek> a").addClass('active');
</script>
<script type="text/javascript">
    $(document).ready(function(){
      $('.select2').select2()
       get_data_detail();

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
                            $('[name="jnsproyek"]').val(data[i].jns_proyek).trigger('change');

                            $('[name="perusahaan"]').val(data[i].kd_perusahaan).trigger('change');
                            // $('[name="dinas"]').val(data[i].kd_dinas).trigger('change');
                            $('[name="thn_ang"]').val(data[i].thn_anggaran).trigger('change');
                            $('[name="jns_pph"]').val(data[i].jns_pph).trigger('change');
                            // $('[name="loc"]').val(data[i].loc).trigger('change');
                            $('[name="paketproyek"]').val(data[i].nm_paket_proyek).trigger('change');
                            $('[name="kd_proyek"]').val(data[i].kd_proyek).trigger('change');
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
  </script>