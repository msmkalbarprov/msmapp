  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              Edit Sub Area </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('subarea/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List Sub Area</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('subarea/edit/'.$subarea['kd_subarea']), 'class="form-horizontal"' )?> 

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id" class="col-md-2 control-label">Area</label>
                    <select name="area" class="form-control">
                    <option value=""><?= trans('select_role') ?></option>
                    <?php foreach($data_area as $area): ?>
                      <?php if($area['kd_area'] == $subarea['kd_area']): ?>
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
                    <select name="subarea" class="form-control">
                    <option value="">No Selected</option>
                    <?php foreach($data_kabupaten as $kabupaten): ?>
                      <?php if($kabupaten['id'] == $subarea['kd_kabupaten']): ?>
                        <option value="<?= $kabupaten['id']; ?>" selected><?= $kabupaten['nm_kabupaten']; ?></option>
                        <?php else: ?>
                          <option value="<?= $kabupaten['id']; ?>"><?= $kabupaten['nm_kabupaten']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

                <div class="form-group">
                  <div class="col-md-12">
                    <input type="submit" name="submit" value="Update" class="btn btn-primary pull-right">
                  </div>
                </div>
                <?php echo form_close(); ?>
              </div>
              <!-- /.box-body -->
            </div>
    </section>
  </div>