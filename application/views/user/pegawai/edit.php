  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              Edit Pegawai </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('pegawai/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List Pegawai</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('pegawai/edit/'.$data_pegawai['kd_pegawai']), 'class="form-horizontal"' )?> 

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id" class="col-md-2 control-label">Area</label>
                    <select name="area" class="form-control">
                    <option value="">No Selected</option>
                    <?php foreach($data_area as $area): ?>
                      <?php if($area['kd_area'] == $data_pegawai['kd_area']): ?>
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
                            <label for="id" class="col-md-6 control-label">Kode Pegawai</label>
                            <input type="text" name="kd_pegawai" id="kd_pegawai" value="<?= $data_pegawai['kd_pegawai']; ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id" class="col-md-6 control-label">Nama Pegawai</label>
                                <input type="text" name="nama" id="nama" value="<?= $data_pegawai['nama']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id" class="col-md-6 control-label">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" value="<?= $data_pegawai['jabatan']; ?>" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id" class="col-md-6 control-label">No. HP</label>
                                <input type="text" name="nohp" id="nohp" value="<?= $data_pegawai['no_hp']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            &nbsp;
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