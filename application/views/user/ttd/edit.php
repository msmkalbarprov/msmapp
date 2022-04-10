  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              Edit Penandatangan </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('ttd/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List Area</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('ttd/edit/'.$tandatangan['kd_area']), 'class="form-horizontal"' )?> 

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id" class="col-md-2 control-label">Area</label>
                    <select name="area" class="form-control" readonly>
                    <option value=""><?= trans('select_role') ?></option>
                    <?php foreach($data_area as $area): ?>
                      <?php if($area['kd_area'] == $tandatangan['kd_area']): ?>
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
                    <label for="id" class="col-md-6 control-label">Mengajukan</label>
                    <select name="mengajukan" class="form-control">
                    <option value="">No Selected</option>
                    <?php foreach($data_ttd as $ttd1): ?>
                      <?php if($ttd1['nama'] == $tandatangan['mengajukan']): ?>
                        <option value="<?= $ttd1['nama']; ?>" selected><?= $ttd1['nama']; ?></option>
                        <?php else: ?>
                          <option value="<?= $ttd1['nama']; ?>"><?= $ttd1['nama']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id" class="col-md-6 control-label">Mengetahui</label>
                    <select name="mengetahui" class="form-control">
                    <option value="">No Selected</option>
                    <?php foreach($data_ttd as $ttd2): ?>
                      <?php if($ttd2['nama'] == $tandatangan['mengetahui']): ?>
                        <option value="<?= $ttd2['nama']; ?>" selected><?= $ttd2['nama']; ?></option>
                        <?php else: ?>
                          <option value="<?= $ttd2['nama']; ?>"><?= $ttd2['nama']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id" class="col-md-6 control-label">Menyetujui</label>
                    <select name="menyetujui" class="form-control">
                    <option value="">No Selected</option>
                    <?php foreach($data_ttd as $ttd3): ?>
                      <?php if($ttd3['nama'] == $tandatangan['menyetujui']): ?>
                        <option value="<?= $ttd3['nama']; ?>" selected><?= $ttd3['nama']; ?></option>
                        <?php else: ?>
                          <option value="<?= $ttd3['nama']; ?>"><?= $ttd3['nama']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id" class="col-md-6 control-label">Nama Bank</label>
                    <input type="text" name="nm_bank" id="nm_bank" class="form-control" value="<?= $tandatangan['nm_bank1']; ?>">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id" class="col-md-6 control-label">No. Rekening</label>
                    <input type="text" name="no_rek" id="no_rek" class="form-control" value="<?= $tandatangan['rekening1']; ?>">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id" class="col-md-6 control-label">Nama Pemilik</label>
                    <input type="text" name="nm_pemilik" id="nm_pemilik" class="form-control" value="<?= $tandatangan['nama_rekening1']; ?>">
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