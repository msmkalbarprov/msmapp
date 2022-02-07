  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              Edit Dinas </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('dinas/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List Dinas</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('dinas/add/'), 'class="form-horizontal"' )?> 

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id" class="col-md-2 control-label"><?= trans('id') ?></label>
                    <input type="text" name="id"  class="form-control" id="id" readonly="true" placeholder="Terisi otomatis">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nama_dinas" class="col-md-2 control-label">Nama Dinas</label>
                    <input type="text" name="nama_dinas"  class="form-control" id="nama_dinas" placeholder="">
                  </div>
                </div>
              </div>

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
                    <label for="id" class="col-md-2 control-label">Sub Area</label>
                    <select name="subarea" class="form-control">
                    <option value="">No Selected</option>
                    <?php foreach($data_subarea as $subarea): ?>
                          <option value="<?= $subarea['kd_subarea']; ?>"><?= $subarea['nm_subarea']; ?></option>
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