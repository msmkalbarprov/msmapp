  <!-- Content Wrapper. Contains page content -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
    <style type="text/css">
.select2-container .select2-selection {
  height: 37px; 
}
    </style>
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              Tambah Sub Area </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('sub-area'); ?>" class="btn btn-success btn-sm"><i class="fa fa-list"></i> List Sub Area</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('sub-area/add/'), 'class="form-horizontal"' )?> 

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id" class="col-md-2 control-label">Area</label>
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
                    <label for="id" class="col-md-6 control-label">Provinsi/Kabupaten/Kota</label>
                    <select name="subarea" class="form-control select2">
                    <option value="">No Selected</option>
                    <?php foreach($data_kabupaten as $kabupaten): ?>
                          <option value="<?= $kabupaten['id']; ?>"><?= $kabupaten['nm_kabupaten']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

                <div class="form-group">
                  <div class="col-md-12">
                    <input type="submit" name="submit" value="Simpan" class="btn btn-primary pull-right">
                  </div>
                </div>
                <?php echo form_close(); ?>
              </div>
              <!-- /.box-body -->
            </div>
    </section>
  </div>

  <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
  <script>
  $(document).ready(function(){
    $('.select2').select2()
  });
</script>