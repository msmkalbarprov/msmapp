  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
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
            <a href="<?= base_url('proyek'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  <?= trans('proyek_list') ?></a>
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>

         <?php echo form_open(base_url('proyek/add'), 'class="form-horizontal"');  ?> 
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label"><?= trans('area') ?></label>
                <select name="area" id ="area" class="form-control" required>
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
              <select name="subarea"  id="subarea" class="form-control" required>
                <option value="">No Selected</option>
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
              <select class="form-control" id="dinas" name="dinas" required>
                <option value="">No Selected</option>
              </select>
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="jnspagu" class="control-label"><?= trans('jnspagu') ?></label>
                <select name="jnspagu" id="jnspagu" class="form-control" required>
                  <option value="1">Target</option>
                  <!-- <?php foreach($data_pagu as $jnspagu): ?> -->
                    <!-- <option value="<?= $jnspagu['id']; ?>"><?= $jnspagu['nama']; ?></option> -->
                  <!-- <?php endforeach; ?> -->
                </select>
            </div>
          </div>
          <div class="col-md-3">
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
              <label for="nilai" class="control-label">Nama Paket pekerjaan</label>
              <input type="text" name="paketproyek" class="form-control" id="paketproyek" placeholder="Nama Paket pekerjaan" required>
          </div>
          </div>
         </div>


          <div class="row">
          <div class="col-md-3">
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
          <div class="col-md-3">
            <label for="loc" class="control-label">LOC <small>Level of Confidence</small></label>
             <div class="input-group">
                  
                  <input type="text" name="loc" maxlength="5" class="form-control" id="loc" placeholder="0.00" style="text-align:right;" onkeypress="return(currencyFormat(this,',','.',event))"  required>
                  <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
            <label for="nilai" class="control-label"><?= trans('nilai') ?> Target</label>
              <input type="text" name="nilai" class="form-control" id="nilai" placeholder="Nilai" style="text-align:right;" onkeypress="return(currencyFormat(this,',','.',event))"  required>
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="jns_pph" class="control-label">Keterangan</label>
                <textarea name="catatan" id="catatan" class="form-control" rows="2"></textarea>
            </div>
          </div>
         </div>

        <div class="form-group">
          <div class="col-md-12">
            <input type="submit" name="submit" value="Simpan" class="btn btn-primary pull-right">
          </div>
        </div>
        <?php echo form_close( ); ?>
      </div>
      <!-- /.box-body -->
    </div>
  </section> 
</div>
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/dist/js/jquery-3.3.1.js'?>"></script> -->
  <script>
  // $("#proyek").addClass('menu-open');
  $("#proyek> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    get_subareacombo();
    function get_subareacombo(){ 
                var subarea=document.getElementById("area").value;
                $.ajax({
                    url : "<?php echo site_url('proyek/get_area');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: subarea},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="subarea"]').empty();
                        
                        $.each(data, function(key, value) {
                            $('select[name="subarea"]').append('<option value="'+ value.kd_subarea +'">'+ value.nm_subarea +'</option>');
                        });

                    }
                });
                return false;
            };

    $('#area').change(function(){ 
                var subarea=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('proyek/get_area');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: subarea},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="subarea"]').empty();
                        
                        $.each(data, function(key, value) {
                            $('select[name="subarea"]').append('<option value="'+ value.kd_subarea +'">'+ value.nm_subarea +'</option>');
                        });

                    }
                });
                return false;
            });

    $('#subarea').change(function(){ 
                var subarea=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('proyek/get_dinas');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: subarea},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="dinas"]').empty();
                        
                        $.each(data, function(key, value) {
                            $('select[name="dinas"]').append('<option value="'+ value.id +'">'+ value.nama_dinas +'</option>');
                        });

                    }
                });
                return false;
            });


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
</script>