  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              Tambah Sub Proyek </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('sub-proyek'); ?>" class="btn btn-success"><i class="fa fa-list"></i> list Sub Proyek</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('sub-proyek/edit/'), 'class="form-horizontal"' )?> 
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="id" class=" control-label">Proyek</label>
                    <select name="proyek" class="form-control">
                    <option value="">No Selected</option>
                    <?php foreach($data_proyek as $projek): ?>
                        <?php if($projek['kd_projek'] == $aplikasi['kd_projek']): ?>
                        <option value="<?= $projek['kd_projek']; ?>" selected><?= $projek['nm_projek']; ?></option>
                        <?php else: ?>
                          <option value="<?= $projek['kd_projek']; ?>"><?= $projek['nm_projek']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="id" class=" control-label">Kode Sub Proyek</label>
                    <input type="text" name="kode"  class="form-control" id="kode" value="<?= $aplikasi['kd_subprojek']; ?>" placeholder="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="id" class=" control-label">Nama Sub Proyek</label>
                    <input type="text" name="nama"  class="form-control" id="nama" value="<?= $aplikasi['nm_subprojek']; ?>"  placeholder="">
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