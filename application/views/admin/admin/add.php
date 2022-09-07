<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
<style type="text/css">
  .select2-container .select2-selection {
    height: 37px; 
  }

  .tabs {
    display: inline-block;
    margin-left: 40px;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              <?= trans('add_new_admin') ?> </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/admin'); ?>" class="btn btn-success"><i class="fa fa-list"></i> <?= trans('admin_list') ?></a>
          </div>
        </div>
        <div class="card-body">
        <?php $this->load->view('admin/includes/_messages.php') ?>
        <?php echo form_open(base_url('admin/admin/add'), 'class="form-horizontal"');  ?> 
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="username" class="col-md-12 control-label"><?= trans('username') ?></label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="role" class="col-md-12 control-label">Pegawai*</label>
                  <select name="firstname" id="firstname" class="form-control select2" style="width: 100%;">
                    <option value=""><?= trans('select_role') ?></option>
                    <?php foreach($data_pegawai as $pegawai): ?>
                      <option value="<?= $pegawai['kd_pegawai']; ?>"><?= $pegawai['nama']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <input type="hidden" name="lastname" class="form-control" id="lastname" placeholder="">
                </div>
              </div>
          </div>
          <!-- <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="firstname" class="col-md-12 control-label"><?= trans('firstname') ?></label>
                    <input type="text" name="firstname" class="form-control" id="firstname" placeholder="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="lastname" class="col-md-12 control-label"><?= trans('lastname') ?></label>
                    
                </div>
              </div>
          </div> -->
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="mobile_no" class="col-md-12 control-label"><?= trans('mobile_no') ?></label>
                  <input type="number" name="mobile_no" class="form-control" id="mobile_no" placeholder="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email" class="col-md-12 control-label"><?= trans('email') ?></label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="">
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password" class="col-md-12 control-label"><?= trans('password') ?></label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="role" class="col-md-12 control-label">Area*</label>
                  <select name="kd_area" class="form-control">
                    <option value=""><?= trans('select_role') ?></option>
                    <?php foreach($data_area as $area): ?>
                      <option value="<?= $area['kd_area']; ?>"><?= $area['nm_area']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="role" class="col-md-12 control-label"><?= trans('select_admin_role') ?>*</label>
                  <select name="role" class="form-control">
                    <option value=""><?= trans('select_role') ?></option>
                    <?php foreach($admin_roles as $role): ?>
                      <option value="<?= $role['admin_role_id']; ?>"><?= $role['admin_role_title']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="role" class="col-md-12 control-label">Avatar*</label>
                    <select name="avatar" class="form-control">
                    <option value="profile1.png" style="background-image:base_url('/assets/dist/img/default.png');">Default</option>
                      <option value="profile1.png" style="background-image:base_url('/assets/dist/img/profile1.png');">Avatar 1</option>
                      <option value="profile2.png" style="background-image:base_url('/assets/dist/img/profile2.png');">Avatar 2</option>
                      <option value="profile3.png" style="background-image:base_url('/assets/dist/img/profile3.png');">Avatar 3</option>
                      <option value="profile4.png" style="background-image:base_url('/assets/dist/img/profile4.png');">Avatar 4</option>
                      <option value="profile5.png" style="background-image:base_url('/assets/dist/img/profile5.png');">Avatar 5</option>
                      <option value="profile6.png" style="background-image:base_url('/assets/dist/img/profile6.png');">Avatar 6</option>
                    </select>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                      <input type="submit" name="submit" value="<?= trans('add_admin') ?>" class="btn btn-primary pull-right">
                </div>
            </div>
          </div>
        <?php echo form_close(); ?>
 
        </div>
      </div>
    </section> 
  </div>
  <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
  <script>
    $('.select2').select2()
  </script>