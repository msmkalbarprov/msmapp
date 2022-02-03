  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-plus"></i>
             <?= trans('proyek_add') ?> </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('proyek'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>

         <?php echo form_open(base_url('proyek/edit/'.$proyek['id_proyek']), 'class="form-horizontal"');  ?> 
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label"><?= trans('area') ?></label>
                <select name="area" class="form-control" required>
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
              <select name="subarea" class="form-control" required>
                  <option value="">No Selected</option>
                  <?php foreach($data_subarea as $subarea): ?>
                    <option value="<?= $subarea['kd_subarea']; ?>"><?= $subarea['nm_subarea']; ?></option>
                  <?php endforeach; ?>
                </select>
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="jenis_proyek" class="control-label"><?= trans('jenis_proyek') ?></label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <select name="jnsproyek" id="jnsproyek" class="form-control" required>
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
              <select class="form-control" id="jnssubproyek" name="jnssubproyek" required>
                <option value="">No Selected</option>
              </select>
          </div>
          </div>
         </div>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="perusahaan" class="control-label"><?= trans('perusahaan') ?></label>
                <select name="perusahaan" id="perusahaan" class="form-control" required>
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
              <select name="dinas" id="dinas" class="form-control" required>
                <option value="">No Selected</option>
                <?php foreach($data_dinas as $dinas): ?>
                  <option value="<?= $dinas['id']; ?>"><?= $dinas['nama_dinas']; ?></option>
                <?php endforeach; ?>
              </select>
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="thn_ang" class="control-label">Tahun Anggaran</label>
                <select name="thn_ang" id="thn_ang" class="form-control" required>
                  <option value="">No Selected</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                  <option value="2026">2026</option>
                  <option value="2027">2027</option>
                  <option value="2028">2028</option>
                  <option value="2029">2029</option>
                  <option value="2030">2030</option>
                  <option value="2031">2031</option>
                  <option value="2032">2032</option>
                  <option value="2033">2033</option>
                  <option value="2034">2034</option>
                </select>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="jns_pph" class="control-label">Jenis PPH</label>
            <select name="jns_pph" id="jns_pph" class="form-control" required>
                  <option value="">No Selected</option>
                  <option value="21">PPH 21</option>
                  <option value="22">PPH 22</option>
                  <option value="23">PPH 23</option>
                </select>
          </div>
          </div>
         </div>

              

        <div class="form-group">
          <div class="col-md-12">
            <input type="submit" name="submit" value="<?= trans('proyek_update') ?>" class="btn btn-primary pull-right btn-sm">
          </div>
        </div>
        <?php echo form_close( ); ?>
      </div>
      <!-- /.box-body -->
    </div>
    <div class="card card-default">
      <div class="card-header">
          <div class="d-inline-block">
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('proyek/addrincian/').$proyek['id_proyek']; ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>  Tambah Rincian</a>
          </div>
      </div>
      <div class="card-body">
           <div class="row">
            <div class="col-md-12">
              <div class="card-body table-responsive">
                <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr>
                      <th>#id</th>
                      <th>jenis pagu</th>
                      <th>tipe proyek</th>
                      <th>tanggal</th>
                      <th>tanggal selesai</th>
                      <th>Nilai</th>
                      <th>no dokumen</th>
                      <th>Dokumen</th>
                      <th>Action</th>
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
  <script>
  // $("#proyek").addClass('menu-open');
  $("#proyek> a").addClass('active');
</script>
<script type="text/javascript">
    $(document).ready(function(){
       get_data_detail();

  function get_data_detail(){
              var id = "<?php echo $proyek['id_proyek'] ?>";
              $.ajax({
                url : "<?php echo site_url('proyek/get_data_detail_edit');?>",
                    method : "POST",
                    data :{
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id :id
                    },
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        $.each(data, function(i, item){
                            jnsproyek= data[i].jns_proyek;
                          // alert(data[i].kd_usulan);
                            $('[name="area"]').val(data[i].kd_area).trigger('change');
                            $('[name="subarea"]').val(data[i].kd_sub_area).trigger('change');
                            $('[name="jnsproyek"]').val(data[i].jns_proyek).trigger('change');
                            $('[name="perusahaan"]').val(data[i].kd_perusahaan).trigger('change');
                            $('[name="dinas"]').val(data[i].kd_dinas).trigger('change');
                            $('[name="thn_ang"]').val(data[i].thn_anggaran).trigger('change');
                            $('[name="jns_pph"]').val(data[i].jns_pph).trigger('change');
                            // document.getElementById("thn_ang").selectedIndex = data[i].thn_anggaran;
                        });
                    }

              });
            }


      $('#jnsproyek').change(function(){ 
            var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = $('.txt_csrfname').val(); // CSRF hash
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('proyek/get_subproyek');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="jnssubproyek"]').empty();
                        
                        $.each(data, function(key, value) {
                            $('select[name="jnssubproyek"]').append('<option value="'+ value.kd_subprojek +'">'+ value.kd_subprojek + '-' + value.nm_subprojek +'</option>');
                        });

                    }
                });
                return false;
            });      
    });

    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('proyek/datatable_json_rincian/'.$proyek["id_proyek"])?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "nm_jns_pagu", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "tipe_proyek", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "no_dokumen", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "tanggal", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "tanggal2", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 7, "name": "dokumen", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
  </script>